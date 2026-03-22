<?php

class Faculty {

    private $conn;
    private $table = 'faculty';

    public function __construct($conn) {
        $this->conn = $conn;
        $this->createTable();
    }

    private function createTable() {
        $this->conn->query("
            CREATE TABLE IF NOT EXISTS {$this->table} (
                id         INT AUTO_INCREMENT PRIMARY KEY,
                fname      VARCHAR(80)   NOT NULL,
                mname      VARCHAR(80),
                lname      VARCHAR(80)   NOT NULL,
                age        TINYINT UNSIGNED NOT NULL,
                gender     VARCHAR(30)   NOT NULL,
                address    VARCHAR(255)  NOT NULL,
                position   VARCHAR(100)  NOT NULL,
                salary     DECIMAL(10,2) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
        ");
    }

    public function getAll() {
        $result = $this->conn->query("SELECT * FROM {$this->table} ORDER BY lname ASC");
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function create($data) {
        $stmt = $this->conn->prepare("
            INSERT INTO {$this->table} (fname, mname, lname, age, gender, address, position, salary)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->bind_param(
            'sssisssd',
            $data['fname'], $data['mname'], $data['lname'],
            $data['age'],   $data['gender'], $data['address'],
            $data['position'], $data['salary']
        );
        return $stmt->execute();
    }

    public function update($id, $data) {
        $stmt = $this->conn->prepare("
            UPDATE {$this->table}
            SET fname=?, mname=?, lname=?, age=?, gender=?, address=?, position=?, salary=?
            WHERE id=?
        ");
        $stmt->bind_param(
            'sssisssdi',
            $data['fname'], $data['mname'], $data['lname'],
            $data['age'],   $data['gender'], $data['address'],
            $data['position'], $data['salary'], $id
        );
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = ?");
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    public static function validate($data) {
        $errors = [];

        if (empty($data['fname']))
            $errors['fname'] = 'First name is required.';
        if (empty($data['lname']))
            $errors['lname'] = 'Last name is required.';

        $age = (int)($data['age'] ?? 0);
        if ($age < 18 || $age > 80)
            $errors['age'] = 'Age must be between 18 and 80.';

        $allowed_genders = ['Male', 'Female', 'Non-binary', 'Prefer not to say'];
        if (!in_array($data['gender'] ?? '', $allowed_genders))
            $errors['gender'] = 'Please select a gender.';

        if (strlen($data['address'] ?? '') < 5)
            $errors['address'] = 'Address must be at least 5 characters.';

        if (empty($data['position']))
            $errors['position'] = 'Position is required.';

        $salary = (float)($data['salary'] ?? 0);
        if ($salary <= 0)
            $errors['salary'] = 'Salary must be a positive number.';

        return $errors;
    }
}