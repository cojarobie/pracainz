$( document ).ready(function() {
  $.scrollTo(0);
  
  $('#addTeam').click(function() {
    managerBoxSetUp();
    $('#managerTitle').html('Add Team');
    //$('#managerPanel').html('');
  });
  
  $('.manage-team').click(function() {
    managerBoxSetUp();
    $('#managerTitle').html('Team Manager');
  });
  
  $('.cancle-button').click(function() {
    $.scrollTo($('#contentRow'), 500);
    $('#managerBox').hide("slow");
  });
  
  function managerBoxSetUp() {
    $('#managerBox').show("slow");
    $.scrollTo($('#managerRow'), 500);
  }
}
);