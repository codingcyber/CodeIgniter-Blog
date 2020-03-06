        <div id="page-wrapper" style="min-height: 345px;">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit Widget</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Update Widget Here...
                        </div>
                        <div class="panel-body">
                            <?php echo validation_errors("<div class='alert alert-danger'>", "</div>"); ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php 
                                    $attributes = array('role' => 'form');
                                    echo form_open('Admin/UpdateWidget', $attributes); ?>
                                    <input type="hidden" name="id" value="<?php echo $widget['id']; ?>">
                                        <div class="form-group">
                                            <label>Widget Title</label>
                                            <input name="title" class="form-control" placeholder="Enter Article Title" value="<?php echo $widget['title']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Widget Type</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="type" id="optionsRadios1" value="html" <?php if($widget['type'] == 'html'){ echo "checked"; } ?>>HTML
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="type" id="optionsRadios2" value="categories" <?php if($widget['type'] == 'categories'){ echo "checked"; } ?>>Categories
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="type" id="optionsRadios3" value="search" <?php if($widget['type'] == 'search'){ echo "checked"; } ?>>Search
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="type" id="optionsRadios3" value="articles" <?php if($widget['type'] == 'articles'){ echo "checked"; } ?>>Recent Articles
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="type" id="optionsRadios3" value="pages" <?php if($widget['type'] == 'pages'){ echo "checked"; } ?>>Pages
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Widget Content</label>
                                            <textarea name="content" class="form-control" rows="3"><?php echo $widget['content']; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Widget Order</label>
                                            <select name="order" class="form-control">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Submit</button>
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