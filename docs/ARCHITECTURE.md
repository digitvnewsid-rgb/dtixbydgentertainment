# Event Ticketing Management System — Arsitektur

## 1. Struktur folder

```
app/
├── Enums/                 # UserRole, EventStatus, PaymentStatus, TicketStatus, ...
├── Http/
│   ├── Controllers/
│   │   ├── Auth/          # Login, Register (customer)
│   │   ├── Admin/         # Dashboard, User, Event, Order, ...
│   │   ├── Creator/
│   │   ├── Customer/
│   │   ├── Ticketing/
│   │   └── Public/        # Homepage, events (tahap 3)
│   ├── Middleware/        # EnsureRole, ...
│   └── Requests/          # Form Request per modul
├── Models/
├── Policies/
└── Services/              # OrderService, TicketService, ScanService (tahap 4–5)

database/migrations/
database/seeders/

resources/views/
├── layouts/               # public, dashboard
├── auth/
├── admin/
├── creator/
├── customer/
├── ticketing/
└── public/

routes/web.php             # Route utama + grup per role
```

## 2. Database schema (MySQL)

| Tabel | Keterangan |
|-------|------------|
| `users` | Semua role; `role`, `is_active`, profil |
| `categories` | Kategori event |
| `events` | `creator_id`, `category_id`, jadwal, status, banner |
| `ticket_types` | Harga, kuota, periode jual, `sold` |
| `orders` | Order customer per event |
| `order_items` | Detail qty per jenis tiket |
| `payments` | Bukti & validasi manual |
| `tickets` | E-ticket + `qr_token` unik |
| `ticket_scans` | Riwayat scan |
| `event_ticketing_staff` | Petugas ↔ event |

## 3. Alur sistem (ringkas)

```
Customer → pilih event/tiket → checkout → order (pending)
         → upload bukti bayar → Admin validasi → paid
         → generate tickets + QR → customer download e-ticket
Ticketing → scan QR → validasi + lock row → status used (tidak bisa scan lagi)
```

## 4. Route utama

| Prefix | Role | Contoh |
|--------|------|--------|
| `/` | public | home, events |
| `/login`, `/register` | guest | auth |
| `/admin/*` | administrator | users, events, payments |
| `/creator/*` | creator | events, ticket-types |
| `/customer/*` | customer | orders, tickets |
| `/ticketing/*` | ticketing | scan, history |

## 5. Tahapan implementasi

| Tahap | Scope |
|-------|--------|
| **1** | Setup, MySQL, auth, role middleware, layout dashboard |
| **2** | Event, category, ticket type (creator + admin) |
| **3** | Public pages, checkout, order, payment manual |
| **4** | Generate ticket, QR, e-ticket |
| **5** | Scan QR, anti double-scan |
| **6** | Statistik, laporan, export |

## 6. Tahap 1 — selesai saat

- [x] Schema DB + model relasi dasar
- [x] Login/register + redirect per role
- [x] Middleware role
- [x] Layout dashboard (Tailwind)
- [x] Admin CRUD user + aktif/nonaktif
