<?php

namespace App\Exceptions;

use Exception;

class CompanyNotFoundException extends Exception
{
    public $message = '';

    public function __construct($message)
    {
        parent::__construct();

        $this->message = $message;
    }

    public function render($request)
    {
        return response()->json(["message" => $this->message, 'success' => false], 404);
    }
}
