<?php

use Symfony\Component\Process\Process;
$path = __FILE__;
// Change to the project directory
chdir(getcwd());

// Determine the command to open a new terminal window
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    $terminalCommand = ['cmd', '/c', 'start'];
} else {
    $terminalCommand = ['gnome-terminal', '--'];
}

// Start the Laravel development server
$process = new Process(array_merge($terminalCommand, ['php', 'artisan', 'serve']));
$process->start();

// Start the scheduler worker
$process = new Process(array_merge($terminalCommand, ['php', 'artisan', 'scheduler:work']));
$process->start();

// Start the queue worker
$process = new Process(array_merge($terminalCommand, ['php', 'artisan', 'queue:work']));
$process->start();
