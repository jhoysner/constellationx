
## Installation

To get started with the project, follow these steps:

1. Clone the repository:
    ```sh
    git clone https://github.com/your-repository.git
    cd your-repository
    ```

2. Install the dependencies:
    ```sh
    composer install
    ```

3. Copy the `.env.example` file to `.env` and configure your environment variables:
    ```sh
    cp .env.example .env
    ```

4. Generate the application key:
    ```sh
    php artisan key:generate
    ```

5. Run the migrations and seed the database:
    ```sh
    php artisan migrate --seed
    ```

6. Install the Node.js dependencies:
    ```sh
    npm install
    ```

7. Compile the assets:
    ```sh
    npm run dev
    ```

8. Start the development server:
    ```sh
    php artisan serve
    ```

Now you can access the application at `http://localhost:8000`.
