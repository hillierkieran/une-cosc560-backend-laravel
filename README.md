UNE - COSC60 Advanced Web Programming - Assignment 3

# Backend Laravel API

This project is a Laravel backend providing a RESTful API that serves blog post data to a React frontend. It uses Sanctum for authentication, MongoDB for data storage, and includes routes for fetching both a list of posts and individual post details. Data formatting and structure are handled using helper functions to ensure consistency and ease of use.

---

### GitHub Repository Location

**React**: [github.com/hillierkieran/une-cosc560-frontend-react-app](https://github.com/hillierkieran/une-cosc560-frontend-react-app)

**Laravel**: [github.com/hillierkieran/une-cosc560-backend-laravel](https://github.com/hillierkieran/une-cosc560-backend-laravel)

### Setup Instructions

For setup instructions, go to the [SETUP.md](./SETUP.md) file.

## Report

### Student Information

- **Student ID:** 220281036
- **Name:** Kieran Hillier
- **Email:** khillie2@myune.edu.au

### My Approach
My approach started by building on the work I’d already done with Sanctum during the lectures. I focused on creating the necessary routes to fetch blog post data via the API. Since the assignment didn’t require authentication for the GET routes, I simplified things by removing it. To make the data cleaner and more readable, I added a helper function to the controllers to convert MongoDB's `_id` into the more common `id` format.

### Challenges Faced
During development, I ran into a few challenges:
- **Authentication issues**: I initially tried to implement authentication from the React side but faced several issues. I decided to leave it for later and focus on completing the API routes.
- **Handling MongoDB’s `_id`**: I had trouble at first getting the correct `id` values in the API responses. I eventually realised I needed to map `_id` to `id`, which solved the problem.

### Extra Features
I didn’t add any extra features this time. The focus was on completing the core functionality as required. There are some areas where I could add improvements later, such as authentication, but those weren’t necessary for this assignment.
