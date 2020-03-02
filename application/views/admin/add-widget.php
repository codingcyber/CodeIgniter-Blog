        <div id="page-wrapper" style="min-height: 345px;">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add New Widget</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Create a New Widget Here...
                        </div>
                        <div class="panel-body">
                            <?php echo validation_errors("<div class='alert alert-danger'>", "</div>"); ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php 
                                    $attributes = array('role' => 'form');
                                    echo form_open('', $attributes); ?>
                                        <div class="form-group">
                                            <label>Widget Title</label>
                                            <input name="title" class="form-control" placeholder="Enter Article Title" value="<?php echo set_value('title'); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Widget Type</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="type" id="optionsRadios1" value="html" <?php echo set_radio('type', 'html'); ?>>HTML
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="type" id="optionsRadios2" value="categories" <?php echo set_radio('type', 'categories'); ?>>Categories
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="type" id="optionsRadios3" value="search" <?php echo set_radio('type', 'search'); ?>>Search
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="type" id="optionsRadios3" value="articles" <?php echo set_radio('type', 'articles'); ?>>Recent Articles
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="type" id="optionsRadios3" value="pages" <?php echo set_radio('type', 'pages'); ?>>Pages
                                                </label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Widget Content</label>
                                            <textarea name="content" class="form-control" rows="3"><?php echo set_value('content'); ?></textarea>
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