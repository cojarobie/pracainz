var allUsers = [];
var invitedUsers = [];

$(document).ready(function() {
  var outputContent = '';
  const $box = $('#managerPanel');
  $('#invitePlayer').keyup(function(){
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
    .done(function(jsonArray){
      jsonArray.forEach(function(playerObject) {
        outputContent += '<div class="player" id="player' + playerObject['id'] + '" onclick="invitePlayerToTeam(\''
        + playerObject['id']      + '\',\''
        + playerObject['name']    + '\',\''
        + playerObject['surname'] + '\',\''
        + playerObject['nick']    + '\',\''
        + playerObject['email']   + '\')">'
        + playerObject['id']      + ' ' 
        + playerObject['name']    + ' ' 
        + playerObject['surname'] + ' ' 
        + playerObject['nick']    + ' ' 
        + playerObject['email']   + 
        '</div>';
        //allUsers.push(playerObject['id']);
      });
      $('#foundPlayers').show('fast');
      $('#foundPlayers').html(outputContent);
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
  $('#output').append('<li>'
  + id      + ' ' 
  + name    + ' ' 
  + surname + ' ' 
  + nick    + ' ' 
  + email   +'</li>');
}