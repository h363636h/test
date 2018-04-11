<script src='js/jquery-11.0.min.js' type='text/javascript'></script>
<script src="js/jquery-1.10.2.js" type='text/javascript'></script>
<script src="js/jquery-ui.js" type='text/javascript'></script>
<script type="text/javascript">
  function sg_connect(){
    alert("connect");
    $.ajax({
      type : "post",
      url : "sg_connect.php",
      // data : {path : path},
      dataType:'html',
      success: function(){
        alert(data);
        // $('#gallery').html(data);
      },beforeSend : function(){
        $('.wrap-loading').removeClass('display-none');
      },complete:function(){
        $('.wrap-loading').addClass('display-none');
      }, error:function (request, status,error){
        console.log("code : "+request.status+"\n"+"message : "+request.responseText+"\n"+"error : "+error);
      }
    });
  }
</script>

<?php

include "lib/dbconn.php";
require_once "./excel/Classes/PHPExcel.php"; // PHPExcel.php을 불러와야 하며, 경로는 사용자의 설정에 맞게 수정해야 한다.
$objPHPExcel = new PHPExcel();
require_once "./excel/Classes/PHPExcel/IOFactory.php"; // IOFactory.php을 불러와야 하며, 경로는 사용자의 설정에 맞게 수정해야 한다.

// $filename = "uploads/".$_GET['file_name'];

$filename = "uploads/MG_TD_Cglist.xls";
try {
    $objReader = PHPExcel_IOFactory::createReaderForFile($filename);
    $objReader->setReadDataOnly(true);
    $objExcel = $objReader->load($filename);

    // $i=0;
    // while($objExcel->setActiveSheetIndex($i)){

      $objWorksheet = $objExcel->getActiveSheet();
      $rowIterator = $objWorksheet->getRowIterator();
      foreach ($rowIterator as $row) { // 모든 행에 대해서
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false); 
      }

      $maxRow = $objWorksheet->getHighestRow();
      $maxCol = $objWorksheet ->getHighestDataColumn();
      $maxColIndex = PHPExcel_Cell::columnIndexFromString($maxCol);

      $colArr = [];

      if($i == 0){
          for($j=0;$j<$maxColIndex;$j++){
            $value = $objWorksheet->getCellByColumnAndRow($j,5)->getValue();
            $value = str_replace(chr(10),"",$value);

            if($value == "shot code"){
              array_push($colArr,$j);
            } else if($value == "우선순위"){
              array_push($colArr,$j);
            } else if($value == "Tracking"){
              array_push($colArr,$j);
            } else if($value == "Match Move"){
              array_push($colArr,$j);
            } else if($value == "Blocking"){
              array_push($colArr,$j);
            } else if($value == "Ani"){
              array_push($colArr,$j);
            } else if($value == "Fx"){
              array_push($colArr,$j);
            } else if($value == "Lighting"){
              array_push($colArr,$j);
            } else if($value == "Matte"){
              array_push($colArr,$j);
            } else if($value == "Motion"){
              array_push($colArr,$j);
            } else if($value == "Remove"){
              array_push($colArr,$j);
            } else if($value == "Roto"){
              array_push($colArr,$j);
            } else if($value =="key"){
              array_push($colArr,$j);
            } else if($value == "Comp"){
              array_push($colArr,$j);
            } else if($value == "S3D"){
              array_push($colArr,$j);
            }
        }
      } else{
        for($j=0; $j<$maxColIndex;$j++){
           $value = $objWorksheet->getCellByColumnAndRow($j,5) ->getValue();
           if($value == "Asset_Name"){
            array_push($colArr,$j);
           } else if($value == "Modeling"){
            array_push($colArr,$j);
           } else if($value == "Texture"){
            array_push($colArr,$j);
           } else if($value == "Blocking"){
            array_push($colArr,$j);
           } else if($value == "Look Dev"){
            array_push($colArr,$j);
           }
        }
      }

//////////출력////////////
      echo "<table border=1>";
              echo "<tr>";
              echo "<td>우선순위</td>
                    <td>sequence</td>
                    <td>shotname</td>
                    <td>tracking</td>
                    <td>Match Move</td>
                    <td>blocking</td>
                    <td>ani</td>
                    <td>fx</td>
                    <td>lighting</td>
                    <td>matte</td>
                    <td>motion</td>
                    <td>remove</td>
                    <td>roto</td>
                    <td>key</td>
                    <td>comp</td>
                    <td>s3d</td>
                    </tr>
              ";
      echo json_encode($colArr);
          for($row=7; $row <=$maxRow; $row++){
              $rank = $objWorksheet->getCellByColumnAndRow($colArr[0],$row)->getValue();
              $name = $objWorksheet->getCellByColumnAndRow($colArr[1],$row)->getValue();
              $tracking = $objWorksheet->getCellByColumnAndRow($colArr[2],$row)->getValue();
              $match_move = $objWorksheet->getCellByColumnAndRow($colArr[3],$row)->getValue();
              $blocking = $objWorksheet->getCellByColumnAndRow($colArr[4],$row)->getValue();
              $ani = $objWorksheet->getCellByColumnAndRow($colArr[5],$row)->getValue();
              $fx = $objWorksheet->getCellByColumnAndRow($colArr[6],$row)->getValue();
              $lighting = $objWorksheet->getCellByColumnAndRow($colArr[7],$row)->getValue();
              $matte = $objWorksheet->getCellByColumnAndRow($colArr[8],$row)->getValue();
              $motion = $objWorksheet->getCellByColumnAndRow($colArr[9],$row)->getValue();
              $remove = $objWorksheet->getCellByColumnAndRow($colArr[10],$row)->getValue();
              $roto = $objWorksheet->getCellByColumnAndRow($colArr[11],$row)->getValue();
              $key = $objWorksheet->getCellByColumnAndRow($colArr[12],$row)->getValue();
              $comp = $objWorksheet->getCellByColumnAndRow($colArr[13],$row)->getValue();
              $s3d = $objWorksheet->getCellByColumnAndRow($colArr[14],$row)->getValue();

              $sequence = split("_",$name)[0];

              echo "<tr><td>$rank</td>
                        <td>$sequence</td>
                        <td>$name</td>
                        <td>$tracking</td>
                        <td>$match_move</td>
                        <td>$blocking</td>
                        <td>$ani</td>
                        <td>$fx</td>
                        <td>$lighting</td>
                        <td>$matte</td>
                        <td>$motion</td>
                        <td>$remove</td>
                        <td>$roto</td>
                        <td>$key</td>
                        <td>$comp</td>
                        <td>$s3d</td>
                    </tr>";

              $insert_sql = "insert into info(sequence,name,rank,tracking,match_move,blocking,ani,fx,lighting,matte,motion,remove,roto,info_key,comp,s3d,project,type)";
              $insert_sql .="values('$sequence','$name','$rank','$tracking','$match_move','$blocking','$ani','$fx','$lighting','$matte','$motion','$remove','$roto','$key','$comp','$s3d','dst','shot')";
              $insert_result = mysql_query($insert_sql,$connect);
        }
        echo "</table>";

        if($insert_result){
          echo "<script>sg_connect();</script>";
          echo "success";
        }else{
          echo "fail";
        }

//////////출력 end////////////

        // $i++;
    // } //while end
} catch (exception $e) {
    echo '엑셀파일을 읽는도중 오류가 발생하였습니다.';
}

​?>


 <!--   <table align='' border='1' cellspacing='0' cellpadding='0'>
      <tr>
        <td rowspan="2">Shot Name</td>
        <td colspan="12">Pipeline Step</td>
      </tr>
      <tr>
        <td colspan="2">tracking</td>
        <td colspan="2">ani</td>
        <td colspan="2">fx</td>
        <td colspan="2">lighting</td>
        <td colspan="2">matte</td>
        <td colspan="2">comp</td>
      </tr>
      <tr>
        <td>
          s0010_c0210
        </td>
        <td style="border-right : none">
          <input type="text" name="num" value="1" id="" class="num">
        </td>
        <td style="border-left:none;">
          <div class="bt_up">▲</div>
          <div class="bt_down">▼</div>
        </td>

        <td style="border-right : none">
          <input type="text" name="num" value="1" id="" class="num">
        </td>
        <td style="border-left:none;">
          <div class="bt_up">▲</div>
          <div class="bt_down">▼</div>
        </td>

        <td style="border-right : none">
          <input type="text" name="num" value="1" id="" class="num">
        </td>
        <td style="border-left:none;">
          <div class="bt_up">▲</div>
          <div class="bt_down">▼</div>
        </td>

        <td style="border-right : none">
          <input type="text" name="num" value="1" id="" class="num">
        </td>
        <td style="border-left:none;">
          <div class="bt_up">▲</div>
          <div class="bt_down">▼</div>
        </td>

        <td style="border-right : none">
          <input type="text" name="num" value="1" id="" class="num">
        </td>
        <td style="border-left:none;">
          <div class="bt_up">▲</div>
          <div class="bt_down">▼</div>
        </td>

        <td style="border-right : none">
          <input type="text" name="num" value="1" id="" class="num">
        </td>
        <td style="border-left:none;">
          <div class="bt_up">▲</div>
          <div class="bt_down">▼</div>
        </td>
      </tr>        
      <tr>
        <td>
          s0010_c0220
        </td>
        <td style="border-right : none">
          <input type="text" name="num" value="1" id="" class="num">
        </td>
        <td style="border-left:none;">
          <div class="bt_up">▲</div>
          <div class="bt_down">▼</div>
        </td>

        <td style="border-right : none">
          <input type="text" name="num" value="1" id="" class="num">
        </td>
        <td style="border-left:none;">
          <div class="bt_up">▲</div>
          <div class="bt_down">▼</div>
        </td>

        <td style="border-right : none">
          <input type="text" name="num" value="1" id="" class="num">
        </td>
        <td style="border-left:none;">
          <div class="bt_up">▲</div>
          <div class="bt_down">▼</div>
        </td>

        <td style="border-right : none">
          <input type="text" name="num" value="1" id="" class="num">
        </td>
        <td style="border-left:none;">
          <div class="bt_up">▲</div>
          <div class="bt_down">▼</div>
        </td>

        <td style="border-right : none">
          <input type="text" name="num" value="1" id="" class="num">
        </td>
        <td style="border-left:none;">
          <div class="bt_up">▲</div>
          <div class="bt_down">▼</div>
        </td>

        <td style="border-right : none">
          <input type="text" name="num" value="1" id="" class="num">
        </td>
        <td style="border-left:none;">
          <div class="bt_up">▲</div>
          <div class="bt_down">▼</div>
        </td>
      </tr>        
      
    </table> -->