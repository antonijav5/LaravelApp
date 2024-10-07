# Laravel Blog Application

## Table of Contents
- [Introduction](#introduction)
- [Requirements](#requirements)
- [Installation](#installation)
- [Database Configuration](#database-configuration)
- [Running Migrations](#running-migrations)
- [Compile Frontend Assets](#compile-frontend-assets)
- [Start the Development Server](#start-the-development-server)
- [Testing](#testing)
- [Routes](#routes)
- [Usage of routes](#usage-of-routes)



## Introduction
This is a simple Laravel blog application that allows users to create, view, edit, and delete posts. Users can also leave comments on posts. The application uses SQLite as the database.

## Requirements
- PHP >= 8.0 (my version: 8.3.12)
- Composer (my version: 2.8.1)
- Node.js >= 14.x (my version: v20.10.0)
- npm (comes with Node.js) (my version: 8.12.1)
## Installation
1. Clone the repository:
   git clone https://github.com/antonijav5/LaravelApp.git
   cd laravel-blog
2.  Install the dependencies:
   composer install
3. Copy the environment file:
   cp .env.example .env
4. Generate the application key:
   php artisan key:generate
   
## Database Configuration
The application uses SQLite by default. Ensure the DB_CONNECTION in your .env file is set to sqlite:
DB_CONNECTION=sqlite
DB_DATABASE=/path/to/database.sqlite
Make sure the SQLite driver is installed in your PHP configuration.

## Running Migrations
After configuring the database, run the migrations:  
php artisan migrate  
Then, seed the database with initial data:  
php artisan db:seed  

## Compile Frontend Assets
To compile the Vue.js frontend, run:  
npm run dev  
# or  
yarn dev  
If you want to compile for production, run:  
npm run build  
# or  
yarn build  

## Start the Development Server
Finally, start the Laravel development server:  
php artisan serve  

## Testing
-> Unit testing:
  PASS  Tests\Unit\CommentTest
  ✓ it creates a comment successfully                                                                                                                   12.58s
  ✓ it requires a body to create a comment                                                                                                               0.08s

   PASS  Tests\Unit\PostTest
  ✓ store method creates a post                                                                                                                          0.54s

  Tests:    3 passed (9 assertions)
  Duration: 14.13s
  
-> Feature testing:
  PASS  Tests\Feature\Auth\AuthenticationTest
  ✓ login screen can be rendered                                                                                                                         3.72s
  ✓ users can authenticate using the login screen                                                                                                        1.26s
  ✓ users can not authenticate with invalid password                                                                                                     0.44s
  ✓ users can logout                                                                                                                                     0.09s

   PASS  Tests\Feature\Auth\EmailVerificationTest
  ✓ email verification screen can be rendered                                                                                                            0.12s
  ✓ email can be verified                                                                                                                                0.40s
  ✓ email is not verified with invalid hash                                                                                                              0.36s

   PASS  Tests\Feature\Auth\PasswordConfirmationTest
  ✓ confirm password screen can be rendered                                                                                                              0.05s
  ✓ password can be confirmed                                                                                                                            0.06s
  ✓ password is not confirmed with invalid password                                                                                                      0.26s

   PASS  Tests\Feature\Auth\PasswordResetTest
  ✓ reset password link screen can be rendered                                                                                                           0.05s
  ✓ reset password link can be requested                                                                                                                 2.14s
  ✓ reset password screen can be rendered                                                                                                                0.05s
  ✓ password can be reset with valid token                                                                                                               0.17s

   PASS  Tests\Feature\Auth\PasswordUpdateTest
  ✓ password can be updated                                                                                                                              0.06s
  ✓ correct password must be provided to update password                                                                                                 0.05s

   PASS  Tests\Feature\Auth\RegistrationTest
  ✓ registration screen can be rendered                                                                                                                  0.02s
  ✓ new users can register                                                                                                                               0.10s

   PASS  Tests\Feature\CommentTest
  ✓ a user can add a comment                                                                                                                             0.03s
  ✓ a user can delete a comment                                                                                                                          0.16s
  ✓ a comment requires a body                                                                                                                            0.03s

   PASS  Tests\Feature\PostTest
  ✓ can list all posts                                                                                                                                   0.11s
  ✓ can view single post                                                                                                                                 0.06s
  ✓ authenticated user can create post                                                                                                                   0.13s
  ✓ can update post                                                                                                                                      0.17s
  ✓ can delete post                                                                                                                                      0.04s

   PASS  Tests\Feature\ProfileTest
  ✓ profile page is displayed                                                                                                                            0.04s
  ✓ profile information can be updated                                                                                                                   0.25s
  ✓ email verification status is unchanged when the email address is unchanged                                                                           0.05s
  ✓ user can delete their account                                                                                                                        0.06s
  ✓ correct password must be provided to delete account                                                                                                  0.05s

  Tests:    31 passed (82 assertions)
  Duration: 10.92s

## Routes
The application supports the following routes:  
GET /posts: List all posts.  
GET /posts/create: Show the form to create a new post (authenticated users only).  
POST /posts: Store the post (authenticated users only).  
GET /posts/{id}: View a single post along with comments.  
GET /posts/{id}/edit: Edit the post (only the owner of the post).  
PUT /posts/{id}: Update the post (only the owner of the post).  
DELETE /posts/{id}: Delete the post (only the owner of the post).  
POST /posts/{id}/comments: Add a comment (for authenticated users and guests).  
DELETE /comments/{id}: Delete a comment (only the comment owner or post owner)  

## Usage of Routes
The application provides the following routes for managing posts and comments. Below are the details on how to use each route:
1. **List all posts**
   - **Route:** `GET /posts`
   - **Usage:** Navigate to `/posts` to view a list of all posts available in the application.
   - 
2. **Create a new post**
   - **Route:** `GET /posts/create`
   - **Usage:** Go to `/posts/create` to view the form for creating a new post. **Note:** Only authenticated users can access this route. If you are not logged in, you will be redirected.

3. **Store a new post**
   - **Route:** `POST /posts`
   - **Usage:** After filling out the form at `/posts/create`, submit it to create a new post. The title and content fields are required. Only authenticated users can perform this action.

4. **View a single post**
   - **Route:** `GET /posts/{id}`
   - **Usage:** To view a specific post along with its comments, navigate to `/posts/{id}`, replacing `{id}` with the actual post ID. This will show the post details and any comments associated with it.

5. **Edit a post**
   - **Route:** `GET /posts/{id}/edit`
   - **Usage:** To edit a specific post, go to `/posts/{id}/edit`, replacing `{id}` with the post ID. **Note:** Only the owner of the post can access this route.

6. **Update a post**
   - **Route:** `PUT /posts/{id}`
   - **Usage:** After making changes in the edit form, submit the form to update the post. This action is restricted to the post owner.

7. **Delete a post**
   - **Route:** `DELETE /posts/{id}`
   - **Usage:** To delete a post, send a DELETE request to `/posts/{id}`, replacing `{id}` with the post ID. This action is also restricted to the post owner.

8. **Add a comment**
   - **Route:** `POST /posts/{id}/comments`
   - **Usage:** To add a comment to a post, send a POST request to `/posts/{id}/comments`, replacing `{id}` with the post ID. Both authenticated users and guests can add comments.

9. **Delete a comment**
   - **Route:** `DELETE /comments/{id}`
   - **Usage:** To delete a specific comment, send a DELETE request to `/comments/{id}`, replacing `{id}` with the comment ID. This action is limited to the comment owner or the owner of the post.

