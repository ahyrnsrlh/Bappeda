**Judul Proyek**: Sistem Manajemen Rapat & Dokumen Konsultan
**Stack Teknologi**:

* Backend: **Laravel 12**
* Frontend: **Vue.js 3** (melalui Inertia.js)
* Autentikasi: Laravel Breeze/Fortify + Role-Based Auth
* Database: **MySQL**
* File Storage: Laravel Filesystem (lokal/public, atau bisa diarahkan ke S3 jika dibutuhkan)

---

### 🎯 Tujuan Utama

Membangun aplikasi berbasis web dengan 3 role pengguna utama:

* **Kepala Bidang (kabid)**
* **Konsultan Individu (KI)**
* **Tim Kerja**

Masing-masing role memiliki akses fitur sesuai diagram use case seperti:

* Login role-based
* Lihat & unggah jadwal rapat
* Kelola file tim
* Unduh file
* Arsipkan dokumen hasil rapat

---

### 🧩 Modul & Fitur Berdasarkan Role

#### 👤 1. Kepala Bidang (`role: kabid`)

* Autentikasi (login khusus untuk kepala bidang)
* Lihat jadwal rapat
* Lihat semua file dari seluruh tim
* Unduh semua file dari semua tim (`<<extend>>`)

#### 👤 2. Konsultan Individu (`role: KI`)

* Autentikasi (login khusus konsultan individu)
* Buat jadwal rapat
* Upload hasil/notulen rapat
* Arsipkan berkas hasil rapat
* Unduh semua file tim (`<<extend>>`)

#### 👥 3. Tim Kerja (role tim spesifik: `role: tim_X`)

* Autentikasi (login untuk setiap tim kerja masing-masing)
* Lihat jadwal rapat
* Kelola file tim sendiri (`upload`, `hapus`, `unduh`)
* Lihat file dari tim lain (`<<include>>`)
* Unduh file tim lain (`<<extend>>`)

---

### 🗂️ Struktur Fungsional Sistem (Berbasis Laravel + Inertia)

#### 🔐 Autentikasi & Role

* Gunakan Laravel Breeze atau Fortify untuk login.
* Tambahkan middleware `role:kabid`, `role:ki`, `role:tim_X`.
* Gunakan **Gate** atau **Policy** Laravel untuk kontrol akses granular.

#### 📁 Manajemen File

* Buat model: `File`, relasi ke `User` dan `Team`.
* CRUD file: Upload, Edit, Hapus, Unduh.
* Simpan file di `storage/app/public/files/`, gunakan symlink untuk akses publik.

#### 📅 Manajemen Jadwal Rapat

* Buat model: `MeetingSchedule`
* Fitur:

  * Buat Jadwal (oleh Konsultan Individu)
  * Lihat Jadwal (oleh semua role)
  * Export atau print (opsional)

#### 🗃️ Arsip Notulen & Dokumen Rapat

* Buat model: `MeetingNote`
* Relasikan dengan `MeetingSchedule`
* Fitur unggah notulen (oleh Konsultan Individu)
* Fitur arsip otomatis/manual (penanda status)

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

### 📄 Prompt Akhir untuk AI/Dev Team:

> Buatkan sebuah aplikasi berbasis Laravel + Inertia + Vue untuk sistem manajemen rapat dan dokumen dengan autentikasi role-based. Terdapat 3 role utama: Kepala Bidang, Konsultan Individu, dan Tim Kerja.
>
> Setiap role memiliki akses berbeda terhadap fitur berikut:
>
> * Login akun role-based
> * Kelola jadwal rapat (buat, lihat)
> * Upload hasil rapat
> * Arsipkan dokumen
> * Lihat file tim lain (khusus Kepala Bidang dan Tim Kerja)
> * Kelola file sendiri (Tim Kerja)
> * Unduh semua file tim
>
> Implementasikan middleware dan gate/policy Laravel untuk membatasi akses. Gunakan Inertia.js + Vue 3 untuk frontend SPA. Buat halaman dashboard yang berbeda untuk setiap role. Simpan file ke storage publik dan tampilkan preview jika memungkinkan (PDF/docx/image). Sertakan sistem manajemen tim agar file/jadwal bisa dikelompokkan berdasarkan tim kerja.

---

