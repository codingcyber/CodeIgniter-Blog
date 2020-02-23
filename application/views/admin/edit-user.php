        <div id="page-wrapper" style="min-height: 345px;">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit User</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Update User Here...
                        </div>
                        <div class="panel-body">
                            <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                            <div class="row">
                                <div class="col-lg-6">
                                    <?php 
                                    $attributes = array('role' => 'form');
                                    echo form_open('Admin/UpdateUser', $attributes); ?>
                                    <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                    <!-- <form role="form"> -->
                                        <div class="form-group">
                                            <label>User Name</label>
                                            <input name="username" class="form-control" placeholder="Enter User Name" value="<?php echo $user['username']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>E-Mail</label>
                                            <input name="email" type="email" class="form-control" placeholder="Enter E-Mail" value="<?php echo $user['email']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input name="fname" class="form-control" placeholder="Enter First Name" value="<?php echo $user['fname']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input name="lname" class="form-control" placeholder="Enter Last Name" value="<?php echo $user['lname']; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" class="form-control" placeholder="Enter User Password">
                                        </div>
                                        <div class="form-group">
                                            <label>User Role</label>
                                            <select name="role" class="form-control">
                                                <option value="">Select User Role</option>
                                                <option value="subscriber" <?php if($user['role'] == 'subsriber'){ echo "selected"; } ?>>Subscriber</option>
                                                <option value="editor" <?php if($user['role'] == 'editor'){ echo "selected"; } ?>>Editor</option>
                                                <option value="administrator" <?php if($user['role'] == 'administrator'){ echo "selected"; } ?>>Administrator</option>
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