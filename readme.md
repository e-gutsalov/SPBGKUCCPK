# SPBGKUCCPK

## Описание:

Представьте сервис, в котором сотрудники могут забронировать служебный автомобиль из парка автомобилей для рабочих нужд.

В приложение можно добавлять автомобили и пользователей.

У автомобиля есть поля марка, номер(ГРЗ)

У пользователя есть поле имя, фамилия, должность.

Автомобилей и пользователей должно быть несколько.

Пользователь может бронировать лишь 1 автомобиль, этот автомобиль будет недоступен для других пользователей.

## Задание:

Разработать сервис (REST API) для бронирования служебного в который можно добавлять автомобили и пользователей и бронировать автомобиль на конкретного пользователя.

## Условия:

• Для приложения обязательным условием будет наличие любой базы данных

• Приложение предоставить в виде ссылки на github



# Требования:

Symfony >= 6.0 PHP >= 8.1 MySQL >= 5.7

Инициализация приложения:

Подготовка:

cd projects/

git clone https://github.com/e-gutsalov/SPBGKUCCPK.git

cd SPBGKUCCPK/

composer install

Настроить веб-сервер на директорию /SPBGKUCCPK/public, так чтобы все запросы шли на index.php

Проверить настройки к базе данных в файле .env

Необходимо указать действующего пользователя базы данных и пароль, а также хост и порт:

DATABASE_URL=mysql://db_user:db_password@localhost:3306/spbgkuccpk

Далее:

php bin/console doctrine:database:create

php bin/console doctrine:migrations:migrate

Настройка завершена.

## Описание взаимодействия с API:

## Все запросы к апи находятся в директории проекта http.

### Добавление пользователя 

POST http://localhost:8000/api/add/user
Content-Type: application/json

{
"name": "Сергей",
"surname": "Петров",
"position": "Менеджер"
}

### Добавление машины:

POST http://localhost:8000/api/add/car
Content-Type: application/json

{
"brand": "Лада 2110",
"license_plate": "В333ВВ78"
}

### Бронирование машины:
POST http://localhost:8000/api/book/car
Content-Type: application/json

{
"userId": 1,
"carId": 1
}

### Снять бронь с машины

POST http://localhost:8000/api/unband/car
Content-Type: application/json

{
"carId": 1
}
