<?php

namespace App\Exception;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomError extends Exception
{
    public function render(Request $request): Response
    {
        return response()->view('exception.file1');
    }

    public function report()
    {
    }
}
