# Symfony Authentication Project 🚀

A simple Symfony authentication system with registration and login.

## Features
✅ User registration with password hashing  
✅ User login with validation  
✅ Flash messages for user feedback  
✅ TailwindCSS for styling  
✅ Symfony security & services  

## Installation

1. Clone the repository:
   ```sh
   git clone https://github.com/YOUR_USERNAME/beautiful_symfony.git
   cd beautiful_symfony
2. Install dependencies:
    ```sh
    composer install
    yarn install && yarn encore dev
3. Set up the database
    ```sh
    cp .env.example .env
    php bin/console doctrine:database:create
    php bin/console doctrine:migrations:migrate
4. Run the server:
    ```sh
    symfony server:start
        