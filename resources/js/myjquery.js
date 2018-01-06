$( document ).ready(function() {
  $.scrollTo(0);
  
  $('.manage-team').click(function() {
    $('#managerBox').show("slow");
    $.scrollTo($('#managerRow'), 500);
    $('.manage-team').hide("slow");
    $('#managerTitle').html('Team Manager');
    $('.cancle-button').attr('id', 'teamManagerCancleButton');
  });
  
  $('.cancle-button').click(function() {
    $.scrollTo($('#contentRow'), 500);
    $('#managerBox').hide("slow");
    
    $('.manage-team').show("slow");
  });
}
);