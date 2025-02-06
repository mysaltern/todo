# Laravel 11 TODO List App

This project is a simple TODO list application built using **Laravel 11** for the backend. It supports basic operations such as viewing, adding, and deleting TODO items. The backend stores data in **Redis**, eliminating the need for a traditional database.

---

## Project Setup

### Requirements:
- **PHP**: ^8.2
- **Composer**
- **Node.js** and **npm**
- **Redis**: Used for caching, queues, and session management.

---

## Installation Guide

1. **Clone the repository:**
    ```bash
    git clone <repository-url>
    cd <project-directory>
    ```

2. **Install PHP dependencies:**
    ```bash
    composer install
    ```

3. **Install Node.js dependencies:**
    ```bash
    npm install
    ```

4. **Setup environment:**
    - Copy `.env.example` to `.env` and modify any settings if necessary:
      ```bash
      cp .env.example .env
      ```
    - The application comes with Redis configured for session storage, caching, and queues.

5. **Generate the application key:**
    ```bash
    php artisan key:generate
    ```

6. **Run the development server:**
    ```bash
    php artisan serve
    npm run dev
    ```

---

## Redis Configuration
This project uses Redis to store session data, queues, and cache.

### Redis settings in `.env`:
```
REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
CACHE_STORE=redis
```
Make sure you have Redis installed and running:
```bash
redis-server
```
You can customize Redis settings in the `.env` file as needed.

---

## Key Features
- **In-memory storage:** No database setup is required. Redis stores all TODO items in memory.
- **Modern development tools:** The project uses Laravel 11 with `pestphp` for testing, `tinker` for quick debugging, and `sail` for local development environments.
- **Session and cache management:** Fully managed through Redis.

---

## Development Tools
- **Laravel Sail:** A local development environment built using Docker.
  ```bash
  ./vendor/bin/sail up
  ```
- **Laravel Pint:** For linting and code styling.
  ```bash
  ./vendor/bin/pint
  ```
- **Pest PHP:** For unit and feature tests.
  ```bash
  ./vendor/bin/pest
  ```
- **Laravel Tinker:** A REPL environment for exploring and interacting with the application.
  ```bash
  php artisan tinker
  ```

---

## Important Commands

- **Start local server:**
  ```bash
  php artisan serve
  ```

- **Run the queue listener:**
  ```bash
  php artisan queue:listen
  ```

- **Run the development build:**
  ```bash
  npm run dev
  ```

- **Run tests:**
  ```bash
  php artisan test
  ```

---

## Environment Variables
Below are some important environment variables and their descriptions:

| Variable            | Description                                 | Default Value        |
|--------------------|---------------------------------------------|----------------------|
| APP_NAME            | The application name                       | Laravel              |
| APP_ENV             | The environment (local, production)        | local                |
| APP_DEBUG           | Enable/disable debug mode                  | true                 |
| APP_TIMEZONE        | Timezone setting                           | UTC                  |
| REDIS_HOST          | Redis server host                          | 127.0.0.1            |
| REDIS_PORT          | Redis server port                          | 6379                 |
| QUEUE_CONNECTION    | Queue connection (Redis used here)         | redis                |
| SESSION_DRIVER      | Session storage driver                     | redis                |
| CACHE_STORE         | Cache store driver                         | redis                |

---

## Project Structure

```
├── app/                 # Application source code
├── bootstrap/           # Bootstrap files
├── config/              # Configuration files
├── database/            # Database factories and seeders (not used in this project)
├── public/              # Publicly accessible files
├── resources/           # Frontend resources
├── routes/              # Route definitions
├── storage/             # Logs, compiled views, and cache
├── tests/               # Unit and feature tests
└── .env                 # Environment configuration
```

---

