<?php
$id = $_POST["entry"];

//open database connection
$conn = mysql_connect('localhost','c2230a09','c2230a09') or trigger_error("SQL", E_USER_ERROR);
$db = mysql_select_db('c2230a09proj',$conn) or trigger_error("SQL", E_USER_ERROR);

$query = "select firstName, lastName, phoneNumber from phonebook WHERE id = $id";
$result = mysql_query($query);

$row = mysql_fetch_row($result);
?>
<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>PHONE BOOK - MODIFY</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="phonebook.css">

    <!--[if IE]>
        <script src="https://cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://cdn.jsdelivr.net/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <?php echo
                '<div class="panel panel-default">
                    <div class="panel-heading">
                        Phone Book - Modify
                    </div>
                    <div class="panel-body">
                        <form action="modify.php" method="post" role="form">
                            <div class="form-group">
                                <label for="firstName">First Name</label>
                                <input type="text" class="form-control" name="firstName" value=' . $row[0] . '>
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <input type="text" class="form-control" name="lastName" value=' . $row[1] . '>
                            </div>
                            <div class="form-group">
                                <label for="phoneNumber">Phone Number</label>
                                <input type="number" min="1111111111" max="9999999999" class="form-control" name="phoneNumber" value=' . $row[2] . '>
                            </div>
                            <input type="hidden" class="form-control" name="index" value=' . $id . '>
                            <input type="submit" value="SUBMIT">

                        </form>
                    </div>
                </div>';?>

            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>
