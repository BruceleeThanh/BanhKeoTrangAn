## BÁNH KẸO TRÀNG AN

Đề tài: Xây dựng website giới thiệu và bán sản phẩm cho công ty bánh kẹo Tràng An.
Các bước cài đặt:
**Bước 1:**
-	Tạo database trong Phpmyadmin sau đó import file banhkeotrangan.sql vào database vừa tạo để tự động tạo ra Cơ sở dữ liệu.
**Bước 2:**
-	Giải nén file BanhKeoTrangAn.rar  vào thư mục htdocs của Xampp hoặc vào thư mục root trên host

**Bước 3:**
-	Vào thư mục config mở file config.php và chỉnh sửa lại đường dẫn lưu Cơ sở dữ liệu.
```
Config::set('db.host', 'localhost');
Config::set('db.user', 'root');
Config::set('db.password', '');
Config::set('db.db_name', 'banhkeotrangan');
```
**Bước 4:**
-	Vào thư mục webroot mở file index.php và chỉnh sửa giá trị biến ROOT_PATH theo url tương ứng.

 ```
 define('ROOT_PATH', 'http://localhost:8080/BanhKeoTrangAn/');
 ```

**Bước 5:**
-	Vào thư mục lib mở file **route.class.php** và chỉnh sửa tham số vị trí của mảng $uri_routes tuỳ theo url, ví dụ:
o	Với url: “http://banhkeotrangan.pe.hu/” 
sửa tham số vị trí thành 1 “$uri_routes[1]” 
o	Với url: “http://localhost:8080/BanhKeoTrangAn/” 
sửa tham số vị trí thành 2 “$uri_routes[2]”

 
-	Tiếp tục sửa trong file **route.class.php**, thêm hoặc bớt 1 số câu lệnh array_shift($path_parts); tuỳ theo url, ví dụ:
o	Với url: “http://banhkeotrangan.pe.hu/” 
cần dùng 1 câu lệnh  array_shift($path_parts);
o	Với url: “http://localhost:8080/BanhKeoTrangAn/” 
cần dùng 2 câu lệnh  array_shift($path_parts);

-	Bản chất của Bước 5 này là để chương trình có thể nhận biết được các controller viết sau url.
