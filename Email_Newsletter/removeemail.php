<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Make Me Elvis - Remove Email</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <img src="blankface.jpg" width="300" height="600" alt="" style="float:right" />
  <img name="elvislogo" src="elvislogo.gif" width="500" height="70" border="0" alt="Make Me Elvis" />
  <p>Please select email addresses you wish to remove and then click remove.</p><br>

  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <?php
    $dbc = mysqli_connect('localhost', 'root', 'Home1998', 'elvis_store')
    or die('Couldn\'t connect to the database');

    if(isset($_POST['submit'])){
        foreach($_POST['todelete'] as $id){
            $query = "DELETE FROM email_list where id=$id";
            $result = mysqli_query($dbc, $query) 
                or die("Couldn't query the database");
        }
        echo 'Customer(s) removed. <br>';
    }
    
    $query = "SELECT * FROM email_list";

    $result = mysqli_query($dbc, $query) 
        or die("Couldn't query the database");   

    while($row = mysqli_fetch_array($result)){
        echo '<input type="checkbox" value="' . $row['id'] . '" name ="todelete[]" >'; 
        echo $row['first_name'] . ' ' . $row['last_name'] . ': ' . $row['email'] . '<br />';
    }
    mysqli_close($dbc);  
    ?>
    <input type="submit" name="submit" value="Remove" />
  </form>
</body>
</html>