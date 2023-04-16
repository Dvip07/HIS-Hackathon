<!-- INCLUDE HEADER -->
<?php include '../inc/header.php'; ?>

<!-- INCLUDE SIDEBAR -->
<?php include '../inc/sidebar.php'; ?>

<?php require_once("../backend/cls_select.php"); ?>

<div class="main-panel">
    <div class="content-wrapper">

        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Event</h4>
                        <p class="card-description">
                            Upload jpg/png/pdf if necessary<br>
                        </p>

                        <form class="forms-sample" method="post" action="../backend/DB_insert.php" enctype="multipart/form-data">
                            <div class="row">

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="notice_head">Event Heading</label>
                                        <input type="text"  class="form-control" name="notice_head" id="notice_head" placeholder="">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group other box">
                                        <label for="notice_desc">Event Description</label>
                                        <textarea class="form-control" id="notice_desc" rows="4" name="notice_desc"></textarea>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Event-File</label>
                                        <input type="file" name="noticeFile" class="file-upload-default">
                                        <div class="input-group col-xs-12">
                                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Document">
                                            <span class="input-group-append">
                                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="expDate">Event Date</label>
                                        <input type="date"  class="form-control"  min='<?php echo date("Y-m-d"); ?>' name="expDate" id="expDate" placeholder="">

                                    </div>
                                </div>

                               

                            </div>


                            <!-- Submit Button-->
                            <button type="submit" class="btn btn-primary mr-2" name="add_notice">Submit</button>
                            <button type="reset" class="btn btn-light">Reset</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php
            if(isset($_SESSION['faculty'])){
                $user_id=$_SESSION['faculty'];
            }
            elseif(isset($_SESSION['Admin'])){
                $user_id=$_SESSION['Admin'];
            }
        ?>
        <div class="row">
          <div class="col-md-12 grid-margin">
            <div class="row">
              <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">All Events</h3>
                <h6>From <?php echo $user_id; ?></h6>
              </div>
            </div>
          </div>
        </div>


        <div class="row">
            <?php

                $obj= new Get();
                $obj->faculty_id=$user_id;
                $result=$obj->GetNoticeById();

                if ($result->num_rows > 0) :
                    foreach ($result as $row) :
            ?>

            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  
                  <div class="card-body">
                    <div class="row">
                        <div div class="col-11 ">
                            <h4 class="card-title"><?php echo $row['notice_heading']; ?></h4>
                        </div>
                        <div div class="col-1 ">
                            <a onclick="return cnfdel();" class="actionBtn" href="../backend/DB_delete.php?notice_id=<?php echo $row['notice_id']?>"><i class="mdi mdi-delete-forever"></i></a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 mt-3">
                        <blockquote class="blockquote blockquote">
                            <p>
                                <div class="media">
                                <i class="ti-world icon-md text-info d-flex align-self-center mr-3"></i>
                                <div class="media-body">
                                    <p class="card-text"><?php echo $row['notice_desc']; ?> &nbsp;</p>
                                </div>
                                </div>
                            </p>
                            <footer class="blockquote-footer">By <cite title="Source Title"><?php echo $row['faculty_name']; ?></cite>&nbsp;<?php echo $row['regi_date']; ?>&nbsp;<?php echo $row['regi_time']; ?></footer>
                            </blockquote>
                        </div>
                        <div class="col-md-4 mt-3">
                                <?php 
                                  if($row['notice_document']!="" || $row['notice_document']!=null){
                                    $fileExt = explode('.', $row['notice_document']);
                                    $fileActualExt = strtolower(end($fileExt));
 
                                    if($fileActualExt=='pdf'){
                                       echo "<a href='../backend/notice_documents/".$row['notice_document']."'><img src='../images/pdfSample.png' alt='notice' style='width:80%; border-radius:10px;'></a>";
                                    }
                                    else{
                                     echo "<a href='../backend/notice_documents/".$row['notice_document']."' ><img src='../backend/notice_documents/".$row['notice_document']."' alt='notice' style='width:80%;'></a>";
                                    }
                                  }
                                  else{
                                    echo "No<br>Document";
                                  }
                                   
                                ?>
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



        <div class="row">
            <?php
                $obj= new Get();
                $obj->faculty_id=$user_id;
                $result=$obj->GetNoticeById();

                if ($result->num_rows == 0) :

            ?>

            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  
                  <div class="card-body">
                    <div class="row">
                        <div div class="col-12 ">
                            <h4>
                            Event Board is vacant
                            <small class="text-muted">
                                Whenever some add anything in Event you will find it here
                            </small>
                            </h4>
                        </div>
                    </div>
                </div>
            </div> 
                <?php
                        
                    endif;
                ?>

        </div>



    </div>
</div>
<!-- INCLUDE FOOTER -->
<?php include '../inc/footer.php'; ?>