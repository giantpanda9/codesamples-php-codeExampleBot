# codesamples-php-codeExampleBot
php 7.2 curl Telegram API NASAAPI to Telegram
# Description
In fact a gateway between the NASA API and Telegram API - if you run the bot it will get the information about closet asteroids to Earth for today and then choose on random asteroid from a returned list and send it to Telegram API to the bot, for which you would provide token and chat id(should be received from Telegram API and populated to the bot configuration ini file in config folder)
# Purposes
To demonstrate ability to work with various APIs and implement cross-API interaction
# Requirements
1. PHP 7.2
2. CURL extension for PHP 7.2
3. Telegram bot created via botFather(see here: https://core.telegram.org/api)
# Installation instructions (approximate, not the last ones to follow):
1. git clone this project
2. [optional] sudo apt-get install php7.2-cli
3. [optional] sudo add-apt-repository ppa:ondrej/php
4. [optional] sudo apt-get install php7.2-curl
5. Open your telegram app
6. Search for @botfather - simply put @botfather to search widget
7. You will see BotFather and 'I can help you create and m...' below
8. Click on it and press start
9. Command @BotFather a /newbot
10. You will receive 'Alright, a new bot. How are we going to call it? Please choose a name for your bot.'
11. Answer with the name of your bot
12. The system asks for the user name of your bot
13. Answer with something that ends with _bot
14. You will receive token   
15. [as per https://core.telegram.org/bots/api , follow to Making Requests header] Follow https://api.telegram.org/bot<token>/getUpdates (instead of <token> you token value)
17. Send something to your bot and refresh the page mentioned at point 15 - you should get you chat id - token and chat_id to the /config/codeExampleBot_config.ini instead of placeholder message after =
16. Additional information via https://blog.meer-web.nl/sending-telegram-messages-using-php/

# How to run?:
1. php /path/to/codeExampleBot.php
2. Check you Telegram for message  
