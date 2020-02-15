        <div id="page-wrapper" style="min-height: 345px;">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Category</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Update Category Here...
                        </div>
                        <div class="panel-body">
                            <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php 
                                    $attributes = array('role' => 'form');
                                    echo form_open('Admin/UpdateCategory', $attributes); ?>
                                    <!-- <form role="form" action="http://localhost/CodeIgniter-Blog/index.php/Admin/UpdateCategory" method="post"> -->
                                        <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
                                        <div class="form-group">
                                            <label>Category Title</label>
                                            <input name="title" class="form-control" placeholder="Enter Article Title" value="<?php echo $category['title']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Article Description</label>
                                            <textarea name="description" class="form-control" rows="3"><?php echo $category['description']; ?></textarea>
                                        </div>
                                        <!-- <div class="form-group">
                                            <label>Category Image</label>
                                            <input type="file">
                                        </div> -->
                                        <div class="form-group">
                                            <label>Category Slug</label>
                                            <input name="slug" class="form-control" placeholder="Enter Category Slug Here" value="<?php echo $category['slug']; ?>">
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