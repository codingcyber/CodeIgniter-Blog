        <div id="page-wrapper" style="min-height: 345px;">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Articles</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            All the Articles 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?php echo $this->session->flashdata('posts'); ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Categories</th>
                                            <th>Image</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Operations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($posts as $post) { ?>
                                        <tr>
                                            <td><?php echo $post['id']; ?></td>
                                            <td><?php echo $post['title']; ?></td>
                                            <td>Categories</td>
                                            <td><?php if(!empty($post['pic'])){ echo "Yes"; }else{ echo "No"; } ?></td>
                                            <td><?php echo $post['created']; ?></td>
                                            <td><?php echo $post['status']; ?></td>
                                            <td><a href="EditPost/<?php echo $post['id']; ?>">Edit</a> | <a href="DeletePost/<?php echo $post['id']; ?>">Delete</a></td>
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