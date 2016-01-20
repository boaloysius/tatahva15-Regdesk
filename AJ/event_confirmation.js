$(document).ready(function(){
    $(".captain_id").focus(function(){
        old_captain=$(this).val();
		
    });

    $(".captain_id").change(function(){
         new_captain=$(this).val();
		 event_code=$(this).closest("tr").attr("id");
		 event_code=event_code.replace("_a",'');
		 tathva_id=$(".tathva_id").text();
		$.ajax({
			type: "POST",
			url: "iscaptain.php?CaptainID="+new_captain+"&EventID="+event_code+"&TathvaID="+tathva_id,
			dataType: 'json',
			cache: false,
			success: function(data)
			{

				if(data.iscaptain==1){
					alert(data.message2);
					$("#"+event_code+"_a .captain_id").val(new_captain);
				}
				else{
					alert(data.message2);
					$("#"+event_code+"_a .captain_id").val(old_captain);
				}
			}
		});

    });
});

function changemoney(checkboxid){
  var a = $("#totalmoney").val();
  var present = parseInt(a);
  $.ajax({
    type: "POST",
    url: "getmoney.php",
    data: { 'EventCode' : checkboxid }
    }).done(function(data){
      var b = JSON.parse(data);
      var addingmoney = parseInt(b);
      if(document.getElementById(checkboxid).checked)
        {present += addingmoney;
		}
      else
	  	{present -= addingmoney;}
      $("#totalmoney").val(present);
      });
}

function hide_extra(){
 console.log("Closed extra");
  $("#extra").fadeOut();
}
function hide_extra2(){
 console.log("Closed extra2");
  $("#extra").fadeOut();
  window.location.href="hospi_confirmation.php";
}
function hide_extra3(tid){
 console.log("Closed extra3");
  $("#extra").fadeOut();
  window.location.href="event_confirmation.php?TathvaID="+tid;
}
function hide_extra4(tid){
 console.log("Closed extra3");
  $("#extra").fadeOut();
  window.location.href="hospi_confirmation.php?TathvaID="+tid;
}
function hide_extra_c(){
 console.log("Closed extras");
  $(".extra").fadeOut();
  window.location.href="participant_reg.php";
}
function hide_extra_c2(){
 console.log("Closed extras");
  $(".extra").fadeOut();
  window.location.href="event_user_reg.php";
}
var mz=1;
var ms=160;
var msb=255;
var msc=255;

$('#extra').click(function(){hide_extra()});
function update(){
  $('#extra').click(function(){hide_extra()});
  if(mz==1){
    ms++;
    msb--;
    msc--;
  }
  else if(mz==0){
    ms--;
    msb++;
    msc++;
  }
  if(ms==255)
    mz=0;
  if(ms==150)
    mz=1;

}
function updatename(name){
  $("#Username_display").html("User:"+name);
}
function asd(p){
  window.location.href="event_confirmation.php?TathvaID="+p;
}



