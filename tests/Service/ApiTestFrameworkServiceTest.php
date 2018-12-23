<?php
/**
 * File as a framework to make a request the api.
 *
 * This file contains the framework to make a http request to the apis.
 * All apis request test cases will be passed through this file's methods.
 *
 * @category Service
 * @author Ashwani
 * @since 0.0.0
 *
 */

namespace App\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class to create a framework for api requests
 * @category Service
 * @package App\Tests\Service
 */
class ApiTestFrameworkServiceTest extends WebTestCase
{
    /**
     * Function takes request parameters and returns response
     *
     * @param string $method
     * @param string $uri
     * @param array $parameters
     * @param string $hostName
     *
     * @return array
     */
    public function apiTestFramework($method, $uri, $parameters, $hostName)
    {
        $client = static::createClient();
        $client->request($method, $uri, $parameters);
        $client->setServerParameter('HTTP_HOST', $hostName);
        $response = $client->getResponse();

        return json_decode($response->getContent(), true);
    }
}