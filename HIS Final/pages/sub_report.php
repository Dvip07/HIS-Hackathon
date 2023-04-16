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
            if (isset($_SESSION['Admin']) == true || isset($_SESSION['manager'])) :
                $obj = new GetComplaint();
                date_default_timezone_set("Asia/Calcutta");

                if ($_GET['type'] == "1") {
                    $sDate = date("Y-m-d", strtotime("-7 days"));
                    $eDate = date("Y-m-d");
                    $obj->sDate = $sDate;
                    $obj->eDate = $eDate;
                } elseif ($_GET['type'] == "2") {
                    $sDate = date("Y-m-d", strtotime("-1 month"));
                    $eDate = date("Y-m-d");
                    $obj->sDate = $sDate;
                    $obj->eDate = $eDate;
                } elseif ($_GET['type'] == "3") {
                    $sDate = date("Y-m-d", strtotime("-1 year"));
                    $eDate = date("Y-m-d");
                    $obj->sDate = $sDate;
                    $obj->eDate = $eDate;
                }

                $result_complaint  = $obj->ComplaintGetByDate();
            ?>
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Generate Report
                                <?php
                                if ($_GET['type'] == "1") {
                                    echo "(This Week)";
                                } elseif ($_GET['type'] == "2") {
                                    echo "(This Month)";
                                } elseif ($_GET['type'] == "3") {
                                    echo "(This Year)";
                                }
                                ?>
                            </h4>
                            <p class="card-description">
                                Order By :
                                <a class="links" href="../pages/report.php">Select</a> /
                                <a class="links" href="../pages/sub_report.php?type=1">This Week</a> /
                                <a class="links" href="../pages/sub_report.php?type=2">This Month</a> /
                                <a class="links" href="../pages/sub_report.php?type=3">This Year</a>
                            </p>
                            <div class="table-responsive">
                                <table class="table table-hover" id="table_data">
                                    <thead>
                                        <tr>
                                            <th>Complaint ID</th>
                                            <th>User ID</th>
                                            <th>PC ID</th>
                                            <th>Lab Number</th>
                                            <th>Complaint Type</th>
                                            <th>Complaint Description</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Status</th>
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

                                                    <td><?php echo $row['err_id']; ?></td>

                                                    <td><?php echo $row['cat_no']; ?></td>

                                                    <td><?php echo $row['complaint_type']; ?></td>

                                                    <td><?php echo $row['complaint_desc']; ?></td>

                                                    <td><?php echo $row['date']; ?></td>

                                                    <td><?php echo $row['time']; ?></td>

                                                    <td>
                                                        <?php
                                                        if (isset($_SESSION['manager']) == true) {
                                                            if ($row['status'] == 0) {
                                                                echo '<a class="badge badge-danger" href="../pages/change_status.php?complaint_id=' . $row['complaint_id'] . '">Pending</a>';
                                                            } elseif ($row['status'] == 1) {
                                                                echo '<a class="badge badge-warning" href="../pages/change_status.php?complaint_id=' . $row['complaint_id'] . '">In progress</a>';
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
                                                    
                                                </tr>
                                        <?php
                                            endforeach;
                                        endif;
                                        ?>


                                    </tbody>
                                </table>
                                <?php
                                if (isset($_SESSION['Admin']) == true) {
                                    echo '<a class="btn btn-inverse-primary btn-sm" name="" href="../pages/pdf_download.php?sDate=' . $sDate . '&eDate=' . $eDate . '">Download PDF</a>';
                                }
                                ?>
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