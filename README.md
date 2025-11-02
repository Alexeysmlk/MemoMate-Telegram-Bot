# MemomateBot

Telegram-бот для напоминаний о днях рождения. Построен на Laravel 12.

> ⚠️ Ранняя версия: проект находится в активной разработке, функционал ограничен.

## Возможности

В текущей версии бот умеет:
- 🎂 Отправлять напоминания о днях рождения
- Работать в группах Telegram

## Технологии

- Laravel 12
- PHP 8.2+
- PostgreSQL 16
- Telegraph (Telegram Bot API)
- Docker & Docker Compose

## Требования

- Docker и Docker Compose

## Установка

### 1. Клонирование репозитория

```bash
git clone <repository-url>
cd memomatebot
```

### 2. Настройка окружения

```bash
cp .env.example .env
```

Отредактируйте `.env` и укажите:
- Настройки базы данных PostgreSQL
- Токен Telegram-бота (`TELEGRAM_BOT_TOKEN`)

### 3. Запуск

```bash
# Запуск контейнеров
docker-compose up -d

# Установка зависимостей
docker-compose exec app composer install

# Генерация ключа приложения
docker-compose exec app php artisan key:generate

# Миграции базы данных
docker-compose exec app php artisan migrate
```

### 4. Настройка Telegram-бота

```bash
# Регистрация вебхука
docker-compose exec app php artisan telegraph:set-webhook
```

## Доступ

- 🌐 Веб-приложение: http://localhost:8080
- Laravel Telescope: http://localhost:8080/telescope
- PostgreSQL: localhost:5432
