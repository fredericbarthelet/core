<?php

/*
 * This file is part of the API Platform project.
 *
 * (c) Kévin Dunglas <dunglas@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ApiPlatform\Core\Api;

use ApiPlatform\Core\JsonSchema\Schema;

class FilterDescription
{
    public const ALLOWED_VERSIONS = [
        Schema::VERSION_SWAGGER,
        Schema::VERSION_OPENAPI,
    ];

    private $name;
    private $property;
    private $type;
    private $required;
    private $strategy;
    private $collection;
    private $swagger;
    private $openapi;

    public function __construct(string $name, ?string $property, string $type, bool $required, ?string $strategy, ?bool $collection = false, ?array $swagger = null, ?array $openapi = null)
    {
        $this->name = $name;
        $this->property = $property;
        $this->type = $type;
        $this->required = $required;
        $this->strategy = $strategy;
        $this->collection = $collection;
        $this->swagger = $swagger;
        $this->openapi = $openapi;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getProperty(): ?string
    {
        return $this->property;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function getStrategy(): ?string
    {
        return $this->strategy;
    }

    public function isCollection(): bool
    {
        return $this->collection;
    }

    public function getAdditionalParameters(string $version)
    {
        if (!\in_array($version, self::ALLOWED_VERSIONS, true)) {
            throw new \LogicException('Please provide either of the following allowed parameter versions: '.implode(', ', self::ALLOWED_VERSIONS));
        }

        return $this->{$version};
    }
}
