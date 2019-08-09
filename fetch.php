<?php
//fetch.php
if(isset($_POST["action"]))
{
 $connect = new PDO('mysql:host=localhost;dbname=testing', "root", "");
 $output = '';
 if($_POST["action"] == "institut")
 {
//   $query = "SELECT niveau FROM inst_fil_class WHERE institut = '".$_POST["query"]."' GROUP BY niveau";
    $query = "SELECT niveau FROM inst_fil_class WHERE institut = ? GROUP BY niveau";
  $result = $connect->prepare($query);
  $result->execute([$_POST["query"]]);
  $output .= '<option value="">Select Niveau</option>';
  while($row = $result->fetch())
  {
   $output .= '<option value="'.$row["niveau"].'">'.$row["niveau"].'</option>';
  }
 }
 if($_POST["action"] == "niveau")
 {
//   $query = "SELECT classe FROM inst_fil_class WHERE niveau = '".$_POST["query"]."'";
  $query = "SELECT classe FROM inst_fil_class WHERE niveau = ?";
  $result = $connect->prepare($query);
  $result->execute([$_POST["query"]]);
  $output .= '<option value="">Select Classe</option>';
  while($row = $result->fetch())
  {
   $output .= '<option value="'.$row["classe"].'">'.$row["classe"].'</option>';
  }
 }
 echo $output;
}
?>