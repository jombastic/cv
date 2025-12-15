# 📦 Deployment Guide

This document explains how to deploy the **Single-Page Digital CV Application** built with **Laravel 12**, **Blade**, and **Tailwind CSS**.

The guide is suitable for:

* local development
* shared hosting
* VPS (Ubuntu + Nginx/Apache)
* CI/CD pipelines

---

## 1️⃣ Prerequisites

Before deploying, ensure the target environment meets the following requirements.

### System Requirements

| Requirement | Version                          |
| ----------- | -------------------------------- |
| PHP         | **8.2+**                         |
| Composer    | **2.x**                          |
| Node.js     | **18+**                          |
| npm         | **9+**                           |
| Web Server  | Nginx or Apache                  |
| Database    | ❌ Not required (file-based data) |

### Required PHP Extensions

Ensure the following PHP extensions are enabled:

```
bcmath
ctype
fileinfo
json
mbstring
openssl
pdo
tokenizer
xml
gd
```

> ⚠️ `gd` is required for **PDF generation (DomPDF)**.

---

## 2️⃣ Clone the Repository

```bash
git clone https://github.com/jombastic/cv
cd cv
```

---

## 3️⃣ Install PHP Dependencies

```bash
composer install --no-dev --optimize-autoloader
```

For local development:

```bash
composer install
```

---

## 4️⃣ Install Frontend Dependencies & Build Assets

```bash
npm install
npm run build
```

This generates production-ready CSS and JS assets.

---

## 5️⃣ Environment Configuration (`.env`)

### Create `.env` file

```bash
cp .env.example .env
```

### Key `.env` settings

```env
APP_NAME="Digital CV"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://your-domain.com

LOG_CHANNEL=stack
LOG_LEVEL=warning

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

> 💡 This application does **not** require a database.

---

## 6️⃣ Generate Application Key

```bash
php artisan key:generate
```

---

## 7️⃣ Storage & Permissions

### Create storage directories (if missing)

```bash
php artisan storage:link
```

Ensure these directories are writable:

```
storage/
bootstrap/cache/
```

On Linux servers:

```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

---

## 8️⃣ CV Data Setup

The application loads CV data from **storage**.

### Directory structure

```
storage/app/data/
├── cv.json
└── markdown/
    ├── summary.md
    ├── experience-1.md
    └── experience-2.md
```

### Example `cv.json`

```json
{
  "name": "John Doe",
  "title": "Full-Stack Developer",
  "summary_md_file": "summary.md",
  "experience": [
    {
      "company": "Acme Corp",
      "role": "Senior Developer",
      "markdown_file": "experience-1.md"
    }
  ],
  "socials": {
    "github": "https://github.com/johndoe",
    "linkedin": "https://linkedin.com/in/johndoe"
  }
}
```

---

## 9️⃣ Clear & Cache Configuration

Run the following commands during deployment:

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

For production optimization:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 🔟 PDF Generation (Optional)

The application supports **CV export as PDF**.

### DomPDF Notes

* Requires `ext-gd`
* Uses print-optimized Blade template (`pdf.blade.php`)
* Avoid Tailwind utility classes in PDFs

No extra configuration is required if DomPDF is already installed via Composer.

---

## 1️⃣1️⃣ Web Server Configuration

### Nginx (recommended)

```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /var/www/your-cv-project/public;

    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_pass unix:/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
}
```

---

## 1️⃣2️⃣ Verify Deployment

Open your browser and visit:

```
https://your-domain.com
```

You should see:

* Your CV rendered from Markdown
* Social links visible
* PDF download working

---

## 1️⃣3️⃣ Common Issues & Fixes

### ❌ Blank page / 500 error

```bash
php artisan key:generate
php artisan config:clear
```

### ❌ Markdown not rendering

* Verify files exist in `storage/app/data/markdown`
* Check file permissions

### ❌ PDF download fails

* Ensure `gd` extension is enabled
* Check `storage/` permissions

---

## 1️⃣4️⃣ Useful Artisan Commands (Quick Reference)

```bash
php artisan key:generate
php artisan storage:link
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

---

## ✅ Deployment Checklist

* [ ] PHP 8.2+ installed
* [ ] Composer dependencies installed
* [ ] Node assets built
* [ ] `.env` configured
* [ ] App key generated
* [ ] Storage writable
* [ ] CV data in place
* [ ] Caches optimized

---

## 🧠 Final Notes

This application is intentionally **simple and file-based**, making it:

* easy to deploy
* cheap to host
* perfect for portfolios and demos
