$(document).ready(function() {
  var usedId = new Object();
  var outputContent = '';
  const $box = $('#managerPanel');
  $('#invitePlayer').keyup(function(){
    $.ajax({
      method: 'POST',
      url: 'findPlayers.php',
      dataType: 'json',
      data: {input: $('#invitePlayer').val()},
      beforeSend: function() {
        $('#foundPlayers').html('');
      }
    })
    .done(function(jsonArray){
      jsonArray.forEach(function(playerObject) {
        outputContent += '<div class="player" id="player' + playerObject['id'] + '" onclick="invitePlayerToTeam('+playerObject['id']+')">'
        + playerObject['id']      + ' ' 
        + playerObject['name']    + ' ' 
        + playerObject['surname'] + ' ' 
        + playerObject['nick']    + ' ' 
        + playerObject['email']   + 
        '</div>';
        
      });
      $('#foundPlayers').show('fast');
      $('#foundPlayers').html(outputContent);
      outputContent = '';
    });
  });

});