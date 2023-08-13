Create a database locally named directaxis utf8_general_ci
Download composer https://getcomposer.org/download/
Pull Laravel/php project from git provider.
fill the database information in .env file.
Open the console and cd your project root directory
Run composer install or php composer.phar install
Run php artisan key:generate
Run php artisan migrate
Run php artisan db:seed to run seeders, if any.
Run php artisan serve

Completed tasks & LINKS:
Create a RESTful API with the following endpoints:
POST /api/tasks: Create a new task.
GET /api/tasks: Get a list of all tasks. - http://127.0.0.1:8000/api/tasks
GET /api/tasks/{id}: Get details of a specific task. - http://127.0.0.1:8000/api/tasks/1
PUT /api/tasks/{id}: Update a task's details. 
DELETE /api/tasks/{id}: Delete a task.
Task attributes: title, description, due_date, status (pending, completed), priority (low, medium, high).
Implement a queue job for sending task reminder emails to users a day before the task's due date. - http://127.0.0.1:8000/send-mail
Implement a scheduler that runs every hour to process the queue.
Add pagination to the list of tasks endpoint.
