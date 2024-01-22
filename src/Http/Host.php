<?php

declare(strict_types=1);

namespace Keven\Expose\Util;

final class Host
{
    private string $host;

    public function __construct(string $host)
    {
        if (!filter_var($host, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)) {
            throw new \InvalidArgumentException("Invalid host name: '$host'");
        }

        $this->host = $host;
    }

    public function getValue(): string
    {
        return $this->host;
    }

    public function __toString(): string
    {
        return $this->host;
    }
}
