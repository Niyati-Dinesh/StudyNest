# StudyNest



## Description

StudyNest is a productivity tool designed to help students manage their academic tasks effectively. The app includes a dashboard with a login system, task management by subject, deadline and a journal section. Users can track their goals, deadlines, and their daily progress through journal entries in a personalized manner, helping them stay organized and on top of their academic commitments.The journal section features two types of journals , NORMAL AND LEETCODE , the leetcode type allows you to track your leetcode journey. Moreover, light/dark color theme is an optional feature that allows users to customize the look and feel.

StudyNest is built using modern web technologies like HTML, CSS, JavaScript, AJAX , PHP, and MySQL, making it highly interactive, efficient, and easy to use.

## Features

- **User Authentication**: Secure login and signup system.
- **Task Management**: Create and manage tasks by subject.
- **Deadline Tracker**: Track task deadlines.
- **Journal**: Jot down your daily progress and moods.
- **Reflect**: Reflect back to any day.
- **Light/Dark Color Theme**: An optional feature to change the theme based on user preferences.
  
## Get Started

### Prerequisites

Before you start, ensure you have the following tools installed:

- [Node.js](https://nodejs.org/)
- [npm](https://www.npmjs.com/)
- [MySQL](https://www.mysql.com/)
- [PHP](https://www.php.net/)

### Setup

1. Clone the repository:

```bash
git clone https://github.com/your-username/studynest.git
cd studynest
Install dependencies:

bash
Copy
Edit
npm install
Set up your MySQL database and import the studynest.sql schema file to create the necessary tables.

Update the database configuration in config.php with your MySQL credentials.

Run the PHP server for backend:

bash
Copy
Edit
php -S localhost:8000
In a separate terminal window, run the frontend:

bash
Copy
Edit
npm run dev
Open your browser and navigate to http://localhost:8080 to view the app.

Usage
Once you have the app running, follow these steps to get started:

Login Page
Enter your username and password to log in.

If you don’t have an account, click on Sign Up to create one.

Sign Up Page
Create a new user by entering a username and password.

After successful registration, you will be redirected to the login page.

Dashboard
Host New Game: If you want to create a new session, click on this button.

Join Game: Join an existing session by entering a unique game code.

Profile: Go to your profile to update your details or view your task history.

Log Out: Log out of your account and return to the login page.

Profile Page
Completed Tasks: View all the tasks you’ve completed so far.

Change Username: Update your username.

Change Password: Update your password.

Change Avatar: Select a new profile picture.

Task Management
Add Task: Add new tasks by clicking on the "Add Task" button.

Edit Task: Modify existing tasks by selecting them from the list.

Delete Task: Remove tasks that are no longer relevant.

Weekly Planner
Plan Your Week: Organize tasks for each day of the week.

View Tasks: Check your tasks and progress throughout the week.

Sample Login Credentials
Use the following credentials to test the app:

Username: user

Password: password123

API Routes
users.php

POST /users/register: Register a new user with username, password, and email.

POST /users/login: Log in with username and password.

GET /users/logout: Log out a user.

GET /users/profile: Fetch the profile of the logged-in user.

PUT /users/update: Update user profile details like username or password.

tasks.php

GET /tasks: Fetch all tasks for the current user.

POST /tasks: Create a new task.

PUT /tasks/:id: Update an existing task.

DELETE /tasks/:id: Delete a task.

planner.php

GET /planner: Fetch the current week’s task schedule.

POST /planner: Add tasks to the weekly planner.

Notes
The mood-based theme feature can be toggled in the settings page to help personalize your study experience.

Make sure to keep your session active to avoid session timeouts.

License
This project is licensed under the MIT License - see the LICENSE.md file for details.

Feel free to contribute by creating issues or submitting pull requests. We hope you enjoy using StudyNest for managing your study tasks!

vbnet
Copy
Edit

You can copy and modify this template based on your project's specifics. The file provides clear instru