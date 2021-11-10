<?php

declare(strict_types=1);

namespace App\OpenApi\Responses\Login;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class SuccessfulLoginResponse extends ResponseFactory
{
    public function build(): Response
    {
        $response = Schema::object()->properties(
            Schema::string('token')->example('Bearer token'),
        );
        return Response::created()
            ->description('Token created')
            ->content(
                MediaType::json()->schema($response)
            );
    }
}
