<?php

namespace Tests;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseTransactions, HasExtraAssertions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutExceptionHandling([
            AuthenticationException::class,
            AuthorizationException::class,
            ModelNotFoundException::class,
            RouteNotFoundException::class,
            ValidationException::class,
            HttpException::class,
        ]);
    }
}
