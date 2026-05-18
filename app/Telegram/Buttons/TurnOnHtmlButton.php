<?php

declare(strict_types=1);

namespace App\Telegram\Buttons;

use Lowel\Telepath\Core\Router\Keyboard\Buttons\Inline\AbstractCallbackButton;
use Lowel\Telepath\Core\Router\Keyboard\InlineKeyboardBuilder;
use Lowel\Telepath\Facades\SpiritBox;
use Phptg\BotApi\Type\Message;
use Phptg\BotApi\Type\MessageEntity;

class TurnOnHtmlButton extends AbstractCallbackButton
{
    protected string $text = 'HTML';
    public function handle(Message $message)
    {
        if ($message->entities) {
            $response = '';

            foreach ($message->entities as $entity) {
                if ($entity->type === 'custom_emoji') {
                    $original = self::extractEntityText($message->text, $entity);

                    $response .= "<tg-emoji emoji-id=\"{$entity->customEmojiId}\">{$original}</tg-emoji>\t";

                    $response .= '<code>'.htmlspecialchars("<tg-emoji emoji-id=\"{$entity->customEmojiId}\">{$original}</tg-emoji", ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8').'></code>';

                    $response .= PHP_EOL;
                }
            }

            $response .= "\nby @lowel1337";

            SpiritBox::editMessageText($response, replyMarkup: InlineKeyboardBuilder::create()->column(TurnOnMarkdownButton::make()));
        }
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
