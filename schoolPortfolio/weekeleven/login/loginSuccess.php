<?php
    session_start();
    if (!(isset($_SESSION['login']))) {
        header("Location: loginForm.php");
}

?>
<!DOCTYPE html>
<html lang="">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="description" content="">
     <meta name="author" content="">
     <title>Login Page</title>
     <link rel="shortcut icon" href="">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="login.css">

     <!--[if IE]>
<script src="https://cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://cdn.jsdelivr.net/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
     <div class="container">
          <div class="row">
               <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-primary">
                         <div class="panel-heading">
                              Login Successful!
                         </div>
                         <div class="panel-body">
                              Login was succesful! Woohoo!
                             <?php
                                echo "<br><h1>Login:</h1> " . $_SESSION['login'] .
                                    "<br><h1>First Name:</h1> " . $_SESSION['firstName'] .
                                    "<br><h1>Last Name:</h1> " . $_SESSION['lastName'] .
                                    "<br><h1>Username:</h1> " . $_SESSION['username'] .
                                    "<br><h1>Email:</h1> " . $_SESSION['email'];
//                                print_r($_SESSION);
                            ?>
                            <form action="logout.php">
                                <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-4">
                                    <button type="submit" class="btn btn-default submit">Log out</button>
                                </div>
                            </div>
                            </form>
                         </div>
                    </div>
               </div>
          </div>
     </div>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</body>

</html>
