# CodeIgniter_Learn_1

Saya membagikan ini untuk sama-sama belajar sambil share. <br>
kuncinya ada di file <b>Routes.php</b>

Sesuaikan di file <b>.env</b> nya : <br> <br>
database.default.hostname = localhost <br>
database.default.database = belajar_ci <br>
database.default.username = root <br>
database.default.password =  <br>
database.default.DBDriver = MySQLi <br>
database.default.DBPrefix = ci_ <br>

## Terminal Command

`php spark serve --host 0.0.0.0 --port 8080` untuk menjalankan CI agar dapat diakses oleh semua ip ke alamat localhost CI

## Realease note

### 18/07/2022
- Untuk membuat API sederhana, silahkan dicontoh file diatas
- `username` dan `password` merupakan kunci otoritas ke database. Jika sesuai, maka akan memunculkan datanya
- untuk mysql database silahkan di execute <b>belajar_ci.sql</b>

### 29/07/2022
- Penambahan <b>NewsModel.php</b> di folder `Models`. sebagai Api memunculkan Data Berita
- Jika Aksess Api melalui Flutter bermasalah, silahkan tambahkan <b>Cors.php</b> di folder `Filters`, selanjutnya di folder `Config`, ubah <b>Filters.php</b>, replace saja dengan file yang saya berikan
- Dikarenakan ada penambahan <b>NewsModel.php</b>, struktur database mengalami perubahan, silahkan execute kembali file <b>belajar_ci.sql</b> ke local mysql database anda

#Semoga_bermanfaat
