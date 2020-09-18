<?php

namespace TheProfessor\Laravelrooms\Commands;

use Illuminate\Console\Command;

class LaravelroomsCommand extends Command
{
    public $signature = 'laravelrooms';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
