$( document ).ready(function() {
  
  var error_team = false;
  
  var pattern = new RegExp(/[\'"^$%&*()}{@#~?><>,.;:|=_+¬]/);
  
  $('#teamName').focusout(function() {
    validateTeamName();
  });
  
  $('#teamForm').submit(function() {
    error_team = false;
    
    validateTeamName();
    
    if (!error_team) {
      return true;
    } else {
      return false;
    }
  });
  
  function validateTeamName() {
    var content = $('#teamName').val();
    var length = content.length;
    if (length > 30 || length < 2) {
      $('#teamNameGroup').removeClass('has-success');
      $('#teamNameGroup').addClass('has-danger');
      $('#teamNameHelpBlock').html('Team Name must be contain from 2 to 30 characters');
      $('#teamNameHelpBlock').show('slow');
      error_team = true;
    } else if (pattern.test(content)) {
      $('#teamNameGroup').removeClass('has-success');
      $('#teamNameGroup').addClass('has-danger');
      $('#teamNameHelpBlock').html('Team name can contain only letters and numbers');
      error_team = true;
    } else if(nameAlreadyExists(content)) {
      $('#teamNameGroup').removeClass('has-success');
      $('#teamNameGroup').addClass('has-danger');
      $('#teamNameHelpBlock').html('There is already a team with that name');
    } else {
      $('#teamNameGroup').removeClass('has-danger');
      $('#teamNameGroup').addClass('has-success');
      $('#teamNameHelpBlock').hide('slow', function() {
        $('#teamNameHelpBlock').html('');
      });
    }
  }
  
  function nameAlreadyExists(content) {
    
    var teamExists = false;
    
    $.ajax({
      method: 'POST',
      url: 'ajax/checkteamname.php',
      dataType: 'json',
      data: {teamName: content}
    }).done(function(result) {
      teamExists = result['nameExists'];
    });
    
    return teamExists;
  }
  
});