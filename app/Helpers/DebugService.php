<?php

namespace App\Helpers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Response;

class DebugService extends ServiceProvider
{

    public static function log($content, $message = "message" )
    {
        $output = new \Symfony\Component\Console\Output\ConsoleOutput();
        return $output->writeln("<info>$message:  $content</info>");
       
    }
}
