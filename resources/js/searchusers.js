var allUsers = [];
var invitedUsers = [];

$(document).ready(function() {
  var outputContent = '';
  const $box = $('#managerPanel');
  $('#invitePlayer').on('input', function(){
    var jsonStringInivtedUsers = JSON.stringify(invitedUsers);
    $.ajax({
      method: 'POST',
      url: 'findPlayers.php',
      dataType: 'json',
      data: {input: $('#invitePlayer').val(), invited: jsonStringInivtedUsers},
      beforeSend: function() {
        $('#foundPlayers').html('');
      }
    })
    .done(function(jsonArray) {
      jsonArray.forEach(function(playerObject) {
        outputContent += '<div class="player" id="player' + playerObject['id'] + '" onclick="invitePlayerToTeam(\''
        + playerObject['id']      + '\',\''
        + playerObject['name']    + '\',\''
        + playerObject['surname'] + '\',\''
        + playerObject['nick']    + '\',\''
        + playerObject['email']   + '\')">'
        + playerObject['name']    + ' "' 
        + playerObject['nick']    + '" ' 
        + playerObject['surname'] + ' ' 
        + playerObject['email']   + 
        '</div>';
        //allUsers.push(playerObject['id']);
      });
      if (jsonArray.length == 0) {
        $('#foundPlayers').hide('fast');
      }
      else {
        $('#foundPlayers').show('fast');
        $('#foundPlayers').html(outputContent);
      }
      outputContent = '';
    }).always(function() {
      if ($('#invitePlayer').val().length == 0) {
        $('#foundPlayers').hide('fast');
      }
    });
  });
});

function invitePlayerToTeam(id, name, surname, nick, email) {
  invitedUsers.push(id);
  console.log(invitedUsers);
  $('#player' + id).hide('fast');
  $('#output').append('<div class="row" id="invitedPlayer'+id+'"><div class="col-sm-3 cancle-buttons"><div class="mini-cancle-button float-right" onclick="removeInvitation('+id+')"><i class="icon-cancel"></i></div></div><div class="col-sm-9"><input type="hidden" name="invitedPlayers" class="form-control" id="invitedPlayerInput'+id+'"value="'+id+'"><div class="invited-players">' 
  + name    + ' "' 
  + nick    + '" ' 
  + surname + ' ' 
  + email   + '</div></div>'
  );
}

function removeInvitation(id) {
  $('#invitedPlayer'+id).hide("slow", function() {
    $('#invitedPlayer'+id).remove();
  });
  var index = invitedUsers.indexOf(id.toString());
  console.log("removed" + index);
  if (index > -1) {
    var removed = invitedUsers.splice(index, 1);
    console.log(removed);
  }
}