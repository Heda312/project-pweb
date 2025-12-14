# Nasi Padang Online Ordering

## Cara Menjalankan

1. Pastikan XAMPP aktif, Apache berjalan.
2. Jalankan sekali: buka http://localhost/nasipadang/backend/init_db.php untuk inisialisasi database.
3. Jalankan sekali: buka http://localhost/nasipadang/backend/seed_menu.php untuk mengisi data menu.
4. Akses http://localhost/nasipadang/ untuk mulai dari landing page.

## Fitur
- Landing page dengan logo, tombol Register & Login
- Register & Login user (data tersimpan di SQLite)
- Halaman utama restoran: sidebar, header, top picks, menu grid
- Keranjang (cart) popup: tambah, hapus, edit jumlah, notes, total harga
- Checkout: pilih metode pembayaran, tampilkan kode bayar
- Data menu dan cart tersimpan di backend (untuk user login)
- Guest mode: cart tetap bisa dipakai (localStorage)

## Testing
1. Register user baru, lalu login.
2. Tambahkan beberapa menu ke keranjang.
3. Edit jumlah dan notes di keranjang, hapus item jika perlu.
4. Klik Bayar, pilih metode pembayaran, pastikan kode bayar muncul.
5. Logout, login dengan user lain, pastikan keranjang berbeda.
6. Coba akses sebagai guest (tanpa login), keranjang tetap bisa dipakai (namun tidak tersimpan di backend).

## Catatan
- Untuk menambah menu baru, edit backend/seed_menu.php lalu jalankan ulang.
- Gambar menu bisa ditambah di folder assets/ (nama file sesuai field img di tabel menu).
- Untuk reset database, hapus file data/nasipadang.sqlite lalu ulangi langkah inisialisasi.
