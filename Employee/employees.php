<?php
    class Employee{
        private $conn;

        private $db_table = "employee";

        public $id;
        public $name;
        public $email;
        public $age;
        public $designation;
        public $created;
        public function __construct($db){
            $this->conn = $db;
        }
        public function getEmployees(){
            $sqlQuery = "SELECT id, name, email, age, designation, created FROM "
                . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }
        public function createEmp(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                     SET
                         name = :name,
                         email = :email,
                         age = :age,
                         designation = :designation,
                         created = :created";
            $stmt = $this->conn->prepare($sqlQuery);

            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->age=htmlspecialchars(strip_tags($this->age));
            $this->designation=htmlspecialchars(strip_tags($this->designation));
            $this->created=htmlspecialchars(strip_tags($this->created));

            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":age", $this->age);
            $stmt->bindParam(":designation", $this->designation);
            $stmt->bindParam(":created", $this->created);

            if ($stmt->execute()){
                return true;
            }
            return false;
        }

        public function getOne(){
            $sqlQuery = "SELECT
                         id,
                         name,
                         email,
                         age,
                         designation,
                         created
                         FROM
                         ". $this->db_table ."
                         where id = ?
                         LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            $dateRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->name = $dateRow['name'];
            $this->email = $dateRow['email'];
            $this->age = $dateRow['age'];
            $this->designation = $dateRow['designation'];
            $this->created = $dateRow['created'];
        }
        public function updateEmp(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                        SET
                        name = :name,
                        email = :email,
                        age = :age,
                        designation = :designation,
                        created = :created
                        where
                        id = :id";

            $stmt = $this->conn->prepare($sqlQuery);

            $this->name=htmlspecialchars(strip_tags($this->name));
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->age=htmlspecialchars(strip_tags($this->age));
            $this->designation=htmlspecialchars(strip_tags($this->designation));
            $this->created=htmlspecialchars(strip_tags($this->created));
            $this->id=htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(":name", $this->name);
            $stmt->bindParam(":email", $this->email);
            $stmt->bindParam(":age", $this->age);
            $stmt->bindParam(":designation", $this->designation);
            $stmt->bindParam(":created", $this->created);
            $stmt->bindParam(":id", $this->id);

            if ($stmt->execute()){
                return true;
            }
            return false;
        }
        function deleteEmp(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE id = ?";
            $stmt = $this->conn->prepare($sqlQuery);

            $this->id=htmlspecialchars(strip_tags($this->id));

            $stmt->bindParam(1, $this->id);

            if ($stmt->execute()){
                return true;
            }
            return false;
        }
    }
?>