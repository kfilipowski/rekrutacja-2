<?php

namespace App\Exception;

class InvalidFileMimeTypeException extends \Exception
{
    protected $message = 'Invalid file mime type.';
}
