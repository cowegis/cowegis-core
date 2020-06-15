<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema;

use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Info;
use GoldSpecDigital\ObjectOrientedOAS\Objects\PathItem;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Server;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Tag;
use GoldSpecDigital\ObjectOrientedOAS\OpenApi;

final class SchemaBuilder
{
    private $openApiVersion;

    private $info;

    private $externalDocs;

    private $servers = [];

    private $paths = [];

    private $tags = [];

    /** @var ComponentsBuilder */
    private $components;

    /** @var Schema */
    private $idSchemaRef;

    private function __construct()
    {
    }

    public static function create(Info $info, SchemaContract $idSchema, string $openApiVersion = OpenApi::OPENAPI_3_0_2) : self
    {
        $instance                 = new self;
        $instance->info           = $info;
        $instance->openApiVersion = $openApiVersion;
        $instance->components     = new ComponentsBuilder();
        $instance->idSchemaRef    = $instance->components->withSchema($idSchema, 'Id');

        $instance->components()->withSchema(
            Schema::create('NullValue')
                ->type('object')
                ->nullable()
        );

        return $instance;
    }

    public function idSchemaRef(?string $objectId = null) : Schema
    {
        return $objectId ? $this->idSchemaRef->objectId($objectId) : $this->idSchemaRef;
    }

    public function withTags(Tag ... $tags) : self
    {
        foreach ($tags as $tag) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function withPathItem(PathItem $pathItem) : self
    {
        $this->paths[] = $pathItem;

        return $this;
    }

    public function withServers(Server ... $servers) : self
    {
        foreach ($servers as $server) {
            $this->servers[] = $server;
        }

        return $this;
    }

    public function components() : ComponentsBuilder
    {
        return $this->components;
    }

    public function build() : OpenApi
    {
        return OpenApi::create()
            ->openapi($this->openApiVersion)
            ->externalDocs($this->externalDocs)
            ->info($this->info)
            ->tags(... $this->tags)
            ->paths(... $this->paths)
            ->components($this->components->build());
    }
}
