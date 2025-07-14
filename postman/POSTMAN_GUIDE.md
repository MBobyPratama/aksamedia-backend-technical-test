# 📋 Panduan Lengkap Postman Collection - Aksamedia Backend API

## 🚀 Quick Start Guide

### 1. Import Collection ke Postman

1. **Buka Postman** di komputer Anda
2. **Klik tombol "Import"** di sudut kiri atas
3. **Pilih file** `Aksamedia_Backend_Complete.postman_collection.json`
4. **Import environment** file `Aksamedia_Backend_Environment.postman_environment.json`
5. **Set environment** ke "🚀 Aksamedia Backend Environment"

### 2. Persiapan Server

Pastikan server Laravel sudah berjalan:
```bash
# Buka terminal di folder project
cd aksamedia-backend

# Jalankan server Laravel
php artisan serve
```

Server akan berjalan di: `http://127.0.0.1:8000`

### 3. Login untuk Mendapatkan Token

**PENTING:** Sebelum menggunakan endpoint lain, Anda HARUS login terlebih dahulu!

1. **Buka folder "🔐 Authentication"**
2. **Pilih "Login Admin"**
3. **Klik "Send"** (kredensial sudah diisi otomatis)
4. **Token akan otomatis tersimpan** di environment variable `auth_token`

**Kredensial Default:**
- Username: `admin`
- Password: `pastibisa`

## 📁 Struktur Collection

### 🔐 Authentication
- **Login Admin**: Mendapatkan bearer token untuk autentikasi
- **Logout**: Menghapus token dan logout dari sistem

### 📋 Divisions
- **Get All Divisions**: Mengambil semua divisi dengan pagination
- **Get Divisions with Name Filter**: Pencarian divisi berdasarkan nama
- **Get Divisions with Pagination**: Navigasi halaman data divisi

### 👥 Employees
- **Get All Employees**: Mengambil semua karyawan
- **Get Employees with Name Filter**: Pencarian berdasarkan nama karyawan
- **Get Employees with Division Filter**: Pencarian berdasarkan divisi
- **Get Employees with Combined Filters**: Kombinasi filter nama dan divisi
- **Create Employee**: Membuat karyawan baru dengan upload foto
- **Update Employee**: Memperbarui data karyawan
- **Delete Employee**: Menghapus karyawan

## 🔧 Fitur Otomatis Collection

### Auto Token Management
- ✅ **Login**: Token otomatis disimpan ke environment variable `auth_token`
- ✅ **Logout**: Token otomatis dihapus dari environment
- ✅ **Auto Headers**: Authorization header otomatis ditambahkan ke request

### Auto ID Management
- ✅ **Create Employee**: Employee ID otomatis disimpan ke `employee_id`
- ✅ **Update/Delete**: Menggunakan environment variable `employee_id`
- ✅ **Auto Cleanup**: ID dihapus setelah delete

### Auto Validation
- ✅ **Response Structure**: Validasi otomatis struktur response
- ✅ **Status Code**: Validasi kode status HTTP
- ✅ **Data Integrity**: Validasi data yang dikembalikan

### Console Logging
- ✅ **Request Logging**: Info request method dan URL
- ✅ **Response Logging**: Info response status dan waktu
- ✅ **Token Logging**: Info token save/delete
- ✅ **Error Logging**: Detail error untuk debugging

## 📖 Cara Menggunakan Setiap Endpoint

### 🔐 Authentication Endpoints

#### 1. Login Admin
```
POST /api/login
Content-Type: application/json

{
    "username": "admin",
    "password": "pastibisa"
}
```

**Response:**
```json
{
    "status": "success",
    "message": "Login berhasil",
    "data": {
        "token": "1|bearer-token-here",
        "admin": {
            "id": "uuid",
            "name": "Administrator",
            "username": "admin",
            "phone": "08123456789",
            "email": "admin@aksamedia.com"
        }
    }
}
```

#### 2. Logout
```
POST /api/logout
Authorization: Bearer {token}
```

**Response:**
```json
{
    "status": "success",
    "message": "Logout berhasil"
}
```

### 📋 Divisions Endpoints

#### 1. Get All Divisions
```
GET /api/divisions
Authorization: Bearer {token}
```

#### 2. Filter Divisions by Name
```
GET /api/divisions?name=Backend
Authorization: Bearer {token}
```

#### 3. Pagination
```
GET /api/divisions?page=1
Authorization: Bearer {token}
```

**Response Structure:**
```json
{
    "status": "success",
    "message": "Data divisi berhasil diambil",
    "data": {
        "divisions": [
            {
                "id": "uuid",
                "name": "Backend",
                "created_at": "2025-01-14T12:00:00.000000Z",
                "updated_at": "2025-01-14T12:00:00.000000Z"
            }
        ]
    },
    "pagination": {
        "current_page": 1,
        "per_page": 10,
        "total": 6,
        "last_page": 1,
        "from": 1,
        "to": 6,
        "has_more_pages": false
    }
}
```

### 👥 Employees Endpoints

#### 1. Get All Employees
```
GET /api/employees
Authorization: Bearer {token}
```

#### 2. Filter by Name
```
GET /api/employees?name=John
Authorization: Bearer {token}
```

#### 3. Filter by Division
```
GET /api/employees?division_id=uuid-divisi
Authorization: Bearer {token}
```

#### 4. Combined Filter
```
GET /api/employees?name=John&division_id=uuid-divisi&page=1
Authorization: Bearer {token}
```

#### 5. Create Employee
```
POST /api/employees
Authorization: Bearer {token}
Content-Type: multipart/form-data

Form Data:
- name: John Doe (required)
- phone: 08123456789 (required)
- division_id: uuid-divisi (required)
- position: Software Engineer (required)
- image: file.jpg (optional, max 2MB)
```

**Cara Mendapatkan Division ID:**
1. Jalankan endpoint `GET /api/divisions`
2. Copy `id` dari divisi yang diinginkan
3. Paste ke field `division_id` di form

#### 6. Update Employee
```
PUT /api/employees/{employee_id}
Authorization: Bearer {token}
Content-Type: multipart/form-data

Form Data:
- name: Jane Smith (required)
- phone: 08123456790 (required)
- division_id: uuid-divisi (required)
- position: Senior Software Engineer (required)
- image: new-file.jpg (optional)
```

#### 7. Delete Employee
```
DELETE /api/employees/{employee_id}
Authorization: Bearer {token}
```

**Response Structure:**
```json
{
    "status": "success",
    "message": "Data karyawan berhasil diambil",
    "data": {
        "employees": [
            {
                "id": "uuid",
                "image": "http://127.0.0.1:8000/storage/employees/image.jpg",
                "name": "John Doe",
                "phone": "08123456789",
                "position": "Software Engineer",
                "division": {
                    "id": "uuid",
                    "name": "Backend"
                }
            }
        ]
    },
    "pagination": {
        "current_page": 1,
        "per_page": 10,
        "total": 1,
        "last_page": 1,
        "from": 1,
        "to": 1,
        "has_more_pages": false
    }
}
```

## 🔍 Testing Workflow

### Workflow Basic Testing
1. **Login** → Dapatkan token
2. **Get Divisions** → Lihat divisi yang tersedia
3. **Get Employees** → Lihat karyawan yang ada (mungkin kosong)
4. **Create Employee** → Buat karyawan baru
5. **Update Employee** → Update data karyawan
6. **Delete Employee** → Hapus karyawan
7. **Logout** → Hapus token

### Workflow Advanced Testing
1. **Login** → Dapatkan token
2. **Get Divisions dengan Filter** → Test filter nama
3. **Create Multiple Employees** → Buat beberapa karyawan
4. **Test Filter Employees** → Test filter nama dan divisi
5. **Test Pagination** → Test pagination dengan data banyak
6. **Test Update dengan Image** → Test upload gambar
7. **Test Error Handling** → Test validasi error
8. **Logout** → Hapus token

## 🛠️ Tips & Troubleshooting

### Environment Variables
- **base_url**: `http://127.0.0.1:8000/api`
- **auth_token**: Otomatis diisi setelah login
- **employee_id**: Otomatis diisi setelah create employee
- **division_id**: Manual diisi dari response divisions

### Common Issues

#### 1. Authentication Error
**Problem:** `401 Unauthorized`
**Solution:** 
- Pastikan sudah login
- Cek apakah token tersimpan di environment
- Token format: `Bearer {token}`

#### 2. Validation Error
**Problem:** `422 Unprocessable Entity`
**Solution:**
- Cek field yang required
- Pastikan division_id valid
- Cek format file image (max 2MB)

#### 3. Server Error
**Problem:** `500 Internal Server Error`
**Solution:**
- Pastikan server Laravel running
- Cek database connection
- Lihat Laravel logs di `storage/logs/laravel.log`

#### 4. File Upload Error
**Problem:** Image tidak terupload
**Solution:**
- Pastikan file max 2MB
- Format: jpg, jpeg, png, gif
- Jalankan `php artisan storage:link`

### Debug Tips
- **Console Logs**: Buka Console di Postman untuk debug info
- **Response Body**: Periksa struktur response untuk error detail
- **Status Code**: Perhatikan kode status HTTP
- **Headers**: Pastikan Authorization header ada

## 📊 Expected Test Results

### Divisions (6 divisi tersedia)
- Mobile Apps
- QA
- Full Stack
- Backend
- Frontend
- UI/UX Designer

### Employees (initially empty)
- Mulai dengan 0 karyawan
- Buat karyawan baru untuk testing
- Test CRUD operations

### File Upload
- Maksimal 2MB per file
- Format yang didukung: jpg, jpeg, png, gif
- Image URL akan tersedia di response

## 🚀 Advanced Features

### Auto Environment Management
Collection ini menggunakan environment variables yang dikelola otomatis:
- Token management
- ID management
- URL management

### Comprehensive Validation
Setiap endpoint memiliki validation tests:
- Status code validation
- Response structure validation
- Data integrity validation

### Error Handling
Proper error handling untuk:
- Authentication errors
- Validation errors
- Server errors
- File upload errors

## 📞 Support

Jika mengalami masalah:
1. Cek console logs di Postman
2. Periksa Laravel logs
3. Pastikan server dan database running
4. Cek environment variables

---

**Collection ini dibuat untuk memudahkan testing API Backend Technical Test PT Aksamedia Mulia Digital**

Happy Testing! 🎉
