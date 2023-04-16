<!-- INCLUDE HEADER -->
<?php include '../inc/header.php'; ?>

<!-- INCLUDE SIDEBAR -->
<?php include '../inc/sidebar.php'; ?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-2">
            </div>
            <div class="col-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Lab</h4>
                        <p class="card-description">
                            Fill the form to insert labs
                        </p>

                        <form class="forms-sample" method="post" action="../backend/DB_insert.php" enctype="multipart/form-data">

                            <!-- LAB ID -->
                            <div class="form-group">
                                <label for="pc_no">Lab ID</label>
                                <input type="text" class="form-control" name="lab_id" id="" placeholder="Enter Lab ID" required>
                            </div>

                            <!-- LAB Name -->
                            <div class="form-group">
                                <label for="pc_no">Lab Name</label>
                                <input type="text" class="form-control" name="lab_name" id="" placeholder="Enter Lab Name" required>
                            </div>

                            <!-- Submit Button-->
                            <button type="submit" class="btn btn-primary mr-2" name="add_lab">Submit</button>
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
