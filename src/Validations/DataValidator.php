<?php
/**
 * Validation of the data.
 *
 * File contains method to validate content data depending on the parameters provided.
 *
 * @category   Validations
 * @author     Ashwani
 * @since      0.0.0
 */

namespace App\Validations;

use App\Constants\ValidationConstants;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;

/**
 * Class to support validation of the data
 * @package App\Validations
 */
class DataValidator
{
    /**
     * Array to store all errors
     *
     * @var array $errors
     */
    protected static $errors = [];

    /**
     * Boolean value to keep status of error within the file.
     *
     * @var bool $hasError
     */
    protected static $hasError = false;

    /**
     * @var DataValidator $instance
     */
    private static $instance;

    /**
     * Function to get instance of this class
     *
     * @return DataValidator
     */
    public static function getInstance() : DataValidator
    {
        // Create it if it doesn't exist.
        if (!self::$instance) {
            self::$instance = new DataValidator();
        }

        return self::$instance;
    }

    /**
     * Function to validate data based on rules provided.
     *
     * @param array $data
     * @param array $rules
     * @param array|null $messages
     *
     * @return DataValidator
     *
     * @throws \Exception
     */
    public static function validate(array $data, array $rules, array $messages = null)
    {
        // Create it if it doesn't exist.
        $validator = self::getInstance();

        //Create an instance of the translator
        global $kernel;
        $translator = $kernel->getContainer()->get('translator');

        $errors = [];

        //Loop through all of the provided rules
        foreach ($rules as $k => $rule) {

            //Separate multiple rules and then validate them within the loop
            $rs = explode('|', $rule);
            foreach ($rs as $r) {

                //If there is rule to validate and no pending errors
                if (!empty($r) && !isset($validator::$errors[$k])) {

                    switch ($r) {
                        case ValidationConstants::CONSTRAINT_REQUIRED:
                            //Check the data to not be empty
                            (!(isset($data[$k]) && !empty($data[$k])))
                            && ($validator::$errors[$k] = self::getErrorMessage($k, $messages, ValidationConstants::CONSTRAINT_REQUIRED, $translator));

                            break;

                        case ValidationConstants::CONSTRAINT_STRING:
                            //Check for type string
                            (!is_string($data[$k]))
                                && ($validator::$errors[$k] = self::getErrorMessage($k, $messages, ValidationConstants::CONSTRAINT_STRING, $translator));

                            break;

                        case ValidationConstants::CONSTRAINT_NUMERIC:
                            //Check for type numeric
                            (!is_numeric($data[$k]))
                                && ($validator::$errors[$k] = self::getErrorMessage($k, $messages, ValidationConstants::CONSTRAINT_NUMERIC, $translator));

                            break;

                        case ((strpos($r, ValidationConstants::CONSTRAINT_MAX) !== false) ? $r : false):

                            $sr = explode(':', $r);
                            $ml = (int)end($sr);

                            //Check for valid length
                            if ($ml < 0) {
                                throw new \Exception($translator->trans(ValidationConstants::INCORRECT_MAX_VALUE));
                            }

                            //Check for maximum length of the string
                            (strlen($data[$k]) > $ml)
                            && ($validator::$errors[$k] = self::getErrorMessage($k, $messages, ValidationConstants::CONSTRAINT_MAX, $translator));

                            break;

                        case ((strpos($r, ValidationConstants::CONSTRAINT_MIN) !== false) ? $r : false):
                            $sr = explode(':', $r);
                            $ml = (int)end($sr);

                            //Check for valid length value
                            if ($ml < 0) {
                                throw new \Exception($translator->trans(ValidationConstants::INCORRECT_MIN_VALUE));
                            }

                            //Check for minimum length
                            (strlen($data[$k]) < $ml)
                                && ($validator::$errors[$k] = self::getErrorMessage($k, $messages, ValidationConstants::CONSTRAINT_MIN, $translator));

                            break;

                        case ((strpos($r, ValidationConstants::CONSTRAINT_DIGITS) !== false) ? $r : false):
                            $sr = explode(':', $r);
                            $ml = (int)end($sr);

                            //Check for valid length of digits
                            if ($ml < 0) {
                                throw new \Exception($translator->trans(ValidationConstants::INCORRECT_DIGITS_VALUE));
                            }

                            //Check for value to be number and also not contain decimal part
                            (!is_numeric($data[$k]) || strlen((int)$data[$k]) !== $ml)
                                && ($validator::$errors[$k] = self::getErrorMessage($k, $messages, ValidationConstants::CONSTRAINT_DIGITS, $translator));

                            break;

                    }
                }
            }
        }

        $validator::$hasError = (count($validator::$errors)) ? true : false;

        return $validator;
    }

    /**
     * Function to send boolean value if validation pass
     *
     * @return bool
     */
    public function fails()
    {
        return self::$hasError;
    }

    /**
     * Function to get all validation errors
     *
     * @return array
     */
    public function validationErrors()
    {
        return self::$errors;
    }

    /**
     * Function to return error message based on validation type
     *
     * @param string $key
     * @param array $messages
     * @param string $validationConstant
     * @param Translator $translator
     *
     * @return string
     */
    public function getErrorMessage($key, $messages, $validationConstant, $translator)
    {
        return (isset($messages[$key . '.' . $validationConstant]))
                    ? $messages[$key . '.' . $validationConstant]
                    : $translator->trans($validationConstant);
    }
}