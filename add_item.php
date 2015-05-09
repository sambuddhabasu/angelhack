<?php
  if(isset($_GET['items'])) {
    $items = $_GET['items'];
    $items = explode(",", $items);
//    print_r($items);
  }
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
        <h1>Add Item To Fridge</h1>
      </div>
      <div class="col-lg-6 col-lg-offset-3">
        <form action="extract_receipt.php" method="post" enctype="multipart/form-data" class="form-horizontal">
        <input type="file" name="file" class="form-control">
        <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Upload Receipt</button>
	</form>
      </div>
      <?php
        if(count($items)) {
      ?>
          <form action="api_add_item.php" class="form-horizontal">
      <?php
          for($i = 0; $i < count($items); $i +=2) {
      ?>
            <div class="col-lg-6 col-lg-offset-3">
              <div class="col-lg-6">
              <input class="form-control" value="<?php echo $items[$i]; ?>" name="name_<?php echo $i / 2; ?>">
              </div>
              <div class="col-lg-6">
              <input class="form-control" value="<?php echo $items[$i + 1]; ?>" name="quantity_<?php echo $i / 2; ?>">
              </div>
            </div>
      <?php
	  }
      ?>
          <div class="col-lg-6 col-lg-offset-3">
	    <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Add Items</button>
          </div>
          </form>
      <?php
	}
      ?>
    </div>
  </body>
</html>
