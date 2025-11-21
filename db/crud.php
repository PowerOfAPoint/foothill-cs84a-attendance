<?php

if ($DEBUG) {
    echo "<h1 class='text-center text-success'>defining crud...</h1>";
}

class Crud
{
    // private database object
    private $db;

    // constructor to initialize private variable to the database connection
    public function __construct($conn)
    {
        $this->db = $conn;
    }

    // function to insert a new record into the attendee database
    public function insertAttendees($fname, $lname, $dob, $email, $contact, $specialty, $institution)
    {
        $sql = 'INSERT INTO attendee (firstname, lastname, dob, email, phone, specialty_id, institution_id) VALUES (:fname,:lname,:dob,:email,:contact,:specialty,:institution)';

        $stmt = $this->db->prepare($sql);

        $stmt->bindparam(':fname', $fname);
        $stmt->bindparam(':lname', $lname);
        $stmt->bindparam(':dob', $dob);
        $stmt->bindparam(':email', $email);
        $stmt->bindparam(':contact', $contact);
        $stmt->bindparam(':specialty', $specialty);
        $stmt->bindparam(':institution', $institution);
        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function updateAttendee($id, $fname, $lname, $dob, $email, $contact, $specialty, $institution)
    {
        $sql = "UPDATE attendee SET firstname=:fname, lastname=:lname, dob=:dob, email=:email, phone=:contact, specialty_id=:specialty, institution_id=:institution WHERE attendee_id=:id;";
        $stmt = $this->db->prepare($sql);
        $stmt->bindparam(":id", $id);
        $stmt->bindparam(':fname', $fname);
        $stmt->bindparam(':lname', $lname);
        $stmt->bindparam(':dob', $dob);
        $stmt->bindparam(':email', $email);
        $stmt->bindparam(':contact', $contact);
        $stmt->bindparam(':specialty', $specialty);
        $stmt->bindparam(':institution', $institution);

        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getAttendees()
    {
        $sql = "SELECT a.*, s.name AS specialty_name, i.name AS institution_name FROM attendee a JOIN specialties s ON a.specialty_id = s.specialty_id JOIN institutions i ON a.institution_id = i.institution_id;";

        try {
            $result = $this->db->query($sql);
        } catch (PDOException $e) {
            throw $e;
        }

        return $result;
    }

    public function getAttendeeDetails($id)
    {
        $sql = "SELECT a.*, s.name AS specialty_name, i.name AS institution_name FROM attendee a JOIN specialties s ON a.specialty_id = s.specialty_id JOIN institutions i ON a.institution_id = i.institution_id WHERE a.attendee_id = :id;";
        $stmt = $this->db->prepare($sql);
        $stmt->bindparam(":id", $id);

        try {
            $stmt->execute();
            $result = $stmt->fetch();
        } catch (PDOException $e) {
            throw $e;
        }

        return $result;
    }

    // function to get all the records from the specialties database
    public function getSpecialties()
    {
        $sql = "SELECT * FROM `specialties`;";

        try {
            $result = $this->db->query($sql);
            return $result;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    // Function to get all records from institutions database
    public function getInstitutions()
    {
        $sql = "SELECT * FROM `institutions`;";

        try {
            $result = $this->db->query($sql);
            return $result;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function deleteAttendee($id)
    {
        $sql = "DELETE FROM attendee WHERE attendee_id = :id;";

        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(":id", $id);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}

if ($DEBUG) {
    echo "<h1 class='text-center text-success'>crud defined</h1>";
}
