<?php include "lib/dbconn.php"; ?>
<html>
    <link rel="stylesheet" href="css/jquery_ui.css" />	
    <script src='js/jquery-11.0.min.js' type='text/javascript'></script>
    <script src="js/jquery-1.10.2.js" type='text/javascript'></script>
    <script src="js/jquery-ui.js" type='text/javascript'></script>
<script>
    $(function() {
        $("#datepicker1, #datepicker2").datepicker({
            dateFormat: 'yy.mm.dd'
        });
    });

</script>
<body>
<br><br>
    <p style="padding-left : 72%; font-size:30"><b>Task Manager</b></p><br><br><br>
<?php if(isset($lists)) {?>

	<h1 style='padding-left: 2.5%'>Update Task</h1>
  	<form method="post" action="index.php">
	    <table align='center' border='1' cellspacing="0" cellpadding="0" width="90%">
	      <tr>
	        <th></th>
	        <th align="left">Link</th>
	        <td><textarea name="link" size="" style="width: 100%; height: 100%;"> </textarea></td>
	    </tr>
	    <tr>
	    	<th></th>
	    	<th>Pipeline Step</th>
	    	<td></td>
	    </tr>
	    <tr>
	    	<th><input type="checkbox"></th>
	    	<th>Start Date</th>
	    	<td><input type="text" id="datepicker1" name="start_date" value=""></td>
	    </tr>
	    <tr>
	    	<th><input type="checkbox"></th>
	    	<th>End Date</th>
	    	<td><input type="text" id="datepicker2" name="end_date" value=""></td>
	    </tr>
	    <tr>
	    	<th><input type="checkbox"></th>
	    	<th>Assign To</th>
	    	<td><input type="text" name="assign_to" size="" style="width: 100%; height: 100%;"></td>
	    </tr>
	    <tr>
	    	<th><input type="checkbox"></th>
	    	<th>Bid</th>
	    	<td><input type="text" name="bid" size="" style="width: 100%; height: 100%;"></td>
	    </tr>
	    <tr>
	    	<th><input type="checkbox"></th>
	    	<th>Task Name</th>
	    	<td><input type="text" name="task_name" size="" style="width: 100%; height: 100%;"></td>
	    </tr>
		</table>
		<br><br>
		<center><input type="submit" class="btn-primary-small" value="SAVE"></center>
	</form>
<?php
}else{
  echo "선택된 Asset이나 Shot이 없습니다.";
}
    ?>

<br><br>
 </body>
</html>
