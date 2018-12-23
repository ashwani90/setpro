<?php
/**
 * Created by PhpStorm.
 * User: mindfire
 * Date: 22/12/18
 * Time: 6:03 PM
 */

namespace App\Tests\Controller\Apis;


use App\Tests\Constants\ApiRequestConstants;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Tests\Constants\GeneralConstants;

class LoginControllerTest extends WebTestCase
{
    protected static $dm;

    public function testLoginAction()
    {
        $method = 'GET';
        $uri = '/login';
        $parameters = ApiRequestConstants::LOGIN_PARAMETERS_VALID;

        $client = static::createClient();
        $client->request($method, $uri, $parameters);
        $client->setServerParameter('HTTP_HOST', 'local.setpro.com' );
        $response = $client->getResponse();

        $response = json_decode($response->getContent(), true);

        $this->assertEquals(true, $response['success']);
        $this->assertEquals('Sohel', $response['name']);
        $this->assertEquals('sohel@gmail.com', $response['email']);
        $this->assertEquals('8746382938', $response['phoneNumber']);
        $this->assertEquals('Nandan Vihar', $response['address']);
    }
}