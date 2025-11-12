# Laravel Book Review Application

This is a comprehensive book review platform built with the Laravel framework. It allows users to discover books, share their opinions through reviews and ratings, and engage with a community of readers. Administrators have oversight over the content to ensure quality and appropriateness.

## Features

- **User Authentication:** Secure registration and login for users.
- **User Profiles:** Users can manage their profile information.
- **Book Management:** Admins can add, edit, and delete book listings.
- **Browse Books:** Users can browse and search for books.
- **Book Details:** View detailed information for each book.
- **Review System:** Authenticated users can write and submit reviews for books.
- **Star Ratings:** Users can give a star rating (1-5) along with their review.
- **Admin Review Approval:** New reviews are held for moderation and must be approved by an administrator before being publicly visible.
- **Edit/Delete Reviews:** Users can edit or delete their own reviews.
- **My Reviews Page:** A dedicated page for users to see all the reviews they have submitted.

## Technologies Used

- PHP
- Laravel
- MySQL
- Blade Templating Engine
- JavaScript
- Vite
- Bootstrap

## Setup and Installation

Follow these steps to get the project up and running on your local machine.

1.  **Clone the repository:**
    ```bash
    git clone https://github.com/your-username/book-review.git
    cd book-review
    ```

2.  **Install PHP dependencies:**
    ```bash
    composer install
    ```

3.  **Create your environment file:**
    ```bash
    copy .env.example .env
    ```

4.  **Generate an application key:**
    ```bash
    php artisan key:generate
    ```

5.  **Configure your database:**
    Create a new database and update your `.env` file with your database credentials (DB_DATABASE, DB_USERNAME, DB_PASSWORD).

6.  **Run database migrations and seeders:**
    ```bash
    php artisan migrate --seed
    ```

7.  **Install NPM dependencies:**
    ```bash
    npm install
    ```

8.  **Build assets:**
    ```bash
    npm run dev
    ```

9.  **Start the development server:**
    ```bash
    php artisan serve
    ```

10. **Visit the application:**
    Open your browser and go to `http://127.0.0.1:8000`.

## User Roles

- **User:** Can register, log in, browse books, and submit/manage their own reviews.
- **Admin:** Has all user privileges, plus the ability to manage books and approve/reject user-submitted reviews.