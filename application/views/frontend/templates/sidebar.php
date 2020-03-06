        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">
        <?php 
          echo "<pre>";
          print_r($sidebar);
          echo "</pre>";
         ?>
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

          <!-- Categories Widget -->
          <div class="card my-4">
            <h5 class="card-header">Categories</h5>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6">
                  <ul class="list-unstyled mb-0">
                    <li>
                      <a href="#">Web Design</a>
                    </li>
                    <li>
                      <a href="#">HTML</a>
                    </li>
                    <li>
                      <a href="#">Freebies</a>
                    </li>
                  </ul>
                </div>
                <div class="col-lg-6">
                  <ul class="list-unstyled mb-0">
                    <li>
                      <a href="#">JavaScript</a>
                    </li>
                    <li>
                      <a href="#">CSS</a>
                    </li>
                    <li>
                      <a href="#">Tutorials</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

          <!-- Side Widget -->
          <div class="card my-4">
            <h5 class="card-header">Side Widget</h5>
            <div class="card-body">
              You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
            </div>
          </div>


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