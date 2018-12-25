<?php
/**
 * Login api
 *
 * File contains method to support user sign in into the platform.
 *
 * @category   Controller
 * @author     Ashwani
 * @since      0.0.0
 */

namespace App\Controller\Apis;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class for login api.
 * @package App\Controller\Apis
 */
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
            unset($properties['resultPropertyArray']['password']);

            //Set Properties and save data
            $resultData = $generalService->getSingleObject($properties['resultPropertyArray'], 'App\Document\User');

            $result = $resultData['resultObject'];

            if (!$resultData['status'] || !password_verify($request->query->get('password'), $result->getPassword())) {
                throw new \Exception('Invalid credentials');
            }

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