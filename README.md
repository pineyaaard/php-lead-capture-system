# Lead Generation Landing Page & PHP Backend System

A lightweight, zero-dependency lead generation system built from scratch. This project demonstrates a full-stack approach to capturing user data, processing it securely on the server, and automating email delivery without relying on heavy frameworks or third-party CRM plugins.

## 🚀 Key Features

* **Custom UI/UX:** Clean, responsive front-end built with HTML5 and native CSS3 (using CSS variables for easy theming).
* **Automated Email Dispatch:** PHP script automatically sends a formatted HTML email with a PDF guide attachment to the user upon successful form submission.
* **Flat-File Database:** User emails and timestamps are securely logged into a server-side `.csv` file, eliminating the need for a complex SQL database setup for simple lead gen.
* **Secure Admin Dashboard:** A session-based, password-protected admin panel (`admin.php`) to view and manage collected leads directly from the browser.
* **Anti-Spam Protection:** Implemented a hidden "Honeypot" field in the form. If a bot fills it out, the script silently discards the submission without polluting the database.
* **Server-Side Security:** `.htaccess` rules strictly deny direct browser access to the `.csv` database, preventing data leaks.

## 🛠 Tech Stack

* **Frontend:** HTML5, CSS3 (Flexbox, CSS Variables)
* **Backend:** PHP (Native mail function, file handling, session management)
* **Server Rules:** Apache `.htaccess`

## ⚙️ How It Works (Data Flow)

1. User lands on `index.php` and submits their email.
2. `submit.php` validates the email format and checks the honeypot field.
3. If valid, the email and current timestamp are appended to `leads_secure_xxx.csv`.
4. `submit.php` triggers the `mail()` function to send the requested resource to the user.
5. User is redirected to `thanks.html`.
6. Admin logs into `admin.php` via a secure password to view the collected leads.

## 🔒 Security Notes for this Repository

* **Credentials Hidden:** For security reasons, the actual admin password and SMTP/Email sender details have been replaced with placeholders (`YOUR_PASSWORD_HERE`, `your_email@domain.com`) in this public repository.
* **Database Excluded:** The actual `.csv` file containing user data is excluded from this repository to protect user privacy.

## 💻 Local Setup

1. Clone the repository to your local web server environment (e.g., XAMPP, MAMP, or Docker with Apache/PHP).
2. Update the `$correct_password` in `admin.php`.
3. Update the `$headers` and `$email` configurations in `submit.php` with your working mail server details.
4. Open `index.php` in your browser.
