# Product Requirement Document (PRD)

## Project Name
HNet Solution CRM

## Version
1.0

## Objective

Membangun aplikasi CRM internal yang digunakan untuk:

1. Membuat Penawaran Harga (Quotation)
2. Membuat Invoice
3. Membuat Berita Acara
4. Mengelola Landing Page Company Profile
5. Mengelola Konten Website
6. Menghasilkan Laporan Ringkas (Summary Report)

---

## Technology Stack

| Item | Technology |
|--------|-------------|
| Backend | Laravel 12 |
| Frontend | Tailwind CSS |
| Admin Template | TailAdmin v2.3 |
| Database | MySQL |
| Web Server | Apache (XAMPP) |
| PHP Version | PHP 8.2 |
| PDF Generator | DomPDF |
| Email Service | SMTP |
| WhatsApp Service | Fonnte API / WA Gateway |

---

# User Role

## Admin

Hak akses:

- Full Access
- CRUD Semua Data
- Generate PDF
- Kirim Email
- Kirim WhatsApp
- Kelola Landing Page
- Melihat Report

---

# Core Features

## 1. Dashboard

Menampilkan:

- Total Customer
- Total Quotation
- Total Invoice
- Total Revenue
- Total Outstanding Invoice

---

## 2. Customer Management

Data:

- Nama Customer
- PIC
- Email
- Nomor WA
- Alamat
- NPWP

---

## 3. Quotation

Fitur:

- Generate Nomor Otomatis
- Multi Item
- Tax
- Discount
- Export PDF
- Email PDF
- WA PDF

Status:

- Draft
- Sent
- Approved
- Rejected

---

## 4. Invoice

Fitur:

- Generate Nomor Invoice
- Generate PDF
- Email PDF
- WA PDF

Status:

- Unpaid
- Partial
- Paid

---

## 5. Berita Acara

Jenis:

- Serah Terima
- Instalasi
- Maintenance
- Pekerjaan Selesai

Output:

- PDF

---

## 6. CMS Landing Page

Kelola:

- Hero Banner
- About Us
- Services
- Portfolio
- Testimoni
- Contact

---

## 7. Summary Report

Report:

- Revenue
- Quotation Conversion
- Outstanding Invoice
- Customer Growth
