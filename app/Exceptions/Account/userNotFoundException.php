<?php

namespace App\Exceptions\Account;

use Exception;
use Illuminate\Http\JsonResponse;

class userNotFoundException extends Exception
{

    public function render(): JsonResponse
    {
        return response()->json([
            'message' => 'User not found'
        ], 404);
    }

}
