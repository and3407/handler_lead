# Иструкции

## Инструкция для локальной среды разработки

1. Выполнить сборку образов и запустить контейнеры.
````
docker-compose up --build -d
````
2. Выполнить
````
composer update
````
3. Войти в контейнер php.
````
docker-compose exec php bash

````

4. Запустить
````
php index.php start
````