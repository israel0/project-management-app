# Project Management App – Laravel Full Stack Assessment

## About the Project

This is a full-stack **Project Management Application** built as part of the technical assessment for the **Full Stack Laravel Developer** role.

The application allows authenticated users to manage projects and associated tasks with features such as project/task creation, status tracking, deadline assignment, and filtering. It demonstrates backend logic, API design, frontend interactivity, and development best practices.

---

## Technologies Used

- **Backend:** Laravel 12
- **Authentication:** Laravel Breeze (with Sanctum)
- **Frontend:** Vue.js 3 + Inertia.js
- **Database:** MySQL
- **Testing:** Laravel Feature & Unit Tests
- **Version Control:** Git & GitHub


## Setup Instructions
# Clone the repository
git clone https://github.com/your-username/project-manager-app.git
cd project-manager-app

# Install dependencies
composer install
npm install && npm run dev

# Set up environment
cp .env.example .env
php artisan key:generate

# Set up database
php artisan migrate --seed

# Serve the app
php artisan serve


## Overview of your architecture and decisions
1. Modular Design
Separate Vue components for task form, task list, and dashboard.
Each responsibility (project, task, auth, layout) is isolated for better maintainability.


### 1. Clone Repository

```bash
git clone https://github.com/your-username/project-management-app.git
cd project-management-app
