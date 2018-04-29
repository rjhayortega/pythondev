<?php
error_reporting(-1);
ini_set('display_errors', 'On');

$html = "<img src=http://app.knackmap.com/pdev/0185722b563d116680ee8b42f365f4d8.png></img><b></br></br>Welcome to our Knackmap Family!</b></br></br>Hello [Ronald],</br></br>Thanks for subscribing to our [package name] plan, you can now get started on our platform!</br></br>";


 $localhost = 'knackmap-app.clyo0qp5f5mz.us-west-2.rds.amazonaws.com';
  $user = 'klaus7820';
  $pass = 'G[3K8n873C<PRz<.$xXGf';
  $db = 'knackmapdb';
        $conn = new mysqli($localhost, $user, $pass,$db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";



$sql = "desc knack_email_template";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()){
    var_dump($row);
	echo"<br>";
}

echo $html;
//var_dump(getColumnNames("knack_email_template"));


$sql = "select * from knack_email_template";
$result = $conn->query($sql);
//echo ">>>".$result->num_rows;


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    // echo $row["template"];
    }
} else {
   // echo "0 results";
}






$sql1 = "update knack_email_template set template='".$html."' where id>0";
//$result1 = $conn->query($sql1);

//echo ">>>>".$result1;


$conn->close();

?>


