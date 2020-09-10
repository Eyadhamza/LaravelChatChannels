<?php

namespace TheProfessor\LaravelChatChannels\Commands;

use Illuminate\Console\Command;

class LaravelChatChannelsCommand extends Command
{
    public $signature = 'Laravel-Chat-Channels';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
