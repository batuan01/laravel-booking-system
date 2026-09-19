# Hướng dẫn setup sau khi lấy source code về

Project này dùng **Laravel 5.5**, yêu cầu PHP 7.1 — hầu như không máy nào cài sẵn PHP đời cũ này,
nên môi trường chạy bằng **Docker** (đã có sẵn `docker-compose.yml` + `docker/php/Dockerfile` trong repo).

---

## 1. Yêu cầu

Chỉ cần cài:

- [Docker Desktop](https://www.docker.com/products/docker-desktop/) (đã bật Docker Compose v2)
- Git

Không cần cài PHP, Composer, MySQL trên máy thật — tất cả chạy trong container.

---

## 2. Clone source code

```bash
git clone https://github.com/batuan01/laravel-booking-system.git
cd laravel-booking-system
```

---

## 3. Tạo file .env

```bash
cp .env.example .env
```

Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

`.env.example` đã cấu hình sẵn để khớp với `docker-compose.yml`:

```env
DB_HOST=mysql
DB_DATABASE=booking
DB_USERNAME=root
DB_PASSWORD=root
```

Không cần sửa gì thêm ở bước này.

---

## 4. Build và khởi động container

```bash
docker compose build app
docker compose up -d
```

Kiểm tra container đã chạy:

```bash
docker compose ps
```

Kỳ vọng thấy 2 container: `booking_app` và `booking_mysql`, status `Up`.

---

## 5. Cài dependency PHP

```bash
docker compose exec app composer install
```

Nếu Composer báo lỗi `PluginBlockedException` (do Composer 2.2 chặn plugin bên thứ 3), chạy:

```bash
docker compose exec app composer config --no-plugins allow-plugins.kylekatarnls/update-helper true
docker compose exec app composer config --no-plugins allow-plugins.symfony/thanks true
docker compose exec app composer install
```

---

## 6. Sinh application key

```bash
docker compose exec app php artisan key:generate
```

---

## 7. Chạy migration (tạo bảng trong MySQL)

```bash
docker compose exec app php artisan migrate
```

Nếu cần seed dữ liệu mẫu:

```bash
docker compose exec app php artisan db:seed
```

---

## 8. Chạy server

```bash
docker compose exec -d app php artisan serve --host=0.0.0.0 --port=8000
```

Mở trình duyệt:

```text
http://127.0.0.1:8000
```

---

## 9. Các lệnh hay dùng khác

```bash
# Vào shell trong container app
docker compose exec app bash

# Chạy artisan bất kỳ
docker compose exec app php artisan <command>

# Chạy test
docker compose exec app vendor/bin/phpunit

# Xem log container
docker compose logs -f app

# Tắt container
docker compose down

# Tắt container và xoá luôn volume database (reset sạch DB)
docker compose down -v
```

---

## 10. Sự cố thường gặp

**Lỗi "No application encryption key has been specified"**
→ Chưa chạy `php artisan key:generate`, hoặc vừa sửa `.env` mà server cũ vẫn chạy — cần `docker compose restart app` rồi chạy lại `artisan serve`.

**Truy cập `http://127.0.0.1:8000` bị connection refused**
→ Kiểm tra `artisan serve` đã bind `--host=0.0.0.0` (không phải mặc định `127.0.0.1`, vì đó là địa chỉ *trong* container, không map ra ngoài được).

**Composer báo `PluginBlockedException`**
→ Composer 2.2 mặc định chặn plugin lạ, làm theo bước 5 ở trên để allow-list.

**Không kết nối được MySQL (`SQLSTATE[HY000] [2002]`)**
→ Đảm bảo `.env` có `DB_HOST=mysql` (tên service trong `docker-compose.yml`), không phải `127.0.0.1` — vì `127.0.0.1` bên trong container `app` không trỏ tới container `mysql`.
