# ExamCenter

## Features

- 

## Technologies Used

- Laravel 10.x
- MySQL
- PHP 7.x
- Composer (for package management)


## Setup Instructions

Follow the steps below to set up the project locally:

1. **Clone the Repository:**

    ```
    git clone <https://github.com/alfnkansah/examcenter.git>
    ```

2. **Install Composer Dependencies:**

    Navigate to the project directory and run the following command:

    ```
    composer install
    ```

3. **Create a Copy of the Environment File:**

    Duplicate the `.env.example` file and rename the copy to `.env`.

4. **Generate Application Key:**

    Run the following command to generate a new application key:

    ```
    php artisan key:generate
    ```

5. **Configure the Database:**

    Set up your MySQL database credentials in the `.env` file:

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    ```

6. **Run Migrations:**

    Execute the following command to run migrations and create database tables:

    ```
    php artisan migrate
    ```

7. **Seed the Database (Optional):**

    If you want to populate the database with sample data, run the following command:

    ```
    php artisan db:seed
    ```

8. **Serve the Application:**

    Finally, serve the application using the following command:

    ```
    php artisan serve
    ```

    By default, the application will be accessible at `http://localhost:8000`.

9. **Access the Application:**

    Open your web browser and navigate to the URL where the application is served (e.g., `http://localhost:8000`).

## Contributors

- [Doe John](https://github.com/LYNAPPS/)


## License

This project is licensed under the [MIT License](LICENSE).

---

