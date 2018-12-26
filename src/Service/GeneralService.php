<?php
/**
 * Service for general functions.
 *
 * File contains general methods which will be used by most of the apis.
 *
 * @category   Service
 * @author     Ashwani
 * @since      0.0.0
 */

namespace App\Service;

use Doctrine\ODM\MongoDB\DocumentManager;
use Psr\Log\LoggerInterface;

/**
 * Class containing general methods
 * @category Service
 * @package App\Service
 */
class GeneralService
{
    /**
     * @var DocumentManager $mongo
     */
    private $mongo;

    /**
     * @var LoggerInterface $logger
     */
    private $logger;

    /**
     * GeneralService constructor.
     *
     * @param DocumentManager $mongo
     * @param LoggerInterface $logger
     */
    public function __construct(DocumentManager $mongo, LoggerInterface $logger)
    {
        $this->mongo = $mongo;
        $this->logger = $logger;
    }

    /**
     * Function to fetch all of the expected properties from the given parameters.
     *
     * @param array $propertyArray
     * @param object $requestObject
     *
     * @return mixed
     */
    public function fetchProperties($propertyArray, $requestObject)
    {
        //Set status to be false initially
        $returnData['status'] = false;

        try {
            $resultPropertyArray = array();

            //Loop through the property array
            foreach ($propertyArray as $property) {

                //Ignore optional property but validate presence of compulsory property
                if (!$property['optional'] && null === $requestObject->get($property['value'])) {
                    throw new \Exception('Invalid argument for ' . $property['value']);
                }

                //If value is not null then move value to the result array
                if (null !== $requestObject->get($property['value'])) {
                    $resultPropertyArray[$property['value']] = $requestObject->get($property['value']);
                }

            }

            //Set status to be true and return the result array
            $returnData['status'] = true;
            $returnData['resultPropertyArray'] = $resultPropertyArray;
        } catch (\Exception $e) {
            $this->logger->info($e->getMessage() . ' Error in function : ' . __FUNCTION__);
        }

        return $returnData;
    }

    /**
     * Function to dynamically set all of the properties of the object.
     *
     * @param array $propertiesArray
     * @param string $className
     *
     * @return mixed
     */
    public function setObjectProperties($propertiesArray, $className)
    {
        //Set status to be false initially
        $returnData['status'] = false;

        try {
            //Create object of the given class type
            $customObject = new $className;

            //Set properties dynamically
            foreach ($propertiesArray as $key => $property) {
                $functionName = 'set' . ucfirst($key);
                $customObject->{$functionName}($property);
            }

            //Save data to the database
            $this->mongo->persist($customObject);
            $this->mongo->flush();

            $returnData['status'] = true;

        } catch (\Exception $e) {
            $this->logger->info($e->getMessage() . ' Error in function : ' . __FUNCTION__);
        }

        return $returnData;
    }

    /**
     * Function to fetch a single object with given class and params.
     *
     * @param array $propertyArray
     * @param string $className
     *
     * @return mixed
     */
    public function getSingleObject($propertyArray, $className)
    {
        //Set status to be false initially
        $returnData['status'] = false;

        try {
            //Find object with given params
            $object = $this->mongo->getRepository($className)->findOneBy($propertyArray);

            //Set status true and return the object
            $returnData['status'] = true;
            $returnData['resultObject'] = $object;
        } catch (\Exception $e) {
            $this->logger->info($e->getMessage() . ' Error in function : ' . __FUNCTION__);
        }

        return $returnData;
    }
}