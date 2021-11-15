<?php

namespace App\OpenApi\Responses\Document;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use App\OpenApi\Schemas\DocumentSchema;
use Vyuldashev\LaravelOpenApi\Contracts\Reusable;
use Vyuldashev\LaravelOpenApi\Factories\ResponseFactory;

class SuccessfulDocumentsResponse extends ResponseFactory
{
    public function build(): Response
    {
        return Response::ok()
            ->description('Successful response')
            ->content(
            MediaType::json()->schema(DocumentSchema::ref())
        );
    }
}
