function FileUpload_popup(){
	var popUrl = "upload.php";
	var popOption = "width=400, height = 100";
	window.open(popUrl,"",popOption);
	// alert("open");	
}

$(function(){ 	//숫자 증가
  $('.bt_up').click(function(){ 
    var n = $('.bt_up').index(this);
    var num = $(".num:eq("+n+")").val();
    num = $(".num:eq("+n+")").val(num*1+1); 
  });
  $('.bt_down').click(function(){ 
    var n = $('.bt_down').index(this);
    var num = $(".num:eq("+n+")").val();
    if(num == 0){

    }else{
      num = $(".num:eq("+n+")").val(num*1-1);
    } 
  });
}) 

$(document).ready(function(){	//checkbox select all
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
            $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });
            
    $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
        }
    });
});

    $(function() {
        $("#datepicker1, #datepicker2").datepicker({
            dateFormat: 'yy.mm.dd'
        });
    });