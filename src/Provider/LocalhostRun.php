<?php

declare(strict_types=1);

namespace Keven\Expose\Provider;

use Keven\Expose\Tunnel;
use Keven\Expose\Util\Authority;
use Keven\Expose\Util\Uri;

/**
 * @see https://localhost.run
 */
final class LocalhostRun extends Ssh
{
    public function __construct(string $localAddress = '127.0.0.1:80', ?int $bindPort = 80, ?string $customDomain = null)
    {
        $tunnel = $bindPort.':'.$localAddress;
        if (!is_null($customDomain)) {
            $tunnel = $customDomain.':'.$tunnel;
        }
        $command = "ssh -R $tunnel localhost.run";
    }

    public function open(Authority $distant, ?Authority $local = null): Tunnel
    {
        return parent::open($distant, $local);

        return new class($uri) implements Tunnel
        {

            public function getUri(): Uri
            {
                // TODO: Implement getUri() method.
            }

            public function close(): void
            {
                // TODO: Implement close() method.
            }
        };
    }
}
