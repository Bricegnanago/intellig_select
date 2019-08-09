<?php
//index.php
$connect = new PDO('mysql:host=localhost;dbname=testing', "root", "");
$institut = '';
$query = "SELECT institut FROM inst_fil_class GROUP BY institut ORDER BY institut ASC";
$result = $connect->query($query);
// $result->execute();
while($row = $result->fetch())
{
 $institut .= '<option value="'.$row["institut"].'">'.$row["institut"].'</option>';
}
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Webslesson Tutorial | Dynamic Dependent Select Box using JQuery Ajax with PHP</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body>
  <br /><br />
  <div class="container" style="width:600px;">
   <h2 align="center">Dynamic Dependent Select Box using JQuery Ajax with PHP</h2><br /><br />
   <select name="institut" id="institut" class="form-control action">
    <option value="">Select Institut</option>
    <?php echo $institut; ?>
   </select>
   <br />
   <select name="niveau" id="niveau" class="form-control action">
    <option value="">Select Niveau</option>
   </select>
   <br />
   <select name="classe" id="classe" class="form-control">
    <option value="">Select Classe</option>
   </select>
  </div>
 </body>
</html>

<script>
$(document).ready(function(){
 $('.action').change(function(){
  if($(this).val() != '')
  {
   var action = $(this).attr("id");
   var query = $(this).val();
   var result = '';
   if(action == "institut")
   {
    result = 'niveau';
   }
   else
   {
    result = 'classe';
   }
   $.ajax({
    url:"fetch.php",
    method:"POST",
    data:{action:action, query:query},
    success:function(data){
     $('#'+result).html(data);
    }
   })
  }
 });
});
</script>
