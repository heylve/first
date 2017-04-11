
 $( document ).ready(function() {
        console.log( "document loaded" );
      
});
  $(document).on('click',"[id^=btn_mood]", function () {
              $('#myModal').modal('show');
    }); 
  $(document).on('click', '[id^=choose_smiley]', function(){
    // what you want to happen when mouseover and mouseout 
    // occurs on elements that match '.dosomething'
    alert ("smiley clicked");
});  
  $("[id^=choose_smiley]").on ("click", function (){
//       alert ($(this).id);
       alert ("smiley clicked");
//       $(this).attr('src', '/images/index.jpg');

  });  
    
// function notify() {
//  alert( "clicked smiley" );
//}
//$( "#smiley" ).on( "click", notify );   
//    $( "#dataTable tbody tr" ).on( "click", function() {
//  console.log( $( this ).text() );
//});