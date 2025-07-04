# EventEase Application - Testing Guide

## Application Status: ✅ READY FOR TESTING

The EventEase application is fully prepared for comprehensive testing with complete functionality and test data.

## Application Overview

EventEase is a Laravel-based event management system that allows:
- **Users**: Browse and register for events, view their tickets
- **Admins**: Create, manage events, and verify tickets
- **Theme Toggle**: Full light/dark mode support

## Access Information

**Application URL**: `http://127.0.0.1:8000`

### Test Accounts

#### Admin Account
- **Email**: `admin@example.com`
- **Password**: `password`
- **Capabilities**: Full admin access, event management, ticket verification

#### User Accounts
- **Email**: `test@example.com` | **Password**: `password`
- **Email**: `user@example.com` | **Password**: `password`
- **Email**: `marcus@gmail.com` | **Password**: `password`
- **Capabilities**: Browse events, register for events, view tickets

## Test Data Available

### Events (5 Total)
1. **Laravel Conference 2025** - Published - $150.00 (Max: 200 attendees)
2. **Web Development Workshop** - Published - $75.00 (Max: 50 attendees)
3. **Startup Networking Event** - Published - $25.00 (Max: 100 attendees)
4. **AI & Machine Learning Summit** - Draft - $200.00 (Max: 300 attendees)
5. **Free Coding Bootcamp** - Published - $0.00 (Max: 30 attendees)

## Features to Test

### 🌟 Core Functionality

#### User Features
- [ ] **Registration/Login**: Test account creation and authentication
- [ ] **Event Browsing**: View available events on dashboard
- [ ] **Event Registration**: Register for published events
- [ ] **Ticket Management**: View registered tickets at `/my-tickets`
- [ ] **Profile Management**: Update user profile information

#### Admin Features
- [ ] **Admin Dashboard**: Access admin event management at `/admin/events`
- [ ] **Event Creation**: Create new events with full details
- [ ] **Event Management**: Edit, publish/draft, delete events
- [ ] **Ticket Verification**: Verify tickets at `/admin/verify`
- [ ] **Event Status Control**: Manage published/draft/cancelled statuses

### 🎨 UI/UX Features

#### Theme Toggle
- [ ] **Desktop Theme Toggle**: Click moon/sun icon in top navigation
- [ ] **Mobile Theme Toggle**: Access via hamburger menu
- [ ] **Persistence**: Theme choice saved across sessions
- [ ] **Visual Changes**: All elements properly switch between light/dark

#### Responsive Design
- [ ] **Desktop View**: Full navigation and layout
- [ ] **Mobile View**: Hamburger menu, responsive event cards
- [ ] **Tablet View**: Intermediate responsive behavior

### 🔧 Technical Features

#### Database Operations
- [ ] **Event Registration**: Creates ticket records
- [ ] **Capacity Management**: Prevents over-registration
- [ ] **User Relationships**: Proper ticket-user-event associations

#### Security
- [ ] **Authentication**: Protected routes require login
- [ ] **Authorization**: Admin-only access to admin features
- [ ] **Role-based Access**: Different capabilities per user role

## Testing Scenarios

### Scenario 1: User Registration Flow
1. Visit `/register` and create a new account
2. Login with new credentials
3. Browse events on dashboard
4. Register for an available event
5. Check ticket in "My Tickets"

### Scenario 2: Admin Event Management
1. Login as admin (`admin@example.com`)
2. Navigate to Admin Events
3. Create a new event
4. Edit an existing event
5. Change event status (draft/published)
6. Test ticket verification functionality

### Scenario 3: Theme Toggle Testing
1. Load any page (logged in or not)
2. Click theme toggle in navigation
3. Verify immediate visual changes
4. Refresh page to test persistence
5. Test on mobile by opening hamburger menu

### Scenario 4: Capacity Management
1. Create an event with max_registrants = 1
2. Register one user
3. Try to register another user
4. Verify "Event Full" message appears

## Development Commands

```bash
# Start development server
php artisan serve

# Verify application data
php artisan app:verify-data

# Reset database with fresh test data
php artisan migrate:fresh --seed

# Clear all caches
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Build frontend assets
npm run build
```

## Expected Behavior

### ✅ What Should Work
- All authentication flows
- Event registration/management
- Theme switching (light/dark mode)
- Responsive design on all devices
- Admin ticket verification
- User profile management

### 🚨 Known Limitations
- No email verification (disabled for testing)
- Simple password requirements
- Basic styling (can be enhanced)
- No payment processing (prices are display-only)

## Troubleshooting

If you encounter issues:

1. **Clear caches**: Run all cache clear commands above
2. **Reset database**: Use `php artisan migrate:fresh --seed`
3. **Rebuild assets**: Run `npm run build`
4. **Check logs**: Look in `storage/logs/` for errors

## Development Environment

- **PHP**: Laravel 11
- **Database**: SQLite (database.sqlite)
- **Frontend**: Vite + Tailwind CSS + Alpine.js
- **Server**: PHP built-in development server (port 8000)

---

**Status**: ✅ Application is fully ready for comprehensive testing!
**Last Updated**: July 4, 2025
