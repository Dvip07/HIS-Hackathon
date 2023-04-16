<?php
session_start();
require_once("cls_delete.php");

if (isset($_GET['lab_id'])) {

    $lab_id = $_GET['lab_id'];
    // echo $lab_id;

    $obj = new delete();
    $obj->lab_id = $lab_id;

    $result = $obj->DeleteLab();


    if ($result == true) {
        // $obj1 = new delete();
        // $obj1->lab_id = $lab_id;
        // $result1 = $obj->DeleteComplaintLab();
        // if ($result1 == true) {
           
        // }
        header('Location:../pages/view_lab.php');
    } else {
        header('Location:../error/error-500.php');
    }
}


if (isset($_GET['complaint_id'])) {

    $complaint_id = $_GET['complaint_id'];
    $cat_type=$_GET['cat_type'];
    $obj = new delete();
    $obj->complaint_id = $complaint_id;

    $result = $obj->DeleteComplaint();


    if ($result == true) {
        header('Location:../pages/view_complaints.php?cat_type='.$cat_type);
    } else {
        header('Location:../error/error-500.php');
    }
}



if (isset($_GET['suser_id'])) {

    $user_id = $_GET['suser_id'];
    // echo $lab_id;

    $obj = new delete();
    $obj->user_id = $user_id;

    $result = $obj->DeleteUser();


    if ($result == true) {
        header('Location:../pages/view_student.php?role=2');
    } else {
        header('Location:../error/error-500.php');
    }
}


if (isset($_GET['tuser_id'])) {

    $user_id = $_GET['tuser_id'];
    // echo $lab_id;

    $obj = new delete();
    $obj->user_id = $user_id;

    $result = $obj->DeleteUser();


    if ($result == true) {
        header('Location:../pages/view_technician.php?role=1');
    } else {
        header('Location:../error/error-500.php');
    }
}


if (isset($_GET['in_user_id'])) {

    $user_id = $_GET['in_user_id'];
    // echo $lab_id;

    $obj = new delete();
    $obj->user_id = $user_id;

    $result = $obj->DeleteUser();


    if ($result == true) {
        header('Location:../pages/inactive_user.php');
    } else {
        header('Location:../error/error-500.php');
    }
}

if(isset($_GET['notice_id'])){

    $notice_id=$_GET['notice_id'];

    $obj = new delete();
    $obj->notice_id = $notice_id;

    $result = $obj->DeleteNotice();


    if ($result == true) {
        header('Location:../pages/add_notice.php');
    } else {
        header('Location:../error/error-500.php');
    }

}

if(isset($_GET['appointment_id'])){

    $appointment_id=$_GET['appointment_id'];

    $obj = new delete();
    $obj->appointment_id = $appointment_id;

    $result = $obj->DeleteAppointment();


    if ($result == true) {
        header('Location:../pages/view_appointment.php');
    } else {
        header('Location:../error/error-500.php');
    }

}