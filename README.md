# Athena Learning Management System

A full-stack learning management system built with Laravel.

## Features
- Course management (each course contains modules and each module contains videos)
- User authentication with email verification 
- Payment system (built in wallet)
- Rating and reviews (only after the user attends the course and finish it)
- Bookmarks feature so user can note some points on a specific video at specific time

## Built By
- Jad Alhalaib - 80% of codebase
- Yassir Marzouk - Partner contributions

## Installation
To run the back-end part of Athena app please follow these steps:
1) Clone the project
2) head to the file directory in the terminal
3) run these commands:
- php artisan migrate 
(if it asked to make a new database please write: yes)
- php artisan passport:install

if wanted a fake data in the app you can run:
- php artisan db:seed

finally to run the project:
- php artisan serve

