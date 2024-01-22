<?php

declare(strict_types=1);

namespace Keven\Expose;

use Keven\Expose\Provider\LocalhostRun;
use Keven\Expose\Provider\Provider;
use Keven\Expose\Util\Authority;

function expose(string $local): Tunnel
{
    return (new Builder)->expose($local)->open();
}

final class Builder
{
    private Provider $provider;
    private Authority $local, $distant;

    public function __construct(Provider $provider = null)
    {
        $this->provider = $provider ?? new LocalhostRun();
    }

    public function expose($local): self
    {
        return $this;
    }

    public function onPort(int $port): self
    {
        return $this;
    }

    public function to($distant): self
    {
        return $this;
    }

    public function open(): Tunnel
    {
        return $this->provider->open($this->distant, $this->local);
    }
}
