<?php
// Hàm xử lý tải lên tệp
function uploadFiles($uploadedFiles) {
    $files = array();   
    $errors = array();
    $returnFiles = array();

    // Xử lý gom dữ liệu vào từng tệp đã upload
    foreach ($uploadedFiles as $key => $values) {
        if(is_array($values)){
            foreach ($values as $index => $value) {
                $files[$index][$key] = $value; // Gom nhóm tệp
            }
        }else{
            $files[$key] = $values; // Lưu tệp không phải là mảng
        }
    }

    $uploadPath = dirname(__FILE__) . '/img'; // Đường dẫn tải lên
    // Tạo thư mục img nếu chưa tồn tại
    if (!is_dir($uploadPath)) {
        mkdir($uploadPath, 0777, true);
    }

    if(is_array(reset($files))){ // Nếu là tải nhiều ảnh
        foreach ($files as $file) {
            $result = processUploadFile($file,$uploadPath); // Gọi hàm xử lý tải lên tệp
            if($result['error']){
                $errors[] = $result['message']; // Lưu lỗi nếu có
            }else{
                $returnFiles[] = $result['path']; // Lưu đường dẫn tệp đã tải lên
            }
        }
    }else{ // Nếu chỉ tải một ảnh
        $result = processUploadFile($files,$uploadPath);
        if($result['error']){
            return array(
                'errors' => $result['message']
            );
        }else{
            return array(
                'path' => $result['path']
            );
        }
    }
    return array(
        'errors' => $errors,
        'uploaded_files' => $returnFiles // Trả về tệp đã tải lên
    );
}

// Hàm xử lý tải lên từng tệp
function processUploadFile($file, $uploadPath) {
    $file = validateUploadFile($file, $uploadPath); // Kiểm tra tính hợp lệ của tệp
    if ($file != false) {
        // Thay thế khoảng trắng trong tên tệp bằng dấu gạch dưới
        $file["name"] = str_replace(' ', '_', $file["name"]);
        // Di chuyển tệp tải lên vào thư mục đích
        if (move_uploaded_file($file["tmp_name"], $uploadPath . '/' . $file["name"])) {
            return array(
                'error' => false,
                'path' => $file["name"] // Trả về tên tệp đã tải lên
            );
        }
    } else {
        return array(
            'error' => true, // Đánh dấu là có lỗi
            'message' => "File tải lên " . basename($file["name"]) . " không hợp lệ." // Thông báo lỗi
        );
    }
}

// Hàm kiểm tra tính hợp lệ của tệp tải lên
function validateUploadFile($file, $uploadPath) {
    // Kiểm tra xem có vượt quá dung lượng cho phép không?
    if ($file['size'] > 2 * 1024 * 1024) { // Giới hạn 2MB
        return false; // Không hợp lệ
    }

    // Kiểm tra kiểu tệp có hợp lệ không?
    $validTypes = array("jpg", "jpeg", "png", "bmp", "xlsx", "xls"); // Các loại tệp hợp lệ
    $fileType = strtolower(substr($file['name'], strrpos($file['name'], ".") + 1)); // Lấy phần mở rộng
    if (!in_array($fileType, $validTypes)) {
        return false; // Không hợp lệ
    }

    // Gán tên tệp không cần kiểm tra
    $fileName = str_replace(' ', '_', pathinfo($file['name'], PATHINFO_FILENAME));
    $file['name'] = $fileName . '.' . $fileType;  // Đảm bảo tên đúng

    return $file; // Trả về tệp hợp lệ
}

// Hàm kiểm tra định dạng ngày tháng
function validateDateTime($date) {
    // Kiểm tra định dạng ngày tháng xem đúng DD/MM/YYYY hay chưa?
    preg_match('/^[0-9]{1,2}-[0-9]{1,2}-[0-9]{4}$/', $date, $matches);
    if (count($matches) == 0) { // Nếu ngày tháng nhập không đúng định dạng
        return false;
    }
    $separateDate = explode('-', $date);
    $day = (int) $separateDate[0];
    $month = (int) $separateDate[1];
    $year = (int) $separateDate[2];
    // Nếu là tháng 2
    if ($month == 2) {
        if ($year % 4 == 0) { // Nếu là năm nhuận
            if ($day > 29) {
                return false; // Ngày không hợp lệ
            }
        } else { // Không phải năm nhuận
            if ($day > 28) {
                return false; // Ngày không hợp lệ
            }
        }
    }
    // Kiểm tra các tháng khác
    switch ($month) {
        case 1:
        case 3:
        case 5:
        case 7:
        case 8:
        case 10:
        case 12:
            if ($day > 31) {
                return false; // Ngày không hợp lệ
            }
            break;
        case 4:
        case 6:
        case 9:
        case 11:
            if ($day > 30) {
                return false; // Ngày không hợp lệ
            }
            break;
    }
    return true; // Ngày tháng hợp lệ
}

?>
