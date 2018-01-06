$( document ).ready(function() {
  $.scrollTo(0);
  
  $('.manage-team').click(function() {
    $('#teamData').show("slow");
  });
  
  $('.manage-team').click(function() {
    $.scrollTo($('#teamPanel'), 500);
  });
  
  $('.manage-team').click(function() {
    $('.manage-team').show("slow");
  });

  $('.manage-team').click(function() {
    $(this).hide("slow");
  });
  
  $('#closeTeamManager').click(function() {
    $.scrollTo($('#userTeamsAndLeagues'), 500);
  });
  
  $('#closeTeamManager').click(function(event) {
    event.preventDefault();
    $('#teamData').hide("slow");
  });
  
  $('#closeTeamManager').click(function() {
    $('.manage-team').show("slow");
  });
}
);