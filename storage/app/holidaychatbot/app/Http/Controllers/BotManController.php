<?php
namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Cache\LaravelCache;
use BotMan\BotMan\Cache\SymfonyCache;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

class BotManController extends Controller
{
    protected $user_name;

    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');

//        $botman = BotManFactory::create([
//            'config' => [
//                'user_cache_time' => 30000,
//                'conversation_cache_time' => 30000,
//            ],
//        ], new LaravelCache());
//
//        $adapter = new FilesystemAdapter();
//        $botman = BotManFactory::create([
//            'config' => [
//                'user_cache_time' => 30000,
//                'conversation_cache_time' => 30000,
//            ],
//        ], new SymfonyCache($adapter));
//
//        $botman->hears('{message}', function($botman, $message) {
//            $botman->startConversation(new HolidayConversation);
//        });

        $botman->hears('{message}', function($botman, $message) {
            $this->conversation($botman);

        });
//        $botman->ask('Hello! What is your name?', function(Answer $answer) {
//
//            $this->user_name = $answer->getText();
//            $this->reply('It\'s lovely to meet you, ' . $this->user_name . '. Let\'s find you a holiday!');
//
//            //$this->askCountry($this);
//        });
        $botman->listen();

    }

    /**
     * Place your BotMan logic here.
     */
    public function conversation($botman)
    {
        //$botman->startConversation(new HolidayConversation);
        $botman->ask('Hello! What is your name?', function(Answer $answer) {

            $this->user_name = $answer->getText();
            $this->say('It\'s lovely to meet you, ' . $this->user_name . '. Let\'s find you a holiday!');

            $this->ask('What country do you live in, ' . $this->user_name . '?', function(Answer $answer) {

                $this->country = $answer->getText();

                $this->say('It\'s lovely to meet you, ' . $this->country . '. Let\'s find you a holiday!');
            });
            //$this->askCountry($this);
        });

    }

    /**
     * Place your BotMan logic here.
     */
    public function askCountry($botman)
    {
        $botman->ask('Hello! REATSESTETCOUNTRYname?', function(Answer $answer) {

            $this->user_name = $answer->getText();

            $this->say('It\'s lovely to meet you, ' . $this->user_name . '. Let\'s find you a holiday!');
        });
    }
}
