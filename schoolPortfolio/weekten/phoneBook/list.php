<?php
    function printEmpty(){
        echo "  <tr>
                                                <td>NONE</td>
                                                <td>NONE</td>
                                                <td>NONE</td>
                                                <td>NONE</td>
                                            </tr>";
    }
?>
<!DOCTYPE html>

<html lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>PHONE BOOK</title>
    <link rel="shortcut icon" href="">
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
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Phone Book
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Phone Number</th>
                                <th>Options</th>
                            </tr>
                            <?php
                                //open database connection
                                $conn = mysql_connect('localhost','c2230a09','c2230a09') or trigger_error("SQL", E_USER_ERROR);
                                $db = mysql_select_db('c2230a09proj',$conn) or trigger_error("SQL", E_USER_ERROR);

                                $query = "select firstName, lastName, phoneNumber, id from phonebook";
                                $result = mysql_query($query);

                                if(!$result){
                                    print "Error: Query cannot be processed: ";
                                    $error = mysql_error();
                                    print "$error";
                                    printEmpty();
                                    exit;
                                }

                                $num_rows = mysql_num_rows($result);

                                //if there is any data in the file...
                                if($num_rows){
                                    for($i=0; $i < $num_rows; $i++){
                                        $row = mysql_fetch_row($result);
                                        echo "  <tr>
                                                    <td>" . ucfirst($row[0]) . "</td>
                                                    <td>" . ucfirst($row[1]) . "</td>
                                                    <td>" . "(" . substr($row[2], 0, 3) . ") " . substr($row[2], 3, 3) . "-" . substr($row[2],6,4) . "</td>
                                                    <td>
                                                        <form action='delete.php' method='post' role='form'>
                                                            <input type='hidden' class='form-control' name='entry' value=" . $row[3] . ">
                                                            <input type='submit' value='DELETE'>
                                                        </form>
                                                        <form action='modify-form.php' method='post' role='form'>
                                                            <input type='hidden' class='form-control' name='entry' value=" . $row[3] . ">
                                                            <input type='submit' value='MODIFY'>
                                                        </form>
                                                    </td>
                                                </tr>";
                                    }
                                }
                                else {
                                    printEmpty();
                                }
                            ?>
                        </table>
                            <form method="link" action="insert.html">
                                <input type="submit" value="ADD NEW">
                            </form>
                        </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>
