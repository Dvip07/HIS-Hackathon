<!-- INCLUDE HEADER -->
<?php include '../inc/header.php'; ?>

<!-- INCLUDE SIDEBAR -->
<?php include '../inc/sidebar.php'; ?>

<!-- INCLUDE  -->
<?php
require_once("../backend/cls_select.php");
?>

<!-- Student List Complaints -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <?php
            if (isset($_SESSION['Admin']) == true) :
                $obj = new Get();
                $obj->role = $_GET['role'];
                $result_user  = $obj->GetUser();
            ?>
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">View Users</h4>
                            <p class="card-description">
                                List of <code>Users</code>
                            </p>
                            <div class="table-responsive">
                                <table class="table table-hover" id="table_data">
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>User Name</th>
                                            <th>Mobile Number</th>
                                            <th>Email ID</th>
                                            <th>Action</th>
                                            <th>User status (Inactive)</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if ($result_user->num_rows > 0) :
                                            foreach ($result_user as $row) :
                                        ?>
                                                <tr>
                                                    <td><?php echo $row['user_id']; ?></td>

                                                    <td><?php echo $row['name']; ?></td>

                                                    <td><?php echo $row['mobile_number']; ?></td>

                                                    <td><?php echo $row['email']; ?></td>

                                                    <td><?php echo '<a onclick="return cnfdel();" class="actionBtn" href="../backend/DB_delete.php?suser_id='.$row['user_id'].'"><i class="mdi mdi-delete-forever"></i></a>'; ?></td>

                                                    <td>
                                                        <?php 
                                                        if($row['user_status']==0){
                                                            echo '<a onclick="return cnfdel();" class="btn btn-success btn-rounded btn-fw" href="../backend/DB_update.php?active_user_id='.$row['user_id'].'&role=2">Active</a>';
                                                        }
                                                        elseif($row['user_status']==1){
                                                             
                                                            echo '<a onclick="return cnfdel();" class="btn btn-danger btn-rounded btn-fw" href="../backend/DB_update.php?inactive_user_id='.$row['user_id'].'&role=2">Inactive</a>'; 
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
            <?php
            endif;
            ?>
        </div>

        
    </div>
</div>
<!-- INCLUDE FOOTER -->
<?php include '../inc/footer.php'; ?>