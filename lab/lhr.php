<?php

declare(strict_types=1);

require_once dirname(__DIR__).'/vendor/autoload.php';

$descriptors = [
//    0 => ['pipe', 'r'],
    1 => ['pipe', 'w'],
    2 => ['pipe', 'w'],
];

$cwd ??= getcwd();

$command = 'ssh -R 80:127.0.0.1:80 nokey@localhost.run';
//$resource = proc_open($command, $descriptors, $pipes, $cwd);
//
//var_dump(is_resource($resource));
//var_dump($pipes);
//
//stream_set_blocking($pipes[1], true);
//
//while ($read = fread($pipes[1], 2096)) {
//    echo $read;
//    echo "\n".mb_strlen($read);
//    sleep(1);
//}
//
//proc_close($resource);


//$resource = popen($command.'  2>&1', 'r');
//$log = '';
//while (!feof($resource)) {
//    $log .= fgets($resource, 4096);
//    if (preg_match('/\n(.+) tunneled with tls termination/', $log, $match)) {
//        echo 'Tunnel running: https://'.$match[1]."\n";
//        break;
//    }
//    usleep(100);
//}
//pclose($resource);

$process = new \Symfony\Component\Process\Process(explode(' ', $command));
$process->setTimeout(null);
$process->run(function($t, $s) {
    if ($t !== 'out') {
        return;
    }

    if (preg_match('/tunneled with tls termination, (.+)\n/', $s, $match)) {
        echo 'Tunnel running: ' . $match[1] . "\n";
    }

    echo $s;
});

echo 'bla bla';
//$process->run(function() { print_r(func_get_args()); });
