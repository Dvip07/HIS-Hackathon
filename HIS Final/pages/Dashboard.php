    <?php require_once("../backend/cls_select.php"); ?>
    <?php

    if (isset($_SESSION['success_login']) != TRUE) {
      header('Location:login.php');
    }

    $count_pending = 0;
    $count_progess = 0;
    $count_solved = 0;

    ?>
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-md-12 grid-margin">
            <div class="row">
              <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Welcome 
                  <?php
                  if (isset($_SESSION['Admin']) == true) {
                    echo $_SESSION['Admin_name'] . ' (' . $_SESSION['Admin'] . ')';

                  } elseif (isset($_SESSION['manager']) == true) {
                    echo $_SESSION['manager_name'] . ' (' . $_SESSION['manager'] . ')';
                  } elseif (isset($_SESSION['student']) == true) {
                    echo $_SESSION['student_name'] . ' (' . $_SESSION['student'] . ')';
                  }elseif (isset($_SESSION['faculty']) == true) {
                    echo $_SESSION['faculty_name'] . ' (' . $_SESSION['faculty'] . ')';
                  }
                  elseif (isset($_SESSION['department']) == true) {
                    echo $_SESSION['department_name'] . ' (' . $_SESSION['department'] . ')';
                  }
                  elseif (isset($_SESSION['aditya']) == true) {
                    echo $_SESSION['aditya_name'] . ' (' . $_SESSION['aditya'] . ')';
                  }
                  // ?></h3> <h6>Welcome to <span>Smart City</span></h6>
              </div>
            </div>
          </div>
        </div>



        <?php
        if (isset($_SESSION['Admin']) == true || isset($_SESSION['manager']) == true) {


          $obj_complaint = new GetComplaint();
          $result_complaint  = $obj_complaint->ComplaintGet();
          $result_complaint_year  = $obj_complaint->ComplaintGetByYear();
          $result_complaint_month  = $obj_complaint->ComplaintGetByMonth();

          if ($result_complaint->num_rows > 0) {
            $lab_complaints_pending=0;
            $lab_complaints_inProgress=0;
            $lab_complaints_completed=0;

            $class_complaints_pending=0;
            $class_complaints_inProgress=0;
            $class_complaints_completed=0;

            $library_complaints_pending=0;
            $library_complaints_inProgress=0;
            $library_complaints_completed=0;
            foreach ($result_complaint as $row) {


              if ($row['status'] == 0) {
                $count_pending++;
              } elseif ($row['status'] == 1) {
                $count_progess++;
              } elseif ($row['status'] == 2) {
                $count_solved++;
              }

              // if ($row['status'] == 0 && $row['cat_type']==0) {
              //   $lab_complaints_pending++;
              // }  
              // elseif ($row['status'] == 1 && $row['cat_type']==0) {
              //   $lab_complaints_inProgress++;
              // }
              // elseif ($row['status'] == 2 && $row['cat_type']==0) {
              //   $lab_complaints_completed++;
              // }
              if ($row['status'] == 0 && $row['cat_type']==1) {
                $class_complaints_pending++;
              } 
              elseif ($row['status'] == 1 && $row['cat_type']==1) {
                $class_complaints_inProgress++;
              }
              elseif ($row['status'] == 2 && $row['cat_type']==1) {
                $class_complaints_completed++;
              }
              elseif ($row['status'] == 0 && $row['cat_type']==2) {
                $library_complaints_pending++;
              }
              elseif ($row['status'] == 1 && $row['cat_type']==2) {
                $library_complaints_inProgress++;
              }
              elseif ($row['status'] == 2 && $row['cat_type']==2) {
                $library_complaints_completed++;
              }
            }
          }



          $obj_user = new Get();
          $result_lab = $obj_user->GetAllUser();

          if ($result_lab->num_rows > 0) {
            $count_technician = 0;
            $count_student = 0;

            foreach ($result_lab as $row) {

              if ($row['role'] == 1) {
                $count_technician++;
              } elseif ($row['role'] == 2) {
                $count_student++;
              }
            }
          }

          

          // $obj_lab = new Get();
          // $result_lab = $obj_lab->GetLab();

          // if ($result_lab->num_rows > 0) {
          //   $count_lab = 0;
          //   foreach ($result_lab as $row) {
          //     $count_lab++;
          //   }
          // }


        }

        if (isset($_SESSION['Admin']) == true) :
        ?>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card tale-bg">
                <div class="card-people mt-auto">
                  <img src="../images/dashboard/people.svg" alt="people">
                  <div class="weather-info">
                    <div class="d-flex">
                      <div>
                        <h3 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>
                          <?php
                          echo date("d/m/Y");
                          ?>
                        </h3>
                      </div>
                      <div class="ml-2">
                        <h4 class="location font-weight-normal">Ahmedabad</h4>
                        <h6 class="font-weight-normal">India</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6 grid-margin transparent">
              <div class="row">
                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <p class="mb-4">Pending Complaints</p>
                      <p class="fs-30 mb-2"><?php echo $count_pending; ?></p>
                      <p></p>
                    </div>
                  </div>
                </div>

                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">In Progess Complaints</p>
                      <p class="fs-30 mb-2"><?php echo $count_progess; ?></p>
                      <p></p>
                    </div>
                  </div>
                </div>

                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Solved Complaints</p>
                      <p class="fs-30 mb-2"><?php echo $count_solved; ?></p>
                      <p></p>
                    </div>
                  </div>
                </div>

                <div class="col-md-3 mb-4 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <p class="mb-4">Total Complaints</p>
                      <p class="fs-30 mb-2"><?php echo $count_pending + $count_progess + $count_solved; ?></p>
                      <p></p>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-4 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <p class="mb-4">Total Users</p>
                      <p class="fs-30 mb-2"><?php echo $count_student; ?></p>
                      <p></p>
                    </div>
                  </div>
                </div>

                <div class="col-md-4 mb-4 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">Total Corporation</p>
                      <p class="fs-30 mb-2"><?php echo $count_technician; ?></p>
                      <p></p>
                    </div>
                  </div>
                </div>


    
                
                <!-- <div class="col-md-4 mb-4 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">Emergency Notification</p>
                      <p class="fs-30 mb-2"><?php // echo $count_technician; ?></p>
                      <p></p>
                    </div>
                  </div>
                </div> -->

                <!-- <div class="col-md-4 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Total Labs</p>
                      <p class="fs-30 mb-2"><?php // echo $count_lab; ?></p>
                      <p></p>
                    </div>
                  </div>
                </div> -->
              </div>
            </div>
          </div>

          <!-- Notice Board -->
          <div class="col-12">
              <div class="row">
                <div class="col-10">
                  <h3 class="font-weight-bold">Emergency Notification</h3>
                  <br>
                </div>
              </div>
            </div>

            


            <div class="col-md-12 grid-margin stretch-card">

              <div class="card position-relative">
                <div class="card-body">

                  <div id="detailedReports" class="carousel slide detailed-report-carousel position-static pt-2" data-ride="carousel">

                    <div class="carousel-inner">
                      
                      <?php 
                        $obj_notice= new Get();
                        $result=$obj_notice->GetEmergencyNotification();

                        $tmpCount=0;
                        if ($result->num_rows > 0) :
                          foreach ($result as $row) :
                            
                      ?>
                      <div class="carousel-item <?php if($tmpCount==0){echo "active";} ?>">
                        <div class="row">

                          <div class="col-md-12 col-xl-12">
                            <div class="row">
                              <div class="col-md-10 border-right">
                                <div class="table-responsive mb-3 mb-md-0 mt-3">


                                  <h4 class="card-title">Emergency Notification <?php echo $row['notification_id']; ?></h4>
                                  <blockquote class="blockquote blockquote">
                                    <p>
                                    <div class="media">
                                      <i class="ti-world icon-md text-info d-flex align-self-start mr-3"></i>
                                      <div class="media-body">
                                        <p class="card-text"><?php echo $row['notification_message']; ?></p>
                                      </div>
                                    </div>
                                    </p>
                                    <footer class="blockquote-footer">By <cite title="Source Title"><?php echo $row['smart_light_id']; ?></cite> <?php echo $row['regi_date']; ?>  <?php echo $row['notification_time']; ?> </footer>
                                  </blockquote>

                                </div>

                              </div>

                            </div>
                          </div>
                        </div>
                      </div>
                      <?php 
                          $tmpCount++;
                          endforeach;
                        endif;
                      ?>
                      
                      <?php 
                          if ($result->num_rows == 0) :
                      ?>
                      
                      <div class="carousel-item active">
                        <div class="row">

                          <div class="col-md-12 col-xl-12">
                            <div class="row">
                              <div class="col-md-10 border-right">
                                <div class="table-responsive mb-3 mb-md-0 mt-3">
                                  <h3>
                                    Emergency Notification is vacant
                                    <small class="text-muted">
                                      Whenever some emergency notification will be made, it will be shown here.
                                    </small>
                                  </h3>
                                  <br>

                                </div>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php 
                        endif;
                      ?>

                    </div>

                    <a class="carousel-control-prev" href="#detailedReports" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#detailedReports" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>

          <!-- Graphs -->
          <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">yearly Complaints</h4>
                  <canvas id="barChart"></canvas>
                </div>
              </div>
            </div>
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Complaints Chart</h4>
                  <canvas id="doughnutChart"></canvas>
                </div>
              </div>
            </div>
          </div>


          <div class="row mt-4">
              <div class="col-1"></div>
              <div class="col-lg-10 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Monthly Complaints</h4>
                    <canvas id="barChart1"></canvas>
                  </div>
                </div>
              </div>
            </div>


          <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">AMC Complaints</h4>
                  <canvas id="doughnutChart1"></canvas>
                </div>
              </div>
            </div>

            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Police Complaints</h4>
                  <canvas id="doughnutChart2"></canvas>
                </div>
              </div>
            </div>

            <div class="col-3"></div>
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Cyber Complaints</h4>
                  <canvas id="doughnutChart3"></canvas>
                </div>
              </div>
            </div>

          </div>
         

            
          <?php
        endif;
          ?>

          <?php
          if (isset($_SESSION['manager']) == true) :
          ?>
            <div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card tale-bg">
                  <div class="card-people mt-auto">
                    <img src="../images/dashboard/people.svg" alt="people">
                    <div class="weather-info">
                      <div class="d-flex">
                        <div>
                          <h3 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>
                            <?php
                            echo date("d/m/Y")
                            ?>
                          </h3>
                        </div>
                        <div class="ml-2">
                          <h4 class="location font-weight-normal">Ahmedabad</h4>
                          <h6 class="font-weight-normal">India</h6>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 grid-margin transparent">
                <div class="row">
                  <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                      <div class="card-body">
                        <p class="mb-4">Pending</p>
                        <p class="fs-30 mb-2"><?php echo $count_pending; ?></p>
                        <p></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-light-blue">
                      <div class="card-body">
                        <p class="mb-4">In Progess </p>
                        <p class="fs-30 mb-2"><?php echo $count_progess; ?></p>
                        <p></p>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-dark-blue">
                      <div class="card-body">
                        <p class="mb-4">Completed</p>
                        <p class="fs-30 mb-2"><?php echo $count_solved; ?></p>
                        <p></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-light-danger">
                      <div class="card-body">
                        <p class="mb-4">Total Complaints</p>
                        <p class="fs-30 mb-2"><?php echo $count_pending + $count_progess + $count_solved; ?></p>
                        <p></p>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            </div>

          <?php
          endif;
          ?>

          <?php
          if (isset($_SESSION['student']) == true) :
            $obj = new GetComplaint();
            $obj->id = $_SESSION['student'];
            $result_complaint  = $obj->ComplaintGetStudent();

            if ($result_complaint->num_rows > 0) {

              foreach ($result_complaint as $row) {
                if ($row['status'] == 0) {
                  $count_pending++;
                } elseif ($row['status'] == 1) {
                  $count_progess++;
                } elseif ($row['status'] == 2) {
                  $count_solved++;
                }
              }
            }
            
          ?>
            <div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card tale-bg">
                  <div class="card-people mt-auto">
                    <img src="../images/dashboard/people.svg" alt="people">
                    <div class="weather-info">
                      <div class="d-flex">
                        <div>
                          <h3 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>
                            <?php
                            echo date("d/m/Y")
                            ?>
                          </h3>
                        </div>
                        <div class="ml-2">
                          <h4 class="location font-weight-normal">Ahmedabad</h4>
                          <h6 class="font-weight-normal">India</h6>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 grid-margin transparent">
                <div class="row">
                  <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                      <div class="card-body">
                        <p class="mb-4">Pending</p>
                        <p class="fs-30 mb-2"><?php echo $count_pending; ?></p>
                        <p></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-light-blue">
                      <div class="card-body">
                        <p class="mb-4">In Progess </p>
                        <p class="fs-30 mb-2"><?php echo $count_progess; ?></p>
                        <p></p>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-dark-blue">
                      <div class="card-body">
                        <p class="mb-4">Completed</p>
                        <p class="fs-30 mb-2"><?php echo $count_solved; ?></p>
                        <p></p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-light-danger">
                      <div class="card-body">
                        <p class="mb-4">Total Complaints</p>
                        <p class="fs-30 mb-2"><?php echo $count_pending + $count_progess + $count_solved; ?></p>
                        <p></p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  
                  <div class="card-body">
                    <h4 class="card-title">Center aligned media</h4>
                    
                    <blockquote class="blockquote blockquote">
                      <p>
                        <div class="media">
                          <i class="ti-world icon-md text-info d-flex align-self-center mr-3"></i>
                          <div class="media-body">
                            <p class="card-text">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.</p>
                          </div>
                        </div>
                      </p>
                    <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
                    </blockquote>

                  </div>

                </div>
              </div> -->

            
            
            


            <!-- <div class="col-md-12 grid-margin stretch-card">

              <div class="card position-relative">
                <div class="card-body">

                  <div id="detailedReports" class="carousel slide detailed-report-carousel position-static pt-2" data-ride="carousel">

                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <div class="row">

                          <div class="col-md-12 col-xl-12">
                            <div class="row">
                              <div class="col-md-10 border-right">
                                <div class="table-responsive mb-3 mb-md-0 mt-3">


                                  <h4 class="card-title">Center aligned media</h4>
                                  <blockquote class="blockquote blockquote">
                                    <p>
                                    <div class="media">
                                      <i class="ti-world icon-md text-info d-flex align-self-start mr-3"></i>
                                      <div class="media-body">
                                        <p class="card-text">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.</p>
                                      </div>
                                    </div>
                                    </p>
                                    <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
                                  </blockquote>

                                </div>

                              </div>
                              <div class="col-md-2 mt-3">
                                <br>
                                <img src="../backend/certificate_material/Panache.jpg" alt="Avatar" style="width:100%">
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>


                      <div class="carousel-item">
                        <div class="row">

                          <div class="col-md-12 col-xl-12">
                            <div class="row">
                              <div class="col-md-10 border-right">
                                <div class="table-responsive mb-3 mb-md-0 mt-3">

                                  <h4 class="card-title">Center aligned media</h4>
                                  <blockquote class="blockquote blockquote">
                                    <p>
                                    <div class="media">
                                      <i class="ti-world icon-md text-info d-flex align-self-center mr-3"></i>
                                      <div class="media-body">
                                        <p class="card-text">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.</p>
                                      </div>
                                    </div>
                                    </p>
                                    <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
                                  </blockquote>

                                </div>
                              </div>
                              <div class="col-md-2 mt-3">
                                <br>
                                <img src="../backend/certificate_material/Culture.jpg" alt="Avatar" style="width:100%">
                              </div>

                            </div>
                          </div>

                        </div>
                      </div>

                    </div>

                    <a class="carousel-control-prev" href="#detailedReports" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#detailedReports" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                  </div>
                </div>
              </div>
            </div> -->

            <div class="col-12">
              <div class="row">
                <div class="col-10">
                  <h3 class="font-weight-bold">Notice Board</h3>
                  <br>
                </div>
              </div>
            </div>


            <div class="col-md-12 grid-margin stretch-card">

              <div class="card position-relative">
                <div class="card-body">

                  <div id="detailedReports" class="carousel slide detailed-report-carousel position-static pt-2" data-ride="carousel">

                    <div class="carousel-inner">
                      
                      <?php 
                        $obj_notice= new Get();
                        $result=$obj_notice->GetNotice();

                        $tmpCount=0;
                        if ($result->num_rows > 0) :
                          foreach ($result as $row) :
                            
                      ?>
                      <div class="carousel-item <?php if($tmpCount==0){echo "active";} ?>">
                        <div class="row">

                          <div class="col-md-12 col-xl-12">
                            <div class="row">
                              <div class="col-md-10 border-right">
                                <div class="table-responsive mb-3 mb-md-0 mt-3">


                                  <h4 class="card-title"><?php echo $row['notice_heading']; ?></h4>
                                  <blockquote class="blockquote blockquote">
                                    <p>
                                    <div class="media">
                                      <i class="ti-world icon-md text-info d-flex align-self-start mr-3"></i>
                                      <div class="media-body">
                                        <p class="card-text"><?php echo $row['notice_desc']; ?></p>
                                      </div>
                                    </div>
                                    </p>
                                    <footer class="blockquote-footer">By <cite title="Source Title"><?php echo $row['faculty_name']; ?></cite> <?php echo $row['regi_date']; ?>  <?php echo $row['regi_time']; ?> </footer>
                                  </blockquote>

                                </div>

                              </div>
                              <div class="col-md-2 mt-3">
                                <br>
                                <?php 
                                  if($row['notice_document']!="" || $row['notice_document']!=null){
                                    $fileExt = explode('.', $row['notice_document']);
                                    $fileActualExt = strtolower(end($fileExt));
 
                                    if($fileActualExt=='pdf'){
                                       echo "<a href='../backend/notice_documents/".$row['notice_document']."'><img src='../images/pdfSample.png' alt='notice' style='width:100%; border-radius:10px;'></a>";
                                    }
                                    else{
                                     echo "<a href='../backend/notice_documents/".$row['notice_document']."' ><img src='../backend/notice_documents/".$row['notice_document']."' alt='notice' style='width:100%;'></a>";
                                    }
                                  }
                                  else{
                                    echo "No documents";
                                  }
                                   
                                ?>
                              </div>

                            </div>
                          </div>
                        </div>
                      </div>
                      <?php 
                          $tmpCount++;
                          endforeach;
                        endif;
                      ?>
                      
                      <?php 
                          if ($result->num_rows == 0) :
                      ?>
                      
                      <div class="carousel-item active">
                        <div class="row">

                          <div class="col-md-12 col-xl-12">
                            <div class="row">
                              <div class="col-md-10 border-right">
                                <div class="table-responsive mb-3 mb-md-0 mt-3">
                                  <h3>
                                    Event Board is vacant
                                    <small class="text-muted">
                                      Whenever some add anything in Event you will find it here
                                    </small>
                                  </h3>
                                  <br>

                                </div>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php 
                        endif;
                      ?>




                    </div>

                    <a class="carousel-control-prev" href="#detailedReports" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#detailedReports" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
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