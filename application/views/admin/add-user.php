        <div id="page-wrapper" style="min-height: 345px;">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add New User</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Create a New User Here...
                        </div>
                        <div class="panel-body">
                            <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                            <div class="row">
                                <div class="col-lg-6">
                                    <?php 
                                    $attributes = array('role' => 'form');
                                    echo form_open('', $attributes); ?>
                                    <!-- <form role="form"> -->
                                        <div class="form-group">
                                            <label>User Name</label>
                                            <input name="username" class="form-control" placeholder="Enter User Name" value="<?php echo set_value('username'); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>E-Mail</label>
                                            <input name="email" type="email" class="form-control" placeholder="Enter E-Mail" value="<?php echo set_value('email'); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input name="fname" class="form-control" placeholder="Enter First Name" value="<?php echo set_value('fname'); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input name="lname" class="form-control" placeholder="Enter Last Name" value="<?php echo set_value('lname'); ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" class="form-control" placeholder="Enter User Password">
                                        </div>
                                        <div class="form-group">
                                            <label>User Role</label>
                                            <select name="role" class="form-control">
                                                <option value="">Select User Role</option>
                                                <option value="subscriber">Subscriber</option>
                                                <option value="editor">Editor</option>
                                                <option value="administrator">Administrator</option>
                                            </select>
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