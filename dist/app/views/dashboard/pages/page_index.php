<?php

?>
<h2>Welcome <?php echo $_SESSION['firstname']; ?> !</h2>
<hr><br>
<div class="col-md-12">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-bullhorn"></i>
                  News
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="callout callout-info">
                  <h5>Your Total Links : <?php echo count($linkInfo); ?></h5>
                </div>
                
                <div class="callout callout-success">
                  <h5>Today is: <?php echo date("Y-m-d"); ?></h5>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>