<?php

namespace App\Exceptions;

use Exception;

class ServiceException extends Exception
{
    /**
     * Report the exception.
     *
     * @return void
     */
    public function report()
    {
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        $message = $this->getMessage();
        $status = 400;
        return response()->json(array(
            "message" => $message,
            "status" => $status
        ), 400);
    }

}
