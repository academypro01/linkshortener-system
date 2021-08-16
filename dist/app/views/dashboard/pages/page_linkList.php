<h1>You Have <?php echo count($linkInfo); ?> Links!</h1>
<div class="col-md-12">
<div class="card table-responsive">
              <div class="card-header">
                <h3 class="card-title">
                    your all links table.
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                  <thead>
                  <tr role="row">
                  <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Delete</th>
                  <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">Long Link</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Short Link</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending">Total Views</th>
                  <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending">Submit Time</th>
                </tr>
                  </thead>
                  <tbody>
                      <?php
                      
                        foreach($linkInfo as $link):
                         
                      ?>
                  <tr class="odd">
                    <td class='text-center'>
                            <a href="<?php echo htmlspecialchars("../../trashLink/trash/$link->short_link_id"); ?>">
                            <i class="fa fa-trash text-danger" aria-hidden="true"></i>
                            </a>
                    </td>
                    <td><?php echo $link->long_link; ?></td>
                    <td><?php echo $link->short_link; ?></td>
                    <td><?php echo $link->views; ?></td>
                    <td><?php echo $link->register_time; ?></td>
                  </tr>
                    <?php
                    endforeach;
                    ?>
                </tbody>
                </table>
              <!-- /.card-body -->
            </div>
            </div>