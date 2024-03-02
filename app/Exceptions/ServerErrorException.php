<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class ServerErrorException extends Exception
{
    protected $message;
    protected $payload;

    public function __construct($message = 'Internal Server Error',$payload = "")
    {
        $this->message = $message;
        $this->payload = $payload;
    }
    /**
     * Report or log an exception.
     *
     * @return void
     */
    public function report()
    {
        Log::error($this->payload);
    }

    public function render()
    {
        return response()->json([
            'status' => 'server_error',
            'message' => $this->message
        ], 500);
    }
}
