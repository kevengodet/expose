<?php

declare(strict_types=1);

$connection = ssh2_connect('localhost.run', 80);
stream_set_blocking($connection, true);

$error = ssh2_fetch_stream($connection, SSH2_STREAM_STDERR);
$output = ssh2_fetch_stream($connection, SSH2_STREAM_STDIO);

$tunnel = ssh2_tunnel($connection, '127.0.0.1', 80);


echo "Errors:\n", stream_get_contents($output);
echo "\nOutput:\n", stream_get_contents($output);
