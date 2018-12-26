<?php
/**
 * Register api
 *
 * File contains method to support user sign up into the platform.
 *
 * @category   Controller
 * @author     Ashwani
 * @since      0.0.0
 */

namespace App\Controller\Apis;

use App\Validations\DataValidator;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class for registration api.
 * @category Controller
 * @package App\Controller\Apis
 */
class RegisterController extends FOSRestController
{
    /**
     * @var array $expectedValues
     */
    public $expectedValues = array(
        array ('value' => 'name', 'optional' => false),
        array ('value' => 'email', 'optional' => false),
        array ('value' => 'password', 'optional' => false),
        array ('value' => 'phoneNumber', 'optional' => true),
        array ('value' => 'address', 'optional' => false),
    );

    /**
     * @param LoggerInterface $logger
     * @param Request $request
     *
     * @return JsonResponse
     *
     * @Rest\Post("register")
     */
    public function registerAction(Request $request, LoggerInterface $logger)
    {
        $returnData['success'] = false;

        try {
            $generalService = $this->container->get('app.general_service');

            $properties = $generalService->fetchProperties($this->expectedValues, $request->request);

            //Throw exception if some argument is missing
            if (!$properties['status']) {
                throw new \Exception('Some argument missing');
            }

            $hasError = DataValidator::validate($properties['resultPropertyArray'],
                array('name' => 'required | max:105',
                    'email' => 'required | max:105',
                    'password' => 'required',
                    'phoneNumber' => 'required | digits:10',
                    'address' => 'required'
                )
            )->fails();

            if ($hasError) {
                throw new \Exception('Data is not valid');
            }

            //Set Properties and save data
            $result = $generalService->setObjectProperties($properties['resultPropertyArray'], 'App\Document\User');

            if (!$result['status']) {

                throw new \Exception('Unable to store data.');
            }

            $properties['resultPropertyArray'] = array(
                'email' => $properties['resultPropertyArray']['email'],
            );

            //Set Properties and save data
            $result = $generalService->getSingleObject($properties['resultPropertyArray'], 'App\Document\User');

            if (!$result['status']) {
                throw new \Exception('Unable to fetch data.');
            }

            $result = $result['resultObject'];

            $returnData['success'] = true;
            $returnData['name'] = $result->getName() ? $result->getName() : '';
            $returnData['email'] = $result->getEmail() ? $result->getEmail() : '';
            $returnData['phoneNumber'] = $result->getPhoneNumber() ? $result->getPhoneNumber() : '';
            $returnData['roles'] = $result->getRoles() ? $result->getRoles() : '';
            $returnData['address'] = $result->getAddress() ? $result->getAddress() : '';

        } catch (\Exception $e) {
            $logger->info($e->getMessage() . ' Error in function : ' . __FUNCTION__);
            $returnData['errorMessage'] = $e->getMessage();
        }

        return new JsonResponse($returnData);
    }
}