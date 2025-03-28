<?php

namespace App\EventListener;

use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

final class CommandListener
{
    #[AsEventListener(event: 'console.command')]
    public function onConsoleCommand(ConsoleCommandEvent $event): void
    {
        echo "Hello World !!";
    }
}
