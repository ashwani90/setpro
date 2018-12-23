<?php
/**
 * Created by PhpStorm.
 * User: mindfire
 * Date: 19/12/18
 * Time: 9:17 PM
 */

namespace App\Controller\Apis;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Post;
use Hoa\Exception\Exception;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class RegisterController extends FOSRestController
{
    private $expectedValues = array(
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

            //Validation code

            //Set Properties and save data
            $result = $generalService->setObjectProperties($properties['resultPropertyArray'], 'App\Document\User');

            if (!$result['status']) {
                throw new \Exception('Unable to store data.');
            }

            $properties['resultPropertyArray'] = array(
                'email' => $properties['resultPropertyArray']['email'],
                'password' => $properties['resultPropertyArray']['password']
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