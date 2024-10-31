# SchoolEase

[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/AhmedGamal905/schoolease/tests.yml?branch=main)](https://github.com/AhmedGamal905/schoolease/actions?query=workflow%3Atests+branch%3Amain)
![Test Coverage](https://raw.githubusercontent.com/AhmedGamal905/schoolease/main/badge-coverage.svg)

SchoolEase is a comprehensive school management system designed to streamline administrative tasks and enhance the learning experience for students, teachers, and administrators. Built using PHP, Laravel, HTML, CSS, JavaScript, Livewire, and MySQL, SchoolEase offers a robust and user-friendly platform for managing school operations.

## Table of Contents
- [SchoolEase](#schoolease)
  - [Table of Contents](#table-of-contents)
  - [Features](#features)
  - [Installation](#installation)
  - [Usage](#usage)
  - [Testing](#testing)
  - [Roles and Permissions](#roles-and-permissions)
  - [Dashboard](#dashboard)
  - [Contributing](#contributing)

## Features
- **User Roles and Permissions**: Manage roles and permissions using the Spatie Permissions package.
- **Dashboard**: Accessible by students, teachers, and super admins.
- **Admin Functions**: Create roles, assign permissions, manage users, assign classrooms, and create subjects.
- **Teacher Functions**: Create and manage lessons, exams, and attendance. Ensure no overlapping lessons.
- **Student Functions**: View lessons, exams, grades, and attendance.

## Installation
1. **Clone the repository**:
    ```bash
    git clone https://github.com/AhmedGamal905/schoolease
    cd schoolease
    ```

2. **Install dependencies**:
    ```bash
    composer install
    ```

3. **Set up environment variables**:
  Create a `.env` file in the root directory and add the necessary configuration values

4. **Configure the database** in the `.env` file:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=schoolease
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5. **Run migrations and seed the database**:
    ```bash
    php artisan migrate --seed
    ```

6. **Start the development server**:
    ```bash
    php artisan serve
    npm run dev
    ```

## Usage
- **Admin**: Log in to create roles, assign permissions, manage users, assign classrooms, and create subjects.
- **Teacher**: Log in to create and manage lessons, exams, grades, and attendance.
- **Student**: Log in to view lessons, exams, grades, and attendance.

## Testing
Tests have been created using PEST to ensure that modifications or new features do not interfere with the existing codebase. To run the tests, use:
```bash
php artisan test
```

## Roles and Permissions
Roles and permissions are managed using the Spatie Permissions package. The following roles are available:
- **Super Admin**: Full access to all functionalities.
- **Teacher**: Access to manage lessons, exams, grades, and attendance.
- **Student**: Access to view lessons, exams, grades, and attendance.

## Dashboard
The dashboard provides a centralized interface for all users:
- **Super Admin**: Manage roles, permissions, users, classrooms, and subjects.
- **Teacher**: Manage lessons, exams, grades, and attendance.
- **Student**: View lessons, exams, grades, and attendance.

## Contributing
Contributions are welcome! Please fork the repository and submit a pull request.