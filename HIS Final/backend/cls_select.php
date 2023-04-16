<?php
require_once("DB_connect.php");
// Login Check for all user 
class login
{
    public $userid;
    public $password;
    public function DBlogin()
    {
        $conn = dbconnection();
        $sql = "SELECT `user_id`, `password`, `role`, `name`, `user_status`, `profile` FROM `user` WHERE user_id='$this->userid' and password='$this->password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['user_status'] == 0) {
                    if ($row['role'] == 0) {
                        $_SESSION['Admin'] = $row['user_id'];
                        $_SESSION['Admin_name'] = $row['name'];
                        $_SESSION['profile'] = $row['profile'];
                    } elseif ($row['role'] == 1) {
                        $_SESSION['manager'] = $row['user_id'];
                        $_SESSION['manager_name'] = $row['name'];
                        $_SESSION['profile'] = $row['profile'];
                    } elseif ($row['role'] == 2) {
                        $_SESSION['student'] = $row['user_id'];
                        $_SESSION['student_name'] = $row['name'];
                        $_SESSION['profile'] = $row['profile'];
                    } elseif ($row['role'] == 3) {
                        $_SESSION['faculty'] = $row['user_id'];
                        $_SESSION['faculty_name'] = $row['name'];
                        $_SESSION['profile'] = $row['profile'];
                    } elseif ($row['role'] == 4) {
                        $_SESSION['department'] = $row['user_id'];
                        $_SESSION['department_name'] = $row['name'];
                        $_SESSION['profile'] = $row['profile'];
                    }elseif ($row['role'] == 5) {
                        $_SESSION['aditya'] = $row['user_id'];
                        $_SESSION['aditya_name'] = $row['name'];
                        $_SESSION['profile'] = $row['profile'];
                    }
                    return true;
                } else {
                    $_SESSION['Invalid'] = 'Your account is disabled';
                    return false;
                }
            }
        } else {
            $_SESSION['Invalid'] = 'Invalid User Id or Password';
            return false;
        }
    }
}

// Getting information about the complaints
class GetComplaint
{
    public $id;
    public $cat_type;
    public function ComplaintGetStudentByType()
    {
        $conn = dbconnection();

        $sql = "SELECT `complaint_id`,`user_id`, `err_id`, `cat_no`, `complaint_type`, `complaint_desc`, `status` FROM `complaint` WHERE user_id='$this->id' && cat_type='$this->cat_type'";
        $result = $conn->query($sql);
        return $result;
    }

    public function ComplaintGetStudent()
    {
        $conn = dbconnection();

        $sql = "SELECT `complaint_id`,`user_id`, `err_id`, `cat_no`, `complaint_type`, `complaint_desc`, `status` FROM `complaint` WHERE user_id='$this->id'";
        $result = $conn->query($sql);
        return $result;
    }


    public function ComplaintGetByType()
    {
        $conn = dbconnection();

        $sql = "SELECT `complaint_id`, `user_id`, `err_id`, `cat_no`,`ip`, `complaint_type`, `complaint_desc`, `date`, `time`, `cat_type`, `status` FROM `complaint` WHERE cat_type='$this->cat_type'";
        $result = $conn->query($sql);
        return $result;
    }

    public function ComplaintGet()
    {
        $conn = dbconnection();

        $sql = "SELECT `complaint_id`, `user_id`, `err_id`, `cat_no`,`ip`, `complaint_type`, `complaint_desc`, `date`, `time`, `cat_type`, `status` FROM `complaint` WHERE 1";
        $result = $conn->query($sql);
        return $result;
    }

    public $sDate;
    public $eDate;
    public function ComplaintGetByDate()
    {
        $conn = dbconnection();

        $sql = "SELECT `complaint_id`, `user_id`, `err_id`, `cat_no`, `complaint_type`, `complaint_desc`, `date`, `time`, `status` FROM `complaint` WHERE `date` BETWEEN '$this->sDate' AND '$this->eDate'";

        $result = $conn->query($sql);
        return $result;
    }

    public function ComplaintGetByYear()
    {
        $conn = dbconnection();

        $sql = "SELECT COUNT(*) as 'complaint', YEAR(date) as year FROM complaint WHERE YEAR(date) BETWEEN YEAR(CURDATE())- 5 and YEAR(CURDATE()) GROUP BY YEAR(date);";

        $result = $conn->query($sql);
        return $result;
    }

    public function ComplaintGetByMonth()
    {
        $conn = dbconnection();
        $sDate = date("Y-m", strtotime("-1 year"));

        $sql = "SELECT COUNT(*) as 'complaint', MONTHNAME(date) as 'month' FROM complaint WHERE DATE_FORMAT(date, '%Y-%m') BETWEEN '$sDate' and DATE_FORMAT(CURDATE(), '%Y-%m') GROUP BY DATE_FORMAT(date, '%Y-%m')";

        $result = $conn->query($sql);
        return $result;
    }

    public $status;
    public function ComplaintGetByTypeStatus()
    {
        $conn = dbconnection();

        $sql = "SELECT `complaint_id`, `user_id`, `err_id`, `cat_no`,`ip`, `complaint_type`, `complaint_desc`, `date`, `time`, `cat_type`, `status` FROM `complaint` WHERE cat_type='$this->cat_type' && status='$this->status'";
        $result = $conn->query($sql);
        return $result;
    }
}


// Getting information about the users
class Get
{
    public $role;
    public $status;
    public $user_id;
    public $doc_id;
    public $dp_id;
    public $certi_id;
    public $print_type;
    public $faculty_id;
    public $major_cat;
    public $student_id;

    public function GetUser()
    {
        $conn = dbconnection();

        $sql = "SELECT `user_id`, `password`, `name`, `mobile_number`, `email`, `user_status` FROM `user` WHERE role='$this->role' and `user_status`=0";
        $result = $conn->query($sql);
        return $result;
    }

    public function GetLab()
    {
        $conn = dbconnection();

        $sql = "SELECT `Lab_id`, `Lab_name` FROM `lab` WHERE 1";
        $result = $conn->query($sql);
        return $result;
    }

    public function GetClass()
    {
        $conn = dbconnection();

        $sql = "SELECT `class_id`, `class_name` FROM `class` WHERE 1";
        $result = $conn->query($sql);
        return $result;
    }

    public function GetLib()
    {
        $conn = dbconnection();

        $sql = "SELECT `lib_id`, `lib_name` FROM `Library` WHERE 1";
        $result = $conn->query($sql);
        return $result;
    }

    public function GetAllUser()
    {
        $conn = dbconnection();

        $sql = "SELECT `user_id`, `password`, `name`, `mobile_number`, `email`, `role` FROM `user` WHERE 1";
        $result = $conn->query($sql);
        return $result;
    }


    public function InactiveUser()
    {
        $conn = dbconnection();

        $sql = "SELECT `user_id`, `name`, `mobile_number`, `email`, `user_status`,`role` FROM `user` WHERE `user_status`=1";
        $result = $conn->query($sql);
        return $result;
    }

    
    public function documentProcessFaculty()
    {
        $conn = dbconnection();

        $sql = "SELECT `dp_id`, `student_name`, `student_id`, `doc_id`, `doc_name`, `department_id`, `student_department_status`, `faculty_id`, `faculty_status`, `admin_id`, `admin_status`, `doc_desc`, `doc_path`, `print_type` FROM `documets_process` WHERE `student_department_status`='$this->status' && `faculty_id`='$this->user_id'";
        $result = $conn->query($sql);
        return $result;
    }

    public function documentProcessDepartment()
    {
        $conn = dbconnection();

        $sql = "SELECT `dp_id`, `student_name`, `student_id`, `doc_id`, `doc_name`, `department_id`, `student_department_status`, `faculty_id`, `faculty_status`, `admin_id`, `admin_status`, `doc_desc`, `doc_path`, `print_type` FROM `documets_process` WHERE `department_id`='$this->user_id' && `doc_id`='$this->doc_id'";
        $result = $conn->query($sql);
        return $result;
    }
    
    public function documentProcessAdmin()
    {
        $conn = dbconnection();

        $sql = "SELECT `dp_id`, `student_name`, `student_id`, `doc_id`, `doc_name`, `department_id`, `student_department_status`, `faculty_id`, `faculty_status`, `admin_id`, `admin_status`, `doc_desc`, `doc_path`, `print_type` FROM `documets_process` WHERE `admin_id`='$this->user_id' && `doc_id`='$this->doc_id'";
        $result = $conn->query($sql);
        return $result;
    }
    public function documentProcessStudent()
    {
        $conn = dbconnection();

        $sql = "SELECT `dp_id`, `student_name`, `student_id`, `doc_id`, `doc_name`, `department_id`, `student_department_status`, `faculty_id`, `faculty_status`, `admin_id`, `admin_status`, `doc_desc`, `doc_path`, `print_type` FROM `documets_process` WHERE  `student_id`='$this->user_id'";
        $result = $conn->query($sql);
        return $result;
    }
    public function documentProcessStudentById()
    {
        $conn = dbconnection();

        $sql = "SELECT `dp_id`, `student_name`, `student_id`, `doc_id`, `doc_name`, `department_id`, `student_department_status`, `faculty_id`, `faculty_status`, `admin_id`, `admin_status`, `doc_desc`, `doc_path`, `print_type` FROM `documets_process` WHERE  `student_id`='$this->user_id' && `dp_id`='$this->dp_id'";
        $result = $conn->query($sql);
        return $result;
    }

    public function document()
    {
        $conn = dbconnection();

        $sql = "SELECT `doc_id`, `doc_name`, `doc_desc_status`, `doc_faculty_status` FROM `doc_types` WHERE 1";
        $result = $conn->query($sql);
        return $result;
    }

    
    public function documentByDocId()
    {
        $conn = dbconnection();

        $sql = "SELECT `doc_id`, `doc_name`, `doc_desc_status`, `doc_faculty_status` FROM `doc_types` WHERE `doc_id`='$this->doc_id'";
        $result = $conn->query($sql);
        return $result;
    }

    public function faculty()
    {
        $conn = dbconnection();

        $sql = "SELECT `user_id`, `password`, `name`, `mobile_number`, `profile`, `role`, `email`, `user_status` FROM `user` WHERE `role`=3";
        $result = $conn->query($sql);
        return $result;
    }

    public function department()
    {
        $conn = dbconnection();

        $sql = "SELECT `user_id`, `password`, `name`, `mobile_number`, `profile`, `role`, `email`, `user_status` FROM `user` WHERE `role`=4";
        $result = $conn->query($sql);
        return $result;
    }

    public function Admin()
    {
        $conn = dbconnection();

        $sql = "SELECT `user_id`, `password`, `name`, `mobile_number`, `profile`, `role`, `email`, `user_status` FROM `user` WHERE `role`=0";
        $result = $conn->query($sql);
        return $result;
    }

    public function GetDocProcessById()
    {
        $conn = dbconnection();

        $sql = "SELECT `dp_id`, `student_name`, `student_id`, `doc_id`, `doc_name`, `department_id`, `Student_department_status`, `faculty_id`, `faculty_status`, `admin_id`, `admin_status`, `doc_desc`, `doc_path`, `print_type` FROM `documets_process` WHERE `dp_id`='$this->dp_id'";
        $result = $conn->query($sql);
        return $result;
    }


    public function GetDocFormatById()
    {
        $conn = dbconnection();

        $sql = "SELECT * FROM `doc_types` WHERE `doc_id`='$this->doc_id'";
        $result = $conn->query($sql);
        return $result;
    }

    public function documentStudentInfoById()
    {
        $conn = dbconnection();

        $sql = "SELECT `user_id`, `password`, `name`, `father_name`, `branch_id`, `mobile_number`, `profile`, `role`, `email`, `user_status` FROM `user` WHERE `user_id`='$this->user_id'";
        $result = $conn->query($sql);
        return $result;
    }

    public function GetCertificate()
    {
        $conn = dbconnection();

        $sql = "SELECT `certi_id`, `certi_name`, `certi_path`, `x_coordinates`, `y_coordinates` FROM `certificates` WHERE 1";
        $result = $conn->query($sql);
        return $result;
    }

    public function GetCertificateById()
    {
        $conn = dbconnection();

        $sql = "SELECT `certi_id`, `certi_name`, `certi_path`, `x_coordinates`, `y_coordinates` FROM `certificates` WHERE `certi_id`='$this->certi_id'";
        $result = $conn->query($sql);
        return $result;
    }

    public function GetCertificateByUserId()
    {
        $conn = dbconnection();

        $sql = "SELECT `encerti_id`, `student_id`, `student_name`, `certi_name`, `encerti_path` FROM `event_certi` WHERE  `student_id`='$this->user_id'";
        $result = $conn->query($sql);
        return $result;
    }

    public function GetDecByPrintType()
    {
        $conn = dbconnection();

        $sql = "SELECT `dp_id`, `student_name`, `student_id`, `doc_id`, `doc_name`, `department_id`, `Student_department_status`, `faculty_id`, `faculty_status`, `admin_id`, `admin_status`, `doc_desc`, `doc_path`, `print_type` FROM `documets_process` WHERE print_type='$this->print_type'";
        $result = $conn->query($sql);
        return $result;
    }

    public function GetNoticeById()
    {
        $conn = dbconnection();

        $sql = "SELECT `notice_id`, `notice_heading`, `notice_desc`, `notice_document`, `faculty_id`, `faculty_name`, `regi_date`, `regi_time`, `exp_date`, `status` FROM `notice_board` WHERE `faculty_id`='$this->faculty_id' ORDER BY `notice_id` DESC";
        $result = $conn->query($sql);
        return $result;
    }

    public function GetNotice()
    {
        $conn = dbconnection();

        $sql = "SELECT `notice_id`, `notice_heading`, `notice_desc`, `notice_document`, `faculty_id`, `faculty_name`, `regi_date`, `regi_time`, `exp_date`, `status` FROM `notice_board` WHERE `status`=0 ORDER BY `notice_id` DESC";
        $result = $conn->query($sql);
        return $result;
    }

    public function Get100ActivityById()
    {
        $conn = dbconnection();

        $sql = "SELECT `certi_id`, `certi_path`, `certi_desc`, `student_id`, `event_date`, `student_name`, `certi_cat`, `certi_SubCat`, `level`, `position` FROM `100activity` WHERE `certi_cat`='$this->major_cat' && `student_id`='$this->student_id'";
        $result = $conn->query($sql);
        return $result;
    }

    public function Get100Activity()
    {
        $conn = dbconnection();

        $sql = "SELECT DISTINCT `student_id`, `student_name` FROM `100activity` WHERE 1";
        $result = $conn->query($sql);
        return $result;
    }

    public function GetActivityCat()
    {
        $conn = dbconnection();

        $sql = "SELECT DISTINCT `activityCatHead` FROM `activityCat` WHERE 1";
        $result = $conn->query($sql);
        return $result;
    }

    public function GetActivityCatAll()
    {
        $conn = dbconnection();

        $sql = "SELECT `activityCatId`, `activityCatHead`, `activitySubCat` FROM `activityCat` WHERE 1";
        $result = $conn->query($sql);
        return $result;
    }

    // public function GetAppointmentById()
    // {
    //     $conn = dbconnection();

    //     $sql = "SELECT `appointment_id`, `emp_dept`, `appointment_time`, `emp_name`, `appointment_desc`, `appointment_status` FROM `appointment` WHERE 1";
    //     $result = $conn->query($sql);
    //     return $result;
    // }

    public function GetAppointment()
    {
        $conn = dbconnection();

        $sql = "SELECT `appointment_id`, `user_name`, `employee_name`, `appointment_date`, `appointment_type`, `status` FROM `appointments` WHERE 1";

        $result = $conn->query($sql);
        return $result;
    }

    public function GetEmergencyNotification()
    {
        $conn = dbconnection();

        $sql = "SELECT `notification_id`, `smart_light_id`, `notification_message`, `notification_time` FROM `emergency_notifications` WHERE 1";

        $result = $conn->query($sql);
        return $result;
    }

    public function GetNoiseDetails()
    {
        $conn = dbconnection();

        $sql = "SELECT `complaint_id`, `date_reported`, `time_reported`, `location`, `noise_level` FROM `Noise_Complaints` WHERE 1";

        $result = $conn->query($sql);
        return $result;
    }

}
