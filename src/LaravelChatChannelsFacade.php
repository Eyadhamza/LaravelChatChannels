<?php

namespace TheProfessor\LaravelChatChannels;

use Illuminate\Support\Facades\Facade;

/**
 * @see \TheProfessor\LaravelChatChannels\LaravelChatChannels
 */
class LaravelChatChannelsFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Laravel-Chat-Channels';
    }
}
