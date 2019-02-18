<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Roland Stoll">
    <title>TSV Moosach - Mitgliedschaft</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/custom.css" rel="stylesheet">

</head>
<body>
<h1>Hello Roland!</h1>
<h4>Attempting MySQL connection from php...</h4>
<?php
$host = 'db';
$user = 'user';
$pass = 'pwd';
$conn = new mysqli($host, $user, $pass);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected to MySQL successfully!";
?>

<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>