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
        $('#output').html('');
      }
    })
    .done(function(jsonArray){
      jsonArray.forEach(function(playerObject) {
        outputContent += '<li>'
        + playerObject['id']      + ' ' 
        + playerObject['name']    + ' ' 
        + playerObject['surname'] + ' ' 
        + playerObject['nick']    + ' ' 
        + playerObject['email']   + 
        '</li>';
        
      });
      $('#output').html(outputContent);
      outputContent = '';
    });
  });
});