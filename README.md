# Custom Emojis Bot

A Telegram bot that reveals custom emojis in Telegram messages and provides the correct format for developers. Perfect for developers who need to understand how to properly format custom emojis in their Telegram bot integrations.

## Features

- **Custom Emoji Detection**: Automatically detects custom emojis in incoming Telegram messages
- **Format Display**: Shows both the rendered emoji and the correct code format
- **Format Switching**: Switch between HTML and Markdown formats using inline keyboard buttons
- **Developer-Friendly**: Provides the exact code snippets needed to use custom emojis in your applications

## How It Works

Send a message containing custom emojis to the bot, and it will:
1. Extract all unique custom emojis from your message
2. Display each emoji with its rendered preview
3. Show the correct code format for both HTML (`<tg-emoji>`) and Markdown (`![text](tg://emoji?id=...)`)
4. Allow you to switch between HTML and Markdown formats via inline buttons

## Configuration

Before running the bot, configure the following environment variables in your `.env` file (see `.env.example` for reference):

```env
TELEPATH_TOKEN=your_telegram_bot_token
TELEPATH_USERNAME=your_bot_username
TELEPATH_CHAT_ID_FALLBACK=fallback_chat_id
```

## Getting Started

1. Clone the repository
2. Install dependencies: `composer install`
3. Copy `.env.example` to `.env` and configure your Telegram bot credentials
4. Run migrations: `php artisan migrate`
5. Start the bot webhook server

## Usage

1. Start a conversation with the bot using `/start`
2. Send a message containing custom emojis
3. The bot will respond with the formatted emoji codes
4. Use the inline keyboard buttons to switch between HTML and Markdown formats

## Built With

- [Laravel](https://laravel.com) - PHP Framework
- [Telepath](https://github.com/lowel1337/telepath) - Telegram Bot Framework

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
