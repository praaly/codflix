<?php 
   if(isset($_POST["taskOption"])){
       $selectOption = $_POST['taskOption'];
       echo "select country is => ".$selectOption;
   }



 ?>
 <form method="POST">
<select name="taskOption" onchange="this.form.submit()">
  <option value="1">First</option>
  <option value="2">Second</option>
  <option value="3">Third</option>
</select>
</form>

