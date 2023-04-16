<?php include '../inc/header.php'; ?>

<!-- INCLUDE SIDEBAR -->
<?php include '../inc/sidebar.php'; ?>

<!-- INCLUDE  -->
<?php require_once("../backend/cls_select.php"); ?>

<div class="main-panel">
    <div class="content-wrapper">
    <div class="row">
            <?php
            if (isset($_SESSION['faculty']) == true) :
                $obj = new Get();
                $obj->status = 1;
                $obj->user_id = $_SESSION['faculty'];
                $result_dpf  = $obj->documentProcessFaculty();
            ?>
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">View
                                Complaint</h4>
                            <p class="card-description">
                                List of <code>Complaints</code>
                            </p>
                            <div class="table-responsive">
                                <table class="table table-hover" id="table_data">
                                    <thead>
                                        <tr>
                                            <th>Document Name</th>
                                            <th>Document Description</th>
                                            <th>Student ID</th>
                                            <th>Student Name</th>
                                            <th>Department Status</th>
                                            <th>Faculty Status</th>
                                            <th>Admin Status</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php
                                        if ($result_dpf->num_rows > 0) :
                                            foreach ($result_dpf as $row) :
                                        ?>
                                        <tr>
                                                <td><?php echo $row['doc_name']; ?></td>
                                                <td>
                                                    <?php 
                                                        if($row['doc_desc']=="" || $row['doc_desc']==null){
                                                            echo "No description required";
                                                        }else{
                                                            echo '<a href="doc_info.php?dp_id='. $row['dp_id'] .'" class="badge badge-info"> Available </a>';
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo $row['student_id']; ?></td>
                                                <td><?php echo $row['student_name']; ?></td>

                                                
                                                <?php if(isset($_SESSION["faculty"])==true): ?>
                                                <td>
                                                    <?php 
                                                        if ($row['student_department_status']==0){
                                                            echo 'In progress'; 
                                                        }elseif($row['student_department_status']==1){
                                                            echo '<label class="badge badge-success">Approved</label>';
                                                        }
                                                        else{
                                                            echo '<label class="badge badge-danger">Rejected</label>';
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        if ($row['faculty_status']==0){
                                                            echo '<a class="btn btn-outline-success pt-1 pb-1" href="../backend/DB_update.php?dp_id=' . $row['dp_id'] .'&status=1">Approve</a>    ';
                                                            echo '<a class="btn btn-outline-danger pt-1 pb-1" href="../backend/DB_update.php?dp_id=' . $row['dp_id'] . '&status=2">Reject</a>';
                                                        }elseif($row['faculty_status']==1){
                                                            echo '<label class="badge badge-success">Approved</label>';
                                                        }
                                                        else{
                                                            echo '<label class="badge badge-danger">Rejected</label>';
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        if ($row['admin_status']==0){
                                                            echo '<div class="badge badge-warning">In progress</div>';
                                                        }elseif($row['admin_status']==1){
                                                            echo '<label class="badge badge-success">Approved</label>';
                                                        }
                                                        else{
                                                            echo '<label class="badge badge-danger">Rejected</label>';
                                                        }
                                                    ?>
                                                </td>
                                                <?php endif;?>
                                        </tr>
                                        <?php
                                        endforeach;
                                    endif;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            endif;
            ?>

            <?php 
                if (isset($_SESSION['department']) == true) : 
                    $obj = new Get();
                    $obj->user_id = $_SESSION['department'];
                    $obj->doc_id = $_GET['id'];
                    $result_dpd  = $obj->documentProcessDepartment();
            ?>

                
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">View
                                Complaint</h4>
                            <p class="card-description">
                                List of <code>Complaints</code>
                            </p>
                            <div class="table-responsive">
                                <table class="table table-hover" id="table_data">
                                    <thead>
                                        <tr>
                                            <th>Processing ID</th>
                                            <th>Document Name</th>
                                            <th>Document Description</th>
                                            <th>Student ID</th>
                                            <th>Student Name</th>
                                            <th>Department Status</th>
                                            <?php if($_GET['id']=="lor1"): ?>
                                            <th>Faculty Status</th>
                                            <?php endif;?>
                                            <th>Admin Status</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php
                                        if ($result_dpd->num_rows > 0) :
                                            foreach ($result_dpd as $row) :
                                        ?>
                                        <tr>
                                                <td><?php echo $row['dp_id']; ?></td>
                                                <td><?php echo $row['doc_name']; ?></td>
                                                <td>
                                                    <?php 
                                                        if($row['doc_desc']=="" || $row['doc_desc']==null){
                                                            echo "No description required";
                                                        }else{
                                                            echo '<a href="doc_info.php?dp_id='. $row['dp_id'] .'&id='.$_GET['id'].'" class="badge badge-info"> Available </a>';
                                                        }
                                                    ?>
                                                </td>
                                                <td><?php echo $row['student_id']; ?></td>
                                                <td><?php echo $row['student_name']; ?></td>

                                                
                                                <td>
                                                    <?php 
                                                        if ($row['student_department_status']==0){
                                                            echo '<a class="btn btn-outline-success pt-1 pb-1" href="../backend/DB_update.php?dp_id=' . $row['dp_id'] .'&status=1&id='.$_GET['id'].'">Approve</a>    ';
                                                            echo '<a class="btn btn-outline-danger pt-1 pb-1" href="../backend/DB_update.php?dp_id=' . $row['dp_id'] . '&status=2&id='.$_GET['id'].'">Reject</a>';
                                                        }elseif($row['student_department_status']==1){
                                                            echo '<label class="badge badge-success">Approved</label>';
                                                        }
                                                        else{
                                                            echo '<label class="badge badge-danger">Rejected</label>';
                                                        }
                                                    ?>
                                                </td>

                                                <?php  if($row['faculty_id']!=null):?>
                                                <td>
                                                    <?php 
                                                        if($row['faculty_status']==null && $row['faculty_id']==null){
                                                            echo 'No action for faculty'; 
                                                        }
                                                        elseif ($row['faculty_status']==0){
                                                            echo '<label class="badge badge-warning">In progress</label>'; 
                                                        }elseif($row['faculty_status']==1){
                                                            echo '<label class="badge badge-success">Approved</label>';
                                                        }
                                                        else{
                                                            echo '<label class="badge badge-danger">Rejected</label>';
                                                        }
                                                    ?>
                                                </td>
                                                <?php endif; ?>

                                                <td>
                                                    <?php 
                                                        if ($row['admin_status']==0){
                                                            echo '<div class="badge badge-warning">In progress</div>';
                                                        }elseif($row['admin_status']==1){
                                                            echo '<label class="badge badge-success">Approved</label>';
                                                        }
                                                        else{
                                                            echo '<label class="badge badge-danger">Rejected</label>';
                                                        }
                                                    ?>
                                                </td>
                                        </tr>
                                        <?php
                                        endforeach;
                                    endif;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            

            <?php 
                if (isset($_SESSION['Admin']) == true) : 
                    $obj = new Get();
                    $obj->user_id = $_SESSION['Admin'];
                    $obj->doc_id = $_GET['id'];
                    $result_dpa  = $obj->documentProcessAdmin();

                    if ($result_dpa->num_rows > 0) {
                        foreach ($result_dpa as $row) {
                            if($row['faculty_status']==null){
                                $temp_status=1;
                            }
                        }
                    }
            ?>

                
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">View
                                Complaint</h4>
                            <p class="card-description">
                                List of <code>Complaints</code>
                            </p>
                            <div class="table-responsive">
                                <table class="table table-hover" id="table_data">
                                    <thead>
                                        <tr>
                                            <!-- <th>Processing ID</th> -->
                                            <th>Document Name</th>
                                            <?php if($_GET['id']=="lor1"): ?>
                                            <th>Document Description</th>
                                            <?php endif;?>
                                            <th>Student ID</th>
                                            <th>Student Name</th>
                                            <th>Department Status</th>
                                            <?php if($_GET['id']=="lor1"): ?>
                                            <th>Faculty Status</th>
                                            <?php endif;?>
                                            <th>Admin Status</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php
                                        if ($result_dpa->num_rows > 0) :
                                            foreach ($result_dpa as $row) :
                                        ?>
                                        <tr>
                                                <!-- <td><?php echo $row['dp_id']; ?></td> -->
                                                
                                                <td><?php echo $row['doc_name']; ?></td>

                                                <?php if($row['doc_desc']!="" || $row['doc_desc']!=null):?>
                                                <td>
                                                    <?php 
                                                        echo '<a href="doc_info.php?dp_id='. $row['dp_id'] .'&id='.$_GET['id'].'" class="badge badge-info"> Available </a>';
                                                    ?>
                                                </td>
                                                <?php  endif;?>

                                                <td><?php echo $row['student_id']; ?></td>
                                                <td><?php echo $row['student_name']; ?></td>

                                                
                                                <td>
                                                    <?php 
                                                        if ($row['student_department_status']==0){
                                                            echo '<div class="badge badge-warning">In progress</div>';
                                                        }elseif($row['student_department_status']==1){
                                                            echo '<label class="badge badge-success">Approved</label>';
                                                        }
                                                        else{
                                                            echo '<label class="badge badge-danger">Rejected</label>';
                                                        }
                                                    ?>
                                                </td>
                                                <?php  if($row['faculty_id']!=null):?>
                                                <td>
                                                    <?php 
                                                   
                                                        if($row['faculty_status']==null && $row['faculty_id']==null){
                                                            echo 'No action for faculty'; 
                                                        }elseif ($row['faculty_status']==0){
                                                            echo '<label class="badge badge-warning">In progress</label>'; 
                                                        }
                                                        elseif($row['faculty_status']==1){
                                                            echo '<label class="badge badge-success">Approved</label>';
                                                        }
                                                        else{
                                                            echo '<label class="badge badge-danger">Rejected</label>';
                                                        }
                                                    ?>
                                                </td>
                                                <?php endif; ?>
                                                <td>
                                                    <?php 
                                                        
                                                        if($row['admin_status']==0 && $row['student_department_status']==1 && $row['faculty_id']==null){
                                                            echo '<a class="btn btn-outline-success pt-1 pb-1" href="../backend/DB_update.php?dp_id=' . $row['dp_id'] .'&status=1&student_id='.$row['student_id'].'&doc_id='.$row['doc_id'].'&id='.$_GET['id'].'">Approve</a>    ';
                                                            echo '<a class="btn btn-outline-danger pt-1 pb-1" href="../backend/DB_update.php?dp_id=' . $row['dp_id'] . '&status=2&id='.$_GET['id'].'">Reject</a>';
                                                        }
                                                        elseif ($row['admin_status']==0 && $row['student_department_status']==1 && $row['faculty_status']==1 ){
                                                            echo '<a class="btn btn-outline-success pt-1 pb-1" href="../backend/DB_update.php?dp_id=' . $row['dp_id'] .'&status=1&student_id='.$row['student_id'].'&doc_id='.$row['doc_id'].'&id='.$_GET['id'].'">Approve</a>    ';
                                                            echo '<a class="btn btn-outline-danger pt-1 pb-1" href="../backend/DB_update.php?dp_id=' . $row['dp_id'] . '&status=2&id='.$_GET['id'].'">Reject</a>';
                                                        }
                                                        elseif($row['admin_status']==0 ){
                                                            echo '<label class="badge badge-warning">In progress</label>';     
                                                        }
                                                        elseif ($row['admin_status']==1 ){
                                                            echo '<label class="badge badge-success">Approved</label>'; 
                                                        }
                                                        elseif ($row['admin_status']==2 ){
                                                            echo '<label class="badge badge-danger">Rejected</label>';
                                                        }
                                                    ?>
                                                </td>
                                        </tr>
                                        <?php
                                        endforeach;
                                    endif;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>


            <?php 
                if (isset($_SESSION['student']) == true) : 
                    $obj = new Get();
                    $obj->user_id = $_SESSION['student'];
                    $result_dps = $obj->documentProcessStudent();
            ?>


            <div class="col-md-12 grid-margin">
                <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Generate Certificate</h3>
                    <h6>Select Format for event</h6>
                </div>
                </div>
            </div>

            <?php

                if ($result_dps->num_rows > 0) :
                    foreach ($result_dps as $row) :
            ?>

            <div class="col-md-2 grid-margin stretch-card">
                <div class="card">
                    <a <?php 
                    if($row['doc_path']==null || $row['doc_path']==""){
                        echo "onclick='notGenerated()'";
                    }
                    else{
                        echo "href='".$row['doc_path']."'";
                    }?>><img src="../images/pdfSample.png" alt="Avatar" style="width:100%"></a>
                    <div class="container">
                        <div class="row">
                            <div class="col-9 stretch-card">
                                <b><?php echo $row['doc_name'];?></b>
                            </div>
                            <div class="col-3">
                                
                                <?php echo '<a class="actionBtnPrimary" href="doc_info.php?dp_id='. $row['dp_id'] .'"><i class="mdi mdi-eye"></i></a>'; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
                    endforeach;
                endif;
            ?>


            <!-- <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">View
                                Complaint</h4>
                            <p class="card-description">
                                List of <code>Complaints</code>
                            </p>
                            <div class="table-responsive">
                                <table class="table table-hover" id="table_data">
                                    <thead>
                                        <tr>
                                            <th>Document Name</th>
                                            <th>Document Description</th>
                                            <th>Department Status</th>
                                            <th>Faculty Status</th>
                                            <th>Admin Status</th>
                                            <th>File</th>
                                            
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php
                                        if ($result_dps->num_rows > 0) :
                                            foreach ($result_dps as $row) :
                                        ?>
                                        <tr>
                                                <td><?php echo $row['doc_name']; ?></td>
                                                <td class="tdDescription">
                                                    <?php 
                                                        if($row['doc_desc']=="" || $row['doc_desc']==null){
                                                            echo "No description required";
                                                        }else{
                                                            echo '<a href="doc_info.php?dp_id='. $row['dp_id'] .'" class="badge badge-info"> Available </a>';
                                                        }
                                                    ?>
                                            
                                                </td>
                                                
                                                <td>
                                                    <?php 
                                                        if ($row['student_department_status']==0){
                                                            echo '<div class="badge badge-warning">In progress</div>';
                                                        }elseif($row['student_department_status']==1){
                                                            echo '<label class="badge badge-success">Approved</label>';
                                                        }
                                                        else{
                                                            echo '<label class="badge badge-danger">Rejected</label>';
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        if($row['faculty_status']==null && $row['faculty_id']==null){
                                                            echo 'No action for faculty'; 
                                                        }elseif ($row['faculty_status']==0){
                                                            echo '<label class="badge badge-warning">In progress</label>'; 
                                                        }elseif($row['faculty_status']==1){
                                                            echo '<label class="badge badge-success">Approved</label>';
                                                        }
                                                        else{
                                                            echo '<label class="badge badge-danger">Rejected</label>';
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        if ($row['admin_status']==0){
                                                            echo '<label class="badge badge-warning">In progress</label>'; 
                                                        }elseif($row['admin_status']==1){
                                                            echo '<label class="badge badge-success">Approved</label>';
                                                        }
                                                        else{
                                                            echo '<label class="badge badge-danger">Rejected</label>';
                                                        }
                                                    ?>
                                                </td>
                                                
                                                <td>
                                                    <?php 
                                                        if($row['doc_path']!=null && $row['print_type']=="SOFT"){
                                                            echo '<a href="'.$row['doc_path'].'" class="badge badge-primary"> View </a>';
                                                        }
                                                        elseif($row['doc_path']!=null && $row['print_type']=="HARD"){
                                                            echo '<label class="badge badge-light">Visit Department</label>';
                                                        }
                                                        else{
                                                            echo '<label class="badge badge-warning">Not Generated</label>';
                                                        }
                                                    ?>
                                                </td>
                                        </tr>
                                        <?php
                                        endforeach;
                                    endif;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div> -->
            <?php endif; ?>

            <?php 
                if (isset($_SESSION['aditya']) == true) : 
                    $obj = new Get();
                    $obj->print_type = "HARD";
                    $result_dps = $obj->GetDecByPrintType();
            ?>

                
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">View
                                Complaint</h4>
                            <p class="card-description">
                                List of <code>Complaints</code>
                            </p>
                            <div class="table-responsive">
                                <table class="table table-hover" id="table_data">
                                    <thead>
                                        <tr>
                                            <th>Document Name</th>
                                            <th>Document Description</th>
                                            <th>Department Status</th>
                                            <th>Faculty Status</th>
                                            <th>Admin Status</th>
                                            <th>File</th>
                                            
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php
                                        if ($result_dps->num_rows > 0) :
                                            foreach ($result_dps as $row) :
                                        ?>
                                        <tr>
                                                <td><?php echo $row['doc_name']; ?></td>
                                                <td class="tdDescription">
                                                    <?php 
                                                        if($row['doc_desc']=="" || $row['doc_desc']==null){
                                                            echo "No description required";
                                                        }else{
                                                            echo '<a href="doc_info.php?dp_id='. $row['dp_id'] .'" class="badge badge-info"> Available </a>';
                                                        }
                                                    ?>
                                            
                                                </td>
                                                
                                                <td>
                                                    <?php 
                                                        if ($row['Student_department_status']==0){
                                                            echo '<div class="badge badge-warning">In progress</div>';
                                                        }elseif($row['Student_department_status']==1){
                                                            echo '<label class="badge badge-success">Approved</label>';
                                                        }
                                                        else{
                                                            echo '<label class="badge badge-danger">Rejected</label>';
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        if($row['faculty_status']==null && $row['faculty_id']==null){
                                                            echo 'No action for faculty'; 
                                                        }elseif ($row['faculty_status']==0){
                                                            echo '<label class="badge badge-warning">In progress</label>'; 
                                                        }elseif($row['faculty_status']==1){
                                                            echo '<label class="badge badge-success">Approved</label>';
                                                        }
                                                        else{
                                                            echo '<label class="badge badge-danger">Rejected</label>';
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                        if ($row['admin_status']==0){
                                                            echo '<label class="badge badge-warning">In progress</label>'; 
                                                        }elseif($row['admin_status']==1){
                                                            echo '<label class="badge badge-success">Approved</label>';
                                                        }
                                                        else{
                                                            echo '<label class="badge badge-danger">Rejected</label>';
                                                        }
                                                    ?>
                                                </td>
                                                
                                                <td>
                                                    <?php 
                                                     if($row['doc_path']!=null){
                                                        echo '<a href="'.$row['doc_path'].'" class="badge badge-primary"> Print </a>';
                                                    }
                                                    else{
                                                        echo '<label class="badge badge-warning">Not Generated</label>';
                                                    }
                                                    ?>
                                                </td>
                                        </tr>
                                        <?php
                                        endforeach;
                                    endif;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>


        </div>  
    </div>
</div>

<!-- INCLUDE FOOTER -->
<?php include '../inc/footer.php'; ?>