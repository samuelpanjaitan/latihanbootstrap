<?php
$dbhost = 'localhost';
$dbuser = 'id6885178_images';
$dbpass = 'cacad890';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
mysqli_select_db('id6885178_androiduploadimage');
if(! $conn )
{
  die('Could not connect: ' . mysqli_error());
}

$response = array();

if(isset($_POST['name']) and isset($_FILES['image']['name'])){

$name = $_POST['name'];

$target_path="images/" . $_FILES["image"]["name"];
move_uploaded_file($_FILES["image"]["tmp_name"], $target_path);
$path="images/" . $_FILES["image"]["name"];

if(mysqli_query("INSERT imageupload values(0,'$path','$name')"))
{
 //filling response array with values 
 $response['error'] = false; 
 $response['url'] = $file_url; 
 $response['name'] = $name;
}else{


 } 
 //displaying the response 
 echo json_encode($response);

}
else{
echo "gjhgjh";
}

?>