<?php

namespace Keven\Expose\Util;

final class Authority
{
    private Host $host;
    private Port $port;

    public function __construct(Host $host, Port $port)
    {
        $this->host = $host;
        $this->port = $port;
    }

    public function getHost(): Host
    {
        return $this->host;
    }

    public function getPort(): Port
    {
        return $this->port;
    }

    public function getPortNumber(): int
    {
        return $this->port->getValue();
    }

    public function __toString(): string
    {
        return $this->host->getValue().':'.$this->port->getValue();
    }

    /**
     * Usage:
     *
     *   $authority = Authority::create('localhost'); // Port will be 80
     *   $authority = Authority::create('localhost', 8080);
     *   $authority = Authority::create('localhost:8088');
     *
     * @param string $host
     * @param int|null $port
     *
     * @return Authority
     */
    public static function create(string $host = '127.0.0.1', ?int $port = 80): Authority
    {
        if (false !== strpos($host, ':')) {
            [$host, $port] = explode(':', $host);
        }

        $host = new Host($host);
        $port = new Port((int) $port);

        return new self($host, $port);
    }
}
