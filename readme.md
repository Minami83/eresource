## Dependencies
- [XAMPP](https://www.apachefriends.org/index.html)
- PHP (version 7.1.3 or above)
- [Composer](https://getcomposer.org/)
- Laravel (version 5.6 or above)
- [git](https://git-scm.com/downloads)

## How to run
- Install semua dependency dan pastikan versi nya sesuai
- Jalankan XAMPP, kemudian start apache dan MySQL
- Buka halaman localhost/phpmyadmin dari browser
- Buat database baru
- Melalui command prompt pindah menuju `path\to\xampp\htdocs`
- Clone repo github dengan menjalankan perintah `git clone https://github.com/Minami83/eresource.git` dari terminal
- Pindah ke folder yang telah di clone melalui command prompt
- Salin isi dari `.env.example` ke file baru dan simpan dengan nama `.env`
- Ganti opsi `DB_NAME`, `DB_USERNAME`, `DB_PASSWORD` sesuai dengan konfigurasi database yang telah dibuat
- Jalankan `composer install` melalui command prompt
- Jalankan perintah `php artisan key:generate`
- Jalankan perintah `php artisan migrate:fresh --seed`
- Jalankan project dengan `php artisan serve`
- Melalui browser buka alamat `localhost:8000`. Maka akan tampil halaman login
