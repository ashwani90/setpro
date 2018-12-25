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

        $errors = [];

        //Loop through all of the provided rules
        foreach ($rules as $k => $rule) {

            //Separate multiple rules and then validate them within the loop
            $rs = explode('|', $rule);
            foreach ($rs as $r) {

                //If there is rule to validate and no pending errors
                if (!empty($r) && !isset($validator::$errors[$k])) {

                    switch ($r) {
                        case 'required':
                            //Check the data to not be empty
                            if (!(isset($data[$k]) && !empty($data[$k]))) {
                                $validator::$hasError = true;
                                $validator::$errors[$k] = (isset($messages[$k . 'required'])) ?
                                    $messages[$k . 'required'] : 'This field is required.';
                            }
                            break;

                        case 'string':
                            //Check for type string
                            if (!is_string($data[$k])) {
                                $validator::$hasError = true;
                                $validator::$errors[$k] = (isset($messages[$k . 'string'])) ?
                                    $messages[$k . 'string'] : 'This field must be string.';
                            }
                            break;

                        case 'numeric':
                            //Check for type numeric
                            if (!is_numeric($data[$k])) {
                                $validator::$hasError = true;
                                $validator::$errors[$k] = (isset($messages[$k . 'numeric'])) ?
                                    $messages[$k . 'numeric'] : 'The field under validation must be numeric.';
                            }
                            break;

                        case ((strpos($r, 'max') !== false) ? $r : false):

                            $sr = explode(':', $r);
                            $ml = (int)end($sr);

                            //Check for valid length
                            if ($ml < 0) {
                                throw new \Exception('The max value is incorrect');
                            }

                            //Check for maximum length of the string
                            if (strlen($data[$k]) > $ml) {
                                $validator::$hasError = true;
                                $validator::$errors[$k] = (isset($messages[$k . 'max'])) ?
                                    $messages[$k . 'max'] : 'The length of the field must be less than ' . $ml . '.';
                            }
                            break;

                        case ((strpos($r, 'min') !== false) ? $r : false):
                            $sr = explode(':', $r);
                            $ml = (int)end($sr);

                            //Check for valid length value
                            if ($ml < 0) {
                                throw new \Exception('The min value is incorrect');
                            }

                            //Check for minimum length
                            if (strlen($data[$k]) < $ml) {
                                $validator::$hasError = true;
                                $validator::$errors[$k] = (isset($messages[$k . 'min'])) ?
                                    $messages[$k . 'max'] : 'The length of the field must be greater than ' . $ml . '.';
                            }
                            break;

                        case ((strpos($r, 'digits') !== false) ? $r : false):
                            $sr = explode(':', $r);
                            $ml = (int)end($sr);

                            //Check for valid length of digits
                            if ($ml < 0) {
                                throw new \Exception('The digits length value is incorrect');
                            }

                            //Check for value to be number and also not contain decimal part
                            if (!is_numeric($data[$k]) || strlen((int)$data[$k]) !== $ml) {
                                $validator::$hasError = true;
                                $validator::$errors[$k] = (isset($messages[$k . 'digits'])) ?
                                    $messages[$k . 'digits'] : 'The length of the field must be numeric and equal to ' . $ml . '.';
                            }
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
}