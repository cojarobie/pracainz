$( document ).ready(function() {
  $.scrollTo(0);
  
  $('#addTeam').click(function() {
    managerBoxSetUp();
    $('#managerTitle').html('Add Team');
  });
  
  $('.manage-team').click(function() {
    $('#managerBox').show("slow");
    $.scrollTo($('#managerRow'), 500);
    $('button').hide("slow");
    $('#managerTitle').html('Team Manager');
  });
  
  $('.cancle-button').click(function() {
    $.scrollTo($('#contentRow'), 500);
    $('#managerBox').hide("slow");
    
    $('button').not('#logoutButton').show("slow");
  });
  
  function managerBoxSetUp() {
    $('#managerBox').show("slow");
    $.scrollTo($('#managerRow'), 500);
    $('button').not('#logoutButton').hide("slow");
  }
}
);