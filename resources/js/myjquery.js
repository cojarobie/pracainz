$( document ).ready(function() {
  $.scrollTo(0);
  
  $('#logout').click(function() {
    window.location.href="logout.php";
  });
  
  $('#settings').click(function() {
    $('#userSettingsBox').show("slow", function() {
      $.scrollTo($('#userSettingsRow'), 500);
    });
  });
  
  $('#closeUserSettings').click(function() {
    $.scrollTo($('#contentRow'));
    $('#userSettingsBox').hide("slow");
  })
  
  $('#addTeam').click(function() {
    $('#addTeamBox').show("slow", function() {
      $.scrollTo($('#addTeamRow'), 500);
    });
  });
  
  $('#closeAddTeam').click(function() {
    $.scrollTo($('#contentRow'), 500);
    $('#addTeamBox').hide("slow");
  });
  
  $('#addLeague').click(function() {
    $('#addLeagueBox').show("slow", function(){
      $.scrollTo($('#addLeagueRow'), 500);
    });
  });
  
  $('#closeAddLeague').click(function() {
    $.scrollTo($('#contentRow'), 500);
    $('#addLeagueBox').hide("slow");
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