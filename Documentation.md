## Dependency Installation & Setup Guide

This section provides step-by-step instructions for installing all dependencies required to run the EventEase application, especially for users new to Laravel.

### 1. Prerequisites

Ensure you have the following installed:

- **PHP** (version 8.2 or higher recommended)
- **Composer** (PHP dependency manager)
- **Node.js** (version 18+ recommended)
- **npm** (comes with Node.js)
- **MySQL** (version 8.0+ recommended)
- **Web Server** (Apache/Nginx or use XAMPP for easy setup)

#### Installation Resources

- [Download PHP](https://www.php.net/downloads)
- [Get Composer](https://getcomposer.org/download/)
- [Download Node.js & npm](https://nodejs.org/)
- [Download MySQL](https://dev.mysql.com/downloads/)
- [Download XAMPP](https://www.apachefriends.org/download.html) (Recommended for beginners - includes PHP, MySQL, Apache)

### 2. Easy Setup Option: XAMPP (Recommended for Beginners)

If you're new to web development, XAMPP provides everything you need in one package:

1. **Download XAMPP** from [https://www.apachefriends.org/](https://www.apachefriends.org/)
2. **Install XAMPP** and start Apache and MySQL services
3. **Install Composer** separately from [https://getcomposer.org/](https://getcomposer.org/)
4. **Install Node.js** from [https://nodejs.org/](https://nodejs.org/)

### 3. Clone/Download the Project

```bash
# If using Git
git clone <repository-url>
cd EventEase/iJoin

# Or download and extract the ZIP file to your web server directory
# For XAMPP: Extract to C:\xampp\htdocs\EventEase\iJoin
```

### 4. Install PHP Dependencies

```bash
composer install
```

### 5. Install JavaScript Dependencies

```bash
npm install
```

### 6. Environment Setup

- Copy the example environment file:

    ```bash
    cp .env.example .env
    ```

- Generate the application key:

    ```bash
    php artisan key:generate
    ```

- Update your `.env` file with MySQL database configuration:

    ```env
    APP_NAME=EventEase
    APP_ENV=local
    APP_KEY=base64:YOUR_GENERATED_KEY_HERE
    APP_DEBUG=true
    APP_URL=http://localhost/EventEase/iJoin/public

    LOG_CHANNEL=stack

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=eventease
    DB_USERNAME=root
    DB_PASSWORD=

    # For XAMPP users, leave DB_PASSWORD empty unless you set a MySQL root password
    ```

### 7. Create MySQL Database

#### Option A: Using phpMyAdmin (XAMPP users)
1. Open [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
2. Click "New" to create a database
3. Name it `eventease`
4. Click "Create"

#### Option B: Using MySQL Command Line
```bash
mysql -u root -p
CREATE DATABASE eventease;
EXIT;
```

### 8. Run Database Migrations & Seeders

```bash
php artisan migrate:fresh --seed
```

This will create all necessary tables and populate them with sample data including:
- Admin user: `admin@example.com` / `password`
- Test users and sample events

### 9. Create Storage Link

```bash
php artisan storage:link
```

### 10. Build Frontend Assets

```bash
npm run build
```

### 11. Start the Development Server

#### Option A: Using Laravel's Built-in Server
```bash
php artisan serve
```
Visit [http://127.0.0.1:8000](http://127.0.0.1:8000)

#### Option B: Using XAMPP (Place in htdocs)
If you placed the project in `C:\xampp\htdocs\EventEase\iJoin`, visit:
[http://localhost/EventEase/iJoin/public](http://localhost/EventEase/iJoin/public)

### 12. Test Login Credentials

**Admin Account:**
- Email: `admin@example.com`
- Password: `password`

**Regular User Account:**
- Email: `test@example.com`
- Password: `password`

---

## Troubleshooting

### Common Issues:

1. **Composer not found**: Make sure Composer is installed and added to your system PATH
2. **PHP extensions missing**: Install required extensions: `php-mysql`, `php-mbstring`, `php-xml`, `php-curl`
3. **Database connection failed**: Check your MySQL service is running and credentials are correct
4. **Permission errors**: Ensure proper file permissions for `storage/` and `bootstrap/cache/` directories
5. **npm errors**: Try deleting `node_modules/` and running `npm install` again

### Required PHP Extensions:
- BCMath
- Ctype
- Fileinfo
- JSON
- Mbstring
- OpenSSL
- PDO
- PDO_MySQL
- Tokenizer
- XML

**Tip:** If you encounter errors, check the Laravel logs in `storage/logs/laravel.log` or refer to the official [Laravel Installation Guide](https://laravel.com/docs/11.x/installation).