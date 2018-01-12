$( document ).ready(function() {
  $.scrollTo(0);
  
  $('#addTeam').click(function() {
    $('#addTeamBox').show("slow", function() {
      $.scrollTo($('#addTeamRow'), 500);
    });
  });
  
  $('#closeAddTeam').click(function() {
    $.scrollTo($('#contentRow'), 500);
    $('#addTeamBox').hide("slow");
  });
  
  $('.manage-team').click(function() {
    $('#manageTeamBox').show("slow", function() {
      $.scrollTo($('#manageTeamRow'), 500);
    });
  });
  
  $('#closeManageTeam').click(function() {
    $.scrollTo($('#contentRow'), 500);
    $('#manageTeamBox').hide("slow");
  })
}
);