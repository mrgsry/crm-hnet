# UI UX Guideline

## 1. Admin Panel

Template:
TailAdmin v2.3

Theme:

- Primary : #2563EB
- Success : #22C55E
- Warning : #F59E0B
- Danger : #EF4444
- Info : #0EA5E9
- Neutral : #64748B

---

## 2. Typography

| Element | Font Size | Weight |
|---------|-----------|--------|
| Page Title | 24px - 30px | 700 |
| Section Title | 20px - 24px | 600 |
| Card Title | 16px - 18px | 600 |
| Body Text | 14px - 16px | 400 |
| Helper Text | 12px - 13px | 400 |
| Table Header | 13px - 14px | 600 |
| Button Text | 14px | 500 |

Font family mengikuti default TailAdmin/Tailwind, direkomendasikan menggunakan system font atau Inter.

---

## 3. Responsive Breakpoints

Mobile:
320px - 767px

Tablet:
768px - 1023px

Desktop:
1024px+

---

## 4. Layout

Admin layout terdiri dari:

- Sidebar
- Topbar
- Content Area
- Footer

### Desktop

- Sidebar fixed di kiri
- Topbar sticky di atas
- Content area menggunakan max-width responsive
- Table dapat menggunakan full width

### Mobile

- Sidebar collapsible / drawer
- Table menggunakan horizontal scroll
- Action button dapat dibuat dropdown jika ruang terbatas
- Form menggunakan single column

---

## 5. Sidebar Menu Structure

Rekomendasi menu sidebar:

1. Dashboard
2. Customer
3. Quotation
4. Invoice
5. Berita Acara
6. CMS Landing Page
   - Hero Banner
   - About Us
   - Services
   - Portfolio
   - Testimoni
   - Contact
7. Reports
   - Revenue
   - Quotation Conversion
   - Outstanding Invoice
   - Customer Growth
8. Settings
9. Logout

---

## 6. Component Standards

### 6.1 Button

| Variant | Usage | Color |
|---------|-------|-------|
| Primary | Save, Submit, Add New | #2563EB |
| Success | Approve, Paid, Send | #22C55E |
| Warning | Edit, Draft, Pending | #F59E0B |
| Danger | Delete, Reject, Cancel | #EF4444 |
| Secondary | Back, Reset | #64748B |

Button size:

- Small: 32px height
- Default: 40px height
- Large: 48px height

### 6.2 Form Input

Setiap form wajib memiliki:

- Label
- Placeholder jika diperlukan
- Validation error message
- Required indicator `*` untuk field wajib
- Consistent spacing antar field

### 6.3 Table

Table wajib memiliki:

- Header jelas
- Pagination
- Search/filter jika data banyak
- Empty state jika data kosong
- Action column untuk View/Edit/Delete
- Badge status untuk Quotation dan Invoice

### 6.4 Card

Card digunakan untuk:

- Dashboard summary
- Report summary
- Form grouping
- Detail preview

Card style:

- Rounded corners
- Light shadow
- Padding konsisten 16px - 24px

### 6.5 Modal

Modal digunakan untuk:

- Delete confirmation
- Send Email confirmation
- Send WhatsApp confirmation
- Quick preview

Modal wajib memiliki:

- Title
- Clear description
- Primary action
- Cancel action

---

## 7. Status Badge

### Quotation

| Status | Color |
|--------|-------|
| Draft | Neutral |
| Sent | Info |
| Approved | Success |
| Rejected | Danger |

### Invoice

| Status | Color |
|--------|-------|
| Unpaid | Danger |
| Partial | Warning |
| Paid | Success |

---

## 8. Form Layout

### Customer Form

- Company Name
- PIC Name
- Email
- Phone / WhatsApp
- Address
- NPWP

### Quotation / Invoice Form

- Customer selector
- Document date
- Due date (Invoice only)
- Dynamic item rows
- Subtotal
- Discount (Quotation only)
- Tax
- Grand Total
- Status

---

## 9. Landing Page CMS Guideline

CMS Landing Page harus mudah diedit oleh admin.

Section yang dikelola:

- Hero Banner
- About Us
- Services
- Portfolio
- Testimoni
- Contact

Setiap section minimal memiliki:

- Title
- Subtitle / description
- Image upload jika diperlukan
- Content editor
- Active/inactive status jika diperlukan

---

## 10. PDF Template Guideline

PDF untuk Quotation, Invoice, dan Berita Acara harus memiliki:

- Logo HNet Solution
- Nama dokumen
- Nomor dokumen
- Tanggal dokumen
- Data customer
- Tabel item/detail pekerjaan
- Subtotal/tax/total untuk quotation dan invoice
- Catatan / terms jika diperlukan
- Footer perusahaan
- Signature area

Ukuran kertas:

- A4 Portrait

Style:

- Clean, formal, mudah dibaca
- Warna utama mengikuti primary color #2563EB