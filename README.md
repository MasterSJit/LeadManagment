# Lead Management System

This is a Lead Management System built with CodeIgniter 3. It allows employees to import leads from Excel files, manage the leads, and export them when needed.

## Features

- Lead Import: Upload Excel files containing lead information
- Lead Management: View, update, and delete leads
- Lead Export: Export filtered leads to Excel files
- Role-based access control
- Dashboard with lead statistics
- Role-based Lead Managment

## Requirements

- PHP 7.3 - 8.1
- MySQL
- Composer (for installing dependencies)

## Installation

1. Clone the repository: 
2. Navigate to the project directory:
3. Install dependencies: composer install
4. Create a new MySQL database for the project e.g. leadmgmt
5. Update the database configuration in `application/config/database.php`:
```php
$db['default'] = array(
    'dsn'   => '',
    'hostname' => 'localhost',
    'username' => 'your_username',
    'password' => 'your_password',
    'database' => 'your_database_name',
    'dbdriver' => 'mysqli',
);
```

6. Import SQL file leadmgmt.sql
7. Change the base url in config `$config['base_url'] = 'http://localhost/lead-management-system/'`;
