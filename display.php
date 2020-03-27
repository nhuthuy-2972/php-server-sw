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
<?php
function pg_connection_string_from_database_url() {
  extract(parse_url($_ENV["DATABASE_URL"]));
  return "user=$user password=$pass host=$host dbname=" . substr($path, 1);}
$db = pg_connect(pg_connection_string_from_database_url());

if(!$db){
      echo "Error : Unable to open database\n";
   } else {
      echo "Opened database successfully\n";
   }


 $sql = "SELECT * FROM sensorReaded";

print "<br>$sql<br>";

$ret = pg_query($db, $sql);
if(!$ret){
  echo pg_last_error($db);
  exit();}
?>

<table border="1"  cellspacing="2" cellpadding="2">
  <tr>
    <td>Temparature</td>
    <td>pH</td>
  </tr>
  <?php
    while($myrow = pg_fetch_assoc($ret)){
    printf ("<tr><td>%s</td><td>%s</td></tr>",$myrow['temparature'],$myrow['ph']);
  }

  pg_close($db);
  ?>
</table>
<BR><a href="index.php">HOME</a>
</body>
</html>