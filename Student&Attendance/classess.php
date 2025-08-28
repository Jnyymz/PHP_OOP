<?php
class Database {
    private $host = "localhost";
    private $db_name = "schooldb";  
    private $username = "root";     
    private $password = "";
    protected $conn;

    public function __construct() {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db_name}",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database Connection Error: " . $e->getMessage());
        }
    }

    // CREATE
    public function create($table, $data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    // READ
    public function read($table, $condition = "1") {
        $sql = "SELECT * FROM $table WHERE $condition";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update($table, $data, $condition) {
        $set = "";
        foreach ($data as $key => $value) {
            $set .= "$key = :$key, ";
        }
        $set = rtrim($set, ", ");
        $sql = "UPDATE $table SET $set WHERE $condition";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    // DELETE
    public function delete($table, $condition) {
        $sql = "DELETE FROM $table WHERE $condition";
        return $this->conn->exec($sql);
    }
}

//          STUDENT 

class Student extends Database {
    protected $table = "students";

    public function addStudent($data) {
        return $this->create($this->table, $data);
    }

    public function getStudents() {
        return $this->read($this->table);
    }

    public function updateStudent($data, $condition) {
        return $this->update($this->table, $data, $condition);
    }

    public function deleteStudent($condition) {
        return $this->delete($this->table, $condition);
    }
}

// ================== ATTENDANCE CLASS ==================
class Attendance extends Database {
    protected $table = "attendance";

    public function addAttendance($data) {
        return $this->create($this->table, $data);
    }

    public function getAttendance() {
        return $this->read($this->table);
    }

    public function updateAttendance($data, $condition) {
        return $this->update($this->table, $data, $condition);
    }

    public function deleteAttendance($condition) {
        return $this->delete($this->table, $condition);
    }
}
?>
