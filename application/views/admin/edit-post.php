        <div id="page-wrapper" style="min-height: 345px;">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add New Article</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Create a New Article Here...
                        </div>
                        <div class="panel-body">
                            <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php 
                                    $attributes = array('role' => 'form');
                                    echo form_open_multipart('Admin/UpdatePost', $attributes); ?>
                                    <!-- <form role="form" method="post"> -->
                                        <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
                                        <div class="form-group">
                                            <label>Article Title</label>
                                            <input name="title" class="form-control" placeholder="Enter Article Title" value="<?php echo $post['title']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Article Content</label>
                                            <textarea name="content" class="form-control" rows="3"><?php echo $post['content']; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Featured Image</label>
                                            <?php if(!empty($post['pic'])){ ?>
                                            <img src="<?php echo base_url('assets/media/').$post['pic']; ?>" height="50"> <a href="<?php echo base_url('index.php/Admin/DeletePostPic/').$post['id']; ?>">Delete Pic </a>
                                            <?php }else{ ?>
                                            <input name="image" type="file">
                                            <?php } ?>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Categories</label>
                                                    <select name="categories[]" multiple="" class="form-control">
                                                        <?php foreach ($categories as $category) { ?>
                                                        <option value="<?php echo $category['id']; ?>" <?php if(in_array($category['id'], array_column($catids, 'cid'))){ echo "selected"; } ?>><?php echo $category['title']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Article Status</label>
                                                    <div class="radio">
                                                        <label>
                                                            <input name="status" type="radio" name="optionsRadios" id="optionsRadios1" value="draft" <?php if($post['status'] == "draft"){ echo "checked"; }; ?>>Draft
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input name="status" type="radio" name="optionsRadios" id="optionsRadios2" value="review" <?php if($post['status'] == "review"){ echo "checked"; }; ?>>Pending Review
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input name="status" type="radio" name="optionsRadios" id="optionsRadios3" value="published" <?php if($post['status'] == "published"){ echo "checked"; }; ?>>Published
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Article Slug</label>
                                            <input name="slug" class="form-control" placeholder="Enter Article Slug Here" value="<?php echo $post['slug']; ?>">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="reset" class="btn btn-danger">Reset </button>
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