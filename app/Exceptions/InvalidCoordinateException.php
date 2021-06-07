<?php

namespace App\Exceptions;

use Exception;

class InvalidCoordinateException extends Exception
{
    protected $message = 'The value provided is not a valid Cordinate.';
}
