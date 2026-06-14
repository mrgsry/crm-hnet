# Testing Plan

## 1. Functional Testing

| Module | Test Case | Expected Result |
|--------|-----------|-----------------|
| Login | Admin login dengan credential valid | Masuk ke dashboard |
| Login | Admin login dengan password salah | Muncul error validasi |
| Dashboard | Buka halaman dashboard | Statistik customer, quotation, invoice, revenue tampil |
| Customer | Create customer | Data customer tersimpan |
| Customer | Update customer | Data customer berubah |
| Customer | Delete customer | Data customer terhapus / tidak tampil |
| Quotation | Create quotation multi item | Nomor quotation otomatis dan total dihitung benar |
| Quotation | Update status quotation | Status berubah sesuai pilihan |
| Quotation | Export PDF | File PDF berhasil dibuat |
| Quotation | Kirim Email PDF | Email terkirim ke customer |
| Quotation | Kirim WA PDF | WhatsApp terkirim via Fonnte |
| Invoice | Create invoice multi item | Nomor invoice otomatis dan total dihitung benar |
| Invoice | Update status invoice | Status berubah Unpaid / Partial / Paid |
| Invoice | Export PDF | File PDF berhasil dibuat |
| Invoice | Kirim Email PDF | Email terkirim ke customer |
| Invoice | Kirim WA PDF | WhatsApp terkirim via Fonnte |
| Berita Acara | Create berita acara | Nomor BA otomatis dan data tersimpan |
| Berita Acara | Export PDF | PDF berita acara berhasil dibuat |
| CMS | Update Hero Banner | Konten landing page berubah |
| CMS | Update About / Services / Portfolio / Testimoni / Contact | Konten tersimpan dan tampil di landing page |
| Report | Buka revenue report | Data revenue tampil sesuai invoice paid |
| Report | Buka outstanding invoice report | Invoice unpaid/partial tampil |

---

## 2. Validation Testing

| Form | Field | Rule |
|------|-------|------|
| Customer | company_name | required |
| Customer | email | nullable, email format |
| Customer | phone | nullable |
| Quotation | customer_id | required, exists customers |
| Quotation | items | required, array min 1 |
| Quotation Item | qty | required, integer, min 1 |
| Quotation Item | price | required, numeric, min 0 |
| Invoice | customer_id | required, exists customers |
| Invoice | due_date | nullable, date |
| Berita Acara | jenis | required, in allowed values |
| CMS | slug | required, unique |

---

## 3. Responsive Testing

| Device | Width | Expected Result |
|--------|-------|-----------------|
| Mobile | 320px - 767px | Sidebar collapsible, table responsive |
| Tablet | 768px - 1023px | Layout tetap rapi dan form mudah digunakan |
| Desktop | 1024px+ | Sidebar, topbar, content area tampil penuh |

---

## 4. Browser Testing

- Chrome latest
- Microsoft Edge latest
- Firefox latest

Expected result:

- Layout konsisten
- Form submit berjalan
- Export PDF berjalan
- Tidak ada error JavaScript di console

---

## 5. Integration Testing

| Integration | Test Case | Expected Result |
|------------|-----------|-----------------|
| DomPDF | Generate quotation PDF | PDF berhasil terbuka/terdownload |
| DomPDF | Generate invoice PDF | PDF berhasil terbuka/terdownload |
| DomPDF | Generate berita acara PDF | PDF berhasil terbuka/terdownload |
| SMTP | Kirim email quotation | Email masuk ke inbox/customer |
| SMTP | Kirim email invoice | Email masuk ke inbox/customer |
| Fonnte | Kirim WA quotation | Pesan WhatsApp terkirim |
| Fonnte | Kirim WA invoice | Pesan WhatsApp terkirim |

---

## 6. Security Testing

| Area | Test Case | Expected Result |
|------|-----------|-----------------|
| Authentication | Akses dashboard tanpa login | Redirect ke login |
| CSRF | Submit form tanpa token | Request ditolak |
| SQL Injection | Input `' OR 1=1 --` | Tidak merusak query/data |
| XSS | Input `<script>alert(1)</script>` | Script tidak dieksekusi |
| Authorization | Akses route admin tanpa session | Redirect/403 |
| Env Security | `.env` diakses via browser | Tidak dapat diakses |

---

## 7. Performance Testing

| Area | Target |
|------|--------|
| Dashboard load | < 3 detik untuk data normal |
| List customer | Pagination aktif jika data > 20 |
| Generate PDF | < 5 detik per dokumen |
| Report query | < 5 detik untuk data bulanan |
| Asset loading | CSS/JS hasil build digunakan di production |

---

## 8. Pre-Deployment Testing Checklist

- [ ] Semua migration berhasil dijalankan
- [ ] Admin dapat login
- [ ] Customer CRUD berhasil
- [ ] Quotation CRUD berhasil
- [ ] Invoice CRUD berhasil
- [ ] Berita Acara CRUD berhasil
- [ ] CMS CRUD berhasil
- [ ] Dashboard summary benar
- [ ] Report tampil benar
- [ ] PDF export berhasil
- [ ] Email sending berhasil
- [ ] WhatsApp sending berhasil
- [ ] Responsive mobile/tablet/desktop valid
- [ ] Browser Chrome/Edge/Firefox valid
- [ ] `APP_DEBUG=false` di production