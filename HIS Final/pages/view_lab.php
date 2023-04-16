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
                $result_lab = $obj->GetLab();
            ?>
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">View AMC Corporation</h4>
                            <p class="card-description">
                                <!-- List of <code>Lab</code> -->
                            </p>
                            <div class="table-responsive">
                                <table class="table table-hover" id="table_data">
                                    <thead>
                                        <tr>
                                            <th>AMC Department ID</th>
                                            <th>AMC Department Name</th>
                                            <th>Action</th> 
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if ($result_lab->num_rows > 0) :
                                            foreach ($result_lab as $row) :
                                        ?>
                                                <tr>
                                                    <td><?php echo $row['Lab_id']; ?></td>

                                                    <td><?php echo $row['Lab_name']; ?></td>

                                                    <td><?php echo '<a onclick="return cnfdel();" class="btn btn-outline-danger" href="../backend/DB_delete.php?lab_id='.$row['Lab_id'].'">Delete</a>'; ?></td>
                                                    

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
</div>
<!-- INCLUDE FOOTER -->
<?php include '../inc/footer.php'; ?>