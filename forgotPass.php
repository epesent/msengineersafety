<?php
    session_start();
    require_once 'connectdb.php';
    $errors = array();

try {

  if (isset($_POST['submit'])) {
      if (!filter_var($_POST['userEmail'], FILTER_VALIDATE_EMAIL)) {
          $errors['email'] = "*Please use a valid email.";
      } else { //Valid email is in the db
          $userEmail = mysqli_real_escape_string($dbconn, $_POST['userEmail']);
          $user = getUser($dbconn, $userEmail);
          if (!empty($user)) {
              //set the session variables.
              $_SESSION['userId'] = $user['userId'];
              $_SESSION['permissionLevel'] = $user['permissionLevel'];
              header("location: reqPwd.php?userEmail=$userEmail");
          } else { //Valid email not in the db
              $errors['email'] = 'Your email address is not in our system.  Please contact the office.';
          }
      }
  }
}  catch (Exception $e) {
    echo 'Message: ', $e->getMessage(), "\n";
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="css/main.css" />
    <style type="text/css">
        #content {
            width: 30%;
            min-height: 300px;
            margin: 0 auto 0 auto;
            font-size: 12px;
            font-weight: 100;
        }
    </style>
</head>
<body>
    <?php include_once "includes/inc.topbanner.php"; ?>
    <div id="wrapper">

        <div id="content">
            <div style="height: 40px;"></div><!--spacer-->
            <h2>RESET YOUR PASSWORD</h2>
            <div style="height: 30px;"></div><!--spacer-->
            <form action="" method="post">
                <label for="userEmail">Please enter your email address:</label><br/><br/>
                <input type="text" id="userEmail" name="userEmail" placeholder="Email Address" required="required" value="<?php if ($_POST && $errors) {
                    echo htmlentities($_POST['userEmail'], ENT_COMPAT, 'UTF-8');}?>"/>
                <span class="error" style="font-size: 10px; font-style: italic;">
                    <?php
                    if ($_POST && isset($errors['email'])) {
                        echo $errors['email'];
                    }
                    ?>
                </span><br/><br/>
                <input type="submit" id="submit" name="submit" class="btn" value="Request Password"/>
            </form>

        </div><!--end content-->


        <?php include_once "includes/inc.shlinks.php"; ?>
    </div><!--end wrapper-->
    <?php include_once "includes/inc.botbanner.php"; ?>
</body>
</html>