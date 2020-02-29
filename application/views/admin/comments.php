        <div id="page-wrapper" style="min-height: 345px;">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Comments</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            View all the Comments here...
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?php echo $this->session->flashdata('comment'); ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Author</th>
                                            <th>Comment</th>
                                            <th>In Response To</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Operations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($comments as $comment) { ?>
                                        <tr>
                                            <td><?php echo $comment['id']; ?></td>
                                            <td><?php echo $comment['username']; ?></td>
                                            <td><?php echo $comment['comment']; ?></td>
                                            <td><?php echo $comment['title']; ?></td>
                                            <td><?php echo $comment['created']; ?></td>
                                            <td><?php echo $comment['status']; ?></td>
    <td>
        <?php if($role == 'administrator'){ ?>
        <a href="<?php echo base_url('index.php/Admin/EditComment/') . $comment['id']; ?>">Edit</a> | 
            <?php if($comment['status'] == 'approved'){ ?>
        <a href="<?php echo base_url('index.php/Admin/processComment/') . $comment['id']; ?>/disapproved">Disapprove</a>
        <?php }elseif($comment['status'] == 'disapproved'){ ?>
        <a href="<?php echo base_url('index.php/Admin/processComment/') . $comment['id']; ?>/approved">Approve</a>
        <?php }else{ ?>
        <a href="<?php echo base_url('index.php/Admin/processComment/') . $comment['id']; ?>/approved">Approve</a>
        <a href="<?php echo base_url('index.php/Admin/processComment/') . $comment['id']; ?>/disapproved">Disapprove</a>
        <?php } }else{ echo "NA"; } ?>
    </td>
                                        </tr>
                                        <?php } ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>