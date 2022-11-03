> Projek ini di buat dengan buru-buru. Karena itu tak ada waktu untuk kami buat mengetesnya kemarin. Sekarang saat saya mengetesnya saya sudah menemukan rumayan banyak bug dan berhasil memperbaikinya. Akan tetapi sepertinya masih jauh dari kata selesai. Maka dari itu saya akan menghentikan projek ini.

## Alumnifo

Alumnifo adalah Sistem Informasi Alumni yang dibuat dengan menggunakan Laravel dan Livewire

### Kebutuhan

- PHP ^8.0
- npm
- Pusher
- Composer

### Pemasangan

> Development version

- Clone Repository ini
- Ketik `composer install`
- Setelah selesai ketik `php artisan build:alumnifo`

> Production Version

- Clone Repository ini
- Ketik `composer install`
- Ketik `npm i && npm run prod`
- Setelah selesai ketik `php artisan build:alumnifo --no-dummy`

### Konfigurasi 

Anda diharuskan untuk melakukan konfigurasi pada env ini:
```.env
APP_DEBOUNCE_DELAY=0

SCOUT_DRIVER=database

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1
```

### Pemakaian

Untuk login dengan Admin:

```
email: root@mail.com
password: root12345
```

Untuk login dengan User Biasa:
```
email: asep@mail.com
password: asep12345 
```

### Pengujian Secara Langung

> OTW. Ada yang mau host? [Hubungi Saya](https://twitter.com/AlbetNv)

### Pertanyaan

Sihlakan ajukan pertanyaan di jendela [Issue](https://github.com/albetnov/alumnifo/issues/new).