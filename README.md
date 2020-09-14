# a simple laravel package to create chats rooms and channels

[![Latest Version on Packagist](https://img.shields.io/packagist/v/theprofessor/laravelchatchannels.svg?style=flat-square)](https://packagist.org/packages/theprofessor/laravelchatchannels)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/theprofessor/laravelchatchannels/run-tests?label=tests)](https://github.com/theprofessor/laravelchatchannels/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/theprofessor/laravelchatchannels.svg?style=flat-square)](https://packagist.org/packages/theprofessor/laravelchatchannels)


This is a package to easily add chat room and channels to your Application , 
the demo app is still under construction and below you will see how to use the package properly

## Installation

You can install the package via composer:

```bash
composer require theprofessor/laravelchatchannels
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="TheProfessor\Laravelchatchannels\LaravelchatchannelsServiceProvider" --tag="migrations"
php artisan migrate
```


## Usage


The package contains two main traits where you can find all the functionality 
that that the package offers 

First add the trait Participate.php to the model you which want to use in your rooms e.g:User 
please note that you can have multiple models to participate in the room .

//first creating and joining chats
``` php
$user=User::find(1);
//Creating a new Chat using the current user.
$chat=$user->createChat('chat name','description for your chat');


// if you want to create empty chat (not using a user i mean ..)
$chat=Chat::firstOrCreate(['name'=>'my room','description'=>'fancy']);


//to join a chat use one of the following depending on your use case 
//add single user 
$user->joinRoom($chat);

//to add multiple participants to a chat 
$room->setParticipants($someUsers);

```
first creating and joining channels (it's almost the same )
``` php
//first creating and joining channels
$user=User::find(1);
//Creating a new Chat using the current user.
$chat=$user->createChannel('channel name','description for your channel');


// if you want to create empty channel (not using a user i mean ..)
$channel=Channel::firstOrCreate(['name'=>'my room','description'=>'fancy']);


//to join a channel use one of the following depending on your use case 
//add single user 
$user->joinRoom($channel);

//to add multiple participants to a channel 
$room->setParticipants($someUsers);

```
now for retrieving information of the room 
by room i mean either a chat or channel
``` php
//to retrieve all messages of a certain room
$room->allMessages();

//to retrieve a certain message of a room
$room->getMessage($messageBody);

//to retrieve all participants in a certain room
$room->getAllParticipants();

//to retrieve all chats or channels of a participant
$user->allChats();
$user->allChannels();

//to retrieve a specific room by id
$user->getParticipantChat($chat_id);
$user->getParticipantChannel($channel_id)

```
for sending messages 
``` php

$user=User::find(1);
$chat=Chat::firstOrCreate(['name'=>'my room','description'=>'fancy']);
$message='hello there';
//sending a specific message to a certain room

$user->sendMessage($chat,$message);

//for sending image or images 

$user->sendMessage($chat,$message,$imagesPaths);
//the following is an example on how to achieve this using laravel livewire
//to present the images in the view dont forget to decode the json 

$body= $this->validate([
            'messageBody'=>'required',
            'photos.*' => 'image|max:1024|nullable', // 1MB Max
        ]);
        $name="";
        $data=[];
        foreach ($this->photos as $photo) {
            $name=$photo->getClientOriginalName();
            $photo->storeAs('public/photos',$name);
            $path='/storage/photos/'.$name;
            $data[]=$path;
        }

        $message=$this->chat->addMessage(auth()->user()->id,$body['messageBody'],json_encode($data));
```
for determing roles and abilities (in the chat itself of course)
*dont worry there won't be any contradictions with any table permissions in the app
``` php
//the second arg is the role name 
//the third arg is the abilities given to that role

$role = $chat->givePermissions($user, 'Admin', 'DeleteChat');

//you will then be able to use gate like this 
if(Gate::forUser($admin)->allows($ability, $chat))
{
//do something 
}
//use it in middleware or in blade like any other permission 
//if you want to add more abilities go to the seedAbilities method in RoomRoles model and change it accourdingly
 
```
## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email freek@spatie.be instead of using the issue tracker.

## Credits

- [EyadHamza](https://github.com/EyadHamza)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
