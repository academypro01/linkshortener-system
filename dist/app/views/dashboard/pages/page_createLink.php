<h1>Short your new link!</h1>

<div class="col-md-12">
<div class="card card-primary">
    
    <div class="card-header">
      <h3 class="card-title">add new link</h3>
      
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form action="<?php echo htmlspecialchars("../../createLink/panelCreateLink"); ?>" method='POST'>
      <div class="card-body">
        <div class="form-group">
          <label for="exampleInputEmail1">Long link</label>
          <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter long link" name='long_link'>
        </div>
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <input type="submit" class="btn btn-primary">
      </div>
    </form>
    <?php
                if(isset($_SESSION['semej_lib_alerts_message']) && !empty($_SESSION['semej_lib_alerts_message'])):
            ?>
                <p class="alert-box"><?php echo $_SESSION['semej_lib_alerts_message']; ?></p>
                <?php
            Semej::unset();
            endif;
            ?>
  </div>
</div>