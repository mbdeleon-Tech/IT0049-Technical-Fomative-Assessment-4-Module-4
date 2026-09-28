# Northstar POS Sessions and Authentication Edition

Northstar POS is a CodeIgniter 4 application for IT0049 Technical Formative Assessment 4. It extends the separate TFA3 project with staff login, hashed passwords, session-based authentication, protected management routes, and logout.

## Live website

[Open the hosted TFA4 application](http://tfa4-deleon-tc33.infinityfreeapp.com/)

## Demo staff login

- Username: `admin.marc`
- Password: `Northstar123!`

All six sample users use the same demonstration password. The database stores only the password hash created by PHP's `password_hash()` function.

## Pages and access rules

- `/` - public landing page
- `/about` - public project background
- `/login` - public staff login form
- `/customers`, `/customers/new`, `/customers/{id}/edit` - protected customer management
- `/users`, `/users/new`, `/users/{id}/edit` - protected user management
- `/logout` - protected POST action that destroys the current session

Logged-out visitors who request a protected page are redirected to `/login`. After a successful login, the session stores the user's ID, username, full name, and authenticated state.

## Requirements

- PHP 8.1 or newer with MySQLi enabled
- Composer 2
- MySQL 5.7 or newer, or MariaDB 10.4 or newer

## Local setup using the SQL export

1. Clone the repository and open the project folder.
2. Run `composer install`.
3. Create a MySQL database named `tfa4_pos`.
4. Import `database/tfa4_pos.sql` into the database.
5. Copy `.env.example` to `.env` and update the database username and password.
6. Run `php spark serve`.
7. Open `http://localhost:8080` and sign in with the demo account.

## Upgrade setup using migration and seeder

For an existing TFA3 database, configure `.env`, then run:

```bash
php spark migrate
php spark db:seed Tfa4UserPasswordSeeder
```

The migration adds the `users.password` column, and the seeder assigns a fresh `password_hash()` value for the demonstration password to existing users.

## Authentication structure

- `app/Controllers/Auth.php` validates login credentials with `password_verify()`, starts the session, and handles logout.
- `app/Filters/AuthFilter.php` redirects logged-out visitors before protected controllers run.
- `app/Config/Routes.php` applies the `auth` filter to every customer and user route, including create and edit forms.
- `app/Controllers/Users.php` hashes passwords before new or changed credentials are stored.
- `app/Database/Migrations` and `app/Database/Seeds` provide the TFA3-to-TFA4 upgrade path.
- `database/tfa4_pos.sql` is the complete portable schema and sample dataset.

User-list and edit queries deliberately omit the password column so hashes are never rendered in a view.

## Run tests

```bash
composer test
```

The automated checks cover public login access, logged-out redirects, logged-in protected access, route/filter registration, password hashing and verification, forms, and database files.

## Student

- Marco Arsenio B. De Leon
- Section TC33
- Professor: Mr. Von Erick Magbitang
