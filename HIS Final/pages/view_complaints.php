<!-- INCLUDE HEADER -->
<?php include '../inc/header.php'; ?>

<!-- INCLUDE SIDEBAR -->
<?php include '../inc/sidebar.php'; ?>

<!-- INCLUDE  -->
<?php require_once("../backend/cls_select.php"); ?>

<!-- Student List Complaints -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <?php
            if (isset($_SESSION['student']) == true) :
                $obj = new GetComplaint();
                $obj->id = $_SESSION['student'];
                $obj->cat_type = $_GET['cat_type'];
                $result_complaint  = $obj->ComplaintGetStudentByType();
            ?>
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">View
                                <?php
                                if ($_GET['cat_type'] == 0) {
                                    echo "Lab";
                                } elseif ($_GET['cat_type'] == 1) {
                                    echo "Class";
                                } elseif ($_GET['cat_type'] == 2) {
                                    echo "Library";
                                }
                                ?>
                                Complaint</h4>
                            <p class="card-description">
                                List of <code>Complaints</code>
                            </p>
                            <div class="table-responsive">
                                <table class="table table-hover" id="table_data">
                                    <thead>
                                        <tr>
                                            <th>Complaint ID</th>
                                            
                                            <th>
                                                <?php
                                                if ($_GET['cat_type'] == 0) {
                                                    echo "Lab";
                                                } elseif ($_GET['cat_type'] == 1) {
                                                    echo "Class";
                                                } elseif ($_GET['cat_type'] == 2) {
                                                    echo "Library";
                                                }
                                                ?>
                                                Number</th>
                                            <th>Complaint Type</th>
                                            <th>Complaint Description</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if ($result_complaint->num_rows > 0) :
                                            foreach ($result_complaint as $row) :
                                        ?>
                                                <tr>
                                                    <td><?php echo $row['complaint_id']; ?></td>

                                                    <?php if ($row['err_id'] != null) : ?>
                                                        <td><?php echo $row['err_id']; ?></td>
                                                    <?php endif; ?>
                                                    <td><?php echo $row['cat_no']; ?></td>

                                                    <td>
                                                        <?php
                                                        if ($row['complaint_type'] == "ClsEleP") {
                                                            echo "Electrical Problem in class room";
                                                        } elseif ($row['complaint_type'] == "ClsEnP") {
                                                            echo "Environment Problem in class room";
                                                        } elseif ($row['complaint_type'] == "LibEleP") {
                                                            echo "Electrical Problem in Library";
                                                        } elseif ($row['complaint_type'] == "LibEnP") {
                                                            echo "Environment Problem in Library";
                                                        } else {
                                                            echo $row['complaint_type'];
                                                        }
                                                        ?>
                                                    </td>

                                                    <td><?php echo $row['complaint_desc']; ?></td>

                                                    <td>
                                                        <?php
                                                        if ($row['status'] == 0) {
                                                            echo '<label class="badge badge-danger">Pending</label>';
                                                        } elseif ($row['status'] == 1) {
                                                            echo '<label class="badge badge-warning">In progress</label>';
                                                        } elseif ($row['status'] == 2) {
                                                            echo '<label class="badge badge-success">Compeleted</label>';
                                                        }

                                                        ?>
                                                    </td>

                                                    <td><?php echo '<a onclick="return cnfdel();" class="btn btn-outline-danger" href="../backend/DB_delete.php?complaint_id=' . $row['complaint_id'] . '&cat_type=' . $_GET['cat_type'] . '">Delete</a>'; ?></td>
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

        <!-- Admin List Complaints -->
        <div class="row">
            <?php
            if (isset($_SESSION['Admin']) == true || isset($_SESSION['manager'])) :
                $obj = new GetComplaint();
                $obj->cat_type = $_GET['cat_type'];
                $result_complaint  = $obj->ComplaintGetByType();
            ?>
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">View
                                <?php
                                if ($_GET['cat_type'] == 0) {
                                    echo "Lab Complaint";
                                } elseif ($_GET['cat_type'] == 1) {
                                    echo "Class Complaints";
                                } elseif ($_GET['cat_type'] == 2) {
                                    echo "Library Complaints";
                                } elseif ($_GET['cat_type'] == 3) {
                                    echo "Campus Complaints";
                                }
                                ?>
                            </h4>
                            <p class="card-description">
                                List of <code>
                                    <?php
                                    if ($_GET['cat_type'] == 0) {
                                        echo "Lab Complaints";
                                    } elseif ($_GET['cat_type'] == 1) {
                                        echo "Class Complaints";
                                    } elseif ($_GET['cat_type'] == 2) {
                                        echo "Library Complaints";
                                    } elseif ($_GET['cat_type'] == 3) {
                                        echo "Campus Complaints";
                                    }
                                    ?>
                                </code>
                            </p>
                            <div class="table-responsive">
                                <table class="table table-hover" id="table_data">
                                    <thead>
                                        <tr>
                                            <th>Complaint ID</th>
                                            <th>User ID</th>
                                            <!-- <th>
                                                <?php
                                                // if ($_GET['cat_type'] == 0) {
                                                //     echo "IP";
                                                // } else {
                                                //     echo "Registration";
                                                // }
                                                ?>
                                                Address</th>
                                            <th> -->
                                                <?php
                                                if ($_GET['cat_type'] == 0) {
                                                    echo "Lab";
                                                } elseif ($_GET['cat_type'] == 1) {
                                                    echo "Class";
                                                } elseif ($_GET['cat_type'] == 2) {
                                                    echo "Library";
                                                }
                                                ?>Number</th>
                                            <th>Complaint Description</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Status</th>
                                            <?php
                                            if (isset($_SESSION['Admin']) == true) :
                                            ?>
                                                <th>Action</th>
                                            <?php
                                            endif;
                                            ?>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if ($result_complaint->num_rows > 0) :
                                            foreach ($result_complaint as $row) :
                                        ?>
                                                <tr>
                                                    <td><?php echo $row['complaint_id']; ?></td>

                                                    <td><?php echo $row['user_id']; ?></td>

                                                    <td width="10px"><?php echo $row['complaint_desc']; ?></td>

                                                    <!-- <td ><div style="word-wrap: normal; width: 100px; border: 2px solid red;"><?php echo $row['complaint_desc']; ?></div></td> -->

                                                    <td><?php echo $row['date']; ?></td>

                                                    <td><?php echo $row['time']; ?></td>


                                                    <td>
                                                        <?php
                                                        if (isset($_SESSION['manager']) == true) {
                                                            if ($row['status'] == 0) {
                                                                echo '<a class="badge badge-danger" href="../pages/change_status.php?complaint_id=' . $row['complaint_id'] . '&status=' . $row['status'] . '&cat_type='.$_GET['cat_type'].'">Pending</a>';
                                                            } elseif ($row['status'] == 1) {
                                                                echo '<a class="badge badge-warning" href="../pages/change_status.php?complaint_id=' . $row['complaint_id'] . '&status=' . $row['status'] . '&cat_type='.$_GET['cat_type'].'">In progress</a>';
                                                            } elseif ($row['status'] == 2) {
                                                                echo '<label class="badge badge-success">Compeleted</label>';
                                                            }
                                                        } elseif (isset($_SESSION['Admin']) == true) {
                                                            if ($row['status'] == 0) {
                                                                echo '<label class="badge badge-danger">Pending</label>';
                                                            } elseif ($row['status'] == 1) {
                                                                echo '<label class="badge badge-warning">In progress</label>';
                                                            } elseif ($row['status'] == 2) {
                                                                echo '<label class="badge badge-success">Compeleted</label>';
                                                            }
                                                        }

                                                        ?>
                                                    </td>
                                                    <?php
                                                    if (isset($_SESSION['Admin']) == true) :
                                                    ?>
                                                        <td><?php echo '<a onclick="return cnfdel();" class="btn btn-outline-danger" href="../backend/DB_delete.php?complaint_id=' . $row['complaint_id'] . '&cat_type=' . $_GET['cat_type'] . '">Delete</a>'; ?></td>
                                                    <?php
                                                    endif;
                                                    ?>
                                                </tr>
                                        <?php
                                            endforeach;
                                        endif;
                                        ?>


                                    </tbody>
                                </table>

                            </div>
                            <?php
                            echo '<a class="btn btn-inverse-primary btn-sm" name="" href="../pages/pdf_download.php?ct=' . $_GET['cat_type'] . '&status=' . 0 . '">Download PDF (Pending)</a>';
                            echo '<a class="btn btn-inverse-primary btn-sm ml-3" name="" href="../pages/pdf_download.php?ct=' . $_GET['cat_type'] . '&status=' . 1 . '">Download PDF (In Progress)</a>';
                            echo '<a class="btn btn-inverse-primary btn-sm ml-3" name="" href="../pages/pdf_download.php?ct=' . $_GET['cat_type'] . '&status=' . 2 . '">Download PDF (Completed)</a>';
                            ?>
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