# My React-Inertia-Laravel Application

This is a React-Inertia-Laravel application that demonstrates the integration of React on the front-end, Inertia.js for handling server-side requests, and Laravel on the back-end.

## Technologies Used

- **React**: A JavaScript library for building user interfaces.
- **Inertia.js**: A library that allows you to build single-page applications using classic server-side routing and controllers in Laravel.
- **Laravel**: A PHP framework for building web applications.
- **Tailwind CSS**: A utility-first CSS framework for styling web applications.

## Setup Instructions

Follow these steps to set up the application:

1. Clone the repository:

    ```bash
    git clone <repository-url>
    ```

2. Navigate to the project directory:

    ```bash
    cd ShoppingList
    ```

3. Install PHP dependencies using Composer:

    ```bash
    composer install
    ```

4. Install JavaScript dependencies using npm or yarn:

    ```bash
    npm install
    ```

    or

    ```bash
    yarn
    ```

5. Create a copy of the `.env.example` file and rename it to `.env`:

    ```bash
    cp .env.example .env
    ```

6. Generate an application key:

    ```bash
    php artisan key:generate
    ```

7. Configure your database settings in the `.env` file:

    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    ```

8. Run the database migrations:

    ```bash
    php artisan migrate
    ```

9. Start the development server:

    ```bash
    php artisan serve
    ```

    This will start the Laravel development server.

10. Compile assets and start the frontend server:

    ```bash
    npm run dev
    ```

    or

    ```bash
    yarn dev
    ```

    This will compile the assets and start the frontend server.

11. Visit `http://localhost:8000` in your browser to view the application.

## Artisan Commands

- **Import Items**: To import items from a JSON file, use the following command:

    ```bash
    php artisan items:import /path/to/file.json
    ```

- **Export Items**: To export items to a JSON file, use the following command:

    ```bash
    php artisan items:export
    ```

- **Seed Database**: To seed the database with sample data using the `ItemSeeder` class, run:

    ```bash
    php artisan db:seed --class=ItemSeeder
    ```

## License

