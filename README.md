# Personal Portfolio & Engineering Showcase

A lightweight, high-performance, and responsive personal portfolio website built with semantic HTML5, modern vanilla CSS, vanilla JavaScript, and a custom PHP backend.

## Architecture & Tech Stack

* **Frontend:** Semantic HTML5, CSS3 (CSS Grid/Flexbox, CSS custom properties/variables), Vanilla JavaScript (ES6+ Fetch API, DOM manipulation).
* **Backend:** PHP 8.x with PHPMailer for asynchronous SMTP contact form handling.
* **Fonts & Assets:** System font stacks & web-safe fallbacks with Google Fonts (`Space Grotesk`, `IBM Plex Sans`).
* **Deployment:** Hosted on Linux/Apache shared hosting environment (InfinityFree / cPanel).

---

## Key Features

* **Custom PHP Contact Handler:** Handles form submissions via AJAX/Fetch API and delivers messages directly to Gmail via PHPMailer & SMTP.
* **Inline UI State Feedback:** Zero page reloads; validation and delivery status (success/error) are rendered dynamically directly on the page.
* **Security First:**
  * Input sanitization and email header injection protection.
  * Untracked local configuration (`php/config.php`) keeping SMTP credentials out of Git history.
  * Direct file access restrictions on PHP helper scripts.
* **Responsive & Accessible:** Built mobile-first with ARIA accessibility roles and fluid layout control.
* **Motion & Performance:** Light, dependency-free CSS/JS animations respecting `prefers-reduced-motion`.

---

## Directory Structure

```text
portfolio/
├── css/
│   └── style.css            # Custom CSS variables, grid layouts, and components
├── js/
│   └── main.js             # Form fetch handler, mobile nav, and terminal effects
├── php/
│   ├── config.example.php   # Configuration template for repository
│   ├── config.php           # Real SMTP credentials (gitignored)
│   ├── contact-handler.php  # Form endpoint processing & PHPMailer integration
│   └── PHPMailer/           # PHPMailer core source files (gitignored)
├── favicon.ico
├── index.html               # Main single-page application structure
├── .gitignore               # Excludes sensitive credentials and vendor folders
└── README.md
```
Local Setup & Development Instructions
1. Prerequisites
Local web server environment (e.g., XAMPP, WAMP, or PHP Built-in Server).

PHP 7.4+ or 8.x with openssl enabled.

A Gmail account with 2-Step Verification enabled and a generated App Password.

2. Installation Steps
a. Clone the repository:
```
git clone [https://github.com/your-username/portfolio.git](https://github.com/your-username/portfolio.git)
cd portfolio
```
b. Download PHPMailer:
Obtain the PHPMailer library and place the src/ files in the php/PHPMailer/src/ folder:

Exception.php

PHPMailer.php

SMTP.php

c. Configure Environment Variables:
Copy the example configuration file to create your local config:
```
cp php/config.example.php php/config.php
```
Open php/config.php and fill in your target email and Gmail App Password:
```
<?php
define('SMTP_USER', 'your-email@gmail.com');
define('SMTP_PASS', 'xxxx xxxx xxxx xxxx'); // 16-character Google App Password
```
d. Run Locally:
If using PHP's built-in server, execute from the project root:
```
php -S localhost:8000
```
Navigate to http://localhost:8000 in your web browser.

