# MemomateBot

Laravel 12 приложение для управления заметками и напоминаниями.

## Требования

- Docker и Docker Compose

## Быстрый старт

### 1. Клонирование и настройка окружения

```bash
# Клонируйте репозиторий
git clone <repository-url>
cd memomatebot

# Скопируйте файл окружения (если еще не скопирован)
cp .env.example .env
```

### 2. Запуск через Docker

```bash
# Запустите все сервисы
docker-compose up -d

# Установите зависимости PHP
docker-compose exec app composer install

# Сгенерируйте ключ приложения
docker-compose exec app php artisan key:generate

# Выполните миграции базы данных
docker-compose exec app php artisan migrate
```

## Доступ к приложению

- **Веб-приложение**: http://localhost:8080
- **База данных PostgreSQL**: localhost:5432