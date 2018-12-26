<?php
/**
 * Constants file to contain validation constants.
 *
 * This file contains the constants values that are part of validations.
 *
 * @category Constants
 * @author Ashwani
 * @since 0.0.0
 *
 */

namespace App\Constants;

/**
 * Class for validation constants
 * @category Constants
 * @package App\Tests\Constants
 */
class ValidationConstants
{
    //Validation type constants

    /**
     * Required constant
     */
    public const CONSTRAINT_REQUIRED = 'required';

    /**
     * String constraint
     */
    public const CONSTRAINT_STRING = 'string';

    /**
     * Numeric constraint
     */
    public const CONSTRAINT_NUMERIC = 'numeric';

    /**
     * Max constraint
     */
    public const CONSTRAINT_MAX = 'max';

    /**
     * Min constraint
     */
    public const CONSTRAINT_MIN = 'min';

    /**
     * Digits constraint
     */
    public const CONSTRAINT_DIGITS = 'digits';

    // Validation messages types

    /**
     * Validation message
     */
    public const VALIDATION_MESSAGE = 'validation_messages';

    // Constant values for error messages

    /**
     * Incorrect min value constant
     */
    public const INCORRECT_MIN_VALUE = 'incorrect_min_value';

    /**
     * Incorrect max value constant
     */
    public const INCORRECT_MAX_VALUE = 'incorrect_max_value';

    /**
     * Incorrect digits value constant
     */
    public const INCORRECT_DIGITS_VALUE = 'incorrect_digits_value';
}