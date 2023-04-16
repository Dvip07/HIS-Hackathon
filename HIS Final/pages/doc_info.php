<?php include '../inc/header.php'; ?>

<!-- INCLUDE SIDEBAR -->
<?php include '../inc/sidebar.php'; ?>

<!-- INCLUDE  -->
<?php require_once("../backend/cls_select.php"); ?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <?php
                $obj = new Get();
                $obj->dp_id = $_GET['dp_id'];
                $result_dps = $obj->GetDocProcessById();

              
                ?>
                        <div class="card">



                            <div class="col-md-12 grid-margin stretch-card">
                                <div class="card-body">
                                    <br>
                                    <div class="row">
                                        <div class="col-11">
                                            <h4 class="card-title">Document Details</h4>
                                        </div>
                                        <div class="col-1">
                                            <?php if(isset($_SESSION['student'])==false && isset($_SESSION['faculty'])==false): ?>
                                            <h6><a href="../pages/view_doc_request.php?id=<?php echo $_GET['id'] ?>" class="btn btn-inverse-primary btn-sm">Go Back</a></h6>
                                            <?php endif; ?>

                                            <?php if(isset($_SESSION['student'])==true || isset($_SESSION['faculty'])==true): ?>
                                            <h6><a href="../pages/view_doc_request.php" class="btn btn-inverse-primary btn-sm">Go Back</a></h6>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    

                                    <?php
                                        if ($result_dps->num_rows > 0) :
                                            foreach ($result_dps as $row) : 
                                    ?>

                                    <div class="row">
                                        <div class="col-md-3 ">
                                            <div class="card-body">
                                                <p class="card-description">
                                                    Document Process Id
                                                </p>
                                                <p>
                                                    <?php echo $row['dp_id']; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ">
                                            <div class="card-body">
                                                <p class="card-description">
                                                    Student Name
                                                </p>
                                                <p>
                                                    <?php echo $row['student_name']; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-3 ">
                                            <div class="card-body">
                                                <p class="card-description">
                                                    Student Id
                                                </p>
                                                <p>
                                                    <?php echo $row['student_id']; ?>
                                                </p>
                                            </div>
                                        </div> 
                                        <div class="col-md-3 ">
                                            <div class="card-body">
                                                <p class="card-description">
                                                    Document Name
                                                </p>
                                                <p>
                                                    <?php echo $row['doc_name']; ?>
                                                </p>
                                            </div>
                                        </div>  
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <div class="card-body">
                                                <p class="card-description">
                                                    Document Description
                                                </p>
                                                <p>
                                                    <?php
                                                        if($row['doc_desc']==null || $row['doc_desc']==""){
                                                            echo "No description";
                                                        }else{
                                                            echo $row['doc_desc'];
                                                        }
                                                    
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <?php if(isset($_SESSION['Admin']) == true): ?>
                                    <div class="row">
                                        <div class="col-md-4 ">
                                            <div class="card-body">
                                                <p class="card-description">
                                                    Student Section Status
                                                </p>
                                                <p>
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
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 ">
                                            <div class="card-body">
                                                <p class="card-description">
                                                    Faculty Status
                                                </p>
                                                <p>
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
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 ">
                                            <div class="card-body">
                                                <p class="card-description">
                                                    Institute Status
                                                </p>
                                                <p>
                                                    <?php 
                                                         if($row['admin_status']==0 && $row['Student_department_status']==1 && $row['faculty_id']==null){
                                                            echo '<a class="btn btn-outline-success pt-1 pb-1" href="../backend/DB_update.php?dp_id=' . $row['dp_id'] .'&status=1&student_id='.$row['student_id'].'">Approve</a>    ';
                                                            echo '<a class="btn btn-outline-danger pt-1 pb-1" href="../backend/DB_update.php?dp_id=' . $row['dp_id'] . '&status=2">Reject</a>';
                                                        }
                                                        elseif ($row['admin_status']==0 && $row['Student_department_status']==1 && $row['faculty_status']==1 ){
                                                            echo '<a class="btn btn-outline-success pt-1 pb-1" href="../backend/DB_update.php?dp_id=' . $row['dp_id'] .'&status=1&student_id='.$row['student_id'].'">Approve</a>    ';
                                                            echo '<a class="btn btn-outline-danger pt-1 pb-1" href="../backend/DB_update.php?dp_id=' . $row['dp_id'] . '&status=2">Reject</a>';
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
                                                </p>
                                            </div>
                                        </div> 
                                    </div>
                                    <?php endif;?>


                                    <?php if(isset($_SESSION['faculty']) == true): ?>
                                    <div class="row">
                                        <div class="col-md-4 ">
                                            <div class="card-body">
                                                <p class="card-description">
                                                    Student Section Status
                                                </p>
                                                <p>
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
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-md-4 ">
                                            <div class="card-body">
                                                <p class="card-description">
                                                    Student Section Status
                                                </p>
                                                <p>
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
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-md-4 ">
                                            <div class="card-body">
                                                <p class="card-description">
                                                    Student Section Status
                                                </p>
                                                <p>
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
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif;?>




                                    <?php if(isset($_SESSION['department']) == true): ?>
                                    <div class="row">
                                        <div class="col-md-4 ">
                                            <div class="card-body">
                                                <p class="card-description">
                                                    Student Section Status
                                                </p>
                                                <p>
                                                    <?php 
                                                        if ($row['Student_department_status']==0){
                                                            echo '<a class="btn btn-outline-success pt-1 pb-1" href="../backend/DB_update.php?dp_id=' . $row['dp_id'] .'&status=1">Approve</a>    ';
                                                            echo '<a class="btn btn-outline-danger pt-1 pb-1" href="../backend/DB_update.php?dp_id=' . $row['dp_id'] . '&status=2">Reject</a>';
                                                        }elseif($row['Student_department_status']==1){
                                                            echo '<label class="badge badge-success">Approved</label>';
                                                        }
                                                        else{
                                                            echo '<label class="badge badge-danger">Rejected</label>';
                                                        }
                                                    ?>
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-md-4 ">
                                            <div class="card-body">
                                                <p class="card-description">
                                                    Student Section Status
                                                </p>
                                                <p>
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
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-md-4 ">
                                            <div class="card-body">
                                                <p class="card-description">
                                                    Student Section Status
                                                </p>
                                                <p>
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
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>


                                    <?php if(isset($_SESSION['student']) == true): ?>
                                    <div class="row">
                                        <div class="col-md-3 ">
                                            <div class="card-body">
                                                <p class="card-description">
                                                    Student Section Status
                                                </p>
                                                <p>
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
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-md-3 ">
                                            <div class="card-body">
                                                <p class="card-description">
                                                    Student Section Status
                                                </p>
                                                <p>
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
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-md-3 ">
                                            <div class="card-body">
                                                <p class="card-description">
                                                    Student Section Status
                                                </p>
                                                <p>
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
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-md-3 ">
                                            <div class="card-body">
                                                <p class="card-description">
                                                    Document
                                                </p>
                                                <p>
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
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>


                                    <?php if(isset($_SESSION['aditya']) == true): ?>
                                    <div class="row">
                                        <div class="col-md-3 ">
                                            <div class="card-body">
                                                <p class="card-description">
                                                    Student Section Status
                                                </p>
                                                <p>
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
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-md-3 ">
                                            <div class="card-body">
                                                <p class="card-description">
                                                    Student Section Status
                                                </p>
                                                <p>
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
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-md-3 ">
                                            <div class="card-body">
                                                <p class="card-description">
                                                    Student Section Status
                                                </p>
                                                <p>
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
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-md-3 ">
                                            <div class="card-body">
                                                <p class="card-description">
                                                    Document
                                                </p>
                                                <p>
                                                    <?php 
                                                        if($row['doc_path']!=null){
                                                            echo '<a href="'.$row['doc_path'].'" class="badge badge-primary"> Print </a>';
                                                        }
                                                        else{
                                                            echo '<label class="badge badge-warning">Not Generated</label>';
                                                        }
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>

                                    <?php
                                            endforeach;
                                        endif; 
                                        
                                    ?>
                                    


                                </div>
                            </div>
                            

                                    

                                   
                                </div>
                            </div>
                        </div>


               



            </div>
        </div>
    </div>
</div>

<!-- INCLUDE FOOTER -->
<?php include '../inc/footer.php'; ?>