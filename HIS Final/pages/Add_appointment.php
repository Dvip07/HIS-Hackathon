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
    $result_appointment = $obj->GetAppointment();
?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-2">
            </div>
            <div class="col-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Appointment</h4>
                        <p class="card-description">
                            Please fill the form to take an appointment
                        </p>

                        <form class="forms-sample" method="post" action="../backend/DB_insert.php">
                            <!-- Lab Number -->
                            <div class="form-group">
                                <label for="appointment">Employee Department</label>
                                <select class="form-control" name="emp_dept" required>
                                    <option default selected disabled>---- SELECT Department ----</option>
                            
                                        <option value='1'>Hello</option>
                                        <option value='1'>main</option>

                                    
                                </select>
                            </div>
                <!-- PC Number -->
                <div class="form-group">
                    <label for="pc_no">Appointment Date & Time</label>
                                <input type="datetime-local" class="form-control" name="appointment_time" required>

                                    </div>
                           
                          
                            <!-- PC Number -->
                            <div class="form-group">
                                <label for="appointment">Employee Name</label>
                                <input type="text" class="form-control" name="employee_name" id="employee_name" placeholder="Enter Employee Name" required>
                            </div>
                            <div class="form-group">
                                <label for="appointment">Appointment Description</label>
                                <input type="text" class="form-control" name="appointment_desc" id="appointment_desc" placeholder="Enter Appointment Description" required>
                            </div>
    
                            <!-- Submit Button-->
                            <button type="submit" class="btn btn-primary mr-2" name="appointment">Submit</button>
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