<?php

include "lib/dbconn.php";

if(isset($_POST['project'])){
  $project= $_POST['project'];
}else{
  $project = null;
}

if(isset($_POST['type_lists'])){
  $lists = $_POST['type_lists'];
  // echo json_encode($lists);
}else{
  $lists = null;
}

if(isset($_POST['type'])){
  $type = $_POST['type'];
}else{
  $type = null;
}

$select_fields = "select * from info";
$select_result = mysql_query($select_fields,$connect);
$field = mysql_num_fields($select_result);

$fields = [];

for ($i=6; $i<$field; $i++){
  array_push($fields,mysql_field_name($select_result,$i));
}

?>
<html>
<body>
<br><br>
    <p style="padding-left : 72%; font-size:30"><b>Task Manager</b></p><br><br><br>
<?php if(isset($lists)) {?>

	<h1 style='padding-left: 2.5%'><?php echo $type ?> List</h1>
  <form method="post">
    <table align='center' border='1' cellspacing="0" cellpadding="0" width="90%">
      <tr align="center" height="40px">
        <th rowspan="2"><input type="checkbox" id="select_all"/></th>
        <th rowspan="2"><?php echo $type ?> Name</th>
        <th colspan="26" >Pipeline Step</th>
      </tr>

      <tr align="center" height="25px" width="100px">
        
        <?php

          foreach ($fields as $field) {
            if($field == "match_move"){
              echo "<th colspan=2>Match Move</th>";
            }else if($field == "info_key"){
              echo "<th colspan=2>Key</th>";
            }else{
              echo "<th colspan=2>$field</th>";
            }
          }
        ?>

      </tr>
    <?php
      echo "<tr>";
      foreach ($lists as $list) {
        $list = str_replace("\r\n","",$list);
        $select_sql = "select * from info where project='$project' and name='$list'";
        $select_result = mysql_query($select_sql,$connect);
        $select_cnt = mysql_num_rows($select_result);
        $select_rs = mysql_fetch_array($select_result);
        // echo $select_sql;
        
        echo "<td><input type='checkbox' name='lists[]' class='checkbox' value='$select_rs[idx]'></td>";
        echo "<td>$select_rs[name]</td>";

          foreach ($fields as $field) { //필드 명 db에서 호출
            if($select_rs[$field] == null){
              echo "<td colspan=2>
                      <input type='hidden' name='id' id='idx' value='$select_rs[idx]'>
                      <input type='text' name='$field' value='0' id='$field' size=5 style='border:none'></td>";

            } else if($select_rs[$field] =="O"){
              echo"
                <td style='border-right : none' class='$field'>

                  <input type='hidden' name='id' id='idx' value='$select_rs[idx]'>                  
                  <input type='text' name='$field' value='1' id='$field' class='num' size=5 style='border:none'>
                </td>
                <td style='border-left:none;'>
                  <div class='bt_up'>▲</div>
                  <div class='bt_down'>▼</div>
                </td>
              ";
            }else{
               echo"
                <td style='border-right : none'>
                  <input type='hidden' name='id' id='idx' value='$select_rs[idx]'>
                  <input type='text' name='$select_rs[idx]_num' value='$select_rs[$field]' id ='$field' class='num' size=5 style='border:none'>
                </td>
                <td style='border-left:none;'>
                  <div class='bt_up'>▲</div>
                  <div class='bt_down'>▼</div>
                </td>
              ";             
            }
          }
          echo "</tr>";
      }
      echo "</table>";
      echo "</form>";
}else{
  echo "선택된 Asset이나 Shot이 없습니다.";
}
    ?>
<center><button class='btn-primary-small' id="save">SAVE</button></center>
<br><br>
  <script src='js/jquery-11.0.min.js' type='text/javascript'></script>
  <script src="js/jquery-1.10.2.js" type='text/javascript'></script>
  <script src="js/jquery-ui.js" type='text/javascript'></script>
<script>

$("#save").click(function(){
  var values = new Array();
  $.each($("input[name='lists[]']:checked"),function(){
    var data = $(this).parents("tr:eq(0)");
    values.push({"shot_name":$(data).find("td:eq(1)").text(),"idx":$(data).find("input#idx").val(),"tracking":$(data).find("input#tracking").val(),"match_move":$(data).find("input#match_move").val(),"blocking":$(data).find("input#blocking").val(),"ani":$(data).find("input#ani").val(),"fx":$(data).find("input#fx").val(),"lighting":$(data).find("input#lighting").val(),"matte":$(data).find("input#matte").val(),"motion":$(data).find("input#motion").val(),"remove":$(data).find("input#remove").val(),"roto":$(data).find("input#roto").val(),"info_key":$(data).find("input#info_key").val(),"comp":$(data).find("input#comp").val(),"s3d":$(data).find("input#s3d").val()});
    // alert(data);
  })
  // val = JSON.parse(values);
	$.ajax({
	    type: 'post',	
	    url: 'index.php',
	    data: {val:values},
	    success: function (data) {
	        $('.view').html(data);
	    },
	    error: function (request, status, error) {
	        console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
	    }
	});
// $(location).attr('href', url);

})

  </script>
 </body>
</html>