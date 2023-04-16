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
                        <h4 class="card-title">Add User</h4>
                        <!-- <p class="card-description">
                            Upload the excel file to insert the data<br>
                            Download Sample Excel File 
                            <a class="links" href="../backend/download_sample.php?file=StudentSample">click here</a>
                        </p> -->

                        <form class="forms-sample" method="post" action="../backend/DB_insert.php?role=2" enctype="multipart/form-data">

                            <!-- LAB ID -->
                            <div class="form-group">
                                <label for="pc_no">User ID</label>
                                <input type="text" class="form-control" name="user_id" id="" placeholder="Enter User ID" required>
                            </div>
                            
                            <!-- LAB Name -->
                            <div class="form-group">
                                <label for="pc_no">User Name</label>
                                <input type="text" class="form-control" name="user_name" id="" placeholder="Enter User Name" required>
                            </div>

                            <div class="form-group">
                                <label for="pc_no">Password</label>
                                <input type="password" class="form-control" name="password" id="" placeholder="Enter User Password" required>
                            </div>


                            <div class="form-group">
                                <label for="pc_no">User Mobile Number</label>
                                <input type="text" class="form-control" name="mobile_number" id="" placeholder="Enter User Mobile Number" required>
                            </div>

                            <div class="form-group">
                                <label for="pc_no">User Email ID</label>
                                <input type="email" class="form-control" name="email" id="" placeholder="Enter User Email" required>
                            </div>

                            

                            <!-- <div class="form-group">
                                <label>File upload</label>
                                <input type="file" name="document" class="file-upload-default" required>
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Document">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                    </span>
                                </div>
                            </div> -->

                        </form>


                            <!-- Submit Button-->
                            <button type="submit" class="btn btn-primary mr-2" name="add_student1">Submit</button>
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
    