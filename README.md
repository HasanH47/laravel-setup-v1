# Laravel Auth and CRUD Starter

This project is a Laravel setup with pre-configured authentication, CRUD operations, and various best practices implemented. It provides a solid foundation for building robust web applications.

## Features

- **Authentication**: Pre-configured auth system
- **CRUD Operations**: Basic Create, Read, Update, Delete functionality
- **Request Classes**: Separated validation logic using Laravel Request classes
- **Service Layer**: Business logic encapsulated in service classes
- **Component-based Alerts**: Reusable alert components
- **Route Organization**: Separated routes (e.g., users.php) required in web.php
- **Unit Tests**: Basic test suite included
- **Frontend**: Bootstrap, jQuery, and DataTables integration
- **Middleware**: AuthCheck and GuestCheck middleware implemented

## Getting Started

### Prerequisites

- PHP 8.2+
- Composer
- Node.js and npm

### Installation

1. Clone the repository:
   ```
   git clone https://github.com/HasanH47/laravel-setup-v1.git
   ```

2. Navigate to the project directory:
   ```
   cd laravel-setup-v1
   ```

3. Install PHP dependencies:
   ```
   composer install
   ```

4. Copy the example env file and make the required configuration changes in the .env file:
   ```
   cp .env.example .env
   ```

5. Generate a new application key:
   ```
   php artisan key:generate
   ```

6. Run database migrations:
   ```
   php artisan migrate
   ```

### Running the Application

Start the local development server:
```
php artisan serve
```

You can now access the server at http://localhost:8000

## Running Tests

To run the test suite:
```
php artisan test
```

## Useful Artisan Commands

- Generate a new component:
  ```
  php artisan make:component ComponentName
  ```

- Generate a new request class:
  ```
  php artisan make:request RequestName
  ```

- Generate a new unit test:
  ```
  php artisan make:test TestName
  ```

- Generate a new controller:
  ```
  php artisan make:controller ControllerName
  ```

- Generate a new model:
  ```
  php artisan make:model ModelName
  ```

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
