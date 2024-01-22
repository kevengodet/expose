<?php

declare(strict_types=1);

namespace Keven\Expose;

use Keven\Expose\Util\Uri;

interface Tunnel
{
    public function getUri(): Uri;
    public function close(): void;
}
