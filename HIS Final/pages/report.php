<!-- INCLUDE HEADER -->
<?php include '../inc/header.php'; ?>

<!-- INCLUDE SIDEBAR -->
<?php include '../inc/sidebar.php'; ?>

<?php require_once("../backend/cls_select.php"); ?>

<div class="main-panel">
    <div class="content-wrapper">

        <!-- Select Date Section -->
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Generate Report (By selecting Date)</h4>
                        <p class="card-description">

                            Select Dates from below ranges to Generate Report.

                            <a class="links" href="../pages/report.php">Select</a> /
                            <a class="links" href="../pages/sub_report.php?type=1">This Week</a> /
                            <a class="links" href="../pages/sub_report.php?type=2">This Month</a> /
                            <a class="links" href="../pages/sub_report.php?type=3">This Year</a>
                        </p>

                        <form class="forms-sample" method="post" action="../pages/report.php">

                            <!-- Range -->
                            <div class="row">
                                <!-- From -->
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="pc_no">From</label>
                                        <input type="date" class="form-control" name="from" id="from" required>
                                    </div>
                                </div>
                                <!-- to -->
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="pc_no">To</label>
                                        <input type="date" class="form-control" name="to" id="to" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button-->
                            <button type="submit" class="btn btn-primary mr-2" name="GenerateReportbtn">Submit</button>
                            <button type="reset" class="btn btn-light" id="resetbtn">Reset</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- View Report -->
        <div class="row">
            <?php
            if (isset($_POST['GenerateReportbtn'])) :
                if (isset($_SESSION['Admin']) == true || isset($_SESSION['manager']) == true) :

                    $sDate = $_POST['from'];
                    $eDate = $_POST['to'];

                    $obj = new GetComplaint();
                    $obj->sDate = $sDate;
                    $obj->eDate = $eDate;

                    $result_complaint  = $obj->ComplaintGetByDate();
            ?>
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">View Complaint</h4>
                                <?php
                                if ($result_complaint->num_rows > 0) :
                                ?>
                                    <p class="card-description">
                                        List of <code>Complaints</code>
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

                                                foreach ($result_complaint as $row) :
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row['complaint_id']; ?></td>

                                                        <td><?php echo $row['user_id']; ?></td>

                                                        <td>
                                                            <?php 
                                                            if($row['err_id']==null || $row['err_id']==""){
                                                                echo "N/A";
                                                            }else{
                                                                echo $row['err_id']; 
                                                            }
                                                            ?>
                                                    
                                                        </td>

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

                                            if ($result_complaint->num_rows == 0) :
                                                echo '<p class="card-description">
                                                Sorry,<code> No Records Found,  Please Select Valid Date Range!</code>
                                            </p>';
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
            endif;
            ?>

        </div>
    </div>
</div>

<!-- INCLUDE FOOTER -->
<?php include '../inc/footer.php'; ?>