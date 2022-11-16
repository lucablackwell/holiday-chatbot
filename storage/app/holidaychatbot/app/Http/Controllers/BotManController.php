<?php
namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Cache\LaravelCache;

class BotManController extends Controller
{

    /**
     * Place your BotMan logic here.
     */
    public function handle()
    {
        $botman = app('botman');

        $botman->hears('{message}', function($bot) {
            $bot->startConversation(new HolidayConversation);
        });
//
//        $botman->hears('{message}', function($botman, $message) {
//            $this->askName($botman);
//
//        });
//
//        $botman->listen();

    }

//    /**
//     * Place your BotMan logic here.
//     */
//    public function askName($botman)
//    {
//        $botman->ask('Hello! What is your name?', function(Answer $answer) {
//
//            $this->user_name = $answer->getText();
//
//            $this->say('It\'s lovely to meet you, ' . $this->user_name . '. Let\'s find you a holiday!');
//        });
//        //$this->askCountry($botman);
//    }
//
//    /**
//     * Place your BotMan logic here.
//     */
//    public function askCountry($botman)
//    {
//        $botman->ask('Hello! REATSESTETCOUNTRYname?', function(Answer $answer) {
//
//            $this->user_name = $answer->getText();
//
//            $this->say('It\'s lovely to meet you, ' . $this->user_name . '. Let\'s find you a holiday!');
//        });
//    }
}
