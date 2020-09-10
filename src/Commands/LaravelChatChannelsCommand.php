<?php

namespace TheProfessor\Laravelchatchannels\Commands;

use Illuminate\Console\Command;

class LaravelchatchannelsCommand extends Command
{
    public $signature = 'laravelchatchannels';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
