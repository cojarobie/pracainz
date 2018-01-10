var addTeam = '<form class="form-horizontal" id="teamForm" action="addteam.php" method="post"><div class="form-group has-feedback row" id="teamNameGroup"><div class="col-sm-3"><label class="control-label input-label" for="teamName">Enter team name: </label></div><div class="col-sm-9"><input type="text" name="teamName" class="form-control" id="teamName" aria-describedby="inputTeamNameStatus"><span id="teamNameHelpBlock" class="help-block"></span></div></div><div class="form-group has-feedback row" id="playerNameGroup"><div class="col-sm-3"><label class="control-label input-label" for="invitePlayer">Invite player: </label></div><div class="col-sm-9"><input type="text" class="form-control" id="invitePlayer" aria-describedby="invitePlayerStatus"><span id="invitePlayerHelpBlock" class="help-block"></span><div id="foundPlayers"></div></div></div><div id ="output"></div><button class="btn my-button" type="submit">Create team</button></form>';

$( document ).ready(function() {
  $.scrollTo(0);
  
  $('#addTeam').click(function() {
    managerBoxSetUp();
    $('#managerPanel').html(addTeam);
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
  
  function managerBoxSetUp() {
    $('#managerBox').show("slow");
    $.scrollTo($('#managerRow'), 500);
  }
}
);