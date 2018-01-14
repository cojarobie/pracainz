$(document).ready(function() {
  
  $('#buttonName').click(function(){
    
    var contentName = $('#name').html();
    
    $('#buttonName').hide("slow", function() {
      $('#nameYesNo').html(
        '<label class="settings-label" style="text-align: center;">Confirm</label>'+
        '<div class="accept-container">'+
          '<button type="button" class="btn btn-success accept" style="margin-top: 4px;" id="yesNameSettings">Yes<i class="icon-ok-circled"></i></button>'+
        '</div>'+
        '<div class="decline-container">'+
          '<button type="button" class="btn btn-danger decline" style="margin-top: 4px;" id="noNameSettings">No<i class="icon-cancel-circled"></i></button>'+
        '</div>'+
        '<div class="clear-both"></div>'
      );
      $('#nameYesNo').show("slow");

      $('#noNameSettings').click(function() {
        $('#nameYesNo').hide('slow', function() {
          $('#buttonName').show("slow");
        });
        
        $('#name').hide("slow", function() {
          $('#name').html(contentName);
          $('#name').show();
        });  
      });
    });
    $('#name').hide("slow", function(){
      $('#name').html(
      '<label class="settings-label" for="exampleInputEmail1">Enter new name</label>' +
      '<input type="text" class="form-control" id="changeNameInput" aria-describedby="nameHelp" value="'+contentName+'">' +
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