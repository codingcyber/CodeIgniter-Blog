        <div id="page-wrapper" style="min-height: 345px;">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Users</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            All the Users 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?php echo $this->session->flashdata('user'); ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>User Name</th>
                                            <th>Full Name</th>
                                            <th>E-Mail</th>
                                            <th>Role</th>
                                            <th>Operations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($users as $user) { ?>
                                        <tr>
                                            <td><?php echo $user['id']; ?></td>
                                            <td><?php echo $user['username']; ?></td>
                                            <td><?php echo $user['fname'] . " " . $user['lname']; ?></td>
                                            <td><?php echo $user['email']; ?></td>
                                            <td><?php echo $user['role']; ?></td>
                                            <td><a href="EditUser/<?php echo $user['id']; ?>">Edit</a> | <a href="DeleteUser/<?php echo $user['id']; ?>">Delete</a></td>
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