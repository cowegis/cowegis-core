<?php

declare(strict_types=1);

namespace spec\Cowegis\Core\Schema;

use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Info;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Server;
use PhpSpec\ObjectBehavior;

final class SchemaBuilderSpec extends ObjectBehavior
{
    public function let(Info $info, SchemaContract $idSchema): void
    {
        $this->beConstructedThrough('create', [$info, $idSchema]);
    }

    public function it_adds_servers(): void
    {
        $this->withServers(Server::create()->url('http://example.org/cowegis/api'));
        $this->withServers(Server::create()->url('https://example.org/cowegis/api'));

        $schema = $this->build();

        $schema->servers->shouldHaveCount(2);
        $schema->servers[0]->url->shouldEqual('http://example.org/cowegis/api');
        $schema->servers[1]->url->shouldEqual('https://example.org/cowegis/api');
    }
}
