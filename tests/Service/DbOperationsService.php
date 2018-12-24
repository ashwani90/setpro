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

/**
 * Class to handle db operations.
 * @package App\Tests\Service
 */
class DbOperationsService
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

    public function deleteDocument()
    {
        self::$dm = $this->getMongodbDoctrine();

    }
}