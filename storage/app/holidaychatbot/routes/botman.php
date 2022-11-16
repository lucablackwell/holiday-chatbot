<?php
$botman = new \BotMan\BotMan\BotMan();

$botman->hears('test', function ($bot) {
    $bot->reply('test');
});

$botman->listen();
