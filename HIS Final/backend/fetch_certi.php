
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
                        <br>
                        <h4 class="card-title">Add Certificate</h4>
                        <p class="card-description">
                            Upload the excel file to insert the data<br>
                            Download Sample Execl File 
                            <a class="links" href="../backend/download_sample.php?file=CertiSample">click here</a>
                        </p>

                        <form class="forms-sample" method="post" action="../backend/DB_insert.php" enctype="multipart/form-data">
                            
                                <div class="form-group">
                                    <label>Upload Student Details</label>
                                    <input type="file" name="document_certi_details" class="file-upload-default" required>
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Document">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="certi_date">Date</label>
                                    <input type="date"  class="form-control" name="certi_date" id="certi_date" placeholder="">
                                </div>

                                <div class="form-group" hidden>
                                    <label for="certi_id">Date</label>
                                    <input type="number"  class="form-control" name="certi_id" value='<?php echo $_GET['certi_id'] ?>' id="certi_id" placeholder="">
                                </div>


                            <!-- Submit Button-->
                            <button type="submit" class="btn btn-primary mr-2" name="gen_certificate">Submit</button>
                            <button type="reset" class="btn btn-light">Reset</button>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-1"></div>
            <div class="col-1">
                <h6><a href="../pages/create_certificate.php" type="button" class="btn btn-inverse-primary btn-sm">Go Back</a></h6>
            </div>
        </div>
    </div>
</div>

<!-- INCLUDE FOOTER -->
<?php include '../inc/footer.php'; ?>