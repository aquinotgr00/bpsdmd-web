# BPSDM WebApp
Aplikasi ini menggunakan framework [Laravel](https://laravel.com/docs/5.8) dan menganut standar [PSR-2](https://www.php-fig.org/psr/psr-2/). 

**Cara install aplikasi:**
1. Clone `git clone git@gitlab.com:datains/projects/bpsdm-webapps.git`
2. Copy `.env.example` menjadi `.env` dan ubah sesuai kebutuhan.
  a. Tambahkan key berikut untuk captcha
```
NOCAPTCHA_SECRET=6LdedLoUAAAAAH5GqQnBHxYfyWi6Zkrizr17jghF
NOCAPTCHA_SITEKEY=6LdedLoUAAAAAE8HF0BJcYUdTTuSBiRldxsK7d3x
```
3. Import database `psql namadb < dev-sql/latest.pgsql`
4. Run `composer install`
5. Run `php  artisan doctrine:generate:proxies`
6. Run `php  artisan db:seed`
7. Run `php artisan serve` dan buka website di URL: [http://localhost:8000](http://localhost:8000/)

**Cara develop:**
1. Gunakan branch `feature/nama` untuk membuat fitur baru
2. Rebase berkala dari branch `origin/dev`, terutama ketika akan merge request ke branch master
3.  Update perubahan database (jika ada) dengan command `pg_dump -U postgres namadb --clean > dev-sql/latest.pgsql`
4. Lakukan commit hanya jika perubahan file tidak `breaking the app`
5. Jangan lupa test dahulu sebelum melakukan push 

**Database standard:**
1. Prevent use table prefix, we don't want mix all database in one schema.
2. 3rd party database use new schema instead.
3. Always use underscore "_" for more than 1 word.
4. Foreign key use table1.id and table2.table1_id
5. Priority columns to move: columns with data
6. Always consider to implement 3NF
7. Update sql file from branch database/redesign

Merge ke branch master akan auto-deploy ke server staging. Jika ada pertanyaan, hubungi: [https://t.me/roeswb](https://t.me/roeswb)
