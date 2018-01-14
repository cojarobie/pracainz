$(document).ready(function() {
  
  var pattern = new RegExp(/[\'"^$%&*()}{@#~?><>,.;:|=_+¬]/);
  
  $('#buttonName').click(function(){
    
    var contentName = $('#name').html();
    
    $('#buttonNameWrapper').hide("slow", function() {
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
          $('#buttonNameWrapper').show("slow");
        });
        
        $('#name').hide("slow", function() {
          $('#name').html(contentName);
          $('#name').show("slow");
        });
      });
      
      $('#yesNameSettings').click(function() {
        $('#nameYesNo').hide('slow', function() {
          $('#buttonNameWrapper').show("slow");
        });
        var newName = $('#changeNameInput').val();
        if (newName != contentName) {          
          $('#name').hide("slow", function() {
            var validation = validate(newName, "First name");
            if (validation != null) {
              $('#nameInfo').addClass('settings-error');
              $('#nameInfo').removeClass('settings-success');
              $('#name').html(newName);
              $('#nameInfo').html(validation);
            }
            else {
              $('#name').html(newName);
              $('#nameInfo').removeClass('settings-error');
              $('#nameInfo').addClass('settings-success');
              $('#nameInfo').html("Name was successfuly changed");
            }
            $('#name').show("slow");
            $('#nameInfo').show("slow");
          }); 
        } else {
          $('#name').hide("slow", function() {
            $('#name').html(contentName);
            $('#name').show("slow");
          });
        }
      });
      
    });
    
    $('#nameInfo').hide("slow");
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
  
  function validate(value, type) {
    var pattern = new RegExp(/[\'"^$%&*()}{@#~?><>,.;:|=_+¬]/);
    if (value.length > 30 || value.length < 2) {
      return type + "must contain from 2 to 30";
    }
    
    if (pattern.test(value)) {
      return "Only alphanumeric characters allowed";
    }
    
    return null;
  }
});