
// <!-- bindparam công cụ mạnh mẽ giúp tránh SQL injection -->

// <!-- Cấu trúc cơ bản  -->

PDOStatement::bindParam (
    $parameter, // Tên tham số hoặc số thứ tự của tham số trong câu lệnh SQL (?,?,... -> 1, 2, ... || :name -> :name)
    $variable, // Biến chứa giá trị sẽ được gán cho tham số trong câu lệnh SQL
    $data_type = PDO::PARAM_STR, // PDO::PARAM_INT, PDO::PARAM_BOOL, PDO::PARAM_NULL, PDO::PARAM_STR, PDO::PARAM_LOB, PDO::PARAM_STMT
    $length = 0, // Độ dài dữ liệu, có thể bỏ qua 
    $driver_options = null // (Tùy chọn) // Các tùy chọn của driver PDO
);
