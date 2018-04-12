<?php

include "lib/dbconn.php";
// $project = $_GET['project'];
$project = "dst";
$lists =$_POST['val'];
$json= array_values($lists);
$shots = [];

for($i=0; $i<count($lists); $i++){
  $idx = $json[$i]["idx"];
  $shot_name =  $json[$i]["shot_name"];

  array_push($shots,$shot_name);

  if($json[$i]["tracking"] == "0"){
    $tracking = null;
  }else{
    $tracking = $json[$i]["tracking"];
  }

  if($json[$i]["match_move"] == "0"){
    $match_move = null;
  }else{
    $match_move = $json[$i]["match_move"];
  }

  if($json[$i]["blocking"] == "0"){
    $blocking = null;
  }else{
    $blocking = $json[$i]["blocking"];
  }

  if($json[$i]["ani"] == "0"){
    $ani = null;
  }else{
    $ani = $json[$i]["ani"];
  }

  if($json[$i]["fx"] == "0"){
    $fx = null;
  }else{
    $fx = $json[$i]["fx"];
  }

  if($json[$i]["lighting"] == "0"){
    $lighting = null;
  }else{
    $lighting = $json[$i]["lighting"];
  }

  if($json[$i]["matte"] == "0"){
    $matte = null;
  }else{
    $matte = $json[$i]["matte"];
  }

  if($json[$i]["motion"] == "0"){
    $motion = null;
  }else{
    $motion = $json[$i]["motion"];
  }

  if($json[$i]["remove"] == "0"){
    $remove = null;
  }else{
    $remove = $json[$i]["remove"];
  }

  if($json[$i]["roto"] == "0"){
    $roto = null;
  }else{
    $roto = $json[$i]["roto"];
  }

  if($json[$i]["info_key"] == "0"){
    $info_key = null;
  }else{
    $info_key = $json[$i]["info_key"];
  }

  if($json[$i]["comp"] == "0"){
    $comp = null;
  }else{
    $comp = $json[$i]["comp"];
  }

  if($json[$i]["s3d"] == "0"){
    $s3d = null;
  }else{
    $s3d = $json[$i]["s3d"];
  }

  $update_sql = "update info set tracking='$tracking',match_move='$match_move',blocking='$blocking',ani='$ani',fx='$fx',lighting='$lighting',matte='$matte',motion='$motion',remove='$remove',roto='$roto',info_key='$info_key',comp='$comp',s3d='$s3d' where idx='$idx'";
  mysql_query($update_sql,$connect);

}

$select_seq_sql = "SELECT distinct(sequence) FROM task_manager.info WHERE type='shot' and project='$project' and (NOT(tracking='') or NOT(match_move='') or NOT(blocking='') or NOT(ani='') or NOT(fx='') or NOT(lighting='') or NOT(matte='') or NOT(motion='') or NOT(remove='') or NOT(roto='') or NOT(info_key='') or NOT(comp='') or NOT(s3d=''))";
$select_seq_result = mysql_query($select_seq_sql,$connect);
$select_seq_cnt = mysql_num_rows($select_seq_result);

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


                    $select_shot_sql = "SELECT name FROM task_manager.info where type='shot' and sequence='$select_seq_rs[sequence]' and project='$project'";
                    $select_shot_result = mysql_query($select_shot_sql, $connect);
                    $select_shot_cnt = mysql_num_rows($select_shot_result);                    


      						for($i2=0; $i2<$select_shot_cnt; $i2++){
      							$select_shot_rs = mysql_fetch_array($select_shot_result);
      							echo "<li><i class='fa fa-caret-right'></i>&nbsp;<label><input type='checkbox'>$select_shot_rs[name]</label>";
                    echo "<ul>";

                    $select_task_sql = "SELECT tracking,match_move,blocking,ani,fx,lighting,matte,motion,remove,roto,info_key,comp,s3d FROM task_manager.info WHERE type='shot' and project='$project' and sequence='$select_seq_rs[sequence]' and name='$select_shot_rs[name]' and (NOT(tracking='') or NOT(match_move='') or NOT(blocking='') or NOT(ani='') or NOT(fx='') or NOT(lighting='') or NOT(matte='') or NOT(motion='') or NOT(remove='') or NOT(roto='') or NOT(info_key='') or NOT(comp='') or NOT(s3d=''))";
                    $select_task_result = mysql_query($select_task_sql,$connect);

                    while($row = mysql_fetch_assoc($select_task_result)){
                      foreach ($row as $field => $value){
                        if($value!=""){
                          echo "<li>&nbsp;<label><input class='hummingbirdNoParent' type='checkbox' name='type_lists[]'>$field</label></li>";
                        }
                      }
                    }
                    echo "</ul></li>";
      						}
      						echo "</ul></li>";
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
