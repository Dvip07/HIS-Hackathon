<!-- INCLUDE HEADER -->
<?php include '../inc/header.php'; ?>

<!-- INCLUDE SIDEBAR -->
<?php include '../inc/sidebar.php'; ?>

<?php require_once("../backend/cls_select.php"); ?>

<div class="main-panel">
    <div class="content-wrapper">

        <?php if(isset($_SESSION['student'])): ?>

       

        <div class="row">
          <div class="col-md-12 grid-margin">
            <div class="row">
              <div class="col-10">
                <h3 class="font-weight-bold">100 Point Acitivity Certificate</h3>
                <h6>Your acitivity</h6>
              </div>
              <div class="col-2">
                <h3 class="font-weight-bold"></h3>
                <!-- <h6><a href="" type="button" class="btn btn-inverse-primary btn-fw">Go Back</a></h6> -->
              </div>
            </div>
          </div>
        </div>

        <?php 
            
            $obj = new Get();
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
                        $obj->student_id=$_SESSION['student'];
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

        <?php endif;?>


        <?php
            if (isset($_SESSION['faculty']) == true || isset($_SESSION['Admin']) == true) :
        ?>

        <div class="row">
          <div class="col-md-12 grid-margin">
            <div class="row">
              <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">100 Point Acitivity Certificate</h3>
                <h6>Listing of all student acitivity</h6>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
            <?php
           
                $obj = new Get();
                $result  = $obj->Get100Activity();
            ?>
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">All Student Activity</h4>
                            <p class="card-description">
                                List of <code>Activity</code>
                            </p>
                            <div class="table-responsive">
                                <table class="table table-hover" id="table_data">
                                    <thead>
                                        <tr>
                                            <th>Student ID</th>
                                            <th>Student Name</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        if ($result->num_rows > 0) :
                                            foreach ($result as $row) :
                                        ?>
                                                <tr>
                                                    <td><?php echo $row['student_id']; ?></td>

                                                    <td><?php echo $row['student_name']; ?></td>

                                                    <td><?php echo '<a href="../pages/ActivityInfo.php?student_id='.$row['student_id'].'" class="badge badge-primary"> View Certificates </a>';?></td>
                                                </tr>
                                        <?php
                                            endforeach;
                                        endif;
                                        ?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <?php
            endif;
        ?>

    </div>
</div>

<!-- INCLUDE FOOTER -->
<?php include '../inc/footer.php'; ?>