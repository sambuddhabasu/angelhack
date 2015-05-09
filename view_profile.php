<?php
  $db = new SQLite3('database.db');
  $results = $db->query('SELECT * FROM users WHERE user_id=1;');
  $row = $results->fetchArray();
//  print_r($row);
?>
<html>
  <head>
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="bootstrap.css">
  </head>
  <body>
    <?php
      include_once('header.php');
    ?>
    <div class="container">
      <div class="col-lg-6 col-lg-offset-3">
        <h1>Profile</h1>
      </div>
      <div class="col-lg-6 col-lg-offset-3">
        <img src="https://files.nyu.edu/zcs212/public/images/2012-Nissan-GT-R-Car-Wallpapers.jpg" width="512">
      </div>
      <div class="col-lg-6 col-lg-offset-3" style="margin-top: 10px;">
        <form class="form-horizontal" action="api_update_profile.php" method="GET" enctype="multipart/form-data">
          <div class="form-group">
            <label class="col-lg-4 control-label">Upload profile picture</label>
            <div class="col-lg-8">
              <input type="file" class="form-control" name="image" />
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-4 control-label">First Name</label>
            <div class="col-lg-8">
              <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="<?php echo $row['first_name']; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-4 control-label">Last Name</label>
            <div class="col-lg-8">
              <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="<?php echo $row['last_name']; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-4 control-label">Email</label>
            <div class="col-lg-8">
              <input type="text" class="form-control" id="email" placeholder="Email" name="email" value="<?php echo $row['email']; ?>">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-4 control-label">Phone</label>
            <div class="col-lg-8">
              <input type="text" class="form-control" id="phone" placeholder="Phone" name="phone" value="<?php echo $row['phone']; ?>">
            </div>
          </div>
          <div class="form-group">
            <div class="col-lg-4 col-lg-offset-4">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </div>
        </form>
      </div>
      <div class="col-lg-6 col-lg-offset-3">
        <a href="fav_recipe.php" class="btn btn-default btn-lg btn-block">Favourite List</a>
        <a href="#" class="btn btn-default btn-lg btn-block">History</a>
        <a href="#" class="btn btn-default btn-lg btn-block">Share</a>
        <a href="#" class="btn btn-default btn-lg btn-block">Legal</a>
        <a href="#" class="btn btn-default btn-lg btn-block">SignOut</a>
      </div>
    </div>
  </body>
</html>
