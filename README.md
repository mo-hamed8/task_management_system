# Task Management System

## Overview

The Task Management System is a flexible web application that allows users to manage their personal tasks and collaborate with others on shared tasks. The system provides powerful tools to organize tasks, whether you are working individually or as part of a team.

## Key Features

- **Personal Task Management**: Users can create, edit, and delete their own tasks, helping them organize their time and achieve their goals.
- **Create Shared Workrooms**: You can create a shared room with multiple people, where everyone can contribute tasks and collaborate effectively.
- **Room Entry Token**: The room owner can send a token to invited participants, ensuring secure and controlled access to the shared room.
- **Manage Shared Tasks**: Once participants join the room, they can view all shared tasks and interact with them, facilitating teamwork and achieving common objectives.

## Technologies Used

- **Laravel**: The core PHP framework used for developing the application.
  - **Eloquent ORM**: For interacting with the database using an object-oriented approach.
  - **Blade**: Laravel's templating engine for building dynamic views.
  - **Laravel Queues**: For handling background tasks, such as sending scheduled notifications.
  - **Laravel Scheduler**: To schedule and automate tasks within the application.
  - **Laravel Policies**: To manage authorization logic and access control.
  - **Laravel Notifications**: For sending various types of notifications, including email.
- **MySQL**: The database used for storing data.
- **Tailwind CSS**: Used for designing a modern and simple user interface.

## Getting Started

To get started with the system, install the required dependencies and follow the installation steps below.

### Prerequisites

- PHP
- Composer
- MySQL

### Installation

1. **Clone the Project**:
   ```bash
   git clone https://github.com/mo-hamed8/task_management_system.git
   cd task-management
