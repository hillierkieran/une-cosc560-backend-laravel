## Setup Instructions

After cloning this Laravel project, follow these steps to set up the application:

### 1. **Move the Project to the Web Directory** (Optional if using Laragon)

   If using Laragon, move the project into the `www` directory (default location: `C:\laragon\www`).

### 2. **Install PHP Dependencies**

   Ensure [Composer](https://getcomposer.org/download/) is installed, then navigate to the project directory and install the required PHP dependencies:

   ```bash
   composer install
   ```

### 3. **Set Up Environment Configuration**

   Create a copy of the `.env.example` file to `.env`:

   ```bash
   cp .env.example .env
   ```

   If necessary, update environment variables such as database credentials, etc.

### 4. **Generate Application Key**

   Generate a unique application key, which is used for encrypting data:

   ```bash
   php artisan key:generate
   ```

### 5. **Run Database Migrations**

   Apply the database migrations to set up the necessary tables:

   ```bash
   php artisan migrate
   ```
   **Note**: If you encounter an issue where it says there is "nothing to migrate," try running the following command to reset the migrations:

   ```bash
   php artisan migrate:reset
   ```

   Then try migrating again.

### 6. **Seed the Database with Initial Data**

   Populate the database with initial test data:

   ```bash
   php artisan db:seed
   ```

### 7. **Build Frontend Assets**

   If using frontend assets (CSS/JS), install Node.js dependencies and compile the assets:

   ```bash
   npm install
   npm run dev   # for development mode
   npm run build # for production
   ```

### 8. **Serve the Application**

   Start the local development server to serve the application:

   ```bash
   php artisan serve
   ```

   **_OR_, if using Laragon:**

   Simply open Laragon and click on the "Start All" button to start the web server and database server. Laragon will automatically assign a `.test` domain to your project.

### 9. **Access Your Application**

   Once the server is running, you can access your application at:

   - `http://localhost:8000` (for the built-in PHP server)
   - `http://projectfoldername.test` (if using Laragon)

   Ensure everything is working as expected and that the application is fully functional.

### 10. **Disable Browser Extensions/Features Blocking Local Development**

Some browsers, such as Brave, and certain browser extensions (like ad blockers or privacy tools) may block local development resources, including CSS and JavaScript files served by Vite. To ensure that your application works correctly:

- **Brave Browser Users:** Disable "Shields" for `localhost` by clicking the Brave icon in the address bar and turning off Shields for that site.
- **Other Browsers/Extensions:** If you're using any ad blockers or privacy extensions, either disable them or create an exception for your local development environment.

This will prevent any unexpected blocking of assets and ensure the smooth functioning of your application during development.