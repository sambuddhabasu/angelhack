<?php
  $db = new SQLite3('database.db');
  $results = $db->query('SELECT * FROM ingredient;');
//  print_r($results);
?>
<html>
  <head>
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="bootstrap.css">
    <script>
    function getQueryVariable(variable) {
      var query = window.location.search.substring(1);
      var vars = query.split('&');
      for(var i = 0; i < vars.length; i++) {
        var pair = vars[i].split('=');
        if(decodeURIComponent(pair[0]) == variable) {
          return decodeURIComponent(pair[1]);
        }
      }
    }
    var names = getQueryVariable("names");
    names = names.split(',');
    for(var i = 0; i < names.length; i++) {
      window.open("http://groceries.asda.com/asda-webstore/landing/home.shtml#/search/" + names[i]);
    }
    </script>
  </head>
  <body>
    <?php
      include_once('header.php');
    ?>
    <div class="container">
      <div class="col-lg-6 col-lg-offset-3">
        <h1>My Fridge</h1>
      </div>
      <?php
        while($row = $results->fetchArray()) {
      ?>
          <div class="col-lg-6 col-lg-offset-3">
            <hr>
            <div class="col-lg-6">
              <img src="<?php echo $row['photo']; ?>" width="256">
            </div>
            <div class="col-lg-6">
              <h1><?php echo ucwords($row['name']); ?></h1>
              <form action="api_update_ingredient.php" method="GET">
                <h2><input type="text" value="<?php echo $row['quantity']; ?>" name="quantity"> <small><?php echo $row['unit']; ?></small></h2>
                <input type="hidden" value="<?php echo $row['ingredient_id']; ?>" name="ingredient_id">
                <button type="submit" class="btn btn-primary">Update</button>
              </form>
              <form action="api_delete_ingredient.php">
                <input type="hidden" value="<?php echo $row['ingredient_id']; ?>" name="ingredient_id">
                <button type="submit" class="btn btn-danger">Delete</button>
              </form>
            </div>
          </div>
      <?php
        }
      ?>
    </div>
  </body>
</html>
