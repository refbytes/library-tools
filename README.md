## About Library Tools
Library Tools is an open source application for managing library resources. It is built with Laravel and Filament.
Currently it is in the early stages of development and contains A-Z List functionality.

## Local Development
Install [Laravel Herd](https://herd.laravel.com/)

1. Clone the repository to your computer
2. Copy the .env.example file to .env and update relevant settings (most laravel settings are a sensible default, but this might include app url, database settings, etc.) There are some additional app-specific settings in the env file that can be set later and are covered more fully in the documentation.
3. Run the following commands:
```
npm run install 
composer install
php artisan migrate
php artisan make:filament-user
```

## Roadmap

### Subscriptions (AZ List)
- [x] Admin dashboard A-Z List management
- [ ] Patron facing frontend for AZ List
- [ ] Patron SSO authentication
- [ ] Page builder for custom pages
- [ ] Research Guides
- [ ] Blog management
- [ ] Subject Expert management and display
- [ ] Renewal notifications
- [ ] Task workflow management

### Tickets (Virtual Reference)
- [ ] Admin dashboard for ticket management
- [ ] Patron facing frontend for ticket submission
- [ ] Email ticket management
- [ ] Chat
- [ ] FAQ management

## Possible Future Modules
- Room Reservations
- Appointment Scheduling
- eReserves
- Digital Collections
