<?php

use App\Telegram\Handlers\CustomEmojiHandler;
use App\Telegram\Keyboards\Inline\MarkingSwitch\MarkingSwitchKeyboard;
use Lowel\Telepath\Facades\SpiritBox;
use Lowel\Telepath\Facades\Telepath;

Telepath::onCommand('start', function () {
    SpiritBox::sendMessage("Hello! \n\nSend message to me and I'll echo it back to you with the correct Markdown|HTML marking.\n\nby @lowel1337");
});

Telepath::onMessage(CustomEmojiHandler::class);

Telepath::keyboard(MarkingSwitchKeyboard::class);
