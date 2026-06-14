# Software Architecture Document (SAD)

## Project
HNet Solution CRM

## Version
1.0

---

## 1. Architecture Overview

Aplikasi ini menggunakan arsitektur **MVC (Model-View-Controller)** berbasis framework Laravel 12. Semua modul dikelola secara internal sebagai aplikasi web monolitik yang dijalankan di atas Apache (XAMPP).

```
Browser (User)
    │
    ▼
Apache Web Server (XAMPP)
    │
    ▼
Laravel 12 Application
    ├── Routes (web.php / api.php)
    ├── Middleware (Auth, CSRF)
    ├── Controllers
    ├── Services (PDF, Email, WhatsApp)
    ├── Models (Eloquent ORM)
    └── Views (Blade + TailAdmin)
    │
    ▼
MySQL 8 Database
```

---

## 2. Directory Structure

```
hnet-solution-app/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   ├── CustomerController.php
│   │   │   ├── QuotationController.php
│   │   │   ├── InvoiceController.php
│   │   │   ├── BeritaAcaraController.php
│   │   │   ├── CmsController.php
│   │   │   ├── DashboardController.php
│   │   │   └── ReportController.php
│   │   └── Middleware/
│   ├── Models/
│   │   ├── User.php
│   │   ├── Customer.php
│   │   ├── Quotation.php
│   │   ├── QuotationItem.php
│   │   ├── Invoice.php
│   │   ├── InvoiceItem.php
│   │   ├── BeritaAcara.php
│   │   └── CmsPage.php
│   └── Services/
│       ├── PdfService.php
│       ├── EmailService.php
│       └── WhatsAppService.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   ├── dashboard/
│   │   ├── customers/
│   │   ├── quotations/
│   │   ├── invoices/
│   │   ├── berita-acara/
│   │   ├── cms/
│   │   ├── reports/
│   │   └── pdf/
│   └── js/
├── routes/
│   ├── web.php
│   └── api.php
└── storage/
    └── app/public/ (PDF files)
```

---

## 3. Module Architecture

### 3.1 CRM Module

```
CustomerController  →  Customer Model  →  customers (table)
QuotationController →  Quotation Model →  quotations (table)
                    →  QuotationItem   →  quotation_items (table)
InvoiceController   →  Invoice Model   →  invoices (table)
                    →  InvoiceItem     →  invoice_items (table)
BeritaAcaraController → BeritaAcara   →  berita_acara (table)
```

### 3.2 CMS Module

```
CmsController → CmsPage Model → cms_pages (table)
```

### 3.3 Reporting Module

```
ReportController → Eloquent Queries (aggregasi dari semua tabel)
```

### 3.4 Communication Module

```
EmailService    → Laravel Mail (SMTP)
WhatsAppService → Fonnte API (HTTP Request via Guzzle/Http)
```

### 3.5 PDF Engine

```
PdfService → barryvdh/laravel-dompdf → Blade View (PDF Template) → File PDF
```

---

## 4. Database Relationship

```
users (admin login)

customers
    ├── quotations (has many)
    │       └── quotation_items (has many)
    ├── invoices (has many)
    │       └── invoice_items (has many)
    └── berita_acara (has many)

cms_pages (standalone)
```

### ERD (Entity Relationship)

| Tabel | Relasi |
|-------|--------|
| customers | HasMany → quotations |
| customers | HasMany → invoices |
| customers | HasMany → berita_acara |
| quotations | HasMany → quotation_items |
| quotations | BelongsTo → customers |
| invoices | HasMany → invoice_items |
| invoices | BelongsTo → customers |
| berita_acara | BelongsTo → customers |

---

## 5. Authentication & Authorization

- Menggunakan Laravel built-in Authentication
- Session-based login (bukan API token)
- Single role: **Admin** dengan full access ke semua modul
- Middleware `auth` diaplikasikan pada seluruh route yang memerlukan login
- Route login: `/login`

---

## 6. Third-Party Integration

### 6.1 DomPDF (PDF Generator)

- Package: `barryvdh/laravel-dompdf`
- Flow: Controller → PdfService → Blade template → PDF output / download / store

### 6.2 SMTP (Email Service)

- Konfigurasi via `.env` (MAIL_MAILER, MAIL_HOST, MAIL_PORT, dll)
- Flow: Controller → EmailService → Laravel Mail → SMTP Server → Recipient

### 6.3 Fonnte API (WhatsApp)

- Endpoint: `https://api.fonnte.com/send`
- Autentikasi: Bearer Token via `.env` variable `FONNTE_TOKEN`
- Flow: Controller → WhatsAppService → HTTP POST ke Fonnte API → WhatsApp Recipient

---

## 7. File Storage

- PDF yang di-generate disimpan di `storage/app/public/pdf/`
- Diakses via symlink `php artisan storage:link`
- Path publik: `/storage/pdf/{filename}.pdf`

---

## 8. Error Handling

- Laravel default exception handling via `bootstrap/app.php`
- Error 404 dan 500 menggunakan view custom
- Form validation menggunakan Laravel Form Request
- Try-catch pada service external (Email, WhatsApp, PDF)

---

## 9. Logging

- Log channel: `stack` (daily file)
- Log level: `debug` (local), `error` (production)
- Lokasi log: `storage/logs/laravel.log`

---

## 10. Security

- CSRF Protection: diaktifkan secara default di Laravel untuk semua form POST
- SQL Injection: dicegah via Eloquent ORM / Query Builder parameterized queries
- XSS: output di-escape via Blade `{{ }}` syntax
- Authentication: session-based dengan password di-hash (Bcrypt, 12 rounds)
- `.env` tidak di-commit ke repository (tercantum di `.gitignore`)