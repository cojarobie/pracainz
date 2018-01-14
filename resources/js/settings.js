$(document).ready(function() {
  
  $('#buttonName').click(function(){
    var content = $('#name').html();
    $(this).hide("slow");
    $('#changeNameButton').html(
      '<div class="accept-container">'+
        '<button type="button" class="btn btn-success accept"">Yes<i class="icon-ok-circled"></i></button>'+
      '</div>'+
      '<div class="decline-container">'+
        '<button type="button" class="btn btn-danger decline">No<i class="icon-cancel-circled"></i></button>'+
      '</div>'+
      '<div class="clear-both"></div>'
    );
    $('#name').hide("slow", function(){
      $('#name').html(
      '<label class="settings-label" for="exampleInputEmail1">Enter new name</label>' +
      '<input type="text" class="form-control" id="changeNameInput" aria-describedby="nameHelp" value="'+content+'">' +
      '<span id="settingsNameHelp" class="form-text text-muted"></span>');
      $('#name').show("slow");      
    });
  });
  
  $('#buttonSurname').click(function() {
    $('#surname').hide("slow", function(){
      
    });
  });
  
  $('#buttonNickname').click(function() {
    $('#nickname').hide("slow", function(){
      
    });
  });
  
  $('#buttonEmail').click(function() {
    $('#email').hide("slow", function(){
      
    });
  });
  
  $('#buttonPassword').click(function() {
    $('#password').hide("slow", function(){
      
    });
  });
  
  $('#buttonDescription').click(function() {
    $('#description').hide("slow", function(){
      
    });
  });
});