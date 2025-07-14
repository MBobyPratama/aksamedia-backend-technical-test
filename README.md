# 🚀 Aksamedia Backend API - Technical Test

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Sanctum](https://img.shields.io/badge/Laravel_Sanctum-Authentication-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)

## 📋 Tentang Proyek

Proyek ini adalah implementasi dari **Back End Web Developer Intern Technical Test** untuk **PT Aksamedia Mulia Digital**. Sistem ini merupakan API backend untuk manajemen karyawan dengan fitur autentikasi, CRUD operasi, dan upload file.

### 🎯 Tujuan Proyek
- Mengimplementasikan 7 endpoint API sesuai spesifikasi technical test
- Mendemonstrasikan kemampuan backend development dengan Laravel
- Menggunakan best practices dalam pengembangan API
- Menerapkan autentikasi dan authorization yang aman

## ✨ Fitur Utama

### 🔐 Autentikasi
- **Login Admin**: Sistem login menggunakan username dan password
- **Bearer Token**: Autentikasi menggunakan Laravel Sanctum
- **Logout**: Sistem logout yang menghapus token

### 👥 Manajemen Divisi
- **Listing Divisi**: Menampilkan semua divisi dengan pagination
- **Filter Divisi**: Pencarian divisi berdasarkan nama
- **Data Seeder**: Data divisi sudah tersedia untuk testing

### 👨‍💼 Manajemen Karyawan
- **CRUD Lengkap**: Create, Read, Update, Delete karyawan
- **Upload Foto**: Fitur upload foto karyawan dengan validasi
- **Filter & Pencarian**: Filter berdasarkan nama dan divisi
- **Pagination**: Penampilan data dengan pagination
- **Relasi Database**: Relasi dengan tabel divisi

## 🛠️ Teknologi yang Digunakan

### Backend Framework
- **Laravel 11.x**: Framework PHP terbaru dengan fitur modern
- **Laravel Sanctum**: Autentikasi API yang ringan dan aman
- **Eloquent ORM**: Object-Relational Mapping untuk database

### Database
- **MySQL**: Database utama untuk production
- **SQLite**: Database untuk development dan testing
- **UUID**: Primary key menggunakan UUID untuk keamanan

### Tools & Dependencies
- **Scramble**: Untuk dokumentasi API otomatis
- **Form Request**: Validasi input yang terstruktur
- **File Storage**: Sistem upload dan manajemen file
- **Pagination**: Built-in pagination Laravel

## 📊 Struktur Database

### Tabel Admins
```sql
- id (UUID, Primary Key)
- name (String)
- username (String, Unique)
- phone (String)
- email (String, Unique)
- password (String, Hashed)
- created_at, updated_at
```

### Tabel Divisions
```sql
- id (UUID, Primary Key)
- name (String)
- created_at, updated_at
```

### Tabel Employees
```sql
- id (UUID, Primary Key)
- image (String, Nullable)
- name (String)
- phone (String)
- division_id (UUID, Foreign Key)
- position (String)
- created_at, updated_at
```

## 🚀 Instalasi & Setup

### Prerequisites
Pastikan Anda memiliki:
- PHP 8.2 atau lebih baru
- Composer
- MySQL/XAMPP/MAMP
- Node.js (opsional, untuk frontend)

### 1. Clone Repository
```bash
git clone https://github.com/MBobyPratama/aksamedia-backend-technical-test.git
cd aksamedia-backend-technical-test
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Environment Setup
```bash
# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 4. Database Configuration
Edit file `.env` dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=aksamedia_backend
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Database Migration & Seeding
```bash
# Jalankan migration
php artisan migrate

# Seed database dengan data awal
php artisan db:seed
```

### 6. Create Storage Link
```bash
php artisan storage:link
```

### 7. Jalankan Server
```bash
php artisan serve
```

Server akan berjalan di: `http://127.0.0.1:8000`

## 🔗 API Endpoints

### Base URL
```
http://127.0.0.1:8000/api
```

### 1. 🔐 Login Admin
- **URL**: `POST /api/login`
- **Body**: 
```json
{
    "username": "admin",
    "password": "pastibisa"
}
```

### 2. 📋 Get All Divisions
- **URL**: `GET /api/divisions`
- **Headers**: `Authorization: Bearer {token}`
- **Query Parameters**:
  - `name` (optional): Filter divisi berdasarkan nama
  - `page` (optional): Halaman pagination

### 3. 👥 Get All Employees
- **URL**: `GET /api/employees`
- **Headers**: `Authorization: Bearer {token}`
- **Query Parameters**:
  - `name` (optional): Filter karyawan berdasarkan nama
  - `division_id` (optional): Filter berdasarkan divisi
  - `page` (optional): Halaman pagination

### 4. ➕ Create Employee
- **URL**: `POST /api/employees`
- **Headers**: `Authorization: Bearer {token}`
- **Body** (form-data):
```json
{
    "image": "file.jpg",
    "name": "John Doe",
    "phone": "08123456789",
    "division_id": "uuid-division-id",
    "position": "Software Engineer"
}
```

### 5. ✏️ Update Employee
- **URL**: `PUT /api/employees/{id}`
- **Headers**: `Authorization: Bearer {token}`
- **Body** (form-data):
```json
{
    "image": "file.jpg",
    "name": "Jane Doe",
    "phone": "08123456790",
    "division_id": "uuid-division-id",
    "position": "Senior Software Engineer"
}
```

### 6. 🗑️ Delete Employee
- **URL**: `DELETE /api/employees/{id}`
- **Headers**: `Authorization: Bearer {token}`

### 7. 🚪 Logout
- **URL**: `POST /api/logout`
- **Headers**: `Authorization: Bearer {token}`

## 🔧 Testing API

### Menggunakan Postman
1. Import koleksi Postman dari folder `postman/`
2. Set environment variable `base_url` ke `http://127.0.0.1:8000/api`
3. Login terlebih dahulu untuk mendapatkan token
4. Token akan otomatis tersimpan di environment variable `auth_token`

### Menggunakan Scramble (Alternatif)
Akses dokumentasi API otomatis di: `http://127.0.0.1:8000/docs/api`

#### Kelebihan Menggunakan Scramble:
- **Dokumentasi Otomatis**: Dokumentasi dihasilkan otomatis dari kode
- **Interactive Testing**: Bisa test API langsung dari browser
- **Real-time Updates**: Dokumentasi selalu up-to-date
- **Better UX**: Interface yang modern dan mudah digunakan

#### Cara Menggunakan Scramble:
1. Pastikan server Laravel sudah berjalan
2. Buka browser dan akses `http://127.0.0.1:8000/docs/api`
3. Gunakan tombol "Try it out" untuk testing endpoint
4. Untuk endpoint yang membutuhkan autentikasi:
   - Login terlebih dahulu melalui endpoint `/api/login`
   - Copy token yang didapat
   - Klik tombol "Authorize" di bagian atas
   - Masukkan token dengan format: `Bearer {your-token}`
   - Sekarang Anda bisa mengakses semua endpoint

## 📝 Data Testing

### Admin Login
```json
{
    "username": "admin",
    "password": "pastibisa"
}
```

### Divisions yang Tersedia
- Mobile Apps
- QA
- Full Stack
- Backend
- Frontend
- UI/UX Designer

## 🐛 Troubleshooting

### Common Issues

1. **Error 500 saat Login**
   - Pastikan database sudah di-migrate
   - Jalankan `php artisan db:seed`
   - Cek apakah tabel `admins` sudah ada

2. **Token Authentication Error**
   - Pastikan menggunakan format: `Bearer {token}`
   - Cek apakah token masih valid (belum expired)
   - Pastikan header `Authorization` sudah benar

3. **File Upload Error**
   - Jalankan `php artisan storage:link`
   - Pastikan direktori `storage/app/public` ada
   - Cek permission direktori storage

4. **Database Connection Error**
   - Pastikan MySQL service sudah running
   - Cek konfigurasi database di `.env`
   - Pastikan database sudah dibuat

## 📊 Struktur Proyek

```
aksamedia-backend/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── DivisionController.php
│   │   │   └── EmployeeController.php
│   │   ├── Requests/
│   │   │   ├── LoginRequest.php
│   │   │   ├── StoreEmployeeRequest.php
│   │   │   └── UpdateEmployeeRequest.php
│   │   └── Middleware/
│   │       └── RedirectIfAuthenticated.php
│   └── Models/
│       ├── Admin.php
│       ├── Division.php
│       └── Employee.php
├── database/
│   ├── migrations/
│   └── seeders/
├── routes/
│   └── api.php
└── config/
    ├── auth.php
    └── sanctum.php
```

## 🌐 Deployment

### ⚠️ Catatan Penting untuk Tim Aksamedia

Saya ingin menjelaskan mengapa proyek ini tidak di-deploy ke server production:

**Kendala Biaya Server MySQL:**
- Setelah melakukan riset, biaya server MySQL di cloud provider seperti Laravel Cloud, AWS RDS, atau Digital Ocean lebih mahal dibandingkan PostgreSQL
- Sebagai mahasiswa, budget saya terbatas untuk menyewa server MySQL jangka panjang
- Server PostgreSQL gratis lebih mudah ditemukan (seperti di Railway, Supabase, dll)

**Alternatif yang Tersedia:**
1. **Local Development**: Proyek sudah fully functional di local environment
2. **SQLite Version**: Bisa dijalankan dengan SQLite tanpa setup MySQL
3. **Docker**: Sudah siap untuk containerization jika diperlukan

**Solusi untuk Demo:**
- Semua endpoint sudah ditest dan berfungsi sempurna di local
- Dokumentasi lengkap sudah tersedia
- Video demo atau screen recording bisa disediakan jika diperlukan

Saya berharap tim Aksamedia bisa memahami situasi ini. Jika ada anggaran untuk server MySQL, saya siap untuk mendeploy proyek ini dengan cepat.

### Setup untuk Production (Jika Diperlukan)

1. **Database Migration**
```bash
php artisan migrate --force
php artisan db:seed --force
```

2. **Environment Variables**
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
```

3. **Optimization**
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 🤝 Kontribusi

Proyek ini dibuat untuk technical test, namun saran dan masukan sangat diterima untuk perbaikan.

## 📞 Kontak

- **Developer**: Muhammad Boby Pratama
- **Email**: [bobypratama.dev@gmail.com](mailto:bobypratama.dev@gmail.com)
- **LinkedIn**: [Muhammad Boby Pratama](www.linkedin.com/in/muhammad-boby-pratama)
- **GitHub**: [MBobyPratama](https://github.com/MBobyPratama)

## 📄 Lisensi

Proyek ini dibuat untuk keperluan technical test PT Aksamedia Mulia Digital.

---

## 🎯 Kesimpulan Technical Test

Proyek ini berhasil mengimplementasikan semua requirement dari technical test:

✅ **7 Endpoint API** - Semua endpoint sesuai spesifikasi
✅ **Autentikasi** - Laravel Sanctum dengan bearer token
✅ **CRUD Operations** - Complete CRUD untuk employees
✅ **File Upload** - Upload dan validasi gambar
✅ **Database Design** - Relasi yang tepat dengan UUID
✅ **Validation** - Input validation yang comprehensive
✅ **Error Handling** - Response error yang informatif
✅ **Documentation** - Dokumentasi lengkap dan jelas
✅ **Testing** - Semua endpoint sudah ditest dan berfungsi
✅ **Code Quality** - Clean code dengan best practices

**Bonus Features:**
- Scramble API documentation
- Comprehensive error handling
- File upload dengan automatic cleanup
- Pagination untuk semua listing
- Search dan filter functionality
- UUID untuk enhanced security

Terima kasih atas kesempatan untuk mengerjakan technical test ini! 🚀
