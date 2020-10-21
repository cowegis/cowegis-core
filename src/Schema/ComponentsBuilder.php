<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema;

use Cowegis\Core\Exception\RuntimeException;
use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Objects\BaseObject;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Components;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Example;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Header;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Link;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\PathItem;
use GoldSpecDigital\ObjectOrientedOAS\Objects\RequestBody;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\SecurityScheme;

use function array_values;
use function get_class;

final class ComponentsBuilder
{
    /**
     * @psalm-param list<SchemaContract>
     * @var SchemaContract[]
     */
    private $schemas = [];

    /**
     * @psalm-param list<Response>
     * @var Response[]
     */
    private $responses = [];

    /**
     * @psalm-param list<Parameter>
     * @var Parameter[]
     */
    private $parameters = [];

    /**
     * @psalm-param list<Example>
     * @var Example[]
     */
    private $examples = [];

    /**
     * @psalm-param list<RequestBody>
     * @var RequestBody[]
     */
    private $requestBodies = [];

    /**
     * @psalm-param list<Header>
     * @var Header[]
     */
    private $headers = [];

    /**
     * @psalm-param list<SecurityScheme>
     * @var SecurityScheme[]
     */
    private $securitySchemes = [];

    /**
     * @psalm-param list<Link>
     * @var Link[]
     */
    private $links = [];

    /**
     * @psalm-param list<PathItem>
     * @var PathItem[]
     */
    private $callbacks = [];

    public function withSchema(SchemaContract $component, ?string $reference = null): Schema
    {
        if (! $component instanceof BaseObject) {
            if ($reference === null) {
                throw new RuntimeException(
                    'Reference required for schema components of class ' . get_class($component)
                );
            }

            $this->schemas['#/components/schemas' . $reference] = $component;

            return Schema::ref($reference);
        }

        return Schema::ref(
            $this->addWithUniqueReference($component, $this->schemas, 'schemas/', 'schema', $reference)
        );
    }

    public function withResponse(Response $component, ?string $reference = null): Response
    {
        return Response::ref(
            $this->addWithUniqueReference($component, $this->responses, 'responses/', 'response', $reference)
        );
    }

    public function withParameter(Parameter $component, ?string $reference = null): Parameter
    {
        return Parameter::ref(
            $this->addWithUniqueReference($component, $this->parameters, 'parameters/', 'parameter', $reference)
        );
    }

    public function withExample(Example $component, ?string $reference = null): Example
    {
        return Example::ref(
            $this->addWithUniqueReference($component, $this->examples, 'examples/', 'example', $reference)
        );
    }

    public function withRequestBody(RequestBody $component, ?string $reference = null): RequestBody
    {
        return RequestBody::ref(
            $this->addWithUniqueReference($component, $this->requestBodies, 'requestBodies/', 'requestBody', $reference)
        );
    }

    public function withHeader(Header $component, ?string $reference = null): Header
    {
        return Header::ref(
            $this->addWithUniqueReference($component, $this->headers, 'headers/', 'header', $reference)
        );
    }

    public function withSecurityScheme(SecurityScheme $component, ?string $reference = null): SecurityScheme
    {
        return SecurityScheme::ref(
            $this->addWithUniqueReference(
                $component,
                $this->securitySchemes,
                'securitySchemes/',
                'securityScheme',
                $reference
            )
        );
    }

    public function withLink(Link $component, ?string $reference = null): Link
    {
        return Link::ref(
            $this->addWithUniqueReference($component, $this->links, 'links/', 'link', $reference)
        );
    }

    public function withCallback(PathItem $component, ?string $reference = null): PathItem
    {
        return PathItem::ref(
            $this->addWithUniqueReference($component, $this->callbacks, 'callbacks/', 'callback', $reference)
        );
    }

    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function build(): Components
    {
        $components = Components::create();

        if ($this->schemas) {
            $components = $components->schemas(...array_values($this->schemas));
        }

        if ($this->responses) {
            $components = $components->responses(...array_values($this->responses));
        }

        if ($this->parameters) {
            $components = $components->parameters(...array_values($this->parameters));
        }

        if ($this->examples) {
            $components = $components->examples(...array_values($this->examples));
        }

        if ($this->requestBodies) {
            $components = $components->requestBodies(...array_values($this->requestBodies));
        }

        if ($this->headers) {
            $components = $components->headers(...array_values($this->headers));
        }

        if ($this->securitySchemes) {
            $components = $components->securitySchemes(...array_values($this->securitySchemes));
        }

        if ($this->links) {
            $components = $components->links(...array_values($this->links));
        }

        if ($this->callbacks) {
            $components = $components->callbacks(...array_values($this->callbacks));
        }

        return $components;
    }

    /** @param array<string,mixed> $collection */
    private function addWithUniqueReference(
        BaseObject $object,
        array &$collection,
        string $prefix,
        string $defaultReference,
        ?string $customReference
    ): string {
        $prefix = '#/components/' . $prefix;

        if ($customReference !== null) {
            $objectId  = $customReference;
            $reference = $prefix . $objectId;

            if (! isset($collection[$reference])) {
                $collection[$reference] = $object->objectId($objectId);

                return $reference;
            }
        }

        $objectId  = $object->objectId ?: $defaultReference;
        $reference = $prefix . $objectId;
        $suffix    = 1;

        while (isset($collection[$reference])) {
            $objectId  = ($object->objectId ?: $defaultReference) . ++$suffix;
            $reference = $prefix . $objectId;
        }

        $collection[$reference] = $object->objectId($objectId);

        return $reference;
    }
}
