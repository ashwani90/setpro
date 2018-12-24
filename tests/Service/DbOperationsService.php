<?php
/**
 * File to handle database operations.
 *
 * File to clear up the mess created by the test functions.
 * Such as deleting an entity after it has been created by some test function.
 * Ex: In case of register we do not want the user to exist after all the test case has been passed
 * otherwise it will fail when the tests will run again.
 *
 * @category Service
 * @author Ashwani
 * @since 0.0.0
 */

namespace App\Tests\Service;

use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class to handle db operations.
 * @package App\Tests\Service
 */
class DbOperationsService extends WebTestCase
{

    /**
     * @var DocumentManager $dm
     */
    protected $dm = null;

    /**
     * Function to get container
     *
     * @return null|\Symfony\Component\DependencyInjection\ContainerInterface
     */
    private function getContainer()
    {
        $kernel = self::bootKernel();
        return $kernel->getContainer();
    }

    /**
     * Function to get Document manager
     *
     * @return DocumentManager
     */
    private function getMongodbDoctrine()
    {
        $container = $this->getContainer();
        return $container->get('doctrine_mongodb')->getManager();
    }

    /**
     * Function to delete a document with given params and class name
     *
     * @param $params
     * @param $className
     *
     * @return mixed
     */
    public function deleteDocument($params, $className)
    {
        try {
            //Intially set succes false
            $result['success'] = false;

            //Get document manager
            $this->dm = $this->getMongodbDoctrine();

            //Find the required object
            $object = $this->dm->getRepository($className)->findOneBy($params);

            //Remove the object
            $this->dm->remove($object);
            $this->dm->flush();

            //Set success to be true
            $result['success'] = true;
        } catch (\Exception $e) {
            $result['errorMessage'] = $e->getMessage();
        }

        return $result;
    }
}