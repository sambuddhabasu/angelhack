<?php
  $db = new SQLite3('database.db');
  if(isset($_GET['time']) && isset($_GET['cuisine'])) {
    $favs_results = $db->query('SELECT * FROM fav;');
    $favs = array();
    while($row = $favs_results->fetchArray()) {
      array_push($favs, $row[0]);
    }
    $responses = $db->query('SELECT * FROM recipe;');
    $ingredient_list = $db->query('SELECT * FROM ingredient;');
    $ingredient_arr = array();
    while($row = $ingredient_list->fetchArray()) {
      array_push($ingredient_arr, $row['name']);
    }
//    print_r($ingredient_arr);
    $results = array();
    // The main filtering happens here.
    while($row = $responses->fetchArray()) {
      $valid = true;
      $check_time = explode(',', $row['time']);
      if(!in_array(strtolower($_GET['time']), $check_time)) {
        $valid = false;
      }
      $check_cuisine = explode(',', $row['cuisine']);
      if(!in_array(strtolower($_GET['cuisine']), $check_cuisine)) {
        $valid = false;
      }
      $missing = 0;
      if($valid) {
        $ingredients_response = explode(',', $row['ingredient']);
        foreach($ingredients_response as $response) {
          $res = explode('#', $response)[0];
//          echo $res;
          if(!in_array($res, $ingredient_arr)) {
            $missing = $missing + 1;
          }
        }
        $row['missing'] = $missing;
        array_push($results, $row);
      }
    }
    // After inserting into the array, sort it.
    function sort_by_missing($x, $y) {
      return $x['missing'] - $y['missing'];
    }
    usort($results, 'sort_by_missing');
  }
  $times = array();
  $times_results = $db->query('SELECT * from time;');
  while($row = $times_results->fetchArray()) {
    array_push($times, $row[0]);
  }
  $cuisines = array();
  $cuisines_results = $db->query('SELECT * from cuisine;');
  while($row = $cuisines_results->fetchArray()) {
    array_push($cuisines, $row[0]);
  }
?>
<html>
  <head>
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="bootstrap.css">
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="bootstrap.js"></script>
  </head>
  <body>
    <?php
      include_once('header.php');
    ?>
    <div class="container">
      <div class="col-lg-6 col-lg-offset-3">
        <h1>Possible Recipe</h1>
      </div>
        <div class="col-lg-6 col-lg-offset-3">
          <form action="possible_recipe.php" method="GET">
            <div class="form-group">
              <label for="select" class="col-lg-2 control-label">Time</label>
              <div class="col-lg-10">
                <select class="form-control" id="select" name="time">
                  <?php
                    foreach($times as $time) {
                      if(strtolower($_GET['time']) == $time) {
                  ?>
                        <option selected><?php echo ucwords($time); ?></option>
                  <?php
                      }
                      else {
                  ?>
                        <option><?php echo ucwords($time); ?></option>
                  <?php
                      }
		    }
                  ?>
                </select>
              </div>
            </div>
           <div class="form-group">
              <label for="select" class="col-lg-2 control-label" style="margin-top: 10px;">Cuisine</label>
              <div class="col-lg-10">
                <select class="form-control" id="select" name="cuisine" style="margin-top: 10px;">
                  <?php
                    foreach($cuisines as $cuisine) {
                      if(strtolower($_GET['cuisine']) == $cuisine) {
                  ?>
                      <option selected><?php echo ucwords($cuisine); ?></option>
                  <?php
                      }
                      else {
                  ?>
                      <option><?php echo ucwords($cuisine); ?></option>
                  <?php
                      }
                    }
                  ?>
                </select>
              </div>
            </div>
            <button type="submit" class="btn btn-primary col-lg-offset-5" style="margin-top: 10px;">Show Recipe</button>
          </form>
        </div>
        <?php
          if(isset($_GET['time']) && isset($_GET['cuisine'])) {
            foreach($results as $result) {
        ?>
              <div class="col-lg-6 col-lg-offset-3">
                <hr>
                <a href="recipe_info.php?recipe_id=<?php echo $result['recipe_id']; ?>">
                <div class="col-lg-6">
                  <img src="<?php echo $result['photo']; ?>" width="256">
                </div>
                <div class="col-lg-6">
                  <h1><?php echo ucwords($result['name']); ?></h1>
                  </a>
                  <h3>Items to add: <?php echo $result['missing']; ?></h3>
                </div>
                <?php
                  if(!in_array($result['recipe_id'], $favs)) {
                ?>
                    <a href="api_add_fav_recipe.php?recipe_id=<?php echo $result['recipe_id']; ?>">
                      <img src="https://cdn2.iconfinder.com/data/icons/windows-8-metro-style/512/plus-.png" width="64">
                    </a>
                <?php
                  }
                ?>
              </div>
        <?php
            }
          }
        ?>
    </div>
  </body>
</html>
