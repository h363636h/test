<html>
<head>
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/button.css" />	
   
    <script src='js/jquery-11.0.min.js' type='text/javascript'></script>
    <script src="js/jquery-1.10.2.js" type='text/javascript'></script>
    <script src="js/jquery-ui.js" type='text/javascript'></script>
    <script src="js/main.js" type='text/javascript'></script>
</head>
<body>
	<div class="view">
		<div class="view_left">
			<br><br>
			<center>

     			<button onclick = "FileUpload_popup()" id="btn_list">Get CG List</button><br><br>
     			<button id="btn_list">Load</button>
     			<button id="btn_list">Save</button><br><br>
     			<button id="btn_list">Commit</button>

    			<br><br><br>
                <form method="post">
        			<select style="background: #222; color:white; height: 30px;" name='filter'>
                        <option>Select</option>
        				<option value='pipeline'>Pipeline Step</option>
        				<option value='type'>Type</option>
        				<option>3</option>
        			</select>&nbsp;
                
    			<input type="text" size="16" name="search" style="background: #222; height: 30px; color:white; border-left:none; border-right: none; border-top:none;">&nbsp;

    			<button style="background: none; color:#FA5882; height:30px; border:1px solid #FA5882">SEARCH</button>
                </form>

			</center>
			<br>
			<?php 
				$project = $_GET["project"];
                $val = $_POST['val'];   //step1에서 선택한 값들

                if(isset($val)){
                    include "step2_treeview.php";
                }else{
                    include "treeview.php";
                }
			?>
		</div>
		<div class="view_right">
			<div id="list">
				<?php             
                    if(isset($val)){
                        include "AddTask.php";
        
                    }else{
                        include "main.php";
                    }
                 ?>
			</div>
		</div>
	</div>
    
</body>
</html>