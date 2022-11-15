<?php
$botman = new \BotMan\BotMan\BotMan();

$botman->hears('peepee', function ($bot) {
    $bot->reply('poopoo');
});

$botman->listen();
