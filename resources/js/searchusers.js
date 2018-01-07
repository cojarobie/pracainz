$(document).ready(function() {
  var usedId = new Object();
  $('#invitePlayer').keyup(function(){
    $.ajax({
      method: 'POST',
      url: 'findPlayers.php',
      data: {input: $('#invitePlayer').val()}
    })
    .done(function(msg){
      alert("Alert: " + msg);
    });
  });
});