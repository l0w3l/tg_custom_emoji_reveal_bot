<?php

declare(strict_types=1);

namespace App\Telegram\Keyboards\Inline\MarkingSwitch;

use App\Telegram\Keyboards\Inline\MarkingSwitch\Buttons\TurnOnHtmlButton;
use App\Telegram\Keyboards\Inline\MarkingSwitch\Buttons\TurnOnMarkdownButton;
use Lowel\Telepath\Core\Router\Keyboard\InlineKeyboardBuilder;
use Lowel\Telepath\Core\Router\Keyboard\KeyboardBuilderInterface;
use Lowel\Telepath\Core\Router\Keyboard\KeyboardFactoryInterface;

class MarkingSwitchKeyboard implements KeyboardFactoryInterface
{
    public static function html(): KeyboardBuilderInterface
    {
        $builder = new InlineKeyboardBuilder;

        return $builder->row(new TurnOnHtmlButton);
    }

    public static function markdown(): KeyboardBuilderInterface
    {
        $builder = new InlineKeyboardBuilder;

        return $builder->row(new TurnOnMarkdownButton);
    }

    public function make(): KeyboardBuilderInterface
    {
        $builder = new InlineKeyboardBuilder;

        return $builder->row(new TurnOnHtmlButton, new TurnOnMarkdownButton);
    }
}
