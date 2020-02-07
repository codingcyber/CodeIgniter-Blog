



    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

          <h1 class="my-4">Blog Home
            <small>Secondary Text</small>
          </h1>
          
          <?php foreach($posts as $post){ ?>
          
          <!-- Blog Post -->
          <div class="card mb-4">
            <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
            <div class="card-body">
              <h2 class="card-title"><?php echo $post['title']; ?></h2>
              <p class="card-text"><?php echo $post['content']; ?></p>
              <a href="<?php base_url(); ?>post/<?php echo $post['id']; ?>" class="btn btn-primary">Read More &rarr;</a>
            </div>
            <div class="card-footer text-muted">
              Posted on <?php echo $post['created']; ?> by
              <a href="#">Start Bootstrap</a>
            </div>
          </div>
          <?php } ?>

          <!-- Pagination -->
          <ul class="pagination justify-content-center mb-4">
            <li class="page-item">
              <a class="page-link" href="#">&larr; Older</a>
            </li>
            <li class="page-item disabled">
              <a class="page-link" href="#">Newer &rarr;</a>
            </li>
          </ul>

        </div>

<!-- Sidebar -->

