<?php
/**
 * Created by PhpStorm.
 * User: mindfire
 * Date: 19/12/18
 * Time: 8:45 PM
 */

namespace App\Controller\Apis;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends FOSRestController
{
    public $expectedValues = array(
        array ('value' => 'email', 'optional' => true),
        array ('value' => 'password', 'optional' => false),
        array ('value' => 'phoneNumber', 'optional' => true),
    );

    /**
     * @param LoggerInterface $logger
     * @param Request $request
     *
     * @return JsonResponse
     *
     * @Rest\Get("login")
     */
    public function loginAction(Request $request, LoggerInterface $logger)
    {
        $returnData['success'] = false;

        try {
            $generalService = $this->container->get('app.general_service');

            $properties = $generalService->fetchProperties($this->expectedValues, $request->query);

            //Throw exception if some argument is missing
            if (!$properties['status']) {
                throw new \Exception('Some argument missing');
            }

            //Validation code

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