<?php
/**
 * Created by PhpStorm.
 * User: mindfire
 * Date: 21/12/18
 * Time: 11:15 AM
 */

namespace App\Tests\Service;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

class GeneralServiceTest extends WebTestCase
{
    protected static $dm;

    private function getContainer()
    {
        $kernel = self::bootKernel();
        return $kernel->getContainer();
    }

    private function getMongodbDoctrine()
    {
        $container = $this->getContainer();
        return $container->get('doctrine_mongodb')->getManager();
    }

    private function getServiceObject()
    {
        $container = $this->getContainer();
        return $container->get('app.general_service');;
    }

    public function testFetchProperties()
    {
        self::$dm = $this->getMongodbDoctrine();

        $serviceObject = $this->getServiceObject();

        $expectedValues = array(
            array ('value' => 'name', 'optional' => false),
            array ('value' => 'email', 'optional' => false),
            array ('value' => 'password', 'optional' => false),
            array ('value' => 'phoneNumber', 'optional' => true),
            array ('value' => 'address', 'optional' => false),
        );

        $request = new Request();
        $request->request->set('name', 'Sohel');
        $request->request->set('email', 'sohel@gmail.com');
        $request->request->set('password', 'sihel');
        $request->request->set('phoneNumber', '8746382938');
        $request->request->set('address', 'Nandan Vihar');

        $result = $serviceObject->fetchProperties($expectedValues, $request->request);
        $this->assertEquals(true, $result['status']);
    }

    public function testSetObjectProperties()
    {
        self::$dm = $this->getMongodbDoctrine();

        $serviceObject = $this->getServiceObject();

        $propertiesArray = array(
            'name' => 'Sohel',
            'email' => 'sohel@gmail.com',
            'password' => 'sihel',
            'phoneNumber' => '8746382938',
            'address' => 'Nandan Vihar',
        );

        $result = $serviceObject->setObjectProperties($propertiesArray, 'App\Document\User');

        dump($result);
        $this->assertEquals(true, $result['status']);
    }

    public function testGetSingleObject()
    {
        self::$dm = $this->getMongodbDoctrine();

        $serviceObject = $this->getServiceObject();

        $propertiesArray = array(
            'email' => 'sohel@gmail.com',
            'password' => 'sihel',
        );

        $result = $serviceObject->getSingleObject($propertiesArray, 'App\Document\User');

        dump($result);
        $this->assertEquals(true, $result['status']);
        $this->assertEquals('Sohel', $result['resultObject']->getName());
        $this->assertEquals('sohel@gmail.com', $result['resultObject']->getEmail());
        $this->assertEquals('8746382938', $result['resultObject']->getPhoneNumber());
        $this->assertEquals('Nandan Vihar', $result['resultObject']->getAddress());
    }
}