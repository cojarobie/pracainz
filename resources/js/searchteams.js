var foundTeams = [];
var invitedTeams = [];

$(document).ready(function() {
  var outputContent = '';
  $('#inviteTeam').on('input', function(){
    var jsonStringInivtedTeam = JSON.stringify(invitedTeams);
    $.ajax({
      method: 'POST',
      url: 'ajax/findteams.php',
      dataType: 'json',
      data: {input: $('#inviteTeam').val(), invited: jsonStringInivtedTeam},
      beforeSend: function() {
        $('#foundTeams').html('');
      }
    })
    .done(function(jsonArray) {
      foundTeams = [];
      jsonArray.forEach(function(teamObject) {
        outputContent += '<div class="player" id="team' + teamObject['id'] + '" onclick="inviteTeamToLeague(\''
        + teamObject['id']      + '\',\''
        + teamObject['name']    + '\')">'
        + teamObject['name']    +
        '</div>';
        foundTeams.push(teamObject['id']);
      });
      if (jsonArray.length == 0) {
        $('#foundTeams').hide('fast');
      }
      else {
        console.log(outputContent);
        $('#foundTeams').show('fast');
        $('#foundTeams').html(outputContent);
        console.log("Zawartość: " + $('#foundTeams').html());
      }
      outputContent = '';
    }).always(function() {
      if ($('#inviteTeam').val().length == 0) {
        $('#foundTeams').hide('fast');
      }
    });
  });
});

function inviteTeamToLeague(id, name) {
  invitedTeams.push(id);
  var index = foundTeams.indexOf(id.toString());
  console.log("After: " + foundTeams);
  if (index > -1) {
    var removed = foundTeams.splice(index, 1);
  }
  if (foundTeams.length == 0) {
    $('#foundTeams').hide('fast');
  }
  console.log("Before: " + foundTeams);
  $('#team' + id).hide('fast');
  $('#invitedTeamsList').append('<div style="display:none;" class="row" id="invitedTeam'+id+'"><div class="col-sm-3 cancle-buttons"><div class="mini-cancle-button float-right" onclick="removeTeamInvitation('+id+')"><i class="icon-cancel"></i></div></div><div class="col-sm-9"><input type="hidden" name="invitedTeams[]" class="form-control" id="invitedTeamInput'+id+'"value="'+id+'"><div class="invited-players">' 
  + name    + '</div></div>'
  );
  $('#invitedTeam'+id).show("slow");
}

function removeTeamInvitation(id) {
  $('#invitedTeam'+id).hide("slow", function() {
    $('#invitedTeam'+id).remove();
  });
  var index = invitedTeams.indexOf(id.toString());
  if (index > -1) {
    var removed = invitedTeams.splice(index, 1);
  }
}