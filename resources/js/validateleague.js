$( document ).ready(function() {
  
  var error_league = false;
  
  var pattern = new RegExp(/[\'"^$%&*()}{@#~?><>,.;:|=_+¬]/);
  
  $('#leagueName').focusout(function() {
    validateLeagueName();
  });
  
  $('#addLeagueForm').submit(function() {
    
    error_league = false;
    
    validateLeagueName();
    
    if (!error_league) {
      return true;
    } else {
      return false;
    }
  });
  
  function validateLeagueName() {
    var content = $('#leagueName').val();
    var length = content.length;
    if (length > 30 || length < 2) {
      addHasDanger('League name must be contain from 2 to 30 characters');
      error_league = true;
    } else if (pattern.test(content)) {
      addHasDanger('League name can contain only letters and numbers');
      error_league = true;
    } else if(leagueAlreadyExists(content)) {
      addHasDanger('There is already a league with that name');
      error_league = true;
    } else {
      $('#leagueNameGroup').removeClass('has-danger');
      $('#leagueNameGroup').addClass('has-success');
      $('#leagueNameHelpBlock').hide('slow', function() {
        $('#leagueNameHelpBlock').html('');
      });
    }
  }
  
  function leagueAlreadyExists(content) {
    
    var leagueExists = false;
    
    $.ajax({
      method: 'POST',
      url: 'ajax/checkleaguename.php',
      dataType: 'json',
      data: {teamLeague: content},
      async: false
    }).done(function(result) {
      leagueExists = result['nameExists'];
    });
    
    return leagueExists;
  }
  
  function addHasDanger(message) {
    $('#leagueNameGroup').removeClass('has-success');
    $('#leagueNameGroup').addClass('has-danger');
    $('#leagueNameHelpBlock').html(message);
    $('#leagueNameHelpBlock').show("slow");
  }
  
});