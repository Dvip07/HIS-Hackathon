<!-- INCLUDE HEADER -->
<?php include '../inc/header.php'; ?>

<!-- INCLUDE SIDEBAR -->
<?php include '../inc/sidebar.php'; ?>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
<script src="../js/jquery.js"></script>
<script>
    //     $(document).ready(function(){
    //         $(".box").hide();

    //         $('#resetbtn').click(function(){
    //             $(".box").hide();
    //         })
    //     $('input[type="radio"]').click(function(){
    //         var inputValue = $(this).attr("value");
    //         var targetBox = $("." + inputValue);
    //         $(".box").not(targetBox).hide();
    //         $(targetBox).show();
    //     });
    // });
</script>

<?php
require_once("../backend/cls_select.php");
$obj = new Get();
$obj->doc_id = $_GET['id'];
$result_doc_id  = $obj->documentByDocId();
$result_fac  = $obj->faculty();
$result_depart  = $obj->department();
$result_admin  = $obj->Admin();
// doc_id`, `doc_name`, `doc_desc_status`, `doc_faculty_status;  
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-2">
            </div>
            <div class="col-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Apply For doucment</h4>
                        <p class="card-description">
                            Please fill the form to register a complaint.
                        </p>

                        <form class="forms-sample" method="post" action="../backend/DB_insert.php">

                            <!-- Register Lab Complaints -->
                            <div class="form-group depart box">
                                <label for="depart">Department</label>
                                <select class="form-control" id="depart" name="departmentId">
                                    <option disabled>---- SELECT Department ----</option>
                                    <?php
                                    if ($result_depart->num_rows > 0) :
                                        foreach ($result_depart as $row) :
                                    ?>
                                            <option default selected value="<?php echo $row['user_id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </select>
                            </div>

                            <div class="form-group admin box">
                                <label for="admin">Admin</label>
                                <select class="form-control" id="admin" name="adminId">
                                    <option disabled>---- SELECT Department ----</option>
                                    <?php
                                    if ($result_admin->num_rows > 0) :
                                        foreach ($result_admin as $row) :
                                    ?>
                                            <option default selected value="<?php echo $row['user_id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </select>
                            </div>

                            <?php
                            if ($result_doc_id->num_rows > 0) :
                                foreach ($result_doc_id as $row) :
                            ?>
                                    <!-- Complaint Type-->
                                    <div class="form-group" hidden>
                                        <label for="pc_no">Document Type</label>

                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="text" class="form-check-input" name="doc" id="" value="<?php echo $row['doc_id'] . '-' . $row['doc_name']; ?>">
                                                <?php echo $row['doc_name']; ?>
                                            </label>

                                        </div>
                                    </div>



                                    <?php if ($row['doc_faculty_status'] == 0) : ?>
                                        <div class="form-group faculty box">
                                            <label for="faculty">Faculty</label>
                                            <select class="form-control" id="faculty" name="facultyId">
                                                <option default selected disabled>---- SELECT Faculty ----</option>
                                                <?php
                                                if ($result_fac->num_rows > 0) :
                                                    foreach ($result_fac as $rowFac) :
                                                ?>
                                                        <option value='<?php echo $rowFac['user_id']; ?>'><?php echo $rowFac['name']; ?></option>
                                                <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                            </select>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ($row['doc_desc_status'] == 0) : ?>
                                        <div class="form-group">
                                            <label for="description">Document Description</label>
                                            <textarea class="form-control" id="description" rows="4" name="doc_desc" placeholder="Write down your content that you want to put on the document"></textarea>
                                        </div>
                                    <?php endif; ?>

                                    
                                        <div class="form-group faculty box">
                                            <label for="doc_mode">Document Mode</label>
                                            <select class="form-control" id="doc_mode" name="doc_mode" required>
                                                <option value='SOFT' selected>Soft Copy</option>
                                                <option value='HARD'>Hard Copy</option>
                                            </select>
                                        </div>



                                    

                            <?php
                                endforeach;
                            endif;
                            ?>






                            <!-- Submit Button-->
                            <button type="submit" class="btn btn-primary mr-2" name="apply_document">Submit</button>
                            <button type="reset" class="btn btn-light" id="resetbtn">Reset</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- INCLUDE FOOTER -->
<?php include '../inc/footer.php'; ?>


<!-- 

lab no - dropdown 2 value LAB11,LAB13
pc id
complain type
subtype - dropdown
desc
datetime auto
status default 0 

 -->