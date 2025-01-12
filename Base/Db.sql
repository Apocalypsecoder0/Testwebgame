CREATE TABLE debug_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    class_name VARCHAR(255),
    function_name VARCHAR(255),
    message TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
