# Tugas 2 IF3110 Pengembangan Aplikasi Berbasis Web 

Melakukan *upgrade* Website toko buku online pada Tugas 1 dengan mengaplikasikan **arsitektur web service REST dan SOAP**.

## Penjelasan
- Basis data dari sistem yang Anda buat, yaitu basis data aplkasi pro-book, webservice bank, dan webservice buku.
Probook = Menggunakan database MySQL dengan 3 tabel (books, orders, dan users)
di tabel books kami menyimpan book_id, title, author, image, dan synopsis
di tabel orders kami menyimpan order_id, user_id, book_id, rating, comment, jumlah, time
di tabel users kami menyimpan user_id, username, name, email, password, address, phone, image, token

Webservice Bank = Menggunakan database MySQL dengan 2 tabel (customers, transactions)
di tabel customers kami menyimpan id, username, card_number, dan balance
di tabel transactions kami menyimpan id, sender_cardnumber, receiver_cardnumber, amount, timestamp

Webservice Buku = Menggunakan database MySQL dengan authors, books, categories, orders

- Konsep *shared session* dengan menggunakan REST.
Protokol REST menggunakan konsep stateless sehingga server tidak menyimpan informasi mengenai client session.

- Mekanisme pembangkitan token dan expiry time pada aplikasi Anda.
Saat pengguna sukses melakukan login dan register, kami membangkitkan token dengan ketentuan 8 string awal adalah string random kemudian hasil hashing dari username dan userId kemudian expiry time pengguna.

- Kelebihan dan kelemahan dari arsitektur aplikasi tugas ini, dibandingkan dengan aplikasi monolitik (login, CRUD DB, dll jadi dalam satu aplikasi)
Kelebihan: Memudahkan pembagian tugas dan sumber daya
Kelemahan: Sistem yang berjalan lebih banyak

### Skenario

1. User melakukan registrasi dengan memasukkan informasi nomor kartu.
2. Jika nomor kartu tidak valid, registrasi ditolak dan user akan diminta memasukkan kembali nomor kartu yang valid.
3. User yang sudah teregistrasi dapat mengganti informasi nomor kartu.
4. Ketika user mengganti nomor kartu, nomor kartu yang baru akan diperiksa validasinya melalui webservice bank.
5. Setelah login, user dapat melakukan pencarian buku.
6. Pencarian buku akan mengirim request ke webservice buku. Halaman ini menggunakan AngularJS.
7. Pada halaman detail buku, ada rekomendasi buku yang didapat dari webservice buku. Rekomendasi buku berdasarkan kategori buku yang sedang dilihat.
8. Ketika user melakukan pemesanan buku, aplikasi akan melakukan request transfer kepada webservice bank.
9. Jika transfer berhasil, aplikasi mengirimkan request kepada webservice buku untuk mencatat penjualan buku.
10. Notifikasi muncul menandakan status pembelian, berhasil atau gagal.

REST :
1. Validasi nomor kartu : 13516141
1. Penambahan nasabah baru : 13516141
1. Mendapatkan nomor kartu pengguna tertentu : 13516141
1. Mengubah nomor kartu di edit profile pengguna : 13516141
1. Menambahkan transaksi baru

SOAP :
1. searchBook : 13516090
2. recommendBook : 13516153
3. detailBook : 13516090
4. interface : 13516153
5. Book : 13516153
6. updateDatabase : 13516090
7. buyBook : 13516090

Perubahan Web app :
1. Menampilkan nomor kartu di profile pengguna : 13516141
1. Penambahan field nomor kartu di register : 13516141
1. Halaman Search : 13516153
2. Halaman Recommend : 13516090
3. Halaman Detail Buku : 13516090