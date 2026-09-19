# Laravel 5.5 Booking System

Hệ thống đặt lịch dùng để luyện tập **Laravel 5.5**, PHP, MySQL, Eloquent, Blade, AJAX, Authentication, Authorization, Queue, Notification, Scheduler và Testing.

Project được xây dựng theo hướng một hệ thống booking thực tế, trong đó khách hàng có thể chọn dịch vụ, nhân viên, ngày và khung giờ để đặt lịch.

---

# 1. Mục tiêu

Sau khi hoàn thành project, developer cần hiểu và thực hành được:

- Laravel 5.5
- Routing
- Controller
- Model
- Migration
- Seeder
- Factory
- Eloquent ORM
- Eloquent Relationship
- Form Request
- Validation
- Authentication
- Middleware
- Authorization / Policy
- Session
- Blade
- AJAX
- JSON API
- Database Transaction
- Notification
- Mail
- Queue
- Scheduler
- Event / Listener
- Pagination
- Query Scope
- Eager Loading
- Cache
- Feature Test
- Unit Test

Phần quan trọng nhất của project:

> **Tính toán thời gian trống và ngăn chặn việc đặt trùng lịch.**

---

# 2. Công nghệ

## Backend

```text
PHP
Laravel 5.5
MySQL
Composer
```

## Frontend

```text
Blade
HTML
CSS
Bootstrap
JavaScript
jQuery
AJAX
```

## Development

```text
Git
GitHub
Postman
PHPUnit
```

Có thể sử dụng Docker ở phase cuối.

---

# 3. Yêu cầu môi trường

Laravel 5.5 được phát hành từ năm 2017 nên **không nên mặc định dùng PHP hiện tại**.

Trước khi tạo project, kiểm tra:

```bash
php -v
composer -V
mysql --version
```

Kiểm tra Composer:

```bash
composer diagnose
```

Nếu môi trường PHP hiện tại không tương thích với Laravel 5.5, sử dụng Docker hoặc một PHP runtime cũ tương thích thay vì cố nâng Laravel lên version mới.

---

# 4. Tạo project

Tạo project Laravel 5.5:

```bash
composer create-project laravel/laravel booking-app "5.5.*"
```

Đi vào project:

```bash
cd booking-app
```

Kiểm tra version:

```bash
php artisan --version
```

Kết quả mong muốn:

```text
Laravel Framework 5.5.x
```

---

# 5. Chạy project lần đầu

Khởi động Laravel:

```bash
php artisan serve
```

Mặc định:

```text
http://127.0.0.1:8000
```

Nếu muốn chỉ định port:

```bash
php artisan serve --port=8080
```

---

# 6. Git

Khởi tạo Git:

```bash
git init
```

Kiểm tra:

```bash
git status
```

Thêm file:

```bash
git add .
```

Commit đầu tiên:

```bash
git commit -m "chore: initialize Laravel 5.5 booking app"
```

Đổi branch:

```bash
git branch -M main
```

Kết nối GitHub:

```bash
git remote add origin <GITHUB_REPOSITORY_URL>
```

Push:

```bash
git push -u origin main
```

---

# 7. Cấu hình Environment

Nếu `.env` chưa tồn tại:

```bash
cp .env.example .env
```

Windows CMD:

```cmd
copy .env.example .env
```

Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

Tạo application key:

```bash
php artisan key:generate
```

Kiểm tra `.env`:

```env
APP_NAME=BookingApp
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000
```

---

# 8. Tạo database

Tạo database MySQL:

```sql
CREATE DATABASE booking
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;
```

Cấu hình `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=booking
DB_USERNAME=root
DB_PASSWORD=
```

Kiểm tra kết nối database bằng migration:

```bash
php artisan migrate
```

Nếu migration chạy thành công thì database đã kết nối đúng.

---

# 9. Cấu trúc chức năng

Hệ thống gồm 2 nhóm người dùng:

```text
CUSTOMER
ADMIN
```

## Customer

Customer có thể:

```text
Đăng ký
Đăng nhập
Xem dịch vụ
Xem chi tiết dịch vụ
Chọn nhân viên
Chọn ngày
Xem giờ còn trống
Đặt lịch
Xem lịch đã đặt
Hủy lịch
```

## Admin

Admin có thể:

```text
Đăng nhập
Xem dashboard
Quản lý dịch vụ
Quản lý nhân viên
Quản lý giờ làm việc
Xem tất cả booking
Xác nhận booking
Hủy booking
Hoàn thành booking
```

---

# 10. Database Design

Database chính:

```text
users
services
staff
working_hours
bookings
```

Quan hệ:

```text
users
  |
  +---- bookings
           |
           +---- services
           |
           +---- staff
                    |
                    +---- working_hours
```

---

# 11. Bảng users

Laravel đã tạo sẵn migration users.

Các field:

```text
id
name
email
password
role
remember_token
created_at
updated_at
```

Thêm field `role` vào migration users:

```php
$table->string('role')->default('customer');
```

Giá trị:

```text
customer
admin
```

---

# 12. Bảng services

Tạo model và migration:

```bash
php artisan make:model Service -m
```

Migration:

```text
id
name
description
duration
price
is_active
created_at
updated_at
```

Ý nghĩa:

```text
name        Tên dịch vụ
description Mô tả
duration    Thời lượng tính bằng phút
price       Giá
is_active   Dịch vụ đang hoạt động hay không
```

Ví dụ:

```text
Haircut
30 phút
200000
```

---

# 13. Bảng staff

Tạo:

```bash
php artisan make:model Staff -m
```

Fields:

```text
id
name
email
phone
is_active
created_at
updated_at
```

---

# 14. Bảng working_hours

Tạo:

```bash
php artisan make:model WorkingHour -m
```

Fields:

```text
id
staff_id
day_of_week
start_time
end_time
created_at
updated_at
```

Ví dụ:

```text
Staff: Nguyễn Văn A

Monday:
09:00 - 18:00

Tuesday:
09:00 - 18:00

Wednesday:
09:00 - 18:00
```

Quy ước:

```text
0 = Sunday
1 = Monday
2 = Tuesday
3 = Wednesday
4 = Thursday
5 = Friday
6 = Saturday
```

---

# 15. Bảng bookings

Tạo:

```bash
php artisan make:model Booking -m
```

Fields:

```text
id
user_id
staff_id
service_id
booking_date
start_time
end_time
status
note
created_at
updated_at
```

Status:

```text
pending
confirmed
cancelled
completed
```

---

# 16. Foreign Key

Thiết lập:

```text
bookings.user_id
    -> users.id

bookings.staff_id
    -> staff.id

bookings.service_id
    -> services.id

working_hours.staff_id
    -> staff.id
```

Sau khi hoàn thành migration:

```bash
php artisan migrate
```

Kiểm tra:

```bash
php artisan migrate:status
```

---

# 17. Rollback Migration

Rollback migration gần nhất:

```bash
php artisan migrate:rollback
```

Reset toàn bộ migration:

```bash
php artisan migrate:reset
```

Xóa toàn bộ bảng và chạy lại:

```bash
php artisan migrate:refresh
```

Trong môi trường development có thể dùng:

```bash
php artisan migrate:fresh
```

Nếu cần seed lại:

```bash
php artisan migrate:fresh --seed
```

---

# 18. Eloquent Relationships

## User

```php
public function bookings()
{
    return $this->hasMany(Booking::class);
}
```

## Service

```php
public function bookings()
{
    return $this->hasMany(Booking::class);
}
```

## Staff

```php
public function bookings()
{
    return $this->hasMany(Booking::class);
}

public function workingHours()
{
    return $this->hasMany(WorkingHour::class);
}
```

## WorkingHour

```php
public function staff()
{
    return $this->belongsTo(Staff::class);
}
```

## Booking

```php
public function user()
{
    return $this->belongsTo(User::class);
}

public function service()
{
    return $this->belongsTo(Service::class);
}

public function staff()
{
    return $this->belongsTo(Staff::class);
}
```

---

# 19. Seeder

Tạo các seeder:

```bash
php artisan make:seeder ServiceSeeder
php artisan make:seeder StaffSeeder
php artisan make:seeder WorkingHourSeeder
```

Nếu cần User admin:

```bash
php artisan make:seeder UserSeeder
```

Thêm seeders vào:

```text
database/seeds/DatabaseSeeder.php
```

Chạy:

```bash
php artisan db:seed
```

Hoặc:

```bash
php artisan db:seed --class=ServiceSeeder
```

Reset và seed toàn bộ:

```bash
php artisan migrate:fresh --seed
```

---

# 20. Dữ liệu mẫu

## Services

Tạo tối thiểu:

```text
Haircut
Hair Wash
Hair Coloring
Facial
Massage
```

Ví dụ:

```text
Haircut
duration = 30
price = 200000

Hair Coloring
duration = 120
price = 800000
```

## Staff

Tạo:

```text
Nguyễn Văn A
Nguyễn Văn B
Trần Văn C
```

## Working Hours

Ví dụ:

```text
Monday    09:00 - 18:00
Tuesday   09:00 - 18:00
Wednesday 09:00 - 18:00
Thursday  09:00 - 18:00
Friday    09:00 - 18:00
Saturday  09:00 - 15:00
Sunday    Closed
```

---

# 21. Authentication

Laravel 5.5 có thể scaffold authentication bằng:

```bash
php artisan make:auth
```

Sau đó chạy:

```bash
php artisan migrate
```

Kiểm tra:

```text
/register
/login
```

Kiểm tra route:

```bash
php artisan route:list
```

---

# 22. Middleware

Tạo middleware:

```bash
php artisan make:middleware AdminMiddleware
```

Mục tiêu:

```text
Không đăng nhập
    ↓
/login

Customer
    ↓
403

Admin
    ↓
/admin
```

Đăng ký middleware trong:

```text
app/Http/Kernel.php
```

Sau đó sử dụng middleware cho route admin.

---

# 23. Controller

Tạo controller:

```bash
php artisan make:controller ServiceController
php artisan make:controller BookingController
php artisan make:controller StaffController
php artisan make:controller WorkingHourController
```

Admin:

```bash
php artisan make:controller Admin/DashboardController
php artisan make:controller Admin/ServiceController
php artisan make:controller Admin/StaffController
php artisan make:controller Admin/WorkingHourController
php artisan make:controller Admin/BookingController
```

---

# 24. Service CRUD

Customer:

```text
GET /services
GET /services/{service}
```

Admin:

```text
GET    /admin/services
GET    /admin/services/create
POST   /admin/services
GET    /admin/services/{service}/edit
PUT    /admin/services/{service}
DELETE /admin/services/{service}
```

Có thể dùng:

```php
Route::resource('services', 'Admin\ServiceController');
```

---

# 25. Service Validation

Service phải validate:

```text
name
description
duration
price
is_active
```

Quy tắc:

```text
name        required|string|max:255
description nullable|string
duration    required|integer|min:5
price       required|numeric|min:0
is_active   boolean
```

Không cho phép:

```text
duration = 0
duration < 5
price < 0
```

---

# 26. Form Request

Tạo Form Request:

```bash
php artisan make:request StoreServiceRequest
```

Và:

```bash
php artisan make:request UpdateServiceRequest
```

Chuyển validation của Service vào Form Request.

Mục tiêu:

```text
Controller
    ↓
StoreServiceRequest
    ↓
Validated data
    ↓
Service
```

---

# 27. Staff CRUD

Admin có thể:

```text
Create staff
Read staff
Update staff
Delete staff
Activate / deactivate staff
```

Routes:

```text
/admin/staff
/admin/staff/create
/admin/staff/{staff}/edit
```

Validation:

```text
name  required|string|max:255
email required|email
phone nullable|string|max:30
```

---

# 28. Working Hours

Admin chọn:

```text
Staff
Day of week
Start time
End time
```

Ví dụ:

```text
Nguyễn Văn A

Monday
09:00 - 18:00
```

Validation:

```text
staff_id    exists
day_of_week integer 0-6
start_time  required
end_time    required
```

Phải đảm bảo:

```text
start_time < end_time
```

---

# 29. Booking Flow

Customer booking theo flow:

```text
Services
    ↓
Service Detail
    ↓
Book Now
    ↓
Select Staff
    ↓
Select Date
    ↓
Get Available Slots
    ↓
Select Time
    ↓
Confirm
    ↓
Create Booking
```

---

# 30. Booking Form

Thông tin cần chọn:

```text
Service
Staff
Date
Time
Note
```

Customer không được tự nhập:

```text
user_id
end_time
status
price
```

Các giá trị này phải được backend xác định.

---

# 31. Availability API

Tạo endpoint:

```text
GET /api/availability
```

Parameters:

```text
staff_id
service_id
date
```

Ví dụ:

```text
/api/availability?staff_id=1&service_id=2&date=2026-09-20
```

Response:

```json
{
    "date": "2026-09-20",
    "slots": [
        {
            "start": "09:00",
            "end": "09:30",
            "available": true
        },
        {
            "start": "09:30",
            "end": "10:00",
            "available": true
        }
    ]
}
```

---

# 32. Availability Algorithm

Backend thực hiện theo thứ tự:

```text
1. Kiểm tra Service
       ↓
2. Kiểm tra Staff
       ↓
3. Kiểm tra ngày
       ↓
4. Lấy Working Hour
       ↓
5. Lấy Service Duration
       ↓
6. Lấy Booking hiện tại
       ↓
7. Sinh các time slot
       ↓
8. Kiểm tra overlap
       ↓
9. Trả về available slots
```

---

# 33. Ví dụ Availability

Staff:

```text
09:00 - 18:00
```

Service:

```text
duration = 30 phút
```

Booking hiện tại:

```text
10:00 - 10:30
13:00 - 13:30
```

Các slot:

```text
09:00   available
09:30   available
10:00   unavailable
10:30   available
11:00   available
11:30   available
12:00   available
12:30   available
13:00   unavailable
13:30   available
14:00   available
...
```

---

# 34. Booking Overlap

Điều kiện overlap:

```text
new_start < existing_end
AND
new_end > existing_start
```

Ví dụ booking hiện tại:

```text
10:00 - 11:00
```

Booking mới:

```text
10:30 - 11:30
```

Kết quả:

```text
OVERLAP
```

Booking mới:

```text
11:00 - 12:00
```

Kết quả:

```text
AVAILABLE
```

---

# 35. Double Booking

Không được chỉ kiểm tra availability ở frontend.

Flow đúng:

```text
Frontend
    ↓
Hiển thị 10:00 available
    ↓
User click 10:00
    ↓
POST /bookings
    ↓
Backend kiểm tra availability lần nữa
    ↓
Create booking
```

Nếu thời gian đã bị người khác đặt:

```text
HTTP 422
```

Response:

```json
{
    "message": "Khung giờ này không còn trống."
}
```

---

# 36. Database Transaction

Khi tạo booking:

```text
BEGIN
    ↓
Check availability
    ↓
Create booking
    ↓
COMMIT
```

Nếu lỗi:

```text
ROLLBACK
```

Sử dụng:

```php
DB::transaction(function () {
    // booking logic
});
```

Mục tiêu là tránh trạng thái database không nhất quán.

---

# 37. Booking Status

Trạng thái ban đầu:

```text
pending
```

Admin:

```text
pending
    ↓
confirmed
```

Hoặc:

```text
pending
    ↓
cancelled
```

Sau khi sử dụng dịch vụ:

```text
confirmed
    ↓
completed
```

Không cho customer tự thay đổi thành:

```text
confirmed
completed
```

---

# 38. Booking CRUD

Customer:

```text
GET  /bookings
GET  /bookings/{booking}
POST /bookings/{booking}/cancel
```

Admin:

```text
GET   /admin/bookings
GET   /admin/bookings/{booking}
PATCH /admin/bookings/{booking}/confirm
PATCH /admin/bookings/{booking}/cancel
PATCH /admin/bookings/{booking}/complete
```

---

# 39. Authorization / Policy

Tạo policy:

```bash
php artisan make:policy BookingPolicy
```

Customer chỉ được:

```text
Xem booking của chính mình
Hủy booking của chính mình
```

Customer không được:

```text
Xem booking người khác
Hủy booking người khác
Confirm booking
Complete booking
```

Admin được phép quản lý tất cả booking.

---

# 40. Eager Loading

Không nên:

```php
$bookings = Booking::all();
```

sau đó gọi relationship trong vòng lặp.

Sử dụng:

```php
$bookings = Booking::with([
    'user',
    'service',
    'staff'
])->get();
```

Mục tiêu:

> Hiểu và tránh vấn đề N+1 query.

---

# 41. Query Scope

Tạo scope cho Booking:

```text
pending()
confirmed()
cancelled()
completed()
forDate()
```

Ví dụ:

```php
Booking::confirmed()->get();
```

```php
Booking::forDate($date)->get();
```

Kết hợp:

```php
Booking::confirmed()
    ->forDate($date)
    ->get();
```

---

# 42. Pagination

Admin booking:

```php
Booking::with([
    'user',
    'service',
    'staff'
])->paginate(20);
```

Hiển thị pagination trong Blade.

Kiểm tra:

```text
?page=2
```

---

# 43. Search

Admin có thể tìm:

```text
Customer name
Customer email
```

Ví dụ:

```text
/admin/bookings?search=john
```

Query:

```text
WHERE customer name LIKE ...
OR
customer email LIKE ...
```

---

# 44. Filter

Booking có thể filter theo:

```text
status
staff
service
date
```

Ví dụ:

```text
/admin/bookings?status=confirmed
```

Kết hợp:

```text
/admin/bookings
    ?status=confirmed
    &staff_id=1
    &date=2026-09-20
```

---

# 45. AJAX

Khi customer chọn:

```text
Staff
Date
```

Frontend gọi:

```text
GET /api/availability
```

Không reload toàn bộ page.

Flow:

```text
Select Staff
    ↓
Select Date
    ↓
AJAX
    ↓
Backend
    ↓
Available slots
    ↓
Render buttons
```

---

# 46. Notification

Tạo notification:

```bash
php artisan make:notification BookingCreated
```

Các notification:

```text
BookingCreated
BookingConfirmed
BookingCancelled
BookingReminder
```

Customer nhận thông báo khi:

```text
Booking được tạo
Booking được confirm
Booking bị cancel
Sắp đến giờ booking
```

---

# 47. Mail

Cấu hình mail trong `.env`.

Development có thể sử dụng mail testing service hoặc SMTP local.

Khi booking được tạo:

```text
Create Booking
    ↓
Send confirmation email
```

Email gồm:

```text
Customer
Service
Staff
Date
Start time
End time
Status
```

---

# 48. Queue

Sau khi mail hoạt động, chuyển email sang queue.

Cấu hình queue trong `.env`.

Chạy worker:

```bash
php artisan queue:work
```

Trong development có thể chạy:

```bash
php artisan queue:listen
```

Flow:

```text
Create Booking
    ↓
Dispatch Notification
    ↓
Queue
    ↓
Worker
    ↓
Send Email
```

---

# 49. Event / Listener

Tạo Event:

```bash
php artisan make:event BookingCreated
```

Tạo Listener:

```bash
php artisan make:listener SendBookingConfirmation
```

Flow:

```text
Booking created
    ↓
BookingCreated event
    ↓
Listener
    ↓
Notification / Mail
```

---

# 50. Scheduler

Mục tiêu:

Mỗi ngày kiểm tra booking sắp diễn ra.

Ví dụ:

```text
08:00
    ↓
Find today's bookings
    ↓
Send reminder
```

Định nghĩa schedule trong:

```text
app/Console/Kernel.php
```

Chạy thủ công để test:

```bash
php artisan schedule:run
```

Production sẽ cần cron:

```text
* * * * * php /path/to/project/artisan schedule:run >> /dev/null 2>&1
```

---

# 51. Admin Dashboard

Dashboard:

```text
/admin/dashboard
```

Hiển thị:

```text
Today's bookings
Pending bookings
Confirmed bookings
Completed bookings
Cancelled bookings
```

Ví dụ:

```text
Today's Bookings    20
Pending              3
Confirmed           12
Completed             4
Cancelled             1
```

---

# 52. API

Tạo các API:

```text
GET    /api/services
GET    /api/staff
GET    /api/availability
POST   /api/bookings
GET    /api/bookings
GET    /api/bookings/{booking}
```

Test bằng Postman.

---

# 53. API Validation

API phải trả HTTP status phù hợp:

```text
200 OK
201 Created
400 Bad Request
401 Unauthorized
403 Forbidden
404 Not Found
422 Validation Error
500 Server Error
```

Không trả HTML cho API error.

---

# 54. Security

Kiểm tra:

```text
CSRF
Authentication
Authorization
Validation
Mass Assignment
SQL Injection
XSS
Session
```

Đặc biệt không dùng:

```php
Model::create($request->all());
```

mà không kiểm soát `$fillable`.

---

# 55. Database Index

Xem xét index cho:

```text
bookings.user_id
bookings.staff_id
bookings.service_id
bookings.booking_date
bookings.status
```

Đặc biệt các query thường xuyên:

```text
staff_id + booking_date
```

---

# 56. Testing

Tạo test cho các case chính.

## Authentication

```text
[ ] User có thể register
[ ] User có thể login
[ ] User có thể logout
[ ] User chưa login không thể booking
```

## Service

```text
[ ] Customer xem service
[ ] Admin tạo service
[ ] Admin sửa service
[ ] Admin xóa service
[ ] Invalid service data bị reject
```

## Booking

```text
[ ] Customer tạo booking
[ ] Customer xem booking của mình
[ ] Customer không xem được booking người khác
[ ] Customer cancel booking của mình
[ ] Customer không cancel booking người khác
```

## Availability

```text
[ ] Slot nằm trong working hour
[ ] Slot ngoài working hour không xuất hiện
[ ] Slot đã booking không xuất hiện
[ ] Booking duration được tính đúng
[ ] Không xảy ra overlap
[ ] Không xảy ra double booking
```

---

# 57. Chạy Test

Chạy toàn bộ test:

```bash
vendor/bin/phpunit
```

Hoặc:

```bash
phpunit
```

Chạy một test cụ thể:

```bash
vendor/bin/phpunit tests/Feature/BookingTest.php
```

Chạy test theo filter:

```bash
vendor/bin/phpunit --filter Booking
```

---

# 58. Debug

Xem route:

```bash
php artisan route:list
```

Xem config:

```bash
php artisan config:clear
```

Clear cache:

```bash
php artisan cache:clear
```

Clear route cache:

```bash
php artisan route:clear
```

Clear view cache:

```bash
php artisan view:clear
```

Clear config cache:

```bash
php artisan config:clear
```

Development có thể dùng:

```bash
php artisan optimize:clear
```

nếu command này phù hợp với bộ Laravel 5.5 đang sử dụng; nếu không, dùng từng lệnh clear riêng.

---

# 59. Artisan Command thường dùng

```bash
# Laravel version
php artisan --version

# Danh sách command
php artisan list

# Routes
php artisan route:list

# Migration status
php artisan migrate:status

# Migration
php artisan migrate

# Rollback
php artisan migrate:rollback

# Seed
php artisan db:seed

# Fresh database + seed
php artisan migrate:fresh --seed

# Start server
php artisan serve

# Queue
php artisan queue:work

# Schedule
php artisan schedule:run
```

---

# 60. Thứ tự thực hiện

Không làm tất cả cùng lúc.

## Phase 1 — Project

```text
[ ] Kiểm tra PHP
[ ] Kiểm tra Composer
[ ] Tạo Laravel 5.5
[ ] Cấu hình .env
[ ] Tạo database
[ ] php artisan migrate
[ ] git init
[ ] Initial commit
```

---

## Phase 2 — Authentication

```text
[ ] make:auth
[ ] Register
[ ] Login
[ ] Logout
[ ] User role
[ ] Admin middleware
```

---

## Phase 3 — Service

```text
[ ] Service model
[ ] Service migration
[ ] Service seeder
[ ] Service CRUD
[ ] Validation
[ ] Form Request
[ ] Customer service list
[ ] Customer service detail
```

---

## Phase 4 — Staff

```text
[ ] Staff model
[ ] Staff migration
[ ] Staff seeder
[ ] Staff CRUD
[ ] Validation
```

---

## Phase 5 — Working Hours

```text
[ ] WorkingHour model
[ ] WorkingHour migration
[ ] WorkingHour relationship
[ ] WorkingHour CRUD
[ ] Validate time
```

---

## Phase 6 — Booking

```text
[ ] Booking model
[ ] Booking migration
[ ] Booking relationships
[ ] Booking form
[ ] Booking creation
[ ] Booking detail
[ ] Booking history
```

---

## Phase 7 — Availability

```text
[ ] Working hour calculation
[ ] Service duration calculation
[ ] Generate slots
[ ] Query existing bookings
[ ] Detect overlap
[ ] Return available slots
[ ] AJAX
```

---

## Phase 8 — Booking Management

```text
[ ] Pending
[ ] Confirmed
[ ] Cancelled
[ ] Completed
[ ] Customer cancel
[ ] Admin confirm
[ ] Admin cancel
[ ] Admin complete
```

---

## Phase 9 — Authorization

```text
[ ] BookingPolicy
[ ] Customer ownership check
[ ] Admin authorization
[ ] 403 handling
```

---

## Phase 10 — Admin

```text
[ ] Dashboard
[ ] Booking list
[ ] Search
[ ] Filter
[ ] Pagination
[ ] Service management
[ ] Staff management
[ ] Working hours management
```

---

## Phase 11 — Advanced Laravel

```text
[ ] Notification
[ ] Mail
[ ] Queue
[ ] Event
[ ] Listener
[ ] Scheduler
[ ] API
```

---

## Phase 12 — Optimization

```text
[ ] Eager Loading
[ ] Query Scope
[ ] Database Index
[ ] Query optimization
[ ] Cache
```

---

## Phase 13 — Testing

```text
[ ] Authentication tests
[ ] Service tests
[ ] Staff tests
[ ] Booking tests
[ ] Availability tests
[ ] Authorization tests
[ ] Validation tests
[ ] Double booking tests
```

---

# 61. Definition of Done

Project được xem là hoàn thành khi customer có thể thực hiện đầy đủ:

```text
Register
    ↓
Login
    ↓
View Services
    ↓
Select Service
    ↓
Select Staff
    ↓
Select Date
    ↓
View Available Slots
    ↓
Select Time
    ↓
Create Booking
    ↓
View Booking
    ↓
Cancel Booking
```

Admin có thể:

```text
Login
    ↓
Dashboard
    ↓
Manage Services
    ↓
Manage Staff
    ↓
Manage Working Hours
    ↓
View Bookings
    ↓
Confirm / Cancel / Complete
```

Backend phải đảm bảo:

```text
[x] Validation
[x] Authentication
[x] Authorization
[x] Booking conflict detection
[x] Double booking prevention
[x] Database transaction
[x] Notification
[x] Queue
[x] Scheduler
[x] API
[x] Automated tests
```

---

# 62. Git Commit Convention

Mỗi feature nên commit riêng.

Ví dụ:

```bash
git add .
git commit -m "chore: initialize Laravel 5.5 booking app"
```

```bash
git add .
git commit -m "feat: add authentication"
```

```bash
git add .
git commit -m "feat: add service management"
```

```bash
git add .
git commit -m "feat: add staff management"
```

```bash
git add .
git commit -m "feat: add working hour management"
```

```bash
git add .
git commit -m "feat: add booking creation"
```

```bash
git add .
git commit -m "feat: add booking availability"
```

```bash
git add .
git commit -m "fix: prevent overlapping bookings"
```

```bash
git add .
git commit -m "feat: add booking cancellation"
```

```bash
git add .
git commit -m "feat: add booking confirmation"
```

```bash
git add .
git commit -m "feat: add booking notifications"
```

```bash
git add .
git commit -m "feat: add booking queue"
```

```bash
git add .
git commit -m "feat: add booking reminder scheduler"
```

```bash
git add .
git commit -m "test: add booking feature tests"
```

---

# 63. Quy tắc khi luyện

Mỗi feature nên tự đi qua quy trình:

```text
Requirement
    ↓
Database
    ↓
Migration
    ↓
Model
    ↓
Relationship
    ↓
Controller
    ↓
Validation
    ↓
Route
    ↓
Blade
    ↓
AJAX / API nếu cần
    ↓
Manual Test
    ↓
Automated Test
    ↓
Git Commit
```

Không bỏ qua database và backend logic chỉ để làm UI trước.

---

# 64. Mục tiêu cuối cùng

Sau project này, developer phải có thể tự trả lời và tự implement được:

```text
Laravel request đi qua những layer nào?

Route hoạt động như thế nào?

Controller nên chứa logic gì?

Khi nào dùng Form Request?

Eloquent relationship hoạt động thế nào?

hasMany khác belongsTo thế nào?

Eager Loading giải quyết vấn đề gì?

Middleware dùng khi nào?

Policy khác Middleware thế nào?

Validation nên đặt ở đâu?

Làm thế nào để tránh N+1 query?

Làm thế nào để tìm available booking slots?

Làm thế nào để detect booking overlap?

Làm thế nào để chống double booking?

Khi nào cần DB transaction?

Notification hoạt động thế nào?

Queue giải quyết vấn đề gì?

Scheduler hoạt động thế nào?

Event / Listener dùng khi nào?

Laravel API trả JSON như thế nào?

Làm thế nào để test booking flow?

Làm thế nào để test trường hợp hai người cùng đặt một slot?
```

---

# 65. Kết quả mong muốn

Cuối project phải có một repository có cấu trúc tương tự:

```text
booking-app/
│
├── app/
│   ├── Console/
│   ├── Events/
│   ├── Http/
│   ├── Listeners/
│   ├── Models/
│   ├── Notifications/
│   ├── Policies/
│   └── ...
│
├── database/
│   ├── factories/
│   ├── migrations/
│   └── seeds/
│
├── resources/
│   └── views/
│
├── routes/
│   ├── api.php
│   └── web.php
│
├── tests/
│   ├── Feature/
│   └── Unit/
│
├── .env.example
├── composer.json
└── README.md
```

Mục tiêu không phải chỉ là **"chạy được Laravel 5.5"**, mà là hoàn thành một hệ thống booking đủ phức tạp để developer phải sử dụng các thành phần quan trọng của Laravel trong một project thực tế.