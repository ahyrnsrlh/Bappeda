**Judul Proyek**: Sistem Manajemen Rapat & Dokumen Konsultan
**Stack Teknologi**:

-   Backend: **Laravel 12**
-   Frontend: **Vue.js 3** (melalui Inertia.js)
-   Autentikasi: Laravel Breeze/Fortify + Role-Based Auth
-   Database: **MySQL**
-   File Storage: Laravel Filesystem (lokal/public, atau bisa diarahkan ke S3 jika dibutuhkan)

---

### 🎯 Tujuan Utama

Membangun aplikasi berbasis web dengan 3 role pengguna utama:

-   **Kepala Bidang (kabid)**
-   **Konsultan Individu (KI)**
-   **Tim Kerja**

Masing-masing role memiliki akses fitur sesuai diagram use case seperti:

-   Login role-based
-   Lihat jadwal rapat
-   Kelola file tim (sesuai role)
-   Unduh file
-   Arsipkan dokumen hasil rapat

---

### 🧩 Modul & Fitur Berdasarkan Role

#### 👤 1. Kepala Bidang (`role: kabid`)

-   Autentikasi (login khusus untuk kepala bidang)
-   Lihat jadwal rapat
-   Lihat semua file dari seluruh tim (READ-ONLY)
-   Unduh semua file dari semua tim (`<<extend>>`)
-   ❌ **Tidak dapat upload, edit, atau hapus file**

#### 👤 2. Konsultan Individu (`role: KI`)

-   Autentikasi (login khusus konsultan individu)
-   Buat jadwal rapat
-   Upload hasil/notulen rapat
-   Arsipkan berkas hasil rapat
-   Unduh semua file tim (`<<extend>>`)

#### 👥 3. Tim Kerja (role tim spesifik: `role: tim_X`)

-   Autentikasi (login untuk setiap tim kerja masing-masing)
-   Lihat jadwal rapat
-   Kelola file tim sendiri (`upload`, `hapus`, `unduh`)
-   Lihat file dari tim lain (`<<include>>`)
-   Unduh file tim lain (`<<extend>>`)

---

### 🗂️ Struktur Fungsional Sistem (Berbasis Laravel + Inertia)

#### 🔐 Autentikasi & Role

-   Gunakan Laravel Breeze atau Fortify untuk login.
-   Tambahkan middleware `role:kabid`, `role:ki`, `role:tim_X`.
-   Gunakan **Gate** atau **Policy** Laravel untuk kontrol akses granular.

#### 📁 Manajemen File

-   Buat model: `File`, relasi ke `User` dan `Team`.
-   CRUD file: Upload, Edit, Hapus, Unduh.
-   Simpan file di `storage/app/public/files/`, gunakan symlink untuk akses publik.

#### 📅 Manajemen Jadwal Rapat

-   Buat model: `MeetingSchedule`
-   Fitur:

    -   Buat Jadwal (oleh Konsultan Individu)
    -   Lihat Jadwal (oleh semua role)
    -   Export atau print (opsional)

#### 🗃️ Arsip Notulen & Dokumen Rapat

-   Buat model: `MeetingNote`
-   Relasikan dengan `MeetingSchedule`
-   Fitur unggah notulen (oleh Konsultan Individu)
-   Fitur arsip otomatis/manual (penanda status)

---

### 📦 Struktur Folder Laravel (Saran)

```bash
app/
├── Models/
│   ├── User.php
│   ├── File.php
│   ├── Team.php
│   ├── MeetingSchedule.php
│   └── MeetingNote.php
routes/
├── web.php (route untuk semua fitur frontend)
resources/
├── js/
│   ├── Pages/
│   │   ├── Dashboard.vue
│   │   ├── Meetings/
│   │   ├── Files/
│   │   └── Auth/
├── views/
│   └── app.blade.php (Inertia layout)
```

---
