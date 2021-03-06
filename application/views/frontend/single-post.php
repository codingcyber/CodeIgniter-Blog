

    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <!-- Post Content Column -->
        <div class="col-lg-8">

          <!-- Title -->
          <h1 class="mt-4"><?php echo $post['title'] ?></h1>

          <!-- Author -->
          <p class="lead">
            by
            <a href="#">Start Bootstrap</a>
          </p>

          <hr>

          <!-- Date/Time -->
          <p>Posted on <?php echo $post['created'] ?></p>

          <hr>

          <!-- Preview Image -->
          <?php if(isset($post['pic']) & !empty($post['pic'])){ ?>
            <img class="card-img-rounded" src="<?php echo base_url('assets/media/'); ?><?php echo $post['pic']; ?>" alt="Card image cap" width="100%">
          <?php }else{ ?>
          <img class="card-img-rounded" src="http://placehold.it/900x300" alt="Card image cap">
          <?php } ?>

          <hr>

          <!-- Post Content -->
          <p class="lead"><?php echo $post['content'] ?></p>

          <hr>
          <?php if($userLogin){ ?>
          <!-- Comments Form -->
          <div class="card my-4">
            <h5 class="card-header">Leave a Comment:</h5>
            <div class="card-body">
              <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
              <?php echo $this->session->flashdata('comment'); ?>
              <?php 
                $attributes = array('role' => 'form');
                echo form_open('Blog/submitComment', $attributes); ?>
                <div class="form-group">
                  <input type="hidden" name="pid" value="<?php echo $post['id']; ?>">
                  <textarea name="comment" class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        <?php }else{?>
          <h3>You Should be Loggein to post Comments.</h3><hr>
        <?php } ?>

        <?php 
          if($comment['count'] >= 1){ 
            foreach ($comment['rows'] as $comment) {
          ?>
          <!-- Single Comment -->
          <div class="media mb-4">
            <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
            <div class="media-body">
              <h5 class="mt-0"><?php if((isset($comment['fname']) || isset($comment['lname'])) & (!empty($comment['fname']) || !empty($comment['lname']))){ echo $comment['fname'] . " " . $comment['lname']; }else{ echo $comment['username'];} ?>
                <?php if($comment['role'] == 'administrator'){ echo "<span class='badge badge-danger'>Admin</span>"; }elseif($comment['role'] == 'editor'){
                  echo "<span class='badge badge-primary'>Editor</span>";
                } ?>
              </h5>
              <?php echo $comment['comment']; ?>
            </div>
          </div>
        <?php } }else{ ?>
          <h3>No Comments for this post, be the first one to post a new comment.</h3><hr>
        <?php } ?>

        </div>

        <!-- Sidebar -->