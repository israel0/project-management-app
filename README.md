# Project Management App – Laravel Full Stack Assessment

## About the Project

This is a full-stack **Project Management Application** built as part of the technical assessment for the **Full Stack Laravel Developer** role.

The application allows authenticated users to manage projects and associated tasks with features such as project/task creation, status tracking, deadline assignment, and filtering. 
---

## Technologies Used

- **Backend:** Laravel 12
- **Authentication:** Laravel Breeze
- **Frontend:** Vue.js 3 + Inertia.js
- **Database:** MySQL
- **Testing:** Laravel Feature & Unit Tests
- **Version Control:** Git & GitHub

## Setup Instructions

- **Clone the repository**
```bash
git clone https://github.com/israel0/project-manager-app.git
cd project-manager-app
```

- **Install Dependencies**
```bash
composer install
npm install && npm run dev
```

- **Set up environment**
```bash
cp .env.example .env
php artisan key:generate
```

- **Set up database**
```bash
php artisan migrate --seed
```

- **Serve the app**
```bash
php artisan serve
```

##  Architecture and decisions

**1. Decisions**  
I chose to keep the architecture simple and expressive using Laravel controllers and policies, which is ideal for the scope of this project. Separate Vue components for task form, task list, and dashboard. Each responsibility (project, task, auth, layout) is isolated for better maintainability.

**2 -Modular MVC Structure**  
I separated concerns using Laravel’s MVC structure:

- Controllers: ProjectController, TaskController, DashboardController
- Models: Project, Task, Role
- Pages: Projects/Show.vue, Tasks/TaskForm.vue

**3- Inertia-Driven SPA**  
I used Laravel Breeze with Inertia.js to build a single-page app where Laravel handles routing and Vue renders views.

**3- Component-Based Frontend**  
I reused Vue 3 components like TaskForm, AuthenticatedLayout, and Dropdown to keep the frontend clean and modular.

