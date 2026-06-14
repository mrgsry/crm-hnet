# API Design

Seluruh endpoint API berikut memerlukan Header `Accept: application/json` dan terlindungi middleware `auth` (atau `auth:sanctum` jika diakses eksternal).

---

## 1. Authentication

`POST /api/login`
- **Body**: `{ "email": "admin@example.com", "password": "password" }`
- **Response**: `{ "token": "xxx", "user": { ... } }`

`POST /api/logout`
- **Header**: `Authorization: Bearer {token}`
- **Response**: `{ "message": "Logged out successfully" }`

---

## 2. Dashboard & Reporting

`GET /api/dashboard/summary`
- **Response**: 
  ```json
  {
    "total_customer": 150,
    "total_quotation": 45,
    "total_invoice": 30,
    "total_revenue": 150000000,
    "outstanding_invoice": 25000000
  }
  ```

---

## 3. Customer

`GET /api/customers`
- **Query Params**: `?search=...&page=1`
- **Response**: Paginated list of customers.

`GET /api/customers/{id}`
- **Response**: Customer detail object.

`POST /api/customers`
- **Body**: 
  ```json
  {
    "company_name": "PT Maju Jaya",
    "pic_name": "Budi",
    "email": "budi@majujaya.com",
    "phone": "08123456789",
    "address": "Jl. Sudirman No 1",
    "npwp": "12.345.678.9-012.000"
  }
  ```

`PUT /api/customers/{id}`
- **Body**: Sama seperti POST (dapat partial/lengkap).

`DELETE /api/customers/{id}`
- **Response**: `{ "message": "Customer deleted" }`

---

## 4. Quotation

`GET /api/quotations`
- **Query Params**: `?status=Draft&page=1`

`GET /api/quotations/{id}`
- **Response**: Detail quotation beserta items.

`POST /api/quotations`
- **Body**:
  ```json
  {
    "customer_id": 1,
    "quotation_date": "2024-03-15",
    "status": "Draft",
    "discount": 500000,
    "items": [
      { "description": "Layanan Internet", "qty": 1, "price": 1000000 }
    ]
  }
  ```
  *Catatan: subtotal, tax, dan total dihitung di backend.*

`PUT /api/quotations/{id}`
- **Body**: Sama seperti POST.

`DELETE /api/quotations/{id}`

### Quotation Actions
`POST /api/quotations/{id}/pdf` (Generate PDF)
`POST /api/quotations/{id}/email` (Kirim ke Email Customer)
`POST /api/quotations/{id}/wa` (Kirim ke WA Customer via Fonnte)

---

## 5. Invoice

`GET /api/invoices`
- **Query Params**: `?status=Unpaid&page=1`

`GET /api/invoices/{id}`
- **Response**: Detail invoice beserta items.

`POST /api/invoices`
- **Body**:
  ```json
  {
    "customer_id": 1,
    "invoice_date": "2024-03-15",
    "due_date": "2024-04-15",
    "status": "Unpaid",
    "items": [
      { "description": "Layanan Internet", "qty": 1, "price": 1000000 }
    ]
  }
  ```

`PUT /api/invoices/{id}`

`DELETE /api/invoices/{id}`

### Invoice Actions
`POST /api/invoices/{id}/pdf`
`POST /api/invoices/{id}/email`
`POST /api/invoices/{id}/wa`

---

## 6. Berita Acara

`GET /api/berita-acara`

`GET /api/berita-acara/{id}`

`POST /api/berita-acara`
- **Body**:
  ```json
  {
    "customer_id": 1,
    "tanggal": "2024-03-20",
    "jenis": "Instalasi",
    "isi": "Telah dilakukan instalasi router dan penarikan kabel fiber optik."
  }
  ```

`PUT /api/berita-acara/{id}`

`DELETE /api/berita-acara/{id}`

`POST /api/berita-acara/{id}/pdf`

---

## 7. CMS Pages (Landing Page)

`GET /api/cms`
- **Response**: List semua bagian landing page (Hero, About, dll).

`GET /api/cms/{slug}`
- **Response**: Detail satu halaman CMS.

`PUT /api/cms/{slug}`
- **Body**:
  ```json
  {
    "title": "Tentang Kami",
    "content": "<h1>Sejarah HNet Solution</h1><p>...</p>"
  }
  ```
