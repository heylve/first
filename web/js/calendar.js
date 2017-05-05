
 $( document ).ready(function() {
        console.log( "document loaded" );
      
});
  $(document).on('click',"[id^=btn_mood] , .p_day", function (event) {
//              alert (var day=event.target.id;event.target.id);
              var day_clicked=event.target.id;
             $('#myModal').attr('data-id', day_clicked);  
//             $(this).data('id')=event.target.id;
              $('#myModal').modal('show');
    }); 
  $(document).on('click', '[id^=choose_smiley]', function(event){
    
//    alert ("Day "+day_clicked);
    var btn_day=$('#myModal').attr('data-id');
//    alert ("btn_day"+$('#myModal').attr('data-id'));
//      alert ("btn_day "+btn_day);  
    var day_clicked= parseInt(btn_day.match(/\d+$/)[0], 10);
    var smiley_chosen = parseInt(event.target.id.match(/\d+$/)[0], 10);
//    alert ("smiley_chosen".smiley_chosen);
//    alert ("day_clicked"+day_clicked);
    $("#smiley_"+day_clicked).attr('src','/images/smiley_'+smiley_chosen+'.png');
    $("#value_smiley_"+day_clicked).attr('value',smiley_chosen);
     $('#myModal').modal('hide');
     
});  
 
    
