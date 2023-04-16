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
                            <h4 class="card-title">Smart Street Light</h4>
                            <p class="card-description">
                                List of <code>Street Lights</code>
                            </p>
                            <div class="table-responsive">
                                <table class="table table-hover" id="table_data">
                                    <thead>
                                        <tr>
                                            <th>Light_ID</th>
                                            <th>Street light name</th>
                                            <th>Location</th>
                                            <th>SL_description</th>
                                            <th>SL_Smergency</th>
                                            <th>SL_status</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if ($result_user->num_rows > 0) :
                                            foreach ($result_user as $row) :
                                        ?>
                                                <tr>
                                                    <td>SL_0001</td>

                                                    <td>Street Light 0001</td>

                                                    <td>Rajasthan</td>

                                                    <td>Main Light</td>

                                                    <td>NO</td>

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