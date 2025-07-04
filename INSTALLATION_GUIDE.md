# EventEase - Complete Setup Guide for Beginners

## 📋 Overview

EventEase is a Laravel-based event management web application. This guide will help you set up and run the website from scratch, even if you have no prior Laravel experience.

## 🔧 Prerequisites & Dependencies

### Required Software

#### 1. **PHP** (Version 8.1 or higher)
- **Windows**: Download from [php.net](https://windows.php.net/download/)
- **macOS**: Use Homebrew: `brew install php`
- **Linux**: Use package manager: `sudo apt-get install php8.1`

#### 2. **Composer** (PHP Package Manager)
- Download from [getcomposer.org](https://getcomposer.org/download/)
- Follow installation instructions for your operating system

#### 3. **Node.js and NPM** (Version 18 or higher)
- Download from [nodejs.org](https://nodejs.org/)
- NPM is included with Node.js

#### 4. **Git** (Version Control)
- Download from [git-scm.com](https://git-scm.com/)

### Alternative: All-in-One Solutions

#### **XAMPP** (Recommended for Beginners)
- Download from [apachefriends.org](https://www.apachefriends.org/)
- Includes PHP, MySQL, and Apache web server
- Easy to install and configure

#### **Laravel Herd** (macOS/Windows)
- Download from [herd.laravel.com](https://herd.laravel.com/)
- Official Laravel development environment

## 🚀 Installation Steps

### Step 1: Verify Prerequisites

Open your terminal/command prompt and verify installations:

```bash
# Check PHP version (should be 8.1+)
php --version

# Check Composer
composer --version

# Check Node.js and NPM
node --version
npm --version

# Check Git
git --version
```

### Step 2: Download the Project

```bash
# Navigate to your web directory
# For XAMPP users: cd C:\xampp\htdocs
# For others: choose your preferred directory

# Clone or download the project
cd /path/to/your/web/directory
# If you have the project folder, copy it here
# If using Git: git clone <repository-url>
```

### Step 3: Install PHP Dependencies

```bash
# Navigate to the project directory
cd EventEase/iJoin

# Install PHP packages using Composer
composer install
```

**Note**: If you get permission errors on Windows, run Command Prompt as Administrator.

### Step 4: Install JavaScript Dependencies

```bash
# Install Node.js packages
npm install
```

### Step 5: Environment Configuration

```bash
# Copy the environment file
cp .env.example .env
# On Windows: copy .env.example .env

# Generate application key
php artisan key:generate
```

### Step 6: Database Setup

The project uses SQLite (no additional database server needed):

```bash
# Create the database file
touch database/database.sqlite
# On Windows: type nul > database\database.sqlite

# Run database migrations and seed test data
php artisan migrate:fresh --seed
```

### Step 7: Build Frontend Assets

```bash
# Build CSS and JavaScript files
npm run build
```

### Step 8: Start the Development Server

```bash
# Start the Laravel development server
php artisan serve
```

The website will be available at: `http://127.0.0.1:8000`

## 🔐 Login Information

### Admin Account
- **Email**: `admin@example.com`
- **Password**: `password`
- **Access**: Full admin privileges, event management

### User Accounts
- **Email**: `test@example.com` | **Password**: `password`
- **Email**: `user@example.com` | **Password**: `password`
- **Email**: `marcus@gmail.com` | **Password**: `password`
- **Access**: Browse events, register for events, view tickets

## 📁 PHP Login Code Location

The login functionality is spread across several files:

### 1. **Main Login Controller**
```
📂 app/Http/Controllers/Auth/AuthenticatedSessionController.php
```
- Handles login form display, authentication, and logout
- **Key methods**:
  - `create()`: Shows login form
  - `store()`: Processes login attempt
  - `destroy()`: Handles logout

### 2. **Login Validation**
```
📂 app/Http/Requests/Auth/LoginRequest.php
```
- Validates email and password
- Handles rate limiting and authentication logic

### 3. **Login View Template**
```
📂 resources/views/auth/login.blade.php
```
- HTML form for user login
- Uses Laravel Blade templating

### 4. **Routes Configuration**
```
📂 routes/auth.php
```
- Defines login/logout URL routes

## 🛠️ Common Issues & Solutions

### Issue 1: "composer: command not found"
**Solution**: Composer is not installed or not in PATH
- Reinstall Composer from [getcomposer.org](https://getcomposer.org/)
- Restart your terminal after installation

### Issue 2: "php: command not found"
**Solution**: PHP is not installed or not in PATH
- Install PHP or add it to your system PATH
- For XAMPP users: add `C:\xampp\php` to PATH

### Issue 3: "npm: command not found"
**Solution**: Node.js is not installed
- Download and install from [nodejs.org](https://nodejs.org/)

### Issue 4: Permission Denied Errors
**Solution**: 
- **Windows**: Run Command Prompt as Administrator
- **macOS/Linux**: Use `sudo` for installation commands

### Issue 5: Database Connection Error
**Solution**: 
- Ensure `database/database.sqlite` file exists
- Run: `php artisan migrate:fresh --seed`

### Issue 6: Page Not Loading/Styling Issues
**Solution**: 
- Run: `npm run build`
- Clear cache: `php artisan config:clear`

## 🔄 Development Commands

### Daily Development
```bash
# Start the server
php artisan serve

# Watch for file changes (in another terminal)
npm run dev
```

### Maintenance Commands
```bash
# Reset database with fresh data
php artisan migrate:fresh --seed

# Clear all caches
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Verify application status
php artisan app:verify-data
```

## 📂 Project Structure

```
EventEase/iJoin/
├── app/
│   ├── Http/Controllers/          # PHP controllers
│   │   ├── Auth/                  # Authentication controllers
│   │   ├── EventController.php    # Event management
│   │   └── AdminEventController.php
│   ├── Models/                    # Database models
│   └── ...
├── resources/
│   ├── views/                     # Blade templates (HTML)
│   ├── css/                       # Stylesheets
│   └── js/                        # JavaScript
├── routes/
│   ├── web.php                    # Web routes
│   └── auth.php                   # Authentication routes
├── database/
│   ├── migrations/                # Database structure
│   └── seeders/                   # Test data
└── public/                        # Web server files
```

## 🌐 Accessing the Website

1. **Homepage**: `http://127.0.0.1:8000`
2. **Login**: `http://127.0.0.1:8000/login`
3. **Register**: `http://127.0.0.1:8000/register`
4. **Dashboard**: `http://127.0.0.1:8000/dashboard` (after login)
5. **Admin Panel**: `http://127.0.0.1:8000/admin/events` (admin only)

## 🎯 Testing Features

### User Features
- Browse available events
- Register for events
- View purchased tickets
- Update profile information

### Admin Features
- Create and manage events
- View event registrations
- Verify tickets
- Control event status (published/draft/cancelled)

### Theme Toggle
- Light/Dark mode switch in navigation
- Persistent across sessions
- Works on both desktop and mobile

## 📞 Getting Help

If you encounter issues:

1. **Check the error message** in your terminal
2. **Clear caches** using the maintenance commands above
3. **Reset database** with `php artisan migrate:fresh --seed`
4. **Rebuild assets** with `npm run build`
5. **Check Laravel logs** in `storage/logs/laravel.log`

## ✅ Success Checklist

- [ ] PHP 8.1+ installed and working
- [ ] Composer installed
- [ ] Node.js and NPM installed
- [ ] Project dependencies installed (`composer install` + `npm install`)
- [ ] Environment configured (`.env` file)
- [ ] Database created and seeded
- [ ] Frontend assets built (`npm run build`)
- [ ] Development server running (`php artisan serve`)
- [ ] Website accessible at `http://127.0.0.1:8000`
- [ ] Can login with test accounts

---

**🎉 Congratulations!** If all items are checked, EventEase is ready to use!

For advanced Laravel concepts, visit the [Laravel Documentation](https://laravel.com/docs).
