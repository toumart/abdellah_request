# 📋 Laravel User Management App

This project is a modern Laravel-based User Management App with:

- 🔐 Registration Form
- 🔍 Real-time User Search with Autocomplete
- 📤 Export Users to Excel
- 📥 Import Users from .csv file
- 🌙 Dark Mode Toggle
- 📦 Toast Notifications for Feedback

---

## 🛠 Tools & Frameworks Used

| Tool / Library               | Version               | Description                                      |
|-----------------------------|-----------------------|--------------------------------------------------|
| **Laravel**                 | 8.83.29               | PHP Framework                                    |
| **PHP**                    | 7.4.33                | Backend language (used via WampServer)           |
| **WampServer**             | 3.2.6 (or similar)     | Local dev environment (Apache, PHP, MySQL)       |
| **MySQL**                  | 5.7 / 8.0 (WAMP Default)| Database engine                                  |
| **Bootstrap**              | 5.3.2                 | Frontend styling framework                       |
| **Laravel Excel**          | ^3.1.47               | For import/export Excel & CSV                    |
| **JavaScript (Vanilla)**   | —                     | For dark mode toggle & live search               |

---

## 📦 Installation & Setup

1. **Clone the repository** or create the project:
   ```bash
   composer create-project laravel/laravel user-management-app
   cd user-management-app
Install Laravel Excel:

bash
Copy code
composer require maatwebsite/excel:^3.1.47 -W
Set up .env with your DB:

makefile
Copy code
DB_DATABASE=user_management
DB_USERNAME=root
DB_PASSWORD=
Run migrations:

bash
Copy code
php artisan migrate
Run the app:

bash
Copy code
php artisan serve
🚀 Features Implemented
🧑 User Registration
Name, Email, Phone, Date of Birth

Field validation with elegant error messages

Responsive card-based layout

🔍 Live Search with Autocomplete
Real-time suggestion as you type

Click suggestion to view user details

Animated result card display

📥 Import Users
Upload .csv files (with or without headers)

Shows success feedback using Bootstrap toast

Format: name,email,phone,dob

📤 Export Users
Download all registered users as an Excel file (.xlsx)

🌙 Dark Mode
Toggle between light and dark themes

Preference saved in browser localStorage

📢 Toast Feedback
Elegant success/error messages using Bootstrap toast

Used for registration, import, and search results

✅ Folder Structure Highlights
bash
Copy code
resources/views/welcome.blade.php        # Main UI
app/Http/Controllers/UserController.php  # Logic
app/Imports/UsersImport.php              # CSV Import
app/Exports/UsersExport.php              # Excel Export
routes/web.php                           # Routes
📂 Sample .CSV Format for Import
graphql
Copy code
Toumart,toumart@gmail.com,0600000000,2001-08-12
Hamza,hamza@gmail.com,0611111111,2000-05-30
Fatima,fatima@gmail.com,0622222222,2003-10-21
✅ No header row needed unless modified to support headers

📬 Contact
Made with ❤️ by Toumart
For educational use and beginner-friendly Laravel practice.
