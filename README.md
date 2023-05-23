# Sistem Informasi Magang
## Deskripsi
Sistem Informasi Magang adalah sebuah sistem yang digunakan untuk mengelola data magang. Sistem ini dibuat sebagai project skripsi. Sistem ini dibuat dengan menggunakan bahasa pemrograman PHP dan database MySQL, dengan bantuan framework codeigniter.

## Cara Install
untuk menginstall aplikasi ini, pastikan sudah terinstall composer dan php versi 8.0. setelah itu jalankan perintah `composer install` untuk menginstall semua dependency yang dibutuhkan
> pastikan php yang terintegrasi dengan command line adalah php versi 8.0 anda bisa mengeceknya dengan melihat versi php dari command line dengan perintah php -v

## Initial Setup
### Cara 1
- buat database `magangku`
- import file SQL yang tertera kedalam database yang sudah dibuat
- sesuaikan username dan password database di file `.env`
- jalankan perintah `php spark serve` untuk menjalankan aplikasi

### Cara 2
- buat database `magangku`
- sesuaikan username dan password database di file `.env`
- jalankan perintah `php spark migrate` atau `php spark migrate:rollback && php spark migrate` untuk membuat tabel
- jalankan perintah `php spark db:seed InitialSeed` untuk menyiapkan data awal
- jalankan perintah `php spark serve` untuk menjalankan aplikasi