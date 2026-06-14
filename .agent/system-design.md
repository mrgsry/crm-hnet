# System Design

## 1. Overview

HNet Solution CRM adalah aplikasi web internal berbasis Laravel 12 yang digunakan untuk mengelola customer, quotation, invoice, berita acara, CMS landing page, komunikasi email/WhatsApp, PDF document generation, dan summary report.

Aplikasi menggunakan arsitektur monolitik dengan pattern MVC.

---

## 2. High Level Architecture

```
User/Admin
   │
   ▼
Browser
   │
   ▼
Apache / XAMPP
   │
   ▼
Laravel 12 Application
   ├── Web Routes
   ├── API Routes
   ├── Auth Middleware
   ├── Controllers
   ├── Services
   ├── Eloquent Models
   ├── Blade Views + TailAdmin
   └── DomPDF Templates
   │
   ▼
MySQL 8 Database
```

---

## 3. Modules

### 3.1 CRM

- Customer
- Quotation
- Quotation Items
- Invoice
- Invoice Items
- Berita Acara

### 3.2 CMS

- Hero
- About
- Services
- Portfolio
- Testimonial
- Contact

### 3.3 Reporting

- Revenue
- Sales / Quotation Conversion
- Outstanding Invoice
- Customer Growth

### 3.4 Communication

- Email via SMTP
- WhatsApp via Fonnte API / WA Gateway

### 3.5 PDF Engine

- DomPDF
- PDF templates menggunakan Blade view

---

## 4. Request Flow

### 4.1 Standard Web Flow

```
Admin Login
   │
   ▼
Route Middleware auth
   │
   ▼
Controller
   │
   ▼
Validation / Form Request
   │
   ▼
Model / Service
   │
   ▼
Database / External Service
   │
   ▼
Blade View / Redirect Response
```

### 4.2 PDF Flow

```
User klik Export PDF
   │
   ▼
Controller
   │
   ▼
PdfService
   │
   ▼
Load Blade PDF Template
   │
   ▼
DomPDF Render
   │
   ▼
Download / Store PDF
```

### 4.3 Email Flow

```
User klik Send Email
   │
   ▼
Controller
   │
   ▼
Generate PDF jika belum ada
   │
   ▼
EmailService
   │
   ▼
Laravel Mail
   │
   ▼
SMTP Server
   │
   ▼
Customer Email
```

### 4.4 WhatsApp Flow

```
User klik Send WA
   │
   ▼
Controller
   │
   ▼
Generate PDF jika belum ada
   │
   ▼
WhatsAppService
   │
   ▼
Fonnte API
   │
   ▼
Customer WhatsApp
```

---

## 5. Authentication Flow

```
Admin membuka /login
   │
   ▼
Submit email dan password
   │
   ▼
Laravel Auth attempt
   │
   ├── Valid   → Redirect dashboard
   └── Invalid → Return error
```

Seluruh route internal wajib menggunakan middleware `auth`.

---

## 6. Technology Stack

| Layer | Technology |
|------|------------|
| Backend Framework | Laravel 12 |
| Frontend | Blade + Tailwind CSS |
| Admin Template | TailAdmin v2.3 |
| Database | MySQL 8 |
| Web Server | Apache / XAMPP |
| PDF Engine | DomPDF |
| Email | SMTP |
| WhatsApp | Fonnte API / WA Gateway |
| Asset Bundler | Vite |

---

## 7. Data Flow Summary

| Source | Process | Output |
|--------|---------|--------|
| Customer Form | CustomerController | customers table |
| Quotation Form | QuotationController | quotations + quotation_items |
| Invoice Form | InvoiceController | invoices + invoice_items |
| Berita Acara Form | BeritaAcaraController | berita_acara table |
| CMS Form | CmsController | cms_pages table |
| Report Request | ReportController | Aggregated summary |
| PDF Request | PdfService | PDF file |
| Email Request | EmailService | Email with attachment |
| WA Request | WhatsAppService | WhatsApp message/link |

---

## 8. Error Handling Strategy

- Validation error dikembalikan ke form dengan pesan field spesifik.
- External service error (SMTP/Fonnte) dicatat ke log.
- PDF generation failure ditampilkan sebagai alert dan dicatat ke log.
- Database exception ditangani dengan transaction rollback.
- Error production tidak menampilkan stack trace karena `APP_DEBUG=false`.

---

## 9. Logging Strategy

- Semua error application dicatat pada `storage/logs/laravel.log`.
- Event penting yang direkomendasikan untuk logging:
  - Generate PDF gagal
  - Email gagal terkirim
  - WhatsApp gagal terkirim
  - Login gagal berulang
  - Database transaction gagal

---

## 10. Security Strategy

- Auth middleware untuk semua halaman admin.
- CSRF token untuk semua POST/PUT/DELETE form.
- Validasi input di controller/form request.
- Escape output di Blade menggunakan `{{ }}`.
- File `.env` tidak dipublikasikan.
- Apache DocumentRoot wajib diarahkan ke folder `public`.
- `APP_DEBUG=false` saat production.