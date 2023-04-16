<!-- INCLUDE HEADER -->
<?php include '../inc/header.php'; ?>

<!-- INCLUDE SIDEBAR -->
<?php include '../inc/sidebar.php'; ?>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
<script src="../js/jquery.js"></script>
<script>
    $(document).ready(function(){
        $(".box").hide();

        $('#resetbtn').click(function(){
            $(".box").hide();
        })
    $('input[type="radio"]').click(function(){
        var inputValue = $(this).attr("value");
        var targetBox = $("." + inputValue);
        $(".box").not(targetBox).hide();
        $(targetBox).show();
    });
});
</script>

<?php
    require_once("../backend/cls_select.php");
    $obj = new Get();
    $result_lab = $obj->GetLab();

    $result_class = $obj->GetClass();

    $result_lib = $obj->GetLib();
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-2">
            </div>
            <div class="col-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Register Complaint</h4>
                        <p class="card-description">
                            Please fill the form to register a complaint.
                        </p>

                        <form class="forms-sample" method="post" action="../backend/DB_insert.php">
                            
                        <!-- Register Lab Complaints -->
                        <?php if($_GET['cat_type']==0):?>
                            <!-- Lab Number -->
                            <div class="form-group">
                                <label for="lab_no">Lab Number</label>
                                <select class="form-control" id="cat_no" name="cat_no" required>
                                    <option default selected disabled>---- SELECT LAB NUMBER ----</option>
                                    <?php
                                        if ($result_lab->num_rows > 0) :
                                            foreach ($result_lab as $row) :
                                        ?>
                                        <option value='<?php echo $row["Lab_id"];?>'><?php echo $row['Lab_id']." - ".$row['Lab_name']; ?></option>

                                    <?php
                                            endforeach;
                                        endif;
                                        ?>
                                </select>
                            </div>

                            
                            <!-- PC Number -->
                            <div class="form-group">
                                <label for="pc_no">PC Number</label>
                                <input type="text" class="form-control" name="err_id" id="err_id" placeholder="Enter PC Number OR IP Adress" required>
                            </div>

                            <div class="form-group" style="display:none">
                                <label for="pc_no">Type</label>
                                <input type="number"  class="form-control" name="cat_type" id="cat_type" placeholder="" value="0">
                            </div>

                            <!-- Complaint Type-->
                            <div class="form-group">
                                <label for="pc_no">Complaint Type</label>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="cType" id="hardware" value="hardware" required>
                                        Hardware
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="cType" id="software" value="software" required>
                                        Software
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="cType" id="other" value="other" required>
                                        Other
                                    </label>
                                </div>
                            </div>

                              <!-- Hardware -->
                              <div class="form-group hardware box">
                                <label for="hardware">hardware</label>
                                <select class="form-control" id="hardware" name="complaint_desc1">
                                    <option default selected disabled>---- SELECT Hardware ----</option>
                                    <option>computer will not turn on.</option>
                                    <option>computer turns on, but still does not work.</option>
                                    <option>computer screen freezes.</option>
                                    <option>computer has insufficient memory.</option>
                                    <option>get a CMOS error.</option>
                                    <option>mouse is not working</option>
                                    <option>keyboard is not working</option>
                                </select>
                            </div>

                              <!-- software -->
                              <div class="form-group software box">
                                <label for="software">software</label>
                                <select class="form-control" id="software" name="complaint_desc2">
                                    <option default selected disabled>---- SELECT software ----</option>
                                    <option>get the blue screen of death.</option>
                                    <option>operating system is missing or your hard drive is not detect</option>
                                    <option>Some software are not available or working</option>
                                    <option>Too many crashes</option>
                                    <option>Too many virus</option>
                                </select>
                            </div>

                            <!-- Complaint Description-->
                            <div class="form-group other box">
                                <label for="cdesc">Complaint Description</label>
                                <textarea class="form-control" id="cdesc" rows="4" name="complaint_desc3"></textarea>
                            </div>


                            <?php endif;?>


                            <!-- CLass Complaint-->
                            <?php if($_GET['cat_type']==1):?>

                            <div class="form-group">
                                <label for="lab_no">Class Number/Name</label>
                                <select class="form-control" id="cat_no" name="cat_no" required>
                                    <option default selected disabled>---- SELECT CLASS NUMBER ----</option>
                                    <?php
                                        if ($result_class->num_rows > 0) :
                                            foreach ($result_class as $row) :
                                        ?>
                                        <option value='<?php echo $row["class_id"];?>'><?php echo $row['class_id']." - ".$row['class_name']; ?></option>

                                    <?php
                                            endforeach;
                                        endif;
                                        ?>
                                </select>
                            </div>

                            
                            <div class="form-group" style="display:none">
                                <label for="pc_no">Type</label>
                                <input type="number"  class="form-control" name="cat_type" id="cat_type" placeholder="" value="1">
                            </div>
                            
                            <!-- Complaint Type-->
                            <div class="form-group">
                                <label for="pc_no">Complaint Type</label>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="cType" id="ClsEleP" value="ClsEleP" required>
                                        Class Electrical Problem
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="cType" id="ClsEnP" value="ClsEnP" required>
                                        Class Environment Problem
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="cType" id="other" value="other" required>
                                        Other
                                    </label>
                                </div>
                            </div>

                              <!-- Electrical Problem -->
                              <div class="form-group ClsEleP box">
                                <label for="ClsEleP">Class Electrical Problem</label>
                                <select class="form-control" id="ClsEleP" name="complaint_desc1">
                                    <option default selected disabled>---- SELECT Class Electrical Problem ----</option>
                                    <option>AC is not working properly</option>
                                    <option>Fan is not working properly</option>
                                </select>
                            </div>

                              <!-- Class Environment Problem -->
                              <div class="form-group ClsEnP box">
                                <label for="ClsEnP">Class Environment Problem</label>
                                <select class="form-control" id="ClsEnP" name="complaint_desc2">
                                    <option default selected disabled>---- SELECT Class Environment Problem ----</option>
                                    <option>Banches are broken</option>
                                    <option>Black/White Board is broken</option>
                                </select>
                            </div>

                            <!-- Complaint Description-->
                            <div class="form-group other box">
                                <label for="cdesc">Complaint Description</label>
                                <textarea class="form-control" id="cdesc" rows="4" name="complaint_desc3"></textarea>
                            </div>
                            <?php endif; ?>



                            <!-- Library Complaint-->
                            <?php if($_GET['cat_type']==2):?>

                            <div class="form-group">
                                <label for="lab_no">Library Number/Name</label>
                                <select class="form-control" id="cat_no" name="cat_no" required>
                                    <option default selected disabled>---- SELECT LIBRARY NUMBER ----</option>
                                    <?php
                                        if ($result_lib->num_rows > 0) :
                                            foreach ($result_lib as $row) :
                                        ?>
                                        <option value='<?php echo $row["lib_id"];?>'><?php echo $row['lib_id']." - ".$row['lib_name']; ?></option>

                                    <?php
                                            endforeach;
                                        endif;
                                        ?>
                                </select>
                            </div>
                            
                            
                            <div class="form-group" style="display:none">
                                <label for="pc_no">Type</label>
                                <input type="number"  class="form-control" name="cat_type" id="cat_type" placeholder="" value="2">
                            </div>

                            <!-- Complaint Type-->
                            <div class="form-group">
                                <label for="pc_no">Complaint Type</label>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="cType" id="LibEleP" value="LibEleP" required>
                                        Library Electrical Problem
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="cType" id="LibEnP" value="LibEnP" required>
                                        Library Environment Problem
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="cType" id="other" value="other" required>
                                        Other
                                    </label>
                                </div>
                            </div>

                              <!-- Hardware -->
                              <div class="form-group LibEleP box">
                                <label for="LibEleP">Library Electrical Problem</label>
                                <select class="form-control" id="LibEleP" name="complaint_desc1">
                                    <option default selected disabled>---- SELECT Library Electrical Problem< ----</option>
                                    <option>Fan is not functioning</option>
                                    <option>Lights is not functioning</option>
                                </select>
                            </div>

                              <!-- software -->
                              <div class="form-group LibEnP box">
                                <label for="LibEnP">Library Environment Problem</label>
                                <select class="form-control" id="LibEnP" name="complaint_desc2">
                                    <option default selected disabled>---- SELECT Library Environment Problem ----</option>
                                    <option>Seating Arrangement is not good</option>
                                    <option>Books aren't available/are missing</option>
                                </select>
                            </div>

                            <!-- Complaint Description-->
                            <div class="form-group other box">
                                <label for="cdesc">Complaint Description</label>
                                <textarea class="form-control" id="cdesc" rows="4" name="complaint_desc3"></textarea>
                            </div>

                            <?php endif; ?>

                            <!-- Submit Button-->
                            <button type="submit" class="btn btn-primary mr-2" name="reg_complaint">Submit</button>
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