<?php
/**
 * @User:   Eldeeno
 * Date:    11/08/2021
 * Time:    12:15 PM
 */

namespace app\core;

class Response
{
    /**
     * @param int $code
     */
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }
}