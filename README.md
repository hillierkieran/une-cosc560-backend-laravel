UNE - COSC60 Advanced Web Programming - Assignment 1

### GitHub Repository Location

[🔗 github.com/hillierkieran/UNE_COSC560/tree/**feature/auth-admin-panel**](https://github.com/hillierkieran/UNE_COSC560/tree/feature/auth-admin-panel)

### Student Information

- **Student ID:** 220281036
- **Name:** Kieran Hillier
- **Email:** khillie2@myune.edu.au

### Setup Instructions

For setup instructions, go to the [SETUP.md](./SETUP.md) file.

<br />
<br />

# Assessment 2 Authentication and Admin Panel

## Objective

Enhance the basic blog application by adding user authentication using Laravel UI with Bootstrap. Create an admin panel for managing blog posts and users. This builds on concepts learned in the previous assessment and introduces new features for a robust application.

## Prerequisites

1. Completed Assessment 1: Basic Blog Application.

## Guidelines

1. **Setup and Initialise Project:**
    - Ensure your development environment is set up with the basic blog application from Assessment 1.
    - Create a new branch in your GitHub repository for this feature: `git checkout -b feature/auth-admin-panel`.

2. **Setup MongoDB with Laravel as demonstrated in Lecture 4.**

3. **Install Laravel UI and Set Up Authentication:**
    - Install Laravel UI package: `composer require laravel/ui`.
    - Generate the authentication scaffolding: `php artisan ui bootstrap --auth`.
    - Run the required commands to set up Bootstrap: `npm install && npm run dev`.
    - Update the master layout to include Bootstrap styling.

4. **Create Middleware for Admin Access (Bonus):**
    - Generate middleware to restrict access to the admin panel: `php artisan make:middleware AdminMiddleware`.
    - Implement the middleware to check if the authenticated user is an admin.
    - Apply the middleware to the admin routes.

5. **Define Admin Routes:**
    - Define routes in `web.php` for the admin panel with Admin prefix.
    - Ensure they are protected by the AdminMiddleware (Bonus).
    - Create routes for managing users and blog posts within the admin panel.

6. **Create Admin Controllers:**
    - Generate a controller for managing users: `php artisan make:controller Admin/UserController`.
    - Generate a controller for managing blog posts: `php artisan make:controller Admin/PostController`.
    - Implement CRUD operations in the respective controllers with appropriate validation.

7. **Create Blade Views for Admin Panel:**
    - Download bootstrap examples from [Bootstrap Examples](https://getbootstrap.com/docs/5.3/examples/) and use the dashboard template as the landing page. Use the form template to create your forms.
    - Create a new layout for the admin panel (`admin.blade.php`).
    - Create views for listing, creating, editing, and deleting users and blog posts.
    - Ensure the views use Bootstrap components for styling and are consistent with the overall application design.

8. **Enhance User Management:**
    - Add roles to users (e.g., admin, author, user) and implement role-based access control.
    - Update the registration process to allow assigning roles and create a new migration to add roles in the database (admin, author, user).
    - Ensure only admins can access user management functionalities.

9. **Testing:**
    - Thoroughly test the authentication system.
    - Test each admin functionality by creating, reading, updating, and deleting users and blog posts.
    - Ensure that non-admin users cannot access the admin panel.

10. **GitHub Push:**
    - Ensure your project is version controlled and pushed to GitHub after each major step.

## Deliverables

- An enhanced blog application with authentication and an admin panel.
- Source code pushed to a Private GitHub repository on a separate branch.
- A brief report in the `README.md` file describing your approach, any challenges faced, and the GitHub repository URL.

## Marking Criteria

| Feature Requirement                                        | Points |
|------------------------------------------------------------|--------|
| Setup and Initialise Project                               | 1      |
| Setup MongoDB                                              | 2      |
| Install Laravel UI and Set Up Authentication               | 2      |
| Define Admin Routes                                        | 1      |
| Create Admin Controllers                                   | 2      |
| Create Blade Views for Admin Panel                         | 4      |
| Enhance User Management                                    | 2      |
| Testing                                                    | 2      |
| GitHub                                                     | 2      |
| Report                                                     | 2      |
| Bonus - Create middleware for admin access and apply to admin routes. | 2      |

*Total mark, including any bonus points, will not exceed 20.*

## Submission

1. Copy `.env` file to `.env.example`.
2. Use git and commit your work, then create a zip of the entire folder (excluding files in `.gitignore`) and submit the zip file via Moodle.
3. Ensure you do not include files and folders listed in `.gitignore`.