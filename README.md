**Start**
---
Для запуска на локальной машине нужен docker и docker-compose последней версии.
Разворачивание осуществляется командой ниже. <br/>
Понадобятся порты 8806, 8880. (или поправить под себя файлик docker-compose <code>/_docker_/docker-compose.yml</code>) <br/>

```shell
cd ./_docker_/ && docker-compose up -d \
&& docker-compose run --rm composer install \
&& docker-compose run --rm app php artisan migrate \
&& docker-compose run --rm app php artisan db:seed \
&& docker-compose run --rm app php artisan l5-swagger:generate
```

**TASK 1**
---
Исполняемая команда: <br/>
<code>app/Console/Commands/ShowRoomNumberAtLeastCommand.php</code>
В консоль будет выдан запрос (sql) и результат (учитывая, что данные формируются из факторок, результата может и не быть)
```shell
cd ./_docker_/ && docker-compose run --rm app \
php artisan artec:show-room-number-at-least
```

**TASK 2**
---
Прототип структуры базы данных будет сформирован после старта приложения. Сидер донесет какие-то данные.
Поиграться с апи можно будет http://localhost:8880/api/documentation
