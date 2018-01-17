var foundUsers = [];
var invitedUsers = [];

$(document).ready(function() {
  var outputContent = '';
  $('#invitePlayer').on('input', function(){
    var jsonStringInivtedUsers = JSON.stringify(invitedUsers);
    $.ajax({
      method: 'POST',
      url: 'ajax/findplayers.php',
      dataType: 'json',
      data: {input: $('#invitePlayer').val(), invited: jsonStringInivtedUsers},
      beforeSend: function() {
        $('#foundPlayers').html('');
      }
    })
    .done(function(jsonArray) {
      foundUsers = [];
      jsonArray.forEach(function(playerObject) {
        outputContent += '<div class="player" id="player' + playerObject['id'] + '" onclick="invitePlayerToTeam(\''
        + playerObject['id']      + '\',\''
        + playerObject['name']    + '\',\''
        + playerObject['surname'] + '\',\''
        + playerObject['nick']    + '\',\''
        + playerObject['email']   + '\',\''
        + playerObject['avatar']  + '\')">'
        + playerObject['name']    + ' "' 
        + playerObject['nick']    + '" ' 
        + playerObject['surname'] + ' ' 
        + playerObject['email']   + 
        '</div>';
        foundUsers.push(playerObject['id']);
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

function invitePlayerToTeam(id, name, surname, nick, email, avatar) {
  invitedUsers.push(id);
  var index = foundUsers.indexOf(id.toString());
  console.log("After: " + foundUsers);
  if (index > -1) {
    var removed = foundUsers.splice(index, 1);
  }
  if (foundUsers.length == 0) {
    $('#foundPlayers').hide('fast');
  }
  console.log("Before: " + foundUsers);
  $('#player' + id).hide('fast');
  $('#invitedPlayersList').append(
  '<div style="display:none;" class="row invited-player-wrapper" id="invitedPlayer'+id+'">'+
    '<div class="col-sm-3 cancle-buttons">'+
      '<div class="mini-cancle-button float-right" onclick="removeInvitation('+id+')">'+
        '<i class="icon-cancel"></i>'+
      '</div>'+
    '</div>'+
    '<div class="col-sm-9">'+
      '<input type="hidden" name="invitedPlayers[]" class="form-control" id="invitedPlayerInput'+id+'"value="'+id+'">'+
      '<div class="invited-players">'+
        '<div class="float-left">'+
          '<img class="img-thumbnail img-invited-player" src="' + avatar + '">'+
        '</div>'+
        '<div class="float-left">' +
          '<div class="main-invitation-data">'
            + name    + ' "' 
            + nick    + '" ' 
            + surname + 
          '</div>' +
          '<div class="invitation-email">' +
            email + 
          '</div>' +
        '</div>'+
      '</div>'+
    '</div>'+
  '</div>'
  );
  $('#invitedPlayer'+id).show("slow");
}

function removeInvitation(id) {
  $('#invitedPlayer'+id).hide("slow", function() {
    $('#invitedPlayer'+id).remove();
  });
  var index = invitedUsers.indexOf(id.toString());
  if (index > -1) {
    var removed = invitedUsers.splice(index, 1);
  }
}