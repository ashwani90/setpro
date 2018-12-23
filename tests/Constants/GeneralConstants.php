<?php
/**
 * Constants file to store general constants to be used in all test cases.
 *
 * This file will store constants that can be used in most of the test cases.
 * The constants not related to any test case should be added to this file.
 *
 * @category Constants
 * @author Ashwani
 * @since 0.0.0
 *
 */

namespace App\Tests\Constants;

/**
 * Class to create a framework for api requests
 * @category Constants
 * @package App\Tests\Constants
 */
/**
 * Class GeneralConstants
 * @package App\Tests\Constants
 */
final class GeneralConstants
{
    //Http methods

    /**
     * Get method
     */
    public const HTTP_GET_METHOD = 'GET';

    /**
     * Post method
     */
    public const HTTP_POST_METHOD = 'POST';

    /**
     * Patch method
     */
    public const HTTP_PATCH_METHOD = 'PATCH';

    /**
     * Put method
     */
    public const HTTP_PUT_METHOD = 'PUT';

    /**
     * Delete method
     */
    public const HTTP_DELETE_METHOD = 'DELETE';

    //Api URLs

    public const LOGIN_API_URL = '/login';

    public const REGISTER_API_URL = '/register';

    //Http host url

    /**
     * Http host name
     */
    public const HTTP_HOST_NAME = 'local.setpro.com';
}