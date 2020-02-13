        <div id="page-wrapper" style="min-height: 345px;">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Categories</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            All the Categories 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?php echo $this->session->flashdata('category'); ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Slug</th>
                                            <th>Operations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($categories as $category) { ?>
                                        <tr>
                                            <td><?php echo $category['id']; ?></td>
                                            <td><?php echo $category['title']; ?></td>
                                            <td><?php echo $category['description']; ?></td>
                                            <td><?php echo $category['slug']; ?></td>
                                            <td><a href="EditCategory/<?php echo $category['id']; ?>">Edit</a> | <a href="DeleteCategory/<?php echo $category['id']; ?>">Delete</a></td>
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