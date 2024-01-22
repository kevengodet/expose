<?php

declare(strict_types=1);

namespace Keven\Expose\Util;

final class Port
{
    private int $port;

    public function __construct(int $port)
    {
        $this->port = $port;
    }

    public function getValue(): int
    {
        return $this->port;
    }

    /**
     * Find a free port on the system
     * 
     * @see https://gist.github.com/loilo/dbab2351e8337437cbc359cb82670a91
     *
     * @param int|null $default If given, try to use this port first
     * @return Port
     */
    public static function findFree(int $default = null): Port
    {
        $socket = socket_create_listen($default);

        if (false === $socket) {
            socket_create_listen(0);
        }

        socket_getsockname($socket, $addr, $port);
        socket_close($socket);

        return new self($port);
    }
}
