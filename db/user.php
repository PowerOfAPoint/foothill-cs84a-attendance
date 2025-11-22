<?php

class User
{
    private $db;

    public function __construct($conn)
    {
        $this->db = $conn;
    }

    public function insertUser($user, $pwd)
    {
        try {
            // Check that username is not already used
            $result = $this->getUserByUsername($user);
            if ($result["user_count"] > 0) {
                return false;
            }

            // Basic password hashing using md5
            $pwd_hash = md5("$pwd$user");

            $sql = "INSERT INTO users (username, password) VALUES (:user, :pwd)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(":user", $user);
            $stmt->bindparam(":pwd", $pwd_hash);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getUser($user, $pwd)
    {
        $sql = "SELECT * FROM users WHERE username = :user AND password = :pwd";
        $stmt = $this->db->prepare($sql);
        $stmt->bindparam(":user", $user);
        $stmt->bindparam(":pwd", $pwd);

        try {
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getUserByUsername($user)
    {
        $sql = "SELECT COUNT(*) AS user_count FROM users WHERE username = :user";
        $stmt = $this->db->prepare($sql);
        $stmt->bindparam(":user", $user);

        try {
            $stmt->execute();
            $result = $stmt->fetch();
            return $result;
        } catch (PDOException $e) {
            throw $e;
        }
    }
}
