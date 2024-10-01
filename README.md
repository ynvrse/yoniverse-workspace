# Yoniverse Workspace

## Instalasi

Ikuti langkah-langkah berikut untuk menginstal dan menjalankan proyek ini:

### Persyaratan

Sebelum memulai, ada beberapa persyaratn yang harus dipenuhi [Cek Persyaratan](https://laravel.com/docs/11.x/deployment)

1. Clone repositori:

    ```
    git clone https://github.com/ynvrse/yoniverse-workspace.git
    ```

2. Masuk ke direktori proyek:

    ```
    cd yoniverse-workspace
    ```

3. Instal dependensi PHP:

    ```
    composer install
    ```

4. Salin file .env.example menjadi .env:

    ```
    cp .env.example .env
    ```

5. Generate kunci aplikasi:

    ```
    php artisan key:generate
    ```

6. Instal dependensi JavaScript:

    ```
    npm install
    ```

7. Jalankan migrasi database dan seeder (pastikan Anda telah mengkonfigurasi database di file .env):

    ```
    php artisan migrate --seed
    ```

8. Jalankan server development:
    ```
    php artisan serve
    ```

Sekarang Anda dapat mengakses aplikasi di `http://localhost:8000`.
