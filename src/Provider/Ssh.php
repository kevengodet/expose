<?php

declare(strict_types=1);

namespace Keven\Expose\Provider;

use Keven\Expose\Tunnel;
use Keven\Expose\Util\Authority;
use Symfony\Component\Process\Process;

class Ssh implements Provider
{
    private bool $isOpen = false;

    /** @var resource */
    private $resource = null;

    public function open(Authority $distant, ?Authority $local = null): Tunnel
    {
        $local ??= Authority::create();
        $command = $this->createSshCommand($local, $distant);

        $this->resource = popen($command.'  2>&1', 'r');
        $this->isOpen = true;
        $log = '';
        while (!feof($resource)) {
            $log .= fgets($resource, 4096);
            if (preg_match('/\n(.+) tunneled with tls termination/', $log, $match)) {
                echo 'Tunnel running: https://'.$match[1]."\n";
                break;
            }
            usleep(100);
        }
        pclose($resource);
    }

    private function createSshCommand(Authority $local, Authority $distant): string
    {
        return 'ssh -R '.$distant->getPortNumber().':'.$local.' '.$distant->getHost();
    }

    public function close(): void
    {
        if (!$this->isOpen) {
            return;
        }

        pclose($this->resource);
        $this->isOpen = false;
        $this->resource = null;
    }
}
