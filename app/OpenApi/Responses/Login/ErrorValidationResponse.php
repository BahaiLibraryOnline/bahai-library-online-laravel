<?php

declare(strict_types=1);

namespace App\OpenApi\Responses\Login;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class ErrorValidationResponse extends ResponseFactory implements Reusable
{
    public function build(): Response
    {
        $response = Schema::object()->properties(
            Schema::string('message')->example('The given data was invalid.'),
            Schema::object('errors')
                ->additionalProperties(
                    Schema::array()->items(Schema::string())
                )
                ->example([
                    'field' => ['first error', 'second error', 'X error'],
                ])
        );
        return Response::unprocessableEntity('ValidationErrors')
            ->description('Validation errors')
            ->content(
                MediaType::json()->schema($response)
            );
    }
}
