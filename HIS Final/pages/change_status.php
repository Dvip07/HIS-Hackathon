<!-- INCLUDE HEADER -->
<?php include '../inc/header.php'; ?>

<!-- INCLUDE SIDEBAR -->
<?php include '../inc/sidebar.php'; ?>

<?php
if (isset($_GET['complaint_id']) && isset($_GET['status']) ) {
    $_SESSION['complaint_id'] = $_GET['complaint_id'];
    $_SESSION['status'] = $_GET['status'];
}
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-2">
            </div>
            <div class="col-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Complaint Status</h4>
                        <p class="card-description">
                            Select the status
                        </p>

                        <form class="forms-sample" method="POST" action="../backend/DB_update.php?cat_type=<?php echo $_GET['cat_type']; ?>" enctype="multipart/form-data">

                            <!-- Lab Number -->
                            <div class="form-group">
                                <label for="status">Select complaint Status</label>
                                <select class="form-control" id="status" name="status" required>
                                    <option default selected disabled>---- SELECT LAB NUMBER ----</option>

                                    <?php
                                    if ($_SESSION['status']  == 0) {
                                        echo '
                                        <option value="1">Set as In progess</option>
                                        <option value="2">Set as Completed</option>
                                        ';
                                    } else if ($_SESSION['status']  == 1) {
                                        echo '
                                        <option value="2">Set as Completed</option>
                                        ';
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Submit Button-->
                            <button type="submit" class="btn btn-primary mr-2" name="change_status">Submit</button>
                            <button type="reset" class="btn btn-light">Reset</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- INCLUDE FOOTER -->
<?php include '../inc/footer.php'; ?>