        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">
        
         <?php if($sidebar['search']['widgetcount'] == 1){ ?>
          <!-- Search Widget -->
          <div class="card my-4">
            <h5 class="card-header"><?php echo $sidebar['search']['widget']['title']; ?></h5>
            <div class="card-body">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                  <button class="btn btn-secondary" type="button">Go!</button>
                </span>
              </div>
            </div>
          </div>
        <?php } ?>
        <?php if($sidebar['categories']['widgetcount'] == 1){ ?>
          <!-- Categories Widget -->
          <div class="card my-4">
            <h5 class="card-header"><?php echo $sidebar['categories']['widget']['title']; ?></h5>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12">
                  <ul class="list-unstyled mb-0">
                    <?php foreach ($sidebar['catres'] as $catr) {  ?>
                    <li>
                      <a href="<?php echo base_url('index.php/Blog/category/'); ?><?php echo $catr['id']; ?>"><?php echo $catr['title']; ?></a>
                    </li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
        <?php if($sidebar['articles']['widgetcount'] == 1){ ?>
          <!-- Articles Widget -->
          <div class="card my-4">
            <h5 class="card-header"><?php echo $sidebar['articles']['widget']['title']; ?></h5>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12">
                  <ul class="list-unstyled mb-0">
                    <?php foreach ($sidebar['postres'] as $postr) {  ?>
                    <li>
                      <a href="<?php echo base_url('index.php/Blog/post/'); ?><?php echo $postr['id']; ?>"><?php echo $postr['title']; ?></a>
                    </li>
                    <?php } ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
        <?php if($sidebar['pages']['widgetcount'] == 1){ ?>
          <!-- Articles Widget -->
          <div class="card my-4">
            <h5 class="card-header"><?php echo $sidebar['pages']['widget']['title']; ?></h5>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12">
                  <!-- <ul class="list-unstyled mb-0">
                    <?php //foreach ($sidebar['pageres'] as $pager) {  ?>
                    <li>
                      <a href="<?php //echo base_url('index.php/Blog/page/'); ?><?php //echo $pager['id']; ?>"><?php //echo $pager['title']; ?></a>
                    </li>
                    <?php //} ?>
                  </ul> -->
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
        <?php if($sidebar['html']['widgetcount'] >= 1){ ?>
          <?php foreach ($sidebar['html']['widgets'] as $htmlwidget) { ?>
          <!-- Side Widget -->
          <div class="card my-4">
            <h5 class="card-header"><?php echo $htmlwidget['title']; ?></h5>
            <div class="card-body">
              <?php echo $htmlwidget['content']; ?>
            </div>
          </div>
        <?php } } ?>


          <!-- Side Widget -->
          <div class="card my-4">
            <h5 class="card-header"><?php if($userLogin){ echo "Welcome User!";}else{ echo "User Login";} ?></h5>
            <div class="card-body">
              <?php
                if($userLogin){
              ?>
              Hi <?php if((isset($user['fname']) || isset($user['lname'])) & (!empty($user['fname']) || !empty($user['lname']))){ echo $user['fname'] . " " . $user['lname']; }else{ echo $user['username'];} ?>, Logged in as 
              <?php 
              if(($user['role'] == 'administrator') || ($user['role'] == 'editor')){
                echo "<a href='" . base_url('index.php/Admin/Dashboard') ."'>". $user['role'] ."</a>";
              }elseif($user['role'] == 'subscriber'){
                echo "<a href='" . base_url('index.php/Blog') ."'>". $user['role'] ."</a>";
              } ?>
              <br><a href="<?php echo base_url('index.php/Blog/'); ?>logout">Logout</a>
            <?php }else{ ?>
              <?php echo $this->session->flashdata('login'); ?>
              <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
              <?php 
                  $attributes = array('role' => 'form');
                  echo form_open('Blog/login', $attributes); ?>
                  <fieldset>
                      <div class="form-group">
                          <input name="email" class="form-control" placeholder="E-mail" name="email" type="email" autofocus value="">
                      </div>
                      <div class="form-group">
                          <input name="password" class="form-control" placeholder="Password" name="password" type="password" value="">
                      </div>
                      <!-- Change this to a button or input when using this as a form -->
                      <input type="submit" class="btn btn-lg btn-success btn-block" value="Login" />
                  </fieldset>
              </form>
            <?php } ?>
            </div>
          </div>

        </div>