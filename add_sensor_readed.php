<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta charset="utf-8">
  <style type="text/css">
    .error {color : #FF0000;}
  </style>
</head>
<body>
<h2>PHP Form Validation Example</h2>
<form method="get" action="<?php echo htmlspecialchars($_SERVER['PHP_SELT']);?>">
  Temparature : <input type="text" name="temparature" value="<?php echo $temparature;?>" ><br>
  pH : <input type="text" name="ph" value="<?php echo $ph;?>" ><br>
  <input type="submit" name="submit" value="submit">
</form>
<?php
$temparature = $_GET['temparature'];
$password = $_GET['ph'];

function pg_connection_string_from_database_url() {
  extract(parse_url($_ENV["DATABASE_URL"]));
  return "user=$user password=$pass host=$host dbname=" . substr($path, 1);}
$db = pg_connect(pg_connection_string_from_database_url());

if(!$db){
      echo "Error : Unable to open database\n";
   } else {
      echo "Opened database successfully\n";
   }
 $sql = "INSERT INTO sensorReaded (temparature , ph) VALUES ('$temparature','$ph')";

print "<br>$sql<br>";

$ret = pg_query($db, $sql);
if(!$ret){
  echo pg_last_error($db);
} else {
    echo "Insert successfully\n";
  }
pg_close($db);

?>
<BR><a href="index.php">HOME</a>
</body>
</html>