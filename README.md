# Leave Management System

A robust, secure, and modern Leave Management Web Application built with PHP and MySQL. Designed to streamline the process of managing faculties, departments, and leave allocations within an institution, the system provides a seamless experience for Administrators, Establishment (ESTA) officers, and Department Users.

## 🌟 Features

- **Role-Based Access Control (RBAC):** Distinct dashboards and capabilities for Admin, ESTA, and Department Users.
- **Modern Premium UI:** Features a completely revamped, state-of-the-art Glassmorphism login and dashboard experience styled with Tailwind CSS and Bootstrap.
- **Faculty & Department Management:** Easily add, edit, and manage department masters and faculty information.
- **Leave Allocation System:** Track, allocate, and manage different types of leaves on a per-faculty basis.
- **Advanced Reporting:** Generate comprehensive date-wise, month-wise, and year-wise leave reports.
- **Database Backup Utility:** Built-in tool for administrators to safely back up the MySQL database.

## 🛡️ Security Enhancements

The application has been heavily hardened against common web vulnerabilities:
- **SQL Injection Prevention:** 100% of database queries utilize strict Prepared Statements (`bind_param`).
- **Secure Authentication:** Passwords are encrypted using industry-standard `bcrypt` (`password_hash` and `password_verify`).
- **XSS Mitigation:** All dynamic data rendered on the frontend is safely sanitized using `htmlspecialchars`.
- **Protected Architecture:** Features a modular folder structure protected by layered `.htaccess` rules. Direct access to backend includes and AJAX processors is strictly blocked.

## 📂 Project Structure

```text
LeaveManagement/
├── index.php             # Main Dashboard
├── Log.php               # Secure Login Gateway
├── pages/                # Frontend modules
│   ├── department/       # Department management views
│   ├── faculty/          # Faculty information views
│   ├── leave/            # Leave allocation views
│   ├── reports/          # Report generation views
│   ├── student/          # Student registration views
│   ├── user/             # User and admin management views
│   └── year/             # Year master views
├── ajax/                 # Secure backend AJAX endpoints (POST only)
├── includes/             # Shared logic (Auth, DB connection, Headers/Footers)
├── tools/                # Admin utilities (DB Backup)
└── assets/               # CSS, JS, and Images
```

## 🚀 Installation & Setup

1. **Prerequisites:** 
   - A local development server like XAMPP, WAMP, or equivalent.
   - PHP 7.4 or higher.
   - MySQL / MariaDB.

2. **Clone the Repository:**
   ```bash
   git clone https://github.com/your-username/LeaveManagement.git
   ```
   *Place the cloned folder inside your `htdocs` (XAMPP) or `www` (WAMP) directory.*

3. **Database Configuration:**
   - Create a new MySQL database (e.g., `leavemanagement`).
   - Import the provided `.sql` database backup file into your newly created database.
   - Update the connection parameters in `includes/connect.php` with your local database credentials:
     ```php
     $conn = mysqli_connect("localhost", "root", "password", "leavemanagement");
     ```

4. **Default Admin Login:**
   - Once set up, you can log in to the system at `http://localhost/LeaveManagement/Log.php`.
   - **Username:** `admin`
   - **Password:** `admin123`
   - **User Type:** `Admin`
   - *(Note: It is highly recommended to change this password immediately after your first login via the "Change Password" or "Create Admin" page).*

## 🛠️ Tech Stack

- **Backend:** PHP (Procedural + Prepared Statements)
- **Database:** MySQL
- **Frontend:** HTML5, CSS3, JavaScript (jQuery/AJAX)
- **Styling:** Bootstrap 4, Tailwind CSS

---

*Developed with an emphasis on security, clean code architecture, and a premium user experience.*
