function logout() {
  window.location.href = 'logout.php';
}

function leave(id) {
  $("#leave" + id).html(buttonsYesNo(id, "yesLeave", "noLeave"));
}

function noLeave(id) {
  $("#leave" + id).html('<div id="leave'+id+'" ><button type="button" class="btn btn-danger leave" onclick="leave('+id+')">Leave<i class="icon-logout"></button></div>');
}

function yesLeave(id) {
  window.location.href = 'leave.php?id=' + id;
}

function accept(id) {
  $("#invited" + id).html(buttonsYesNo(id, "yesAccept", "noAcceptDecline"));
}

function yesAccept(id) {
  window.location.href = 'acceptdecline.php?id=' + id + '&status=member';
}

function decline(id) {
  $("#invited" + id).html(buttonsYesNo(id, "yesDecline", "noAcceptDecline"));
}

function yesDecline(id) {
  window.location.href = 'acceptdecline.php?id=' + id + '&status=rejected';
}

function noAcceptDecline(id) {
  $("#invited" + id).html('<div class="invited" id="invited'+ id +'"><div class="accept-container"><button type="button" class="btn btn-success accept" onclick="accept('+ id +')">Accept<i class="icon-ok-circled"></i></button></div> <div class="decline-container"><button type="button" class="btn btn-danger decline" onclick="decline('+ id +')">Decline<i class="icon-cancel-circled"></i></button></div><div class="clear-both"></div></div>');
}

function buttonsYesNo(id, yesFunction, noFunction) {
  return '<div class="accept-container"><button type="button" class="btn btn-success accept" onclick="'+ yesFunction +'('+ id +')">Yes<i class="icon-ok-circled"></i></button></div> <div class="decline-container"><button type="button" class="btn btn-danger decline" onclick="'+ noFunction +'('+ id +')">No<i class="icon-cancel-circled"></i></button></div><div class="clear-both"></div>'
}

function manageTeam(id) {
  
}