# Deployment Guide

## Requirements

- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL 8
- Apache / XAMPP
- Git

---

## 1. Clone / Prepare Project

```bash
git clone {repository-url} hnet-solution-app
cd hnet-solution-app
```

Jika project sudah ada di server, lakukan update:

```bash
git pull origin main
```

---

## 2. Install Backend Dependencies

```bash
composer install --no-dev --optimize-autoloader
```

Untuk environment development:

```bash
composer install
```

---

## 3. Install Frontend Dependencies

```bash
npm install
npm run build
```

---

## 4. Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

Contoh konfigurasi `.env` production:

```env
APP_NAME="Hnet Solution"
APP_ENV=production
APP_KEY=base64:GENERATED_KEY
APP_DEBUG=false
APP_URL=https://your-domain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hnet_solution
DB_USERNAME=db_user
DB_PASSWORD=strong_password

SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database

MAIL_MAILER=smtp
MAIL_HOST=smtp.your-provider.com
MAIL_PORT=587
MAIL_USERNAME=your-email@domain.com
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=no-reply@your-domain.com
MAIL_FROM_NAME="${APP_NAME}"

FONNTE_TOKEN=your_fonnte_token
FONNTE_URL=https://api.fonnte.com/send
```

---

## 5. Database Migration

```bash
php artisan migrate --force
```

Jika tersedia seeder:

```bash
php artisan db:seed --force
```

---

## 6. Storage Link

```bash
php artisan storage:link
```

Pastikan folder berikut writable:

```bash
storage/
bootstrap/cache/
```

---

## 7. Laravel Optimization

Jalankan perintah berikut setelah konfigurasi production siap:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

Untuk clear cache jika ada perubahan `.env` atau route:

```bash
php artisan optimize:clear
```

---

## 8. Apache VirtualHost

Contoh konfigurasi Apache VirtualHost:

```apache
<VirtualHost *:80>
    ServerName your-domain.com
    DocumentRoot "C:/xampp/htdocs/hnet-solution-app/public"

    <Directory "C:/xampp/htdocs/hnet-solution-app/public">
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog "logs/hnet-solution-error.log"
    CustomLog "logs/hnet-solution-access.log" common
</VirtualHost>
```

Pastikan Apache `mod_rewrite` aktif.

---

## 9. Queue Worker

Jika email atau WhatsApp dikirim melalui queue, jalankan worker:

```bash
php artisan queue:work --tries=3
```

Di production, gunakan Supervisor / Task Scheduler agar queue worker selalu berjalan.

---

## 10. Cron Scheduler

Tambahkan scheduler Laravel jika ada task otomatis:

```bash
* * * * * php /path-to-project/artisan schedule:run >> /dev/null 2>&1
```

Untuk Windows Server, gunakan Task Scheduler dengan command:

```bash
php C:\xampp\htdocs\hnet-solution-app\artisan schedule:run
```

---

## 11. SSL / HTTPS

Untuk production, aktifkan SSL menggunakan:

- Let's Encrypt
- Cloudflare SSL
- SSL certificate dari hosting/provider

Pastikan `APP_URL` menggunakan `https://`.

---

## 12. Pre-Deployment Checklist

- [ ] `APP_ENV=production`
- [ ] `APP_DEBUG=false`
- [ ] `APP_KEY` sudah generated
- [ ] Database credentials benar
- [ ] Migration sukses
- [ ] Storage link aktif
- [ ] SMTP sudah dites
- [ ] Fonnte token valid
- [ ] `npm run build` sukses
- [ ] `composer install --no-dev --optimize-autoloader` sukses
- [ ] `php artisan config:cache` sukses
- [ ] File permission storage/cache benar
- [ ] Apache VirtualHost mengarah ke folder `public`