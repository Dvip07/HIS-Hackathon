<?php
session_start();
require_once("cls_update.php");
require_once("cls_select.php");

if (isset($_POST['change_status'])) {

    $status = $_POST['status'];

    $obj = new update();
    $obj->complaint_id = $_SESSION['complaint_id'];
    $obj->status = $status;

    $result = $obj->ComplaintStatus();


    if ($result == true) {
        unset($_SESSION['complaint_id']);
        header('Location:../pages/view_complaints.php?cat_type='.$_GET['cat_type']);
    } else {
        header('Location:../error/error-500.php');
    }
}

// change the status of the appointment
elseif(isset($_POST['change_status'])) {

    $status = $_POST['status'];

    $obj = new update();
    $obj->appointment_id = $_SESSION['appointment_id'];
    $obj->status = $status;

    $result = $obj->AppointmentStatus();

    if($result == true) {
        unset($_SESSION['appointment_id']);
        header('Location:../pages/view_Appointments.php?cat_type='.$_GET['cat_type']);
    }
    else {
        header('Location:../error/error-500.php');
    }
}

//change_password
elseif (isset($_POST['change_password'])) {

    $old_pw = $_POST['old_pw'];
    $new_pw = $_POST['new_pw'];
    $rnew_pw = $_POST['rnew_pw'];

    if ($new_pw == $rnew_pw) {

        $obj = new update();
        $obj->old_pw = $old_pw;
        $obj->new_pw = $new_pw;
        $result = $obj->ChangePassword();


        if ($result == true) {
            header('Location:../pages/index.php');
        } else {
            header('Location:../error/error-400.php');
        }
    } else {
        header('Location:../error/error-400.php');
    }
}


//user status
elseif (isset($_GET['inactive_user_id']) || isset($_GET['active_user_id'])) {

    if (isset($_GET['inactive_user_id'])) {
        $user_id = $_GET['inactive_user_id'];
        $user_status = 0;
    } elseif (isset($_GET['active_user_id'])) {
        $user_id = $_GET['active_user_id'];
        $user_status = 1;
    }


    $obj = new update();
    $obj->user_id = $user_id;
    $obj->user_status = $user_status;

    $result = $obj->UserStatus();


    if ($result == true) {
        if ($_GET['role'] == 1) {
            header('Location:../pages/view_technician.php?role=1');
        } elseif ($_GET['role'] == 2) {
            header('Location:../pages/view_student.php?role=2');
        } else {
            header('Location:../pages/inactive_user.php');
        }
    } else {
        header('Location:../error/error-500.php');
    }
} 

elseif (isset($_GET['dp_id']) == true) {

    $dp_id = $_GET['dp_id'];
    $id=$_GET['id'];
    $obj = new update();
    if (isset($_SESSION['department']) == true) {

        $studetnDepartStatus = $_GET["status"];
        $obj->dp_id = $dp_id;
        $obj->studetnDepartStatus = $studetnDepartStatus;
        $result = $obj->doc_process_status_depart();

    } elseif (isset($_SESSION['faculty']) == true) {
        
        $facultyStatus = $_GET["status"];
        $obj->dp_id = $dp_id;
        $obj->facultyStatus = $facultyStatus;
        $result = $obj->doc_process_status_faculty();

    } elseif (isset($_SESSION['Admin']) == true) {

        $adminStatus = $_GET["status"];

        $doc_id=$_GET['doc_id'];


        $obj1 = new Get();
        $obj1->doc_id = $_GET['doc_id'];
        $result_docFromat = $obj1->GetDocFormatById();


        if ($result_docFromat->num_rows > 0) {
        foreach ($result_docFromat as $row) {
                $doc_Format=$row['format_path'];
            }
        }

        echo $doc_Format;
        if ($_GET["status"] == 2) {
            $doc_path = null;
        } elseif ($_GET["status"] == 1) {
            $student_id=$_GET['student_id'];


            
                include ($doc_Format);

                    require_once("../vendor/autoload.php");
                    $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);



                    $mpdf->defaultheaderline = 0;
                    $mpdf->setAutoTopMargin = 'stretch';


                    $mpdf->defaultfooterline = 0;

                    $date = date("d-m-Y");
                    $mpdf->SetHeader($header_info);

                    $mpdf->WriteHTML($data);
                    $mpdf->SetFooter(' | | ');

                    $file_name = date("dmyhis") . ".pdf";

                    // $mpdf->output($file_name, ../backend/document/Destination::FILE);
                    $mpdf->Output('../backend/documents/'.$file_name, 'F');

                    $doc_path='../backend/documents/'.$file_name;
        }

        
        $obj->dp_id = $dp_id;
        $obj->adminStatus = $adminStatus;
        $obj->doc_path = $doc_path;
        $result = $obj->doc_process_status_admin();
        
    }
    
    if ($result == true) {
        header('Location:../pages/view_doc_request.php?id='.$id);
    } else {
        header('Location:../error/error-500.php');
    }
} else {
    header('Location:../error/error-404.php');
}
