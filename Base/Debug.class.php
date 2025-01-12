<?php
// Base::Debug.class.php
class Debug
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    function logMsg($className, $function, $message)
    {
        if (DEBUG) {
            $stmt = $this->pdo->prepare("INSERT INTO debug_logs (class_name, function_name, message) VALUES (:class_name, :function_name, :message)");
            $stmt->execute([
                ':class_name' => $className,
                ':function_name' => $function,
                ':message' => $message
            ]);
        }
    }
}
?>
