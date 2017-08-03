<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $emailError = null;
        $mobileError = null;
         
        // keep track post values
        $name = $_POST['name'];
        $publisher = $_POST['publisher'];
        $page = $_POST['page'];
         
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter Name';
            $valid = false;
        }
         
        if (empty($publisher)) {
            $publisherError = 'Please enter Publisher';
            $valid = false;
        } 
		if (empty($page)) {
            $mobileError = 'Please enter Page';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO book (name,publisher,page) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$publisher,$page));
            Database::disconnect();
            header("Location: index.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Create a Book</h3>
                    </div>
             
                    <form class="form-horizontal" action="create.php" method="post">
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
					  <div class="control-group <?php echo !empty($publisherError)?'error':'';?>">
                        <label class="control-label">Publisher</label>
                        <div class="controls">
                            <input name="publisher" type="text"  placeholder="Publisher" value="<?php echo !empty($publisher)?$publisher:'';?>">
                            <?php if (!empty($publisherError)): ?>
                                <span class="help-inline"><?php echo $publisherError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
					  <div class="control-group <?php echo !empty($pageError)?'error':'';?>">
                        <label class="control-label">Page</label>
                        <div class="controls">
                            <input name="page" type="text"  placeholder="Page" value="<?php echo !empty($page)?$page:'';?>">
                            <?php if (!empty($pageError)): ?>
                                <span class="help-inline"><?php echo $pageError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
					  
                      
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="index.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>