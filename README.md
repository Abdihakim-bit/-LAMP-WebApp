# LAMP-WebApp

## Overview

LAMP-WebApp is a simple web application built on the LAMP stack (Linux, Apache, MySQL, PHP). It provides user authentication and profile management features, allowing users to register, log in, and view their profiles. In addition to the existing features, the application has been enhanced to include an articles board where users can post and view articles.

## Features

- User registration with username and password
- Secure password hashing using PHP's `password_hash()` function
- User login with session management
- User profile management
- Display of user profile information
- Articles board for posting and viewing articles

## Technologies Used

- **Linux:** Ubuntu 20.04 LTS
- **Apache:** Apache HTTP Server
- **MySQL:** MySQL database management system
- **PHP:** Hypertext Preprocessor
- **HTML/CSS:** Frontend markup and styling

## File Structure

- `index.php`: Homepage of the website
- `sign-up.php`: User registration page
- `register.php`: Script for user registration
- `sign-in.php`: User login page
- `login.php`: Script for user login
- `logout.php`: Script for user logout
- `profile.php`: User profile page
- `articles.php`: Discussion board page
- `post_messages.php`: Script for posting articles
- `navbar.php`: Navbar component for the website
- `db_connection.php`: Database connection script
- `README.md`: Project documentation

## Setup Instructions

1. Clone the repository to your local machine.
2. Set up a LAMP stack environment on your server.
3. Import the provided SQL database schema into MySQL.
4. Update the database connection details in `db_connection.php`.
5. Configure Apache to serve the website from the cloned repository directory.
6. Access the website through your web browser.

## Usage

1. Navigate to the homepage (`index.php`) to get started.
2. Register a new user account using the sign-up page (`sign-up.php`).
3. Log in to your account using the login page (`sign-in.php`).
4. View and edit your profile information on the profile page (`profile.php`).
5. Explore the discussion board by visiting the discussions page (`discussions.php`).
6. Post new articles or view existing ones on the discussion board.
7. Log out of your account using the logout functionality.

## Contributing

Contributions are welcome! If you'd like to contribute to this project, please fork the repository, make your changes, and submit a pull request.

## License

This project is licensed under the MIT License.
