<!-- Developer: Sergey Nizhnik kroloburet@gmail.com -->

# Тестовое задание от 28.08.2021
Это задание из двух задач
* реализовать без использования PHP-фреймворков и сторонних пакетов веб-приложение вывода и сортировки категорий и товаров из БД
* реализовать скрипт построения дерева категорий из выборки БД

## Требования к серверу
* PHP >= 7.0
* MySQL >= 5.1, mysql и pdo драйвера
Подробнее в файлах `docer-compose.yml` и `local/web/Dockerfile`
А так же в `local/web/apache/conf/`

## Установка на удаленный хост
1. Скачай архив и распакуй его. [Загрузить архив](https://github.com/kroloburet/Task_28_08_2021/archive/refs/heads/main.zip)
2. Выгрузи все перечисленные ниже каталоги вместе с их содержимым на сервер.
   ```
   app/
   core/
   public/
   ```
3. Создай базу данных MySQL `test`
4. Импортируй в базу данных таблицы из файла `public/source/test.sql` или используй автоимпорт (смотри на главной странице проекта)
5. Измени конфигурацию подключения к базе данных в файле `app/Config/database.php`
6. Настрой `DocumentRoot` виртуального хоста сервера в каталог `public/`

## Установка в локальном окружении

### Понадобится
* [Git](https://git-scm.com/doc)
* [Docker](https://docs.docker.com/) и [Docker Compose](https://docs.docker.com/compose/install/)

### Установка
1. В консоли перейди в каталог куда будет клонирован корневой каталог проекта и выполни:
   ```
   git clone https://github.com/kroloburet/Task_28_08_2021.git \
   && cd ./Task_28_08_2021 \
   && git checkout -b dev \
   && docker-compose up -d --build
   ```
2. PhpMyadmin для управления базой доступен по адресу `localhost:8080`
   ```
   Root пользователь: root
   Пароль root пользователя: root
   
   Admin пользователь: admin
   Пароль Adnin пользователя: admin
   ```
3. Импортируй в базу данных таблицы из файла `public/source/test.sql` или используй автоимпорт (смотри на главной странице проекта)
4. В `local/` находятся каталоги сервисов используемыми Docker. Контейнер базы данных использует для записи и хранения данных каталог `local/db/data/`
5. Перейди по адресу `localhost`

## Лицензия
Свободная лицензия [MIT license](https://opensource.org/licenses/MIT).
