<?php

declare(strict_types=1);

namespace App\OpenApi\RequestBodies;

use App\OpenApi\Schemas\LoginSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use Vyuldashev\LaravelOpenApi\Factories\RequestBodyFactory;

class LoginUserRequestBody extends RequestBodyFactory
{
    public function build(): RequestBody
    {
        return RequestBody::create('LoginUser')
            ->description('Login user')
            ->content(
                MediaType::json()->schema(LoginSchema::ref())
            )->required(true);
    }
}
