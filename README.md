# BPSDM WebApp
Aplikasi ini menggunakan framework [Laravel](https://laravel.com/docs/5.8) dan menganut standar [PSR-2](https://www.php-fig.org/psr/psr-2/). 

**Cara install aplikasi:**
1. Clone `git clone git@gitlab.com:datains/projects/bpsdm-webapps.git`
2. Copy `.env.example` menjadi `.env` dan ubah sesuai kebutuhan.
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

Merge ke branch master akan auto-deploy ke server staging. Jika ada pertanyaan, hubungi: [https://t.me/roeswb](https://t.me/roeswb)
