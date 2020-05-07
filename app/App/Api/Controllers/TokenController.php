<?php

namespace App\Api\Controllers;

use App\Api\Requests\CreateOrUpdateTokenRequest;
use App\Api\Resources\TokenList;
use Domain\Token\Actions\CreateOrUpdateTokenAction;
use Domain\Token\Models\Token;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class TokenController
{
    public function index(): JsonResource
    {
        $tokens = Token::all();

        return TokenList::collection($tokens);
    }

    public function store(CreateOrUpdateTokenRequest $request, CreateOrUpdateTokenAction $createAction): Response
    {
        $createAction->execute($request->tokens);

        return response()->noContent(201);
    }
}
