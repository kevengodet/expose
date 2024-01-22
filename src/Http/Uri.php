<?php

declare(strict_types=1);

namespace Keven\Expose\Util;

final class Uri
{
    private string $uri;

    /**
     * @param string $uri
     */
    public function __construct(string $uri)
    {
        if (!filter_var($uri, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException("Invalid URI '$uri'.");
        }

        $this->uri = $uri;
    }

    public function getValue(): string
    {
        return $this->uri;
    }

    public function __toString(): string
    {
        return $this->uri;
    }
}
