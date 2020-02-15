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
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php 
                                    $attributes = array('role' => 'form');
                                    echo form_open('', $attributes); ?>
                                    <!-- <form role="form" method="post"> -->
                                        <div class="form-group">
                                            <label>Article Title</label>
                                            <input name="title" class="form-control" placeholder="Enter Article Title">
                                        </div>
                                        <div class="form-group">
                                            <label>Article Content</label>
                                            <textarea name="content" class="form-control" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Featured Image</label>
                                            <input name="image" type="file">
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Categories</label>
                                                    <select name="categories[]" multiple="" class="form-control">
                                                        <option>1</option>
                                                        <option>2</option>
                                                        <option>3</option>
                                                        <option>4</option>
                                                        <option>5</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Article Status</label>
                                                    <div class="radio">
                                                        <label>
                                                            <input name="status" type="radio" name="optionsRadios" id="optionsRadios1" value="draft" checked="">Draft
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input name="status" type="radio" name="optionsRadios" id="optionsRadios2" value="review">Pending Review
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input name="status" type="radio" name="optionsRadios" id="optionsRadios3" value="published">Published
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Article Slug</label>
                                            <input name="slug" class="form-control" placeholder="Enter Article Slug Here">
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