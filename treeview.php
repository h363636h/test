<?php

include "lib/dbconn.php";

if(isset($_POST['filter'])){
  $filter = $_POST["filter"];
  // if($filter = )
}else{
  $filter = null;
}

if(isset($_POST["search"])){
  $search_text = $_POST["search"];
}else{
  $search_text = null;
}

if(isset($filter)){
  $select_seq_sql = "SELECT distinct(sequence) FROM info WHERE $search_text='O'";
  $select_seq_result = mysql_query($select_seq_sql,$connect);
  $select_seq_cnt = mysql_num_rows($select_seq_result);

}else{
  $select_seq_sql = "SELECT distinct(sequence) FROM task_manager.info WHERE type='shot' and project='$project'";
  $select_seq_result = mysql_query($select_seq_sql,$connect);
  $select_seq_cnt = mysql_num_rows($select_seq_result);
}

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="css/font-awesome.min.css">
<link href="css/hummingbird-treeview.css" rel="stylesheet" type="text/css">
<style>

.stylish-input-group .input-group-addon{
    background: white !important;
}

.stylish-input-group .form-control{
    border-right:0;
    box-shadow:0 0 0;
    border-color:#ccc;
}

.stylish-input-group button{
    border:0;
    background:transparent;
}

.h-scroll {
    background-color: #fcfdfd;
    height: 260px;
    overflow-y: scroll;
}
</style>
</head>

<body>

<form method="post" action="">
<div class="container">
  <div id="treeview_container" class="hummingbird-treeview well h-scroll-large">
          <!-- <div id="treeview_container" class="hummingbird-treeview"> -->
        <ul id="treeview" class="hummingbird-base">

        	<li><i class="fa fa-caret-down"></i>&nbsp;<label><input type="checkbox">Assets</label>	<!--Asset List-->
            <ul style="display: block;">


            </ul>
          </li>		<!--Asset List End-->
          <br>
          <li><i class="fa fa-caret-down"></i>&nbsp;<label><input type="checkbox">Shots</label><!--Shot List-->
            <ul style="display: block;">

            	<?php


      					for($i=0; $i<$select_seq_cnt; $i++){
      						$select_seq_rs = mysql_fetch_array($select_seq_result);
      						echo "<li><i class='fa fa-caret-right'></i>&nbsp;<label><input type='checkbox'>$select_seq_rs[sequence]</label>";
      						echo "<ul>";

                  if(isset($filter)){
                    $select_shot_sql = "SELECT name FROM task_manager.info WHERE type='shot' and sequence='$select_seq_rs[sequence]' and project='$project' and $search_text='O'";
                    $select_shot_result = mysql_query($select_shot_sql,$connect);
                    $select_shot_cnt = mysql_num_rows($select_shot_result);

                  }else{
                    $select_shot_sql = "SELECT name FROM task_manager.info where type='shot' and sequence='$select_seq_rs[sequence]' and project='$project'";
                    $select_shot_result = mysql_query($select_shot_sql, $connect);
                    $select_shot_cnt = mysql_num_rows($select_shot_result);                    
                  }

      						for($i2=0; $i2<$select_shot_cnt; $i2++){
      							$select_shot_rs = mysql_fetch_array($select_shot_result);
      							echo "<li>&nbsp;<label><input class='hummingbirdNoParent' type='checkbox' name='type_lists[]' value='$select_shot_rs[name]'><span></span>$select_shot_rs[name]</label></li>";
      						}
      						echo "</ul>";
      						echo "</li>"; 
      					}
                echo "<input type='hidden' name='type' value='Shot'>";
            	?>

            </ul>
          </li>   <!--Shot List End-->



        </ul>
    </div>

</div>
<input type='hidden' name="project" value="<?php echo $project; ?>">
<center><input type="submit" class="btn-primary-small" value="SUBMIT"></center>
</form>

<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="js/hummingbird-treeview.js"></script>
<script>
$("#treeview").hummingbird();
// $( "#checkAll" ).click(function() {
//   $("#treeview").hummingbird("checkAll");
// });
// $( "#uncheckAll" ).click(function() {
//   $("#treeview").hummingbird("uncheckAll");
// });
$( "#collapseAll" ).click(function() {
  $("#treeview").hummingbird("collapseAll");
});

</script>

</body>
</html>
