#Цепочки символов

## Использование:

```
use VTikunov\Chains\Byte;

$bytes = [1, 1, 0, 1, 1, 0, 1, 1, 1];

$length = Byte::maxOnesAfterRemoveItem(...$bytes);
```

## Окружение для разработки и тестирования

### 1. Установите docker и docker-compose
### 2. Клонируйте репозитарий
### 2. Установите зависимости composer

* ``make install``

## Основные команды

* ``make up`` - запуск контейнеров
* ``make down`` - остановка контейнеров
* ``make test`` - запуск всех тестов
* ``make test-phpunit ARGS="<аргументы cli при необходимости>"`` - запуск тестов PhpUnit
* ``make test-phpstan`` - запуск тестов phpstan
* ``make test-phpcs`` - запуск тестов phpcs
* ``make fix-phpcs`` - автоматическое исправление кода под требования phpcs

Остальные команды можно найти в **MakeFile**
