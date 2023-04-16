<?php
session_start();
require_once("cls_insert.php");

if (isset($_POST['reg_complaint'])) {

    $cat_no = $_POST['cat_no'];
    $cType = $_POST['cType'];

    $cat_type=$_POST['cat_type'];
    $ip=$_SERVER['REMOTE_ADDR'];

    //Pc number in which error found
    if($_POST['cat_type']==0){
        $err_id = $_POST['err_id'];
    }
    else{
        $err_id = null;
    }


    if ($ip=="::1") {
        $ip="127.0.0.1";
    }

    if ($cType == "hardware" || $cType == "ClsEleP" || $cType == "LibEleP") {
        $complaint_desc = $_POST['complaint_desc1'];
        // $lab_no = $_POST['lab_no1'];
    } elseif ($cType == "software" || $cType == "ClsEnP" || $cType == "LibEnP") {
        $complaint_desc = $_POST['complaint_desc2'];
        // $lab_no = $_POST['lab_no2'];
    } else {
        $complaint_desc = $_POST['complaint_desc3'];
        // $lab_no = $_POST['lab_no2'];
    }




    date_default_timezone_set("Asia/Calcutta");
    $user_id = $_SESSION["student"];
    $complaint_id = date("d") . date("m") . date("H") . date("i") . date("s");
    $date = date("Y-m-d");
    $time = date("H:i:s");
    $status = 0;

    // echo $lab_no . " " . $pc_no . " " . $cType . " " . $complaint_desc . " " . $complaint_id . " " . $user_id . " " . $date . " " . $time;

    

    $obj = new ComplaintRegi();
    $obj->user_id = $user_id;
    $obj->complaint_id = $complaint_id;
    $obj->err_id = $err_id;
    $obj->cat_no = $cat_no;
    $obj->ip = $ip;
    $obj->complaint_type = $cType;
    $obj->complaint_desc = $complaint_desc;
    $obj->date = $date;
    $obj->time = $time;
    $obj->cat_type = $cat_type;
    $obj->status = $status;
    $result = $obj->RegiComplaint();


    if ($result == true) {
        header('Location:../pages/view_complaints.php?cat_type='.$cat_type);
    } else {
        header('Location:../error/error-400.php');
    }
} 


elseif (isset($_POST['add_student']) || isset($_POST['add_technician'])) {

    require '../vendor/autoload.php';

    $document = $_FILES['document'];

    $fileName = $_FILES['document']['name'];
    $fileTmpname = $_FILES['document']['tmp_name'];
    $fileSize = $_FILES['document']['size'];
    $fileError = $_FILES['document']['error'];
    $fileType = $_FILES['document']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('xlsx');

    // echo "<pre>";
    //     print_r($document);
    //     echo "</pre>";

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                $count = 0;
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fileTmpname);
                $data = $spreadsheet->getActiveSheet()->toArray();
                foreach ($data as $row) {

                    if ($count > 0) {
                        $user_id = $row['0'];
                        $name = $row['1'];
                        $mobile_no = $row['2'];
                        $password = $user_id;
                        $email = $row['3'];

                            $role = $_GET['role'];
                        

                        
                        
                        $obj = new AddUser();
                        $obj->user_id = $user_id;
                        $obj->password = $password;
                        $obj->name = $name;
                        $obj->mobile_number = $mobile_no;
                        $obj->role = $role;
                        $obj->email = $email;
                        $result = $obj->UserAdd();

                        if ($result == TRUE) {
                            if ($role == 1) {
                                header('Location:../pages/view_technician.php?role=1');
                            } elseif ($_GET['role'] == 2) {
                                header('Location:../pages/view_student.php?role=2');
                            }
                        } 

                    } else {
                        $count++;
                    }
                }
            }
            elseif($fileSize > 1000000){
                echo 'too large';
            }
        }
    } else {
        header('Location:../error/error-400.php');
    }
}


//Insert users
elseif (isset($_POST['add_student1'])) {

    $user_id = $_POST['user_id'];
    $password = $_POST['password'];
    $user_name = $_POST['user_name'];
    $mobile_number = $_POST['mobile_number'];
    $email = $_POST['email'];

    
    $obj = new AddUsers();
    $obj->user_id = $user_id;
    $obj->password = $password;
    $obj->user_name = $user_name;
    $obj->mobile_number = $mobile_number;
    $obj->email = $email;
    $result = $obj->Users1Add();


    if ($result == true) {
        header('Location:../pages/view_students.php');
    } else {
        echo "&#128533";
    }
}


//Insert Lab
elseif (isset($_POST['add_lab'])) {

    $lab_id = $_POST['lab_id'];
    $lab_name = $_POST['lab_name'];


    

    $obj = new AddLab();
    $obj->Lab_id = $lab_id;
    $obj->Lab_name = $lab_name;
    $result = $obj->LabAdd();


    if ($result == true) {
        header('Location:../pages/view_lab.php');
    } else {
        echo "&#128533";
    }
}


//Insert Lab
elseif (isset($_POST['apply_document'])) {

    require_once("cls_select.php");
    $obj = new Get();
    $result_depart  = $obj->department();
    $result_admin  = $obj->Admin();

    if ($result_depart->num_rows > 0) {
        foreach ($result_depart as $row){
            
        }
    }

    if ($result_admin->num_rows > 0) {
        foreach ($result_admin as $row) {
            
        }

    }

    $department_id=$_POST['departmentId'];
    $admin_id=$_POST['adminId'];
    $print_type=$_POST['doc_mode'];

    
    if(isset($_POST['facultyId'])){
        $faculty_id=$_POST['facultyId'];
        $faculty_status=0;
    }
    else{
        $faculty_id=3;
        $faculty_status=3;
    }

    $student_id=$_SESSION['student'];
    $student_name=$_SESSION['student_name'];

    $temp=$_POST['doc'];
    $temp_doc=explode("-",$temp);

    if(isset($_POST['doc_desc'])){
        $doc_desc=$_POST['doc_desc'];
    }else{
        $doc_desc=null;
    }


    $doc_id=$temp_doc[0];
    $doc_name=$temp_doc[1];
    

    $obj = new AddDocumentProcess();
   
    $obj->student_name = $student_name;
    $obj->student_id = $student_id;
    $obj->doc_id = $doc_id;
    $obj->doc_name = $doc_name;
    $obj->depart_id = $department_id;
    $obj->faculty_id = $faculty_id;
    $obj->faculty_status = $faculty_status;
    $obj->admin_id = $admin_id;
    $obj->doc_desc = $doc_desc;
    $obj->print_type = $print_type;
    

    $result = $obj->docProcess();

    if ($result == true) {
        header('Location:../pages/view_doc_request.php');
    } else {
        echo "&#128533";
    }
}
elseif (isset($_POST['add_certificate'])) {

    $document = $_FILES['document_certi'];

    $certi_name=$_POST['Certi_name'];
    $x_co=$_POST['x_co'];
    $y_co=$_POST['y_co'];

    $fileName = $_FILES['document_certi']['name'];
    $fileTmpname = $_FILES['document_certi']['tmp_name'];
    $fileSize = $_FILES['document_certi']['size'];
    $fileError = $_FILES['document_certi']['error'];
    $fileType = $_FILES['document_certi']['type'];

    print_r($_FILES['document_certi']);

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg','png','jpeg');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                $fileNameNew = $certi_name.".".$fileActualExt;
                $fileDestination = 'certificate_material/'.$fileNameNew;
                move_uploaded_file($fileTmpname, $fileDestination);
            }
            elseif($fileSize > 1000000){
                echo 'too large';
            }
        }
    }
    else {
        header('Location:../error/error-400.php');
    }


    $obj=new AddCertificate();
    $obj->certi_name=$certi_name;
    $obj->certi_path=$fileNameNew;
    $obj->x_co=$x_co;
    $obj->y_co=$y_co;
    $result=$obj->certificate();

    if ($result == true) {
        header('Location:../pages/create_certificate.php');
    } else {
        echo "&#128533";
    }
}
elseif (isset($_POST['gen_certificate'])) {


    require_once("../backend/cls_select.php");
    $obj= new Get();
    $obj->certi_id=$_POST['certi_id'];
    $result_certi=$obj->GetCertificateById();

    if ($result_certi->num_rows > 0) {
        foreach ($result_certi as $row) {
            $certi_name=$row['certi_name'];
            $certi_path=$row['certi_path'];
            $x_coordinates=$row['x_coordinates'];
            $y_coordinates=$row['y_coordinates'];
        }
    }


    require '../vendor/autoload.php';

    $document = $_FILES['document_certi_details'];
    $certi_date=$_POST['certi_date'];

    $fileName = $_FILES['document_certi_details']['name'];
    $fileTmpname = $_FILES['document_certi_details']['tmp_name'];
    $fileSize = $_FILES['document_certi_details']['size'];
    $fileError = $_FILES['document_certi_details']['error'];
    $fileType = $_FILES['document_certi_details']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('xlsx');

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                $count = 0;
                $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fileTmpname);
                $data = $spreadsheet->getActiveSheet()->toArray();
                foreach ($data as $row) {

                    if ($count > 0) {
                        
                        $user_id = $row['0'];
                        $user_name = $row['1'];

                        $font="certificate_material/Font/BRUSHSCI.TTF";
                        $image=imagecreatefromjpeg("certificate_material/".$certi_path);
                        $color=imagecolorallocate($image,19,21,22);

                        
                        date_default_timezone_set("Asia/Calcutta");
                        $filename="CERITFICATE".$$user_id.str_replace(" ","",$user_name).date('h').date('i').date('s').".jpg";
                        imagettftext($image,50,0,($x_coordinates-175),$y_coordinates,$color,$font,$user_name);
                        imagettftext($image,30,0,($x_coordinates+115),($y_coordinates+50),$color,$font,$certi_date);

                        imagejpeg($image,"../backend/Certificates/".$filename);
                        imagedestroy($image); 

                        
                        $obj = new AddEventCertificate();
                        $obj->student_id = $user_id;
                        $obj->student_name = $user_name;
                        $obj->certi_name = $certi_name;
                        $obj->encerti_path = $filename;
                        $result = $obj->EventCertificate();

                        if ($result == TRUE) {
                            $_SESSION['certiGen']=true;
                            header('Location:../pages/create_certificate.php');
                        } 

                    } else {
                        $count++;
                    }
                }
            }
            elseif($fileSize > 1000000){
                echo 'too large';
            }
        }
    }
    else {
        header('Location:../error/error-400.php');
    }
}
elseif(isset($_POST['add_notice'])) {

    date_default_timezone_set("Asia/Calcutta");
    
    $notice_head=$_POST['notice_head'];
    $notice_desc=$_POST['notice_desc'];
    $expDate=$_POST['expDate'];


    if($_FILES['noticeFile']['name'] != ""){
        $fileName = $_FILES['noticeFile']['name'];
        $fileTmpname = $_FILES['noticeFile']['tmp_name'];
        $fileSize = $_FILES['noticeFile']['size'];
        $fileError = $_FILES['noticeFile']['error'];
        $fileType = $_FILES['noticeFile']['type'];
    
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
    
        $allowed = array('jpg','jpeg','png','pdf');
    
        $tmpName=date("d").date("m").date("y").date("h").date("m").date("s");

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 1000000) {
                    $fileNameNew = $tmpName.".".$fileActualExt;
                    $fileDestination = 'notice_documents/'.$fileNameNew;
                    move_uploaded_file($fileTmpname, $fileDestination);
                }
                elseif($fileSize > 1000000){
                    echo 'too large';
                }
            }
        }
    }
    else{
        $fileNameNew=null;
    }

        if(isset($_SESSION['faculty'])==true){
            $user_id=$_SESSION['faculty'];
            $user_name=$_SESSION['faculty_name'];
        }
        elseif(isset($_SESSION['Admin'])==true){
            $user_id=$_SESSION['Admin'];
            $user_name=$_SESSION['Admin_name'];
        }


        $obj = new AddNotice();
        $obj->noticeHead = $notice_head;
        $obj->noticeDesc = $notice_desc;
        $obj->noticeFile = $fileNameNew;
        $obj->faculty_id = $user_id;
        $obj->faculty_name = $user_name;
        $obj->regiDate = date("Y-m-d");
        $obj->regiTime = date('h:m:s');
        $obj->expDate = $expDate;
        $result = $obj->noticeAdd();

        if ($result == true) {
            header('Location:../pages/add_notice.php');
        } else {
            echo "&#128533";
        }

}
elseif(isset($_POST['100_activity'])){

    date_default_timezone_set("Asia/Calcutta");

    $major_cat = $_POST['major_cat'];
    $acitivity = $_POST['acitivity'];
    $Level = $_POST['Level'];
    $certi_desc = $_POST['certi_desc'];
    $eventDate = $_POST['eventDate'];
    $position = $_POST['position'];


    $fileName = $_FILES['certificate']['name'];
    $fileTmpname = $_FILES['certificate']['tmp_name'];
    $fileSize = $_FILES['certificate']['size'];
    $fileError = $_FILES['certificate']['error'];
    $fileType = $_FILES['certificate']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg','jpeg','png');

    $tmpName=date("d").date("m").date("y").date("h").date("m").date("s");

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                $fileNameNew = $tmpName.".".$fileActualExt;
                $fileDestination = '100Activity/'.$fileNameNew;
                move_uploaded_file($fileTmpname, $fileDestination);
            }
            elseif($fileSize > 1000000){
                echo 'too large';
            }
        }
    }

    $obj = new Add100Activity();
    $obj->certi_path = $fileNameNew;
    $obj->certi_desc = $certi_desc;
    $obj->event_date = $eventDate;
    $obj->student_id = $_SESSION['student'];
    $obj->student_name = $_SESSION['student_name'];
    $obj->certi_cat = $major_cat;
    $obj->certi_SubCat = $acitivity;
    $obj->level = $Level;
    $obj->position = $position;
    $result = $obj->acitvityAdd();

    if ($result == true) {
        header('Location:../pages/ViewActivityCerti.php');
    } else {
        echo "&#128533";
    }

}
elseif(isset($_POST['appointment'])){
    $appointment_id=$_POST['appointment_id'];
    $emp_dept=$_POST['emp_dept'];
    $appointment_time=$_POST['appointment_time'];
    $emp_name=$_POST['emp_name'];
    $appointment_desc=$_POST['appointment_desc'];
    // $appointment_status=$_POST['appointment_status'];

    $obj = new AddAppointment();
    $obj->appointment_id = $appointment_id;
    $obj->emp_dept = $emp_dept;
    $obj->appointment_time = $appointment_time;
    $obj->emp_name = $emp_name;
    $obj->appointment_desc=$appointment_desc;
    // $obj->appointment_status=$appointment_status;
    $result = $obj->AppointmentAdd();


    if ($result == true) {
        header('Location:../pages/view_appointment.php');
    } else {
        echo "&#128533";
    }
}
elseif(isset($_POST['ActivityCat'])){
    $CatHead=$_POST['CatHead'];
    $SubCatValue=$_POST['SubCatValue'];

    echo $CatHead."<br>";
    echo $SubCatValue."<br>";

    for($i=1;$i<=$SubCatValue;$i++){
        $SubCat=$_POST['SubCat'.$i];
        echo $SubCat."<br>";

        $obj = new AddActivityCat();
        $obj->CatHead = $CatHead;
        $obj->SubCat = $SubCat;
        $result = $obj->acitvitySabAdd();
    }

    if ($result == true) {
        $_SESSION["insert"]=true;
        header('Location:../pages/ActivityCat.php');
    } else {
        echo "&#128533";
    }
}

elseif(isset($_POST['fuck'])){
    echo "hi<br>";

    echo $_POST['acitivity']."<br>";
    echo $_POST['acitivity1']."<br>";
}

else {
    header('Location:../error/error-404.php');
}

