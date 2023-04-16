<?php
require_once("DB_connect.php");

// Complaint Registration
class ComplaintRegi
{
    public $user_id;
    public $complaint_id;
    public $err_id;
    public $cat_no;
    public $complaint_type;
    public $complaint_desc;
    public $date;
    public $time;
    public $status;
    public $ip;
    public $cat_type;
    public function RegiComplaint()
    {
        $conn = dbconnection();
        $sql = "INSERT INTO `complaint`(`complaint_id`, `user_id`, `err_id`, `cat_no`,`ip`, `complaint_type`, `complaint_desc`, `date`, `time`, `cat_type`, `status`) VALUES ('$this->complaint_id','$this->user_id','$this->err_id','$this->cat_no','$this->ip','$this->complaint_type','$this->complaint_desc','$this->date','$this->time','$this->cat_type','$this->status')";

        $result = $conn->query($sql);


        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}

// Adding user (Student & Technician by roleID)
class AddUser
{
    public $user_id;
    public $password;
    public $name;
    public $mobile_number;
    public $role;
    public $email;
    public function UserAdd()
    {
        $conn = dbconnection();

        $sql = "INSERT INTO `user`(`user_id`, `password`, `name`, `mobile_number`, `role`, `email`) VALUES ('$this->user_id','$this->password','$this->name','$this->mobile_number','$this->role','$this->email')";

        $result = $conn->query($sql);


        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}

// Adding user (Student & Technician by roleID)
class AddLab
{
    public $Lab_id;
    public $Lab_name;
    public function LabAdd()
    {
        $conn = dbconnection();

        $sql = "INSERT INTO `lab`(`Lab_id`, `Lab_name`) VALUES ('$this->Lab_id','$this->Lab_name')";

        $result = $conn->query($sql);


        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}

class AddUsers
{
    public $user_id;
    public $password;
    public $user_name;
   
    public $mobile_number;
    public $email;

    public function Users1Add()
    {
        $conn = dbconnection();

        $sql = "INSERT INTO `user`(`user_id`, `password`, `name`, `father_name`, `mobile_number`, `email`) VALUES ('$this->user_id','$this->password','$this->user_name','$this->mobile_number','$this->email')";

        $result = $conn->query($sql);

        if($result === TRUE) {
            return true;
        }
        else
        {
            return false;
        }
    }
}
class AddDocumentProcess
{
    public $student_name;
    public $student_id;
    public $doc_id;
    public $doc_name;
    public $depart_id;
    public $faculty_id;
    public $faculty_status;
    public $admin_id;
    public $doc_desc;
    public $print_type;
    
    public function docProcess()
    {
        $conn = dbconnection();

        if ($this->faculty_status == 3 || $this->faculty_id == 3) {
            $sql = "INSERT INTO `documets_process`( `student_name`, `student_id`, `doc_id`, `doc_name`, `department_id`, `faculty_id`, `faculty_status`, `admin_id`, `doc_desc`, `print_type`) VALUES ('$this->student_name','$this->student_id','$this->doc_id','$this->doc_name','$this->depart_id',null,null,'$this->admin_id','$this->doc_desc', '$this->print_type')";
            
        } else {

            $sql = "INSERT INTO `documets_process`( `student_name`, `student_id`, `doc_id`, `doc_name`, `department_id`, `faculty_id`, `faculty_status`, `admin_id`, `doc_desc`, `print_type`) VALUES ('$this->student_name','$this->student_id','$this->doc_id','$this->doc_name','$this->depart_id','$this->faculty_id','$this->faculty_status','$this->admin_id','$this->doc_desc', '$this->print_type')";
        }
        $result = $conn->query($sql);


        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}

class AddCertificate
{
    public $certi_name;
    public $certi_path;
    public $x_co;
    public $y_co;
    
    public function certificate()
    {
        $conn = dbconnection();

        $sql = "INSERT INTO `certificates`(`certi_name`, `certi_path`, `x_coordinates`, `y_coordinates`) VALUES ('$this->certi_name','$this->certi_path','$this->x_co','$this->y_co')";
        $result = $conn->query($sql);


        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}

class AddEventCertificate
{
    public $student_id;
    public $student_name;
    public $certi_name;
    public $encerti_path;
    
    public function EventCertificate()
    {
        $conn = dbconnection();

        $sql = "INSERT INTO `event_certi`( `student_id`, `student_name`, `certi_name`, `encerti_path`) VALUES ('$this->student_id','$this->student_name','$this->certi_name','$this->encerti_path')";
        $result = $conn->query($sql);


        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}

class AddNotice
{
    public $noticeHead;
    public $noticeDesc;
    public $noticeFile;
    public $faculty_id;
    public $faculty_name;
    public $regiDate;
    public $regiTime;
    public $expDate;
    
    public function noticeAdd()
    {
        $conn = dbconnection();

        $sql = "INSERT INTO `notice_board`(`notice_heading`, `notice_desc`, `notice_document`, `faculty_id`, `faculty_name`, `regi_date`, `regi_time`, `exp_date`) VALUES ('$this->noticeHead','$this->noticeDesc','$this->noticeFile','$this->faculty_id','$this->faculty_name','$this->regiDate','$this->regiTime','$this->expDate')";
        $result = $conn->query($sql);


        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}

class Add100Activity
{
    public $certi_path;
    public $certi_desc;
    public $event_date;
    public $student_id;
    public $student_name;
    public $certi_cat;
    public $certi_SubCat;
    public $level;
    public $position;
    
    public function acitvityAdd()
    {
        $conn = dbconnection();

        $sql = "INSERT INTO `100activity`(`certi_path`, `certi_desc`, `event_date`, `student_id`, `student_name`, `certi_cat`, `certi_SubCat`, `level`, `position`) VALUES ('$this->certi_path','$this->certi_desc','$this->event_date','$this->student_id','$this->student_name','$this->certi_cat','$this->certi_SubCat','$this->level','$this->position')";
        $result = $conn->query($sql);


        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}

class AddActivityCat
{
    
    public $CatHead;
    public $SubCat;
    
    public function acitvitySabAdd()
    {
        $conn = dbconnection();

        $sql = "INSERT INTO `activityCat`(`activityCatHead`, `activitySubCat`) VALUES ('$this->CatHead','$this->SubCat')";
        $result = $conn->query($sql);


        if ($result === TRUE) {
            return true;
        } else {
            return false;
        }
    }
}

// add appointment
class AddAppointment
{
    public $appointment_id;
    public $emp_dept;
    public $appointment_time;
    public $emp_name;
    public $appointment_desc;
    public $appointment_status;

    public function AppointmentAdd()
    {
        $conn = dbconnection();

        $sql = "INSERT INTO `appointment`(`appointment_id`, `emp_dept`, `appointment_time`, `emp_name`, `appointment_desc`, `appointment_status`) VALUES ('$this->appointment_id','$this->emp_dept','$this->appointment_time','$this->emp_name','$this->appointment_desc','$this->appointment_status')";
        $result = $conn->query($sql);

        if($result === TRUE) {
            return true;
        }
        else {
            return false;
        }
    }
}