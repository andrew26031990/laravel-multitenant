<?php

namespace App\Exceptions;

use Exception;

class EmployeeInactiveException extends Exception
{
    public $message = '';

    public function __construct($message)
    {
        parent::__construct();

        $this->message = $message;
    }

    public function render($request)
    {
        return response()->json(["message" => $this->message, 'success' => false], 403);
    }
}
