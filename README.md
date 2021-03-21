# Evaluación Final Integradora - Programación III
## Reale, Santiago.

## Database Model

![Database_Model](https://github.com/sntgreale/Laravel7-Blog/blob/main/public/images/DiagramDB.png)

## About The Project

In the context of the Integrated Final Evaluation, of the course Programming III (Laravel), I developed a small web application to simulate a classic Blog with, in addition, the possibility of following users, refueling posts and likes.

Still in development.

## How to install RePost 

1. Create a DB Schema called 'rePostDB'.

2. Clone the git-repo.
    - **https://github.com/sntgreale/Laravel7-Blog.git**

3. With your terminal, navigate within the project. And type the following commands:
    - **`composer install`**
    - **`npm install`**
    
4. Set up the '.env' file.

5. Type the following commands:
    - **`php artisan migrate`** 
    - **`php artisan db:seed --class=DatabaseSeeder`** 

    The migration will create some user, posts, comments, refueling, likes and follows.

    Users:
    - email: userX@gmail.com (where 'X' is a number from 1 to 10)

    - password: 1234567890
    
    Admin:
    - email: admin@gmail.com

    - password: 1234567890


6. Finally you are ready to start using the app. Run:
    - **`php artisan serve`**
    - By default it will run on port **8000**
    

## API
## Endpoints:

1. Returns the data of the registered users (not administrator)
    - **Method:** GET
    - **URI:** api/users

2. Returns the data of the user 'X' (not administrator)
    - **Method:** GET
    - **URI:** api/users/{user_id}

3. Returns the data of the registered posts. (Without TAGS)
    - **Method:** GET
    - **URI:** api/posts

4. Returns the data of the registered posts. (With TAGS)
    - **Method:** GET
    - **URI:** api/posts/complete

5. Returns the data of the posts 'X'. (Without TAGS)
    - **Method:** GET
    - **URI:** api/posts/{post_id}

6. Return the data of the posts 'X'. (With TAGS)
    - **Method:** GET
    - **URI:** api/posts/{post_id}/complete

7. Return 'rePost' statistics
    - **Method:** GET
    - **URI:** api/statistics

## ## ## ##