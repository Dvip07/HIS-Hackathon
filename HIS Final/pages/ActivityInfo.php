<!-- INCLUDE HEADER -->
<?php include '../inc/header.php'; ?>

<!-- INCLUDE SIDEBAR -->
<?php include '../inc/sidebar.php'; ?>

<?php require_once("../backend/cls_select.php"); ?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-11">
                        <h3 class="font-weight-bold">100 Point Acitivity Certificate</h3>
                        <h6>
                            <?php
                                $obj= new Get();
                                $result  = $obj->Get100Activity();

                                if ($result->num_rows > 0) {
                                    foreach ($result as $row) {
                                        if($row['student_id']== $_GET['student_id']){
                                            echo $row['student_id'].' - '.$row['student_name'];
                                        }
                                    }
                                }
                            ?>
                        </h6>
                    </div>
                    <div class="col-1">
                        <h6><a href="../pages/ViewActivityCerti.php" type="button" class="btn btn-inverse-primary btn-sm">Go Back</a></h6>
                    </div>
                </div>
            </div>
        </div>


        <?php         
            $resultCatHead = $obj->GetActivityCat();

            if ($resultCatHead->num_rows > 0) :
                foreach ($resultCatHead as $row) :

        ?>
        <div class="row">
          <div class="col-md-12 grid-margin">
            <div class="row">
              <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h4 class="font-weight-bold"><?php echo $row['activityCatHead']; ?></h4>
                <h6>
                    <?php 
                        $obj->major_cat=$row['activityCatHead'];
                        $obj->student_id=$_GET['student_id'];
                        $resultAllCerti=$obj->Get100ActivityById();

                        if ($resultAllCerti->num_rows == 0) {
                            echo "None";
                        }
                    ?>
                </h6>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
            <?php
                if ($resultAllCerti->num_rows > 0) :
                    foreach ($resultAllCerti as $row) :
            ?>

            <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                    <a href="../backend/100Activity/<?php echo $row['certi_path']; ?>"><img src="../backend/100Activity/<?php echo $row['certi_path']; ?>" alt="Avatar" style="width:100%; height: 250px;"></a>
                    
                    <div class="container">
                        <div class="row">
                            <div class="col-9">
                                <h4><b><?php echo $row['certi_SubCat'];?></b></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
            <?php 
                    endforeach;
                endif;
            ?>
        </div>
        <?php 
                endforeach;
            endif;
        ?>
            
        </div>
    </div>
</div>

<!-- INCLUDE FOOTER -->
<?php include '../inc/footer.php'; ?>