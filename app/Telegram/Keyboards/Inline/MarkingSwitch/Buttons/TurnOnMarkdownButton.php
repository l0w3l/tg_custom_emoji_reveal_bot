<?php

declare(strict_types=1);

namespace App\Telegram\Keyboards\Inline\MarkingSwitch\Buttons;

use App\Telegram\Keyboards\Inline\MarkingSwitch\MarkingSwitchKeyboard;
use Lowel\Telepath\Core\Router\Keyboard\Buttons\Inline\AbstractCallbackButton;
use Lowel\Telepath\Facades\SpiritBox;
use Phptg\BotApi\Type\Message;
use Phptg\BotApi\Type\MessageEntity;

class TurnOnMarkdownButton extends AbstractCallbackButton
{
    public function handle(): callable
    {
        return static function (Message $message) {
            if ($message->entities) {
                $response = '';

                foreach ($message->entities as $entity) {
                    if ($entity->type === 'custom_emoji') {
                        $original = self::extractEntityText($message->text, $entity);

                        $response .= "<tg-emoji emoji-id=\"{$entity->customEmojiId}\">{$original}</tg-emoji>\t";

                        $response .= "<code>![{$original}](tg://emoji?id={$entity->customEmojiId})</code>";

                        $response .= PHP_EOL;
                    }
                }

                $response .= "\nby @lowel1337";

                SpiritBox::editMessageText($response, replyMarkup: MarkingSwitchKeyboard::html());
            }
        };
    }

    public static function extractEntityText(string $text, MessageEntity $entity): string
    {
        $utf16 = mb_convert_encoding($text, 'UTF-16LE', 'UTF-8');

        $start = $entity->offset * 2;
        $length = $entity->length * 2;

        $slice = substr($utf16, $start, $length);

        return mb_convert_encoding($slice, 'UTF-8', 'UTF-16LE');
    }

    public function text(array $args = []): int|string|callable
    {
        return 'MARKDOWN';
    }
}
