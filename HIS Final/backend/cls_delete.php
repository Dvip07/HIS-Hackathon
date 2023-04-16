<?php
require_once("DB_connect.php");
class delete
{


    public $lab_id;
    public function DeleteLab()
    {
        $conn = dbconnection();

        $sql = "DELETE FROM `lab` WHERE `Lab_id`='$this->lab_id'";
        $result = $conn->query($sql);
        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public $complaint_id;

    public function DeleteComplaint()
    {
        $conn = dbconnection();

        $sql = "DELETE FROM `complaint` WHERE `complaint_id`='$this->complaint_id'";
        $result = $conn->query($sql);
        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public $user_id;
    public function DeleteUser()
    {
        $conn = dbconnection();

        $sql = "DELETE FROM `user` WHERE `user_id`='$this->user_id'";
        $result = $conn->query($sql);
        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }
    // public function DeleteComplaintLab()
    // {
    //     $conn = dbconnection();

    //     $sql = "DELETE FROM `lab` WHERE `Lab_id`='$this->lab_id'";
    //     $result = $conn->query($sql);
    //     if ($result === TRUE) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    public $notice_id;
    public function DeleteNotice()
    {
        $conn = dbconnection();

        $sql = "DELETE FROM `notice_board` WHERE `notice_id`='$this->notice_id'";
        $result = $conn->query($sql);
        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public $appointment_id;
    public function DeleteAppointment()
    {
        $conn = dbconnection();

        $sql = "DELETE FROM `notice_board` WHERE `notice_id`='$this->notice_id'";
        $sql = "DELETE FROM `appointments` WHERE 'appointment_id'='$this->appointment_id'";
        $result = $conn->query($sql);
        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }


}
