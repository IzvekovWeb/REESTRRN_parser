# Парсер для компании ООО "Реестр-РН"
![parserlib](https://img.shields.io/static/v1?label=parserlib&message=phpQuery&color=brightgreen)

Парсинг сайтов новостей для телеграм бота

Парсит заданый список сайтов, по определенным тегам и отправляет полученные данные в телеграм. 

Парсинг происходит с помощью cron задачи на сервере.

## Парсер
Путь newsParser/code/parsers/SiteParser.php



<!-- # SQL 

Обновить serial

    ALTER SEQUENCE <seq> RESTART WITH 1;
    UPDATE <table> SET <idcolumn>=nextval('<seq>');

Посмотреть все SEQUENCEs

    SELECT * FROM information_schema.sequences; -->