<?php

use App\Telegram\Buttons\TurnOnHtmlButton;
use App\Telegram\Buttons\TurnOnMarkdownButton;
use App\Telegram\Handlers\CustomEmojiHandler;
use Lowel\Telepath\Facades\SpiritBox;
use Lowel\Telepath\Facades\Telepath;

Telepath::onCommand(function () {
    SpiritBox::sendMessage("Hello! \n\nSend message to me and I'll echo it back to you with the correct Markdown|HTML marking.\n\nby @lowel1337");
}, 'start');

Telepath::onMessage([CustomEmojiHandler::class, 'handle']);

Telepath::buttons([TurnOnHtmlButton::class, TurnOnMarkdownButton::class]);
