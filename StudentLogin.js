$(document).ready(function() {
    
    $("#registration").hide()
    $('#login-form').on('submit', function(e){

    e.stopPropagation();
    e.preventDefault();

    $.ajax('StudentLogin.php',
      {type : 'POST',
       data : $('#login-form').serialize(),
       cache : false,
       success : function(response){
         alert("Login successful");
         //$("#loadStudentHome").load("StudentHome.html");
         window.location.href = 'http://groupmaker.cloudapps.unc.edu/StudentHome.html';
       },
       error : function(){
         alert('Login failed');
       }
    });
  });

  $("#signup").click(function(){
    $("#registration").show()
    $("#loadStudentHome").hide()
	   });

    $("#signin").click(function(){
      $("#registration").hide()
       $("#loadStudentHome").show()
   	   });
  $('#register-form').on('submit', function(e){

    e.stopPropagation();
    e.preventDefault();

    $.ajax('register.php', {
      type : 'POST',
      data : $('#register-form').serialize(),
      cache : false,
      success : function(response){
        //alert(response);
        alert("Registered Successfully");
        //alert(response);
        $('#register-form').trigger('reset');
      },
      error : function(xhr, status, error){
        alert('Failed to register');
        //alert(error);
      }
    });
  });
});
