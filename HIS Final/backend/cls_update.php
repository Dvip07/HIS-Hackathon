<?php
require_once("DB_connect.php");
class update
{
    public $complaint_id;
    public $status;
    public function ComplaintStatus()
    {
        $conn = dbconnection();

        $sql = "UPDATE `complaint` SET `status`='$this->status' WHERE `complaint_id`='$this->complaint_id'";
        $result = $conn->query($sql);
        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public $old_pw;
    public $new_pw;
    public function ChangePassword()
    {
        $conn = dbconnection();

        $sql = "UPDATE `user` SET `password`='$this->new_pw' WHERE `password`='$this->old_pw'";
        $result = $conn->query($sql);
        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public $user_id;
    public $user_status;
    public function UserStatus()
    {
        $conn = dbconnection();

        $sql = "UPDATE `user` SET `user_status`='$this->user_status' WHERE `user_id`='$this->user_id'";
        $result = $conn->query($sql);
        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    //Process Status for all three modules
    public $dp_id;
    public $studetnDepartStatus;
    public $facultyStatus;
    public $adminStatus;
    public $doc_path;
    public function doc_process_status_depart()
    {
        $conn = dbconnection();

        $sql = "UPDATE `documets_process` SET `Student_department_status`='$this->studetnDepartStatus' WHERE `dp_id`='$this->dp_id'";
        $result = $conn->query($sql);
        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function doc_process_status_faculty()
    {
        $conn = dbconnection();

        $sql = "UPDATE `documets_process` SET `faculty_status`='$this->facultyStatus' WHERE `dp_id`='$this->dp_id'";
        $result = $conn->query($sql);
        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function doc_process_status_admin()
    {
        $conn = dbconnection();

        $sql = "UPDATE `documets_process` SET `admin_status`='$this->adminStatus',`doc_path`='$this->doc_path' WHERE `dp_id`='$this->dp_id'";

        $result = $conn->query($sql);
        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    

    public $appointment_id;
    // public $status;

    public function AppointmentStatus()
    {
        $conn = dbconnection();
        
        $sql = "UPDATE `appointments` SET `status`='$this->status' WHERE `appointment_id`='$this->appointment_id'";

        
        $result = $conn->query($sql);
        if($result === TRUE) {
            return true; 
        }else {
                return false;
            }
    }

    
}
