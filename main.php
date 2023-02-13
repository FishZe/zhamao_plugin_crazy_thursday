<?php

declare(strict_types=1);

$plugin = new ZMPlugin();

function CrazyThursdayGetArrayRand(array $array): string
{
    return $array[array_rand($array)];
}

$plugin->addBotCommand(BotCommand::make('crazy-thursday', match: '疯狂星期四')->on(function (OneBotEvent $event, BotContext $ctx) {
    if (date("w") != 4) {
        $ctx->reply(CrazyThursdayGetArrayRand(["今天不是星期四哦~", "哇, 这个人不在星期四吃肯德基, 是富哥!", "哎呀等星期四再吃吧", "不是星期四! 没有肯德基!", "诶? 你想天天都吃肯德基吗"]));
    } else {
        $ctx->reply(CrazyThursdayGetArrayRand(kv("CRAZY_THURSDAY")->get('DATA')));
    }
}));

$plugin->onPluginLoad(function () {
    kv("CRAZY_THURSDAY")->set('DATA', json_decode(file_get_contents(dirname(__FILE__) . "/json/Thursday.json"), true));
});

return $plugin;
