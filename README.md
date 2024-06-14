# LAMP-WebApp

## Overview

LAMP-WebApp is a simple web application built on the LAMP stack (Linux, Apache, MySQL, PHP). It provides user authentication and profile management features, allowing users to register, log in, post and read published messages and view their profiles. In addition to the existing features, the application has been enhanced to include an articles board where users can post and view articles.
LAMP-WebApp is a simple web application built on the LAMP stack (Linux, Apache, MySQL, PHP). It provides user authentication and profile management features, allowing users to register, log in, post and read published messages, and view their profiles. In addition to the existing features, the application has been improved to ensure all website traffic is conducted over HTTPS and to make the website accessible via a DuckDNS subdomain.

## Features

- User registration with username and password
- Secure password hashing using PHP's `password_hash()` function
- User login with session management
- User profile management
- Display of user profile information
- Articles board for posting and viewing articles
- Website is accessible via a DuckDNS subdomain (e.g., `mydomain.duckdns.org`)
- All website traffic is conducted over HTTPS

## Technologies Used

- Linux: Ubuntu 20.04 LTS
- Apache: Apache HTTP Server
- MySQL: MySQL database management system
- PHP: Hypertext Preprocessor
- HTML/CSS: Frontend markup and styling
- HTTPS with Certbot
- DuckDNS for dynamic DNS

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
- `letsencrypt/duckdns.sh`: Script for updating DuckDNS TXT records

## Setup Instructions

1. Clone the repository to your local machine.
2. Set up a LAMP stack environment on your server.
3. Import the provided SQL database schema into MySQL.
4. Update the database connection details in `db_connection.php`.
5. Configure Apache to serve the website from the cloned repository directory.
6. Configure DuckDNS for your domain by creating an account and a subdomain on DuckDNS.
7. Install Certbot for obtaining and renewing SSL certificates.
    - Use the command: `sudo apt install certbot`
    - Create and set up the DuckDNS script:
        ```bash
        sudo mkdir -p /etc/letsencrypt/duckdns
        sudo nano /etc/letsencrypt/duckdns/duckdns.sh
        ```
    - Refer to [duckdns.sh](https://github.com/Abdihakim-bit/-LAMP-WebApp/blob/main/duckdns.sh) for the script.
    - Make the script executable:
        ```bash
        sudo chmod +x /etc/letsencrypt/duckdns/duckdns.sh
        ```
    - Run Certbot to obtain a certificate:
        ```bash
        sudo certbot certonly --manual --preferred-challenges=dns --manual-auth-hook /etc/letsencrypt/duckdns/duckdns.sh -d your-subdomain.duckdns.org
        ```
    - Verify the TXT record with:
        ```bash
        dig TXT _acme-challenge.your-subdomain.duckdns.org
        ```
8. Update Apache configurations for SSL in `/etc/apache2/sites-available/default-ssl.conf`:
    ```apache
    SSLCertificateFile /etc/letsencrypt/live/your-subdomain.duckdns.org/cert.pem
    SSLCertificateChainFile /etc/letsencrypt/live/your-subdomain.duckdns.org/fullchain.pem
    SSLCertificateKeyFile /etc/letsencrypt/live/your-subdomain.duckdns.org/privkey.pem
    ```
9. Set up a cron job for automatic renewal:
    - Open the cron file for editing:
        ```bash
        sudo crontab -e
        ```
    - Add the following line to run the renewal twice a day:
        ```bash
        0 0,12 * * * certbot renew --manual --manual-auth-hook /etc/letsencrypt/duckdns/duckdns.sh --deploy-hook "systemctl reload apache2"
        ```
10. Access the website through your web browser via `https://your-subdomain.duckdns.org`.

## Usage

1. Navigate to the homepage (`index.php`) to get started.
2. Register a new user account using the sign-up page (`sign-up.php`).
3. Log in to your account using the login page (`sign-in.php`).
4. View and edit your profile information on the profile page (`profile.php`).
5. Explore the discussion board by visiting the discussions page (`discussions.php`).
6. Post new messages or view existing ones on the discussion board.
7. Log out of your account using the logout functionality.

## Contributing

Contributions are welcome! If you'd like to contribute to this project, please fork the repository, make your changes, and submit a pull request.

## License

This project is licensed under the MIT License.
