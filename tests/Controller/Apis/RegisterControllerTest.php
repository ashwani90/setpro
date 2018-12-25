<?php
/**
 * Test register api controller.
 *
 * File to test a register api.
 * Multiple api parameters are passed and test register api.
 *
 * @category Controller
 * @author Ashwani
 * @since 0.0.0
 *
 */

namespace App\Tests\Controller\Apis;

use App\Tests\Service\DbOperationsService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Tests\Constants\GeneralConstants;
use App\Tests\Service\ApiTestFrameworkServiceTest;
use App\Tests\Constants\ApiRequestConstants;
use App\Document\User;

/**
 * Class to test register api
 * @category Controller
 * @package App\Tests\Controller/Apis
 */
class RegisterControllerTest extends WebTestCase
{
    /**
     * Function to test register api
     */
    public function testRegisterAction()
    {
        //Create objects to the necessary services
        $apiTestFramework = new ApiTestFrameworkServiceTest();
        $dbOperationsService = new DbOperationsService();

        //Get all general constants
        $method = GeneralConstants::HTTP_POST_METHOD;
        $hostName = GeneralConstants::HTTP_HOST_NAME;
        $uri = GeneralConstants::REGISTER_API_URL;
        $params = GeneralConstants::API_PARAMS_NAME;
        $expectedValues = GeneralConstants::API_EXPECTED_NAME;

        //Get all test request parameters
        $allParameters = ApiRequestConstants::REGISTRATION_PARAMETERS_VALID;

        //Loop through all the request test parameters
        foreach ($allParameters as $parameter) {

            //Call framework function to get response
            $response = $apiTestFramework->apiTestFramework($method, $uri, $parameter[$params], $hostName);

            //Assert response with the expected values
            $this->assertEquals(true, $response['success']);
            $this->assertEquals($parameter[$expectedValues]['name'], $response['name']);
            $this->assertEquals($parameter[$expectedValues]['email'], $response['email']);
            $this->assertEquals($parameter[$expectedValues]['phoneNumber'], $response['phoneNumber']);
            $this->assertEquals($parameter[$expectedValues]['address'], $response['address']);

            //Deleting created entities
            $dbOperationsService->deleteDocument(array('email' => $response['email']), 'App\Document\User');
        }
    }
}