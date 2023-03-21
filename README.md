# Иструкции

## Инструкция для локальной среды разработки

1. Выполнить сборку образов и запустить контейнеры.
````
docker-compose up --build -d
````

2. Войти в контейнер php.
````
docker-compose exec php bash
composer update
supervisorctl
php index.php start
````