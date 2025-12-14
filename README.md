# Nasi Padang Online Ordering

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