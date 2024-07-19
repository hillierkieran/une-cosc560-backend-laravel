## Setup Instructions

After cloning this Laravel project, follow these steps to set up the application:

1. **Move the Project to the Web Directory:** (Optional if using Laragon)

    Move the project into the `www` directory of Laragon (default: `C:\laragon\www`).

2. **Install Dependencies**

   With Composer installed, install PHP dependencies:

   ```bash
   composer install
   ```

3. **Set Up Environment**

   Copy the `.env.example` file to a new `.env` file:

   ```bash
   cp .env.example .env
   ```

4. **Generate Application Key**

   Generate a new application key:

   ```bash
   php artisan key:generate
   ```

5. **Run Migrations**

   Apply database migrations:

   ```bash
   php artisan migrate
   ```

6. **Seed the Database**

   Populate the database with initial data:

   ```bash
   php artisan db:seed
   ```

7. **Serve the Application**

   Start the local development server:

   ```bash
   php artisan serve
   ```

   **OR, if using Laragon:**

   Open Laragon and click on the "Start All" button to start the web server and database server.

8. **Access Your Application:**

   The application should now be available at `http://localhost:8000`, or `http://myproject.test` if using Laragon.

