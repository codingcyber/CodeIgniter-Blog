        <div id="page-wrapper" style="min-height: 345px;">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Widgets</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            All the Widgets 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <?php echo $this->session->flashdata('widget'); ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Type</th>
                                            <th>Order</th>
                                            <th>Date</th>
                                            <th>Operations</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($widgets as $widget) { ?>
                                        <tr>
                                            <td><?php echo $widget['id']; ?></td>
                                            <td><?php echo $widget['title']; ?></td>
                                            <td><?php echo $widget['type']; ?></td>
                                            <td><?php echo $widget['widget_order']; ?></td>
                                            <td><?php echo $widget['created']; ?></td>
                                            <td><a href="EditWidget/<?php echo $widget['id']; ?>">Edit</a> | <a href="DeleteWidget/<?php echo $widget['id']; ?>">Delete</a></td>
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
