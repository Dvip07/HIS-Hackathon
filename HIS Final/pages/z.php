<!-- INCLUDE HEADER -->
<?php include '../inc/header.php'; ?>

<!-- INCLUDE SIDEBAR -->
<?php include '../inc/sidebar.php'; ?>

<?php require_once("../backend/cls_select.php"); ?>

<div class="main-panel">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-2 grid-margin stretch-card">
            </div>
            <div class="col-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add 100 Point Activity Certificate</h4>
                        <p class="card-description">
                            Upload jpg/png it's necessary<br>
                        </p>

                        <?php
                        $obj = new Get();
                        $resultCatHead = $obj->GetActivityCat();
                        ?>

                        <form class="forms-sample" method="post" action="../backend/DB_insert.php" enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="major_cat">Major Category</label>
                                <select class="form-control" id="major_cat" name="major_cat">
                                    <option default selected disabled>---- SELECT Major Category ----</option>
                                    <?php
                                    if ($resultCatHead->num_rows > 0) :
                                        foreach ($resultCatHead as $row) :
                                    ?>
                                            <option><?php echo $row['activityCatHead']; ?></option>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </select>
                            </div>

                            <div class="form-group other box">
                                <label for="acitivity">Activity</label>
                                <div id="acitivity_default">
                                    <select class="form-control" id="acitivity" name="acitivity" required>
                                        <option default selected disabled>---- SELECT Activity ----</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="Level">Level</label>
                                <select class="form-control" id="Level" name="Level" required>
                                    <option default selected disabled>---- SELECT level ----</option>
                                    <option>College Level</option>
                                    <option>Zonal Level</option>
                                    <option>Inter-College/University(State Level)</option>
                                    <option>Inter-College/University(National Level)</option>
                                    <option>International Level</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="eventDate">Expiration Date</label>
                                <input type="date" class="form-control" name="eventDate" id="eventDate" placeholder="">

                            </div>


                            <div class="form-group">
                                <label>Certificate</label>
                                <input type="file" name="certificate" class="file-upload-default">
                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Document">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group other box">
                                <label for="certi_desc">Cetificate Description</label>
                                <textarea class="form-control" id="certi_desc" rows="4" name="certi_desc" placeholder="Detail about the activity"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="position">Position</label>
                                <select class="form-control" id="position" name="position" required>
                                    <option default selected disabled>---- SELECT Position ----</option>
                                    <option value="1">No winner</option>
                                    <option value="0">Winner</option>
                                </select>
                            </div>

                            <!-- Submit Button-->
                            <button type="submit" class="btn btn-primary mr-2" name="100_activity">Submit</button>
                            <button type="reset" class="btn btn-light">Reset</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    const firstDropdown = document.getElementById("major_cat");
    const secondDropdown = document.getElementById("acitivity");

    firstDropdown.addEventListener("change", (event) => {
        // clear options from second dropdown
        secondDropdown.innerHTML = "";

        // add options to second dropdown based on value of first dropdown

        <?php
        $resultCatAll = $obj->GetActivityCatAll();
        if ($resultCatHead->num_rows > 0) :
            foreach ($resultCatHead as $row) :
        ?>
                if (event.target.value === "<?php echo $row['activityCatHead']; ?>") {

                    secondDropdown.innerHTML = `
                        <option default selected disabled>---- SELECT Activity ----</option>
                        <?php
                        if ($resultCatAll->num_rows > 0) :
                            foreach ($resultCatAll as $row1) :
                                if ($row1['activityCatHead'] == $row['activityCatHead']) :
                        ?><option><?php echo $row1['activitySubCat']; ?></option>
                        <?php
                                endif;
                            endforeach;
                        endif;
                        ?>`;
                }
        <?php

            endforeach;
        endif;
        ?>
        // add more conditions for other values of first dropdown if needed
    });
</script>
<!-- INCLUDE FOOTER -->
<?php include '../inc/footer.php'; ?>