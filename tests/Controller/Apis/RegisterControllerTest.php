<?php
/**
 * Test register api controller.
 *
 * File to test a register api.
 * Multiple api parameters are passed and test register api.
 *
 * @category Service
 * @author Ashwani
 * @since 0.0.0
 *
 */

namespace App\Tests\Controller\Apis;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Tests\Constants\GeneralConstants;
use App\Tests\Service\ApiTestFrameworkServiceTest;
use App\Tests\Constants\ApiRequestConstants;

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
        $apiTestFramework = new ApiTestFrameworkServiceTest();

        $method = GeneralConstants::HTTP_POST_METHOD;
        $hostName = GeneralConstants::HTTP_HOST_NAME;
        $uri = GeneralConstants::REGISTER_API_URL;

        $allParameters = ApiRequestConstants::REGISTRATION_PARAMETERS_VALID;
dump($allParameters);die;
        foreach ($allParameters as $parameters) {

            $response = $apiTestFramework->apiTestFramework($method, $uri, $parameters, $hostName);

            $this->assertEquals(true, $response['success']);
            $this->assertEquals('Sohel', $response['name']);
            $this->assertEquals('sohel@gmail.com', $response['email']);
            $this->assertEquals('8746382938', $response['phoneNumber']);
            $this->assertEquals('Nandan Vihar', $response['address']);
        }
    }
}