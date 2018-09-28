<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Make Me Elvis - Send Email</title>
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <img src="blankface.jpg" width="161" height="350" alt="" style="float:right" />
  <img name="elvislogo" src="elvislogo.gif" width="229" height="32" border="0" alt="Make Me Elvis" />
  <p><strong>Private:</strong> For Elmer's use ONLY<br />
  Write and send an email to mailing list members.</p>

  <?php
    $subject = NULL;
    $text = NULL;
    if(isset($_POST['submit'])){
        //this executes only if the form is submitted.
        $from = 'elmer@makemeelvis.com';
        $subject = $_POST['subject'];
        $text = $_POST['elvismail'];
        $show_form = false;

        //checking if either of the fields are empty.
        if( empty($subject) || empty($text) ){
            // If so, display the message and set the show_form flag to true.
            $show_form = true;
        }
        else{
            // if both fields were filled, send the mail.
            $dbc = mysqli_connect('localhost', 'root', 'Home1998', 'elvis_store')
                or die('Couldn\'t connect to the database');
            
            $query = "SELECT * FROM email_list";

            $result = mysqli_query($dbc, $query) 
                or die("Couldn't query the database");

            while($row = mysqli_fetch_array($result)){
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $to = $row['email'];

                $msg = "Dear $first_name $last_name,\n$text";

                if(mail($to, $subject, $msg, 'FROM: ' . $from))
                    echo 'email was sent to ' . $to . '<br/>';
                else
                    echo 'ERROR: couldn\'t email ' . $to . '<br/>';
            }

            mysqli_close($dbc);
        }
    }
    else{
        //This executes if the form was not submitted.
        $show_form = true;
    }
    //check if the form should be displayed or not.
    if($show_form){
  ?>

  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="subject">Subject of email:</label><br />
    <input id="subject" name="subject" type="text" size="30" value="<?php echo $subject; ?>"/><br />
    <?php 
        if(empty($subject) && isset($_POST['submit'])){
            echo '<p style="color:red; font-weight:lighter; font-size:12px;">Please fill the Subject field.</p>';
        }
    ?>
    <label for="elvismail">Body of email:</label><br />
    <textarea id="elvismail" name="elvismail" rows="8" cols="40" ><?php echo $text; ?></textarea><br />
    <?php
        if(empty($text) && isset($_POST['submit'])){
            echo '<p style="color:red; font-weight:lighter; font-size:12px;">Please fill the Email body.</p>';
        }
    ?>
    <input type="submit" name="submit" value="submit" />
  </form>

  <?php 
    //code for making the form 'sticky' is added.
    }
  ?>
</body>
</html>