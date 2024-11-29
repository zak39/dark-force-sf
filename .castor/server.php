<?php

namespace server;

use Castor\Attribute\AsTask;

use function docker\down;
use function docker\up;
use function symfony\start as sfStart;
use function symfony\stop as sfStop;

#[AsTask(
    description: 'Start the web server and all docker services. It can use as dev environment.',
    aliases: ['start'])]
function start(bool $detach = false): void
{
    sfStart($detach);
}

#[AsTask(description: 'Start the web server and all docker services', aliases: ['start:demo'])]
function startDemo(bool $quietly = false): void
{
    up($quietly);
}

#[AsTask(description: 'Stop the web server and all docker services', aliases: ['stop'])]
function stop(bool $quietly = false, bool $purge = false): void
{
    down($purge, $quietly);
    sfStop();
}
