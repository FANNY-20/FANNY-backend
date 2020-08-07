<?php

namespace App\Web\Controllers;

use Illuminate\Http\JsonResponse;

class HomeController
{
    public function __invoke(): JsonResponse
    {
        return response()->json(
            [
                'name' => config('app.name'),
                'description' => 'Expose routes API for hybrid application',
                'website' => config('app.url'),
            ]
        );
    }
}
