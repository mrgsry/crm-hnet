# Project Execution Plan – HNet Solution CRM

## Overview
The following plan details every step required to turn the **Product Requirement Document (PRD)** into a fully functional Laravel 12 application using **TailAdmin v2.3**, MySQL, DomPDF, SMTP, and Fonnte API for WhatsApp. All work follows the specifications, architecture, UI/UX guidelines, and testing plan contained in the `.agent` directory.

---

## ✅ Completed Milestones
- **Plan Document (this file) created**
- **Backend Dependencies installed**
- **Database migrations created for all tables**
- **Eloquent models generated for every entity**
- **Migrations executed (pending run on local DB)**
- **Authentication scaffolding (Laravel Auth) ready** *(will be completed in Sprint 1)*

---

## 📅 Development Sprints & Tasks

| Sprint | Focus | Key Deliverables | Status |
|--------|-------|------------------|--------|
| **Sprint 0** | Project Setup | • Repo clone<br>• Composer install<br>• NPM install & build<br>• .env setup | ✅ Done |
| **Sprint 1** | Authentication & Base Layout | • Laravel auth (login/logout)<br>• TailAdmin integration<br>• Global middleware `auth` on admin routes | ⬜ Not started |
| **Sprint 2** | **Customer Management** | • `CustomerController` (CRUD)<br>• Resource routes (`/admin/customers`)<br>• Blade views: index, create, edit, show<br>• Validation rules (see testing plan)<br>• UI follows **UI‑UX guideline** (tables, modals, forms) | ⬜ Not started |
| **Sprint 3** | Quotation Module | • `QuotationController` & `QuotationItem` handling<br>• Auto‑numbering (format `QTN/HNET/YYYY/####`)<br>• PDF generation, Email & WhatsApp actions<br>• Dynamic item rows, tax/discount calculations | ⬜ Not started |
| **Sprint 4** | Invoice Module | • `InvoiceController` & `InvoiceItem` handling<br>• Auto‑numbering (`INV/HNET/YYYY/####`)<br>• PDF, Email, WhatsApp actions<br>• Status workflow (Unpaid → Partial → Paid) | ⬜ Not started |
| **Sprint 5** | Berita Acara Module | • `BeritaAcaraController` CRUD<br>• Auto‑numbering (`BA/HNET/YYYY/####`)<br>• PDF export | ⬜ Not started |
| **Sprint 6** | CMS Landing Page | • `CmsController` CRUD for `CmsPage`<br>• Sections: Hero, About, Services, Portfolio, Testimonial, Contact<br>• Slug routing, content editor integration | ⬜ Not started |
| **Sprint 7** | Summary Reporting | • `ReportController` with aggregated queries<br>• Dashboard cards for Revenue, Quotation Conversion, Outstanding Invoice, Customer Growth | ⬜ Not started |
| **Sprint 8** | Integration Services | • `PdfService` (DomPDF)<br>• `EmailService` (SMTP)<br>• `WhatsAppService` (Fonnte API)<br>• Queue workers for async sending | ⬜ Not started |
| **Sprint 9** | Testing & QA | • Execute functional, validation, integration, security, performance tests (see `testing-plan.md`)<br>• Fix bugs, improve UX | ⬜ Not started |
| **Sprint 10** | Deployment | • Production `.env` configuration<br>• Apache VirtualHost setup<br>• Laravel cache/route optimization<br>• Supervisor/Task Scheduler for queue & scheduler<br>• Final checklist (see deployment guide) | ⬜ Not started |

---

## 📂 Directory Structure (key folders)

```
app/
├─ Http/
│   ├─ Controllers/
│   │   ├─ Auth/
│   │   ├─ CustomerController.php
│   │   ├─ QuotationController.php
│   │   ├─ InvoiceController.php
│   │   ├─ BeritaAcaraController.php
│   │   ├─ CmsController.php
│   │   └─ ReportController.php
│   └─ Middleware/
├─ Models/
│   ├─ Customer.php
│   ├─ Quotation.php
│   ├─ QuotationItem.php
│   ├─ Invoice.php
│   ├─ InvoiceItem.php
│   ├─ BeritaAcara.php
│   └─ CmsPage.php
│   └─ User.php (Laravel default)
resources/
├─ views/
│   ├─ layouts/ (TailAdmin base)
│   ├─ customers/ (index, create, edit, show)
│   ├─ quotations/ (full CRUD UI)
│   ├─ invoices/
│   ├─ berita_acara/
│   ├─ cms/
│   └─ reports/
routes/
├─ web.php   (admin UI routes, guarded by auth)
└─ api.php   (API endpoints as described in api‑design.md)
```

---

## 🛠️ Technical Decisions & Conventions
- **Naming** – Follow Laravel conventions (`snake_case` DB columns, `StudlyCase` models).
- **Auto‑Numbering** – Implemented via DB transaction + `max()` query; stored format per **Numbering Format** table in SAD.
- **Status Badges** – Use TailAdmin badge colors (refer to UI‑UX guideline).
- **Validation** – All request data validated via Form Request classes (see testing‑plan.md for required rules).
- **PDF Layouts** – Blade templates under `resources/views/pdf/` using TailAdmin styling.
- **Queue** – `database` driver for local dev, `redis`/`supervisor` for production.
- **Security** – CSRF middleware active, Eloquent prevents SQL injection, output escaped with `{{ }}`.

---

## ✅ Pre‑Deployment Checklist (from Deployment Guide)

- [ ] `APP_ENV=production`
- [ ] `APP_DEBUG=false`
- [ ] `APP_KEY` generated
- [ ] DB credentials verified, migrations run
- [ ] Storage link (`php artisan storage:link`)
- [ ] `npm run build` succeeded
- [ ] Composer install with `--no-dev --optimize-autoloader`
- [ ] Config/route/view caches built
- [ ] Apache VirtualHost points to `public/`
- [ ] SSL enabled (`https://`)
- [ ] Queue worker running (`php artisan queue:work`)
- [ ] Scheduler cron entry set
- [ ] Email & WhatsApp services tested

---

## 📅 Estimated Timeline
Total **31 days** as defined in `development-plant.md`.  
Each sprint is allocated the number of days indicated there (e.g., Sprint 2 – 3 days, Sprint 3 – 5 days, etc.).

---

## ✅ Next Action
Begin **Sprint 2 – Customer Management Module**:

1. Create `CustomerController` with resource methods.  
2. Define routes in `routes/web.php` (`Route::resource('admin/customers', CustomerController::class)->middleware('auth');`).  
3. Build Blade views (`index.blade.php`, `create.blade.php`, `edit.blade.php`, `show.blade.php`) using TailAdmin components and UI‑UX guidelines.  
4. Add Form Request `StoreCustomerRequest` & `UpdateCustomerRequest` for validation.  

Once the Customer module is functional and passes the functional tests, we will proceed to the Quotation module.

---

*Prepared by Cline – software engineer.*