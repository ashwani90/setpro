<?php
/**
 * Constants file to manage constants in api request.
 *
 * This file contains the constants values that will be used in the api requests.
 * Any constant being used in the test case for api should be written down in this file.
 *
 * @category Constants
 * @author Ashwani
 * @since 0.0.0
 *
 */

namespace App\Tests\Constants;

/**
 * Class to manage api requests constant
 * @category Constants
 * @package App\Tests\Constants
 */
final class ApiRequestConstants
{
    /**
     * Valid registration values (with phone number and email)
     */
    public const REGISTRATION_PARAMETERS_VALID = array(
        array(
            "params" => array(
                'name' => 'Sohel',
                'email' => 'sohel@gmail.com',
                'password' => 'sihel',
                'phoneNumber' => '8746382938',
                'address' => 'Nandan Vihar',
            ),
            "expectedValues" => array(
                'name' => 'Sohel',
                'email' => 'sohel@gmail.com',
                'password' => 'sihel',
                'phoneNumber' => '8746382938',
                'address' => 'Nandan Vihar',
            )
        ),
        array(
            "params" => array(
                'name' => 'Sohel',
                'email' => 'sohel@gmail.com',
                'password' => 'sihel',
                'phoneNumber' => '8746382938',
                'address' => 'Nandan Vihar',
            ),
            "expectedValues" => array(
                'name' => 'Sohel',
                'email' => 'sohel@gmail.com',
                'password' => 'sihel',
                'phoneNumber' => '8746382938',
                'address' => 'Nandan Vihar',
            )
        ),
        array(
            "params" => array(
                'name' => 'Sohel',
                'email' => 'sohel@gmail.com',
                'password' => 'sihel',
                'phoneNumber' => '8746382938',
                'address' => 'Nandan Vihar',
            ),
            "expectedValues" => array(
                'name' => 'Sohel',
                'email' => 'sohel@gmail.com',
                'password' => 'sihel',
                'phoneNumber' => '8746382938',
                'address' => 'Nandan Vihar',
            )
        ),
        array(
            "params" => array(
                'name' => 'Sohel',
                'email' => 'sohel@gmail.com',
                'password' => 'sihel',
                'phoneNumber' => '8746382938',
                'address' => 'Nandan Vihar',
            ),
            "expectedValues" => array(
                'name' => 'Sohel',
                'email' => 'sohel@gmail.com',
                'password' => 'sihel',
                'phoneNumber' => '8746382938',
                'address' => 'Nandan Vihar',
            )
        ),
        array(
            "params" => array(
                'name' => 'Sohel',
                'email' => 'sohel@gmail.com',
                'password' => 'sihel',
                'phoneNumber' => '8746382938',
                'address' => 'Nandan Vihar',
            ),
            "expectedValues" => array(
                'name' => 'Sohel',
                'email' => 'sohel@gmail.com',
                'password' => 'sihel',
                'phoneNumber' => '8746382938',
                'address' => 'Nandan Vihar',
            )
        ),
        array(
            "params" => array(
                'name' => 'Sohel',
                'email' => 'sohel@gmail.com',
                'password' => 'sihel',
                'phoneNumber' => '8746382938',
                'address' => 'Nandan Vihar',
            ),
            "expectedValues" => array(
                'name' => 'Sohel',
                'email' => 'sohel@gmail.com',
                'password' => 'sihel',
                'phoneNumber' => '8746382938',
                'address' => 'Nandan Vihar',
            )
        ),
        array(
            "params" => array(
                'name' => 'Sohel',
                'email' => 'sohel@gmail.com',
                'password' => 'sihel',
                'phoneNumber' => '8746382938',
                'address' => 'Nandan Vihar',
            ),
            "expectedValues" => array(
                'name' => 'Sohel',
                'email' => 'sohel@gmail.com',
                'password' => 'sihel',
                'phoneNumber' => '8746382938',
                'address' => 'Nandan Vihar',
            )
        ),
        array(
            "params" => array(
                'name' => 'Sohel',
                'email' => 'sohel@gmail.com',
                'password' => 'sihel',
                'phoneNumber' => '8746382938',
                'address' => 'Nandan Vihar',
            ),
            "expectedValues" => array(
                'name' => 'Sohel',
                'email' => 'sohel@gmail.com',
                'password' => 'sihel',
                'phoneNumber' => '8746382938',
                'address' => 'Nandan Vihar',
            )
        ),
        array(
            "params" => array(
                'name' => 'Sohel',
                'email' => 'sohel@gmail.com',
                'password' => 'sihel',
                'phoneNumber' => '8746382938',
                'address' => 'Nandan Vihar',
            ),
            "expectedValues" => array(
                'name' => 'Sohel',
                'email' => 'sohel@gmail.com',
                'password' => 'sihel',
                'phoneNumber' => '8746382938',
                'address' => 'Nandan Vihar',
            )
        ),
    );

    /**
     * Valid login values (with email)
     */
    public const LOGIN_PARAMETERS_VALID = array(
        array(
            "params" => array(
                'email' => 'sohel@gmail.com',
                'password' => 'sihel',
            ),
            "expectedValues" => array(
                'name' => 'Sohel',
                'email' => 'sohel@gmail.com',
                'password' => 'sihel',
                'phoneNumber' => '8746382938',
                'address' => 'Nandan Vihar',
            )
        ),
        array(
            "params" => array(
                'email' => 'sohel@gmail.com',
                'password' => 'sihel',
            ),
            "expectedValues" => array(
                'name' => 'Sohel',
                'email' => 'sohel@gmail.com',
                'password' => 'sihel',
                'phoneNumber' => '8746382938',
                'address' => 'Nandan Vihar',
            )
        ),
        array(
            "params" => array(
                'email' => 'sohel@gmail.com',
                'password' => 'sihel',
            ),
            "expectedValues" => array(
                'name' => 'Sohel',
                'email' => 'sohel@gmail.com',
                'password' => 'sihel',
                'phoneNumber' => '8746382938',
                'address' => 'Nandan Vihar',
            )
        ),
    );

}