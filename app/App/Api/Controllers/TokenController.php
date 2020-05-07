<?php

namespace App\Api\Controllers;

use App\Api\Requests\CreateOrUpdateTokenRequest;
use Domain\Token\Actions\CreateOrUpdateTokenAction;
use Illuminate\Http\Response;

class TokenController
{
    public function store(CreateOrUpdateTokenRequest $request, CreateOrUpdateTokenAction $createAction): Response
    {
        $createAction->execute($request->tokens);

        return response()->noContent(201);
    }
}
