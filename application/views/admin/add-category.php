        <div id="page-wrapper" style="min-height: 345px;">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add New Category</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Create a New Category Here...
                        </div>
                        <div class="panel-body">
                            <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form" method="post">
                                        <div class="form-group">
                                            <label>Category Title</label>
                                            <input name="title" class="form-control" placeholder="Enter Article Title" value="<?php echo set_value('title'); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Article Description</label>
                                            <textarea name="description" class="form-control" rows="3"><?php echo set_value('description'); ?></textarea>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label>Category Image</label>
                                            <input type="file">
                                        </div> -->
                                        <div class="form-group">
                                            <label>Category Slug</label>
                                            <input name="slug" class="form-control" placeholder="Enter Category Slug Here" value="<?php echo set_value('slug'); ?>">
                                        </div>

                                        <input type="submit" class="btn btn-primary" value="Submit" />
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