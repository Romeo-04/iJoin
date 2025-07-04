## Dependency Installation & Setup Guide

This section provides step-by-step instructions for installing all dependencies required to run the iJOIN application, especially for users new to Laravel.

### 1. Prerequisites

Ensure you have the following installed:

- **PHP** (version 8.2 or higher recommended)
- **Composer** (PHP dependency manager)
- **Node.js** (version 18+ recommended)
- **npm** (comes with Node.js)
- **SQLite** (or another supported database)

#### Installation Resources

- [Download PHP](https://www.php.net/downloads)
- [Get Composer](https://getcomposer.org/download/)
- [Download Node.js & npm](https://nodejs.org/)
- [SQLite Download](https://www.sqlite.org/download.html)

### 2. Clone the Repository

```bash
git clone <repository-url>
cd iJoin
```

### 3. Install PHP Dependencies

```bash
composer install
```

### 4. Install JavaScript Dependencies

```bash
npm install
```

### 5. Environment Setup

- Copy the example environment file:

    ```bash
    cp .env.example .env
    ```

- Generate the application key:

    ```bash
    php artisan key:generate
    ```

- Ensure your `.env` file has the following for SQLite:

    ```
    DB_CONNECTION=sqlite
    DB_DATABASE=/absolute/path/to/database.sqlite
    ```

- Create the SQLite database file if it doesn't exist:

    ```bash
    touch database/database.sqlite
    ```

### 6. Run Database Migrations & Seeders

```bash
php artisan migrate:fresh --seed
```

### 7. Build Frontend Assets

```bash
npm run build
```

### 8. Start the Development Server

```bash
php artisan serve
```

Visit [http://127.0.0.1:8000](http://127.0.0.1:8000) in your browser.

---

**Tip:** If you encounter errors, refer to the Troubleshooting section above or check the official [Laravel Installation Guide](https://laravel.com/docs/11.x/installation).