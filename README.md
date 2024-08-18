UNE - COSC60 Advanced Web Programming - Assignment 2

### GitHub Repository Location

[🔗 github.com/hillierkieran/UNE_COSC560/tree/**feature/auth-admin-panel**](https://github.com/hillierkieran/UNE_COSC560/tree/feature/auth-admin-panel)

### Student Information

- **Student ID:** 220281036
- **Name:** Kieran Hillier
- **Email:** khillie2@myune.edu.au

### Setup Instructions

For setup instructions, go to the [SETUP.md](./SETUP.md) file.

# Report

### My Approach

Since I had already completed the initial setup, MongoDB integration, and authentication with Laravel UI, I started by making draft controllers and setting up routes. At first, I created more controllers and routes than I actually needed, so I had to scale things back and refactor. Getting the hang of middleware, especially how to reference and use it properly, took some time, which slowed me down quite a bit. Once I streamlined the backend, I moved on to working on the Blade views.

I started by building out the new views I needed using the existing app layout. Once the site was mostly functional, I tried integrating the Bootstrap Dashboard template. This turned out to be trickier than I expected, and I spent a fair bit of time getting it right. Eventually, I managed to get the template to fit with the project and broke it off into components. After that, I focused on finishing up the remaining functionality, fixing bugs, adding some nice extra touches, and polishing the overall experience.

### Challenges Faced

The two main challenges I encountered were, first, the overall backend structure involving the controller, middleware, and routing setup; and second, integrating the Bootstrap Dashboard template. Getting the middleware structure and references right was tricky initially, and the complexity of the dashboard template took some time to fully understand and implement.

### Extra Features

The two main extra features I’m proud of are, first, an author filter in the post management panel, available only to admins, which makes it easier to filter posts by author; and second, detailed form validation with clear error messages displayed directly under the relevant input fields.

I also added other smaller enhancements like Bootstrap icons, a link from the author’s name on the post show page to their user show page, and other minor tweaks and polish.