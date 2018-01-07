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
  
  $('#teamName').focusout(function() {
    validateTeamName();
  });
  
  function managerBoxSetUp() {
    $('#managerBox').show("slow");
    $.scrollTo($('#managerRow'), 500);
  }
  
  function validateTeamName() {
    var length = $('#teamName').val().length;
    if (length > 30 || length < 2) {
      $('#teamNameGroup').removeClass('has-success');
      $('#teamNameGroup').addClass('has-danger');
      $('#teamNameHelpBlock').html('Team Name must be contain from 2 to 30 characters');
    }
    else {
      $('#teamNameGroup').removeClass('has-danger');
      $('#teamNameGroup').addClass('has-success');
    }
  }
}
);