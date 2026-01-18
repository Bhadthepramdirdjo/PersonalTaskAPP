# Personal Task App 📝

A primitive yet beautiful, glassmorphism-styled Task Management Application built with **Laravel 10**, **Tailwind CSS**, and **Alpine.js**.

![Dashboard Preview](public/img/Logo_baru.svg)
*(Note: Replace with an actual screenshot of your dashboard if available)*

## ✨ Key Features

### 🎨 User Interface & Experience
-   **Glassmorphism Design**: Modern, translucent UI components with blur effects.
-   **Dark Mode Ready**: Fully responsive design that looks great in both light and dark themes.
-   **Responsive Layout**: Optimized for Desktop, Tablet, and Mobile devices.
-   **Custom Scrollbars**: Sleek, themed scrollbars for a polished look.

### 🚀 Core Functionality
-   **Dashboard**:
    -   Real-time statistics (Pending, Completed, Total Tasks).
    -   **Motivational Quotes**: Random quotes (Indonesian) to keep you inspired.
    -   **Special Greetings**: Personalized welcome messages.
    -   **Visual Charts**: Doughnut charts for category distribution and priority analysis.
-   **Task Management**:
    -   Create, Read, Update, Delete (CRUD) tasks.
    -   Categorize tasks (Work, Personal, etc.) with custom colors.
    -   Set Priorities (Low, Medium, High, Urgent).
    -   **Deadline Indicators**: Visual cues for overdue tasks (Red) and tasks due soon (Yellow).
-   **Category Management**: Manage custom categories to organize your workflow.
-   **Email Reminders**: Automated email notifications for tasks due in 2 or 3 days.

### ⚙️ Settings & Personalization
-   **Multi-Language Support**: Switch between **English** and **Bahasa Indonesia** seamlessly.
-   **Profile Management**: Update your name, email, and upload a **Profile Photo**.
-   **Authentication**:
    -   Secure Login & Registration.
    -   **Forgot Password** flow with a "Back to Login" option.
    -   Username-based login support.

## 🛠️ Tech Stack

-   **Framework**: [Laravel 10](https://laravel.com/) (PHP)
-   **Frontend**: [Blade Templates](https://laravel.com/docs/blade)
-   **Styling**: [Tailwind CSS](https://tailwindcss.com/)
-   **Interactivity**: [Alpine.js](https://alpinejs.dev/)
-   **Database**: MySQL

## 🚀 Installation & Setup

Follow these steps to run the project locally:

1.  **Clone the Repository**
    ```bash
    git clone https://github.com/Bhadthepramdirdjo/PersonalTaskAPP.git
    cd PersonalTaskAPP
    ```

2.  **Install PHP Dependencies**
    ```bash
    composer install
    ```

3.  **Install Frontend Dependencies**
    ```bash
    npm install
    ```

4.  **Environment Configuration**
    -   Copy the example environment file:
        ```bash
        cp .env.example .env
        ```
    -   Update the database settings in `.env` (DB_DATABASE, DB_USERNAME, etc.).
    -   Update mail settings if you want to test email reminders (MAIL_MAILER, MAIL_HOST, etc.).

5.  **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

6.  **Run Migrations & Seeders**
    This will set up the database tables and default data (priorities, user settings).
    ```bash
    php artisan migrate --seed
    ```

7.  **Build Assets**
    ```bash
    npm run build
    ```

8.  **Run the Application**
    ```bash
    php artisan serve
    ```
    Access the app at `http://localhost:8000`.

## 📖 Usage Guide

1.  **Registration**:
    -   Create a new account on the `/register` page.
2.  **Dashboard**:
    -   After login, you will see your dashboard with task summaries and a motivational quote.
3.  **Managing Tasks**:
    -   Go to **My Tasks** to view list of tasks.
    -   Click **New Task** to add a todo item. Select category, priority, and deadline.
    -   Mark tasks as completed by clicking the checkbox or status icon.
    -   Completed tasks older than 7 days are automatically cleaned up.
4.  **Categories**:
    -   Go to **Categories** to create or delete task categories (e.g., "Office", "Hobby").
5.  **Settings**:
    -   Click the **Profile** dropdown or **Settings** in sidebar.
    -   Change the **Language** (English/Indonesian) under "Application Preferences".

## 🤝 Contributing

Contributions are welcome! Please fork the repository and submit a pull request.

## 📄 License

This project is open-source and available under the [MIT license](https://opensource.org/licenses/MIT).

---
*Created by Bhadriko Theo Pramudya Djojosoedirdjo - 2026*
