<?php

declare(strict_types=1);

namespace Keven\Expose\Provider;

use Keven\Expose\Tunnel;
use Keven\Expose\Util\Authority;

interface Provider
{
    public function open(Authority $distant, ?Authority $local = null): Tunnel;
}
