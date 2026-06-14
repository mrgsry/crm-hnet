# Database Design

Database menggunakan MySQL 8 dan Laravel Eloquent ORM.

---

## users

| Field | Type | Constraint |
|---------|----------|-------------|
| id | bigint unsigned | primary key |
| name | varchar(255) | not null |
| email | varchar(255) | unique, not null |
| password | varchar(255) | not null |
| remember_token | varchar(100) | nullable |
| created_at | timestamp | nullable |
| updated_at | timestamp | nullable |

---

## customers

| Field | Type | Constraint |
|---------|----------|-------------|
| id | bigint unsigned | primary key |
| company_name | varchar(255) | not null |
| pic_name | varchar(255) | nullable |
| email | varchar(255) | nullable |
| phone | varchar(50) | nullable |
| address | text | nullable |
| npwp | varchar(50) | nullable |
| created_at | timestamp | nullable |
| updated_at | timestamp | nullable |

---

## quotations

| Field | Type | Constraint |
|---------|----------|-------------|
| id | bigint unsigned | primary key |
| quotation_no | varchar(100) | unique, not null |
| customer_id | bigint unsigned | foreign key customers.id |
| quotation_date | date | not null |
| subtotal | decimal(15,2) | default 0 |
| discount | decimal(15,2) | default 0 |
| tax | decimal(15,2) | default 0 |
| total | decimal(15,2) | default 0 |
| status | enum | Draft, Sent, Approved, Rejected |
| created_at | timestamp | nullable |
| updated_at | timestamp | nullable |

---

## quotation_items

| Field | Type | Constraint |
|---------|----------|-------------|
| id | bigint unsigned | primary key |
| quotation_id | bigint unsigned | foreign key quotations.id |
| description | text | not null |
| qty | int | default 1 |
| price | decimal(15,2) | default 0 |
| total | decimal(15,2) | default 0 |
| created_at | timestamp | nullable |
| updated_at | timestamp | nullable |

---

## invoices

| Field | Type | Constraint |
|---------|----------|-------------|
| id | bigint unsigned | primary key |
| invoice_no | varchar(100) | unique, not null |
| customer_id | bigint unsigned | foreign key customers.id |
| invoice_date | date | not null |
| due_date | date | nullable |
| subtotal | decimal(15,2) | default 0 |
| tax | decimal(15,2) | default 0 |
| total | decimal(15,2) | default 0 |
| status | enum | Unpaid, Partial, Paid |
| created_at | timestamp | nullable |
| updated_at | timestamp | nullable |

---

## invoice_items

| Field | Type | Constraint |
|---------|----------|-------------|
| id | bigint unsigned | primary key |
| invoice_id | bigint unsigned | foreign key invoices.id |
| description | text | not null |
| qty | int | default 1 |
| price | decimal(15,2) | default 0 |
| total | decimal(15,2) | default 0 |
| created_at | timestamp | nullable |
| updated_at | timestamp | nullable |

---

## berita_acara

| Field | Type | Constraint |
|---------|----------|-------------|
| id | bigint unsigned | primary key |
| nomor | varchar(100) | unique, not null |
| customer_id | bigint unsigned | foreign key customers.id |
| tanggal | date | not null |
| jenis | enum | Serah Terima, Instalasi, Maintenance, Pekerjaan Selesai |
| isi | longtext | not null |
| created_at | timestamp | nullable |
| updated_at | timestamp | nullable |

---

## cms_pages

| Field | Type | Constraint |
|---------|----------|-------------|
| id | bigint unsigned | primary key |
| title | varchar(255) | not null |
| slug | varchar(255) | unique, not null |
| content | longtext | nullable |
| created_at | timestamp | nullable |
| updated_at | timestamp | nullable |

---

## Relationships

| Relationship | Type |
|--------------|------|
| customers → quotations | one to many |
| quotations → quotation_items | one to many |
| customers → invoices | one to many |
| invoices → invoice_items | one to many |
| customers → berita_acara | one to many |

---

## Indexing Recommendation

| Table | Index |
|-------|-------|
| customers | company_name, email, phone |
| quotations | quotation_no, customer_id, status, quotation_date |
| invoices | invoice_no, customer_id, status, invoice_date, due_date |
| berita_acara | nomor, customer_id, tanggal, jenis |
| cms_pages | slug |

---

## Numbering Format

| Document | Format Example |
|----------|----------------|
| Quotation | QTN/HNET/2024/0001 |
| Invoice | INV/HNET/2024/0001 |
| Berita Acara | BA/HNET/2024/0001 |