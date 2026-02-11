<?php

declare(strict_types=1);

namespace App\Telegram\Handlers;

use App\Telegram\Keyboards\Inline\MarkingSwitch\MarkingSwitchKeyboard;
use Lowel\Telepath\Core\Router\Handler\AbstractTelegramHandler;
use Lowel\Telepath\Facades\SpiritBox;
use Phptg\BotApi\Type\Message;
use Phptg\BotApi\Type\MessageEntity;

class CustomEmojiHandler extends AbstractTelegramHandler
{
    public function handler(): callable
    {
        return static function (Message $message) {
            if ($message->entities) {
                $counter = 0;
                $memory = [];
                $response = '';

                foreach ($message->entities as $entity) {
                    if ($entity->type === 'custom_emoji' && $entity->customEmojiId !== null) {
                        if (in_array($entity->customEmojiId, $memory)) {
                            continue;
                        } else {
                            $memory[] = $entity->customEmojiId;
                        }

                        $original = self::extractEntityText($message->text, $entity);

                        $response .= "<tg-emoji emoji-id=\"{$entity->customEmojiId}\">{$original}</tg-emoji>\t";

                        $response .= "<code>![{$original}](tg://emoji?id={$entity->customEmojiId})</code>";

                        $response .= PHP_EOL;

                        $counter++;

                        if ($counter > 50) {
                            $response .= "\nby @lowel1337";

                            SpiritBox::sendMessage($response, replyMarkup: MarkingSwitchKeyboard::html());
                            sleep(1);
                            $response = '';
                            $counter = 0;
                        }
                    }
                }

                if ($response === '') {
                    return;
                }

                $response .= "\nby @lowel1337";

                SpiritBox::sendMessage($response, replyMarkup: MarkingSwitchKeyboard::html());
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
}
