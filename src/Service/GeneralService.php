<?php
/**
 * Created by PhpStorm.
 * User: mindfire
 * Date: 19/12/18
 * Time: 10:47 PM
 */

namespace App\Service;


use Doctrine\ODM\MongoDB\DocumentManager;

use Psr\Log\LoggerInterface;

class GeneralService
{
    private $mongo;

    private $logger;

    public function __construct(DocumentManager $mongo, LoggerInterface $logger)
    {
        $this->mongo = $mongo;
        $this->logger = $logger;
    }

    public function fetchProperties($propertyArray, $requestObject)
    {
        $returnData['status'] = false;

        try {
            $resultPropertyArray = array();

            foreach ($propertyArray as $property) {

                if (!$property['optional'] && null === $requestObject->get($property['value'])) {
                    throw new \Exception('Invalid argument for ' . $property['value']);
                }

                if (null !== $requestObject->get($property['value'])) {
                    $resultPropertyArray[$property['value']] = $requestObject->get($property['value']);
                }

            }

            $returnData['status'] = true;
            $returnData['resultPropertyArray'] = $resultPropertyArray;
        } catch (\Exception $e) {
            $this->logger->info($e->getMessage() . ' Error in function : ' . __FUNCTION__);
        }

        return $returnData;
    }

    public function setObjectProperties($propertiesArray, $className)
    {
        $returnData['status'] = false;

        try {
            $customObject = new $className;

            foreach ($propertiesArray as $key => $property) {
                $functionName = 'set' . ucfirst($key);
                $customObject->{$functionName}($property);
            }

            $this->mongo->persist($customObject);
            $this->mongo->flush();

            $returnData['status'] = true;

        } catch (\Exception $e) {
            $this->logger->info($e->getMessage() . ' Error in function : ' . __FUNCTION__);
        }

        return $returnData;
    }

    public function getSingleObject($propertyArray, $className)
    {
        $returnData['status'] = false;

        try {
            $object = $this->mongo->getRepository($className)->findOneBy($propertyArray);

            $returnData['status'] = true;
            $returnData['resultObject'] = $object;
        } catch (\Exception $e) {
            $this->logger->info($e->getMessage() . ' Error in function : ' . __FUNCTION__);
        }

        return $returnData;
    }
}