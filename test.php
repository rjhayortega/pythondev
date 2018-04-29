<?php
error_reporting(-1);
ini_set('display_errors', 'On');

$html = "<img src=http://app.knackmap.com/pdev/0185722b563d116680ee8b42f365f4d8.png></img><b></br></br>Welcome to our Knackmap Family!</b></br></br>Hello [Ronald],</br></br>Thanks for subscribing to our [package name] plan, you can now get started on our platform!</br></br>Please use below credentials to get into our platform:</br></br><b>Username:</b> [rjhayortega@mail.com]</br><b>Password:</b> [po2developers]</br></br>Our friendly team are only a live chat or email away, so don't hesitate to get in touch!Our Customer Service lead Dolly will be in touch with you at some point soon to check up and make sure that you are going well on our platform 🙂Thanks,</br></br><p style=\"border-radius: 50px; overflow: hidden; width: 100px; height: 100px; padding: 0px; border: 1px solid rgb(204, 204, 204);\"><img src=\"https://knackmap.com/wp-content/uploads/2018/02/josh.jpg\" style=\"width: 100%; height: auto; position: relative; top: 10px; left: -5px;\"></p>";


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


