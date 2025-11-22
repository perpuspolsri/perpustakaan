# 📚 Polsri Library Fine Services (Local Development Guide)


## 🔧 Persiapan Wajib
Sebelum mulai, pastiin di laptop udah ada:
- Git 🐙 → buat clone project
- Composer 🎼 → buat install dependency
- PHP 8.x ➕
- MySQL/MariaDB (misalnya via XAMPP/WAMP)

---

## 🚀 Cara Setup

### 1. Clone Repo
```bash
git clone https://github.com/Hiddev666/Polsri-Library-Fine-Services.git polsri-libray-fine-services
```

### 2. Masuk Folder Project
```bash
cd polsri-library-fine-services
```

### 3. Install Dependency
```bash
composer install
```

### 4. Copy File `.env`
```bash
cp .env.example .env
```
*(Windows bisa pakai: `copy .env.example .env`, atau copy manual file `.env.example` lalu ubah menjadi `.env`)*

---

## ⚙️ Konfigurasi

### Database
Buka file `.env`, cari bagian ini, terus sesuaikan:
```ini
database.default.hostname = localhost
database.default.database = polsri-library
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
```

### Generate Key
```bash
php spark key:generate
```

---

## 🗄️ Migration
Untuk generate otomatis skema database yang sudah dirancang
```bash
php spark migrate
```
Kemudian jalankan seeder
```bash
php spark db:seed LibrarySeeder
```
---

## ▶️ Jalankan Project
```bash
php spark serve
```

Lalu buka di browser:
👉 http://localhost:8080

---

## 📝 Catatan
- Kalau ada error, cek lagi `.env` (biasanya masalah DB)
- Jangan lupa `git pull` dulu sebelum coding, biar update sama branch terbaru
- Push jangan langsung ke `main`, bikin branch dulu ya 🚨

---

## 🤝 Teamwork
Kerja santai tapi serius 🔥. Kalau ada problem, bahas dulu di grup sebelum eksekusi.
