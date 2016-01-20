var mz=1;
var ms=120;
function blurElement_speed(element, size,speed) {

     var filterVal = 'blur(' + size + 'px)';
     $(element)
         .css('filter', filterVal)
         .css('webkitFilter', filterVal)
         .css('mozFilter', filterVal)
         .css('oFilter', filterVal)
         .css('msFilter', filterVal)
         .css('transition', 'all '+speed+'s ease-out')
         .css('-webkit-transition', 'all '+speed+'s ease-out')
         .css('-moz-transition', 'all '+speed+'s ease-out')
         .css('-o-transition', 'all '+speed+'s ease-out');
 }
function blurElement(element,size){
  blurElement_speed(element,size,0.5);
}

function update(){
  $('#extra').click(function(){hide_extra()});;
  if(mz==1){
    ms++;
  }
  else {
    ms--;
  }
  if(ms==255)
    mz=0;
  if(ms==150)
    mz=1;
//  $("body").css("backgroundColor","rgb("+(ms)+","+(ms)+","+(ms)+")");
}
function hide_extra(){
 console.log("Closed extra");
  blurElement('#page',0);
  $("#extra").fadeOut();
}
function updatename(name){
  $("#Username_display").html("User:"+name);
}
$("document").ready(function(){
  console.log("Page loaded");
    blurElement('#page',0);
    $("#part").click(function(){
      document.location.href="event_confirmation.php";
    });
    $("#acc_details").click(function(){
      document.location.href="money_collect.php";
    });
    $("#log_out").click(function(){
      document.location.href="logout.php";
    });
  setInterval(update, 33);
});
