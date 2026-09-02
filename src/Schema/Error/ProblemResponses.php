<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema\Error;

use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

final class ProblemResponses
{
    public static function notFound(): Response
    {
        return Response::create()
            ->statusCode(404)
            ->description('The requested resource does not exist')
            ->content(MediaType::json()->schema(Schema::ref(ErrorSchema::FULL_REF)));
    }

    public static function badRequest(): Response
    {
        return Response::create()
            ->statusCode(400)
            ->description('The request parameters are invalid')
            ->content(MediaType::json()->schema(Schema::ref(ErrorSchema::FULL_REF)));
    }
}
