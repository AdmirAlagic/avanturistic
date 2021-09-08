<?php

namespace App\Repositories;

use Exception;

class ServiceResponse
{
    public $data;
    public $errors;

    public function __construct($errors = null, $data = [])
    {
        $this->errors = $errors;
        $this->data = $data;
    }

    public function throwExceptionWithErrorMessages(){
        throw new Exception($this->convertErrorsToString());
    }

    public function convertErrorsToString(){
        return implode('.', $this->errors);
    }
}