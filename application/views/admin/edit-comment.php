<div id="page-wrapper" style="min-height: 345px;">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Comment</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Update Comment Here...
                </div>
                <div class="panel-body">
                    <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <?php 
                            $attributes = array('role' => 'form');
                            echo form_open('Admin/UpdateComment', $attributes); ?>
                            <!-- <form role="form" action="http://localhost/CodeIgniter-Blog/index.php/Admin/UpdateCategory" method="post"> -->
                                <input type="hidden" name="id" value="<?php echo $comment['id']; ?>">
                                
                                <div class="form-group">
                                    <label>Comment</label>
                                    <textarea name="comment" class="form-control" rows="3"><?php echo $comment['comment']; ?></textarea>
                                </div>
                                <div class="form-group">
                                            <label>Article Status</label>
                                            <div class="radio">
                                                <label>
                                                    <input name="status" type="radio" name="optionsRadios" id="optionsRadios1" value="submitted" <?php if($comment['status'] == "submitted"){ echo "checked"; }; ?>>Submitted
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input name="status" type="radio" name="optionsRadios" id="optionsRadios2" value="approved" <?php if($comment['status'] == "approved"){ echo "checked"; }; ?>>Approved
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input name="status" type="radio" name="optionsRadios" id="optionsRadios3" value="disapproved" <?php if($comment['status'] == "disapproved"){ echo "checked"; }; ?>>Disapproved
                                                </label>
                                            </div>
                                        </div>

                                <input type="submit" class="btn btn-primary" value="Update" />
                            </form>
                        </div>
                        <!-- /.col-lg-6 (nested) -->   
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>