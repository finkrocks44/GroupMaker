$(document).ready(function(){
    var loaded = false;
    
    function updateUser(){
        if(loaded) return;
        
        $.ajax('getusername.php', {
            tyoe: 'POST',
            cache : false,
            success : function(response){
                //alert(response);
                document.getElementById("welcomeuser").innerHTML = "Welcome, " + response + ".";
                loaded = true;
            },
            error : function(){
                alert("Session Expired");
                window.location.href = 'http://groupmaker.cloudapps.unc.edu';
            }
        });
    }
    
    updateUser();
    
    $('#logout-form').on('submit', function(e){
        //alert('clicked logout');
        e.stopPropagation();
        e.preventDefault();
        
        $.ajax('Logout.php', {
            type : 'GET',
            cache : false,
            success : function (){
                alert("Logged out");
                window.location.href = 'http://groupmaker.cloudapps.unc.edu';
            }
        });
    });
    
    $('#preference-form').on('submit', function(e){
        
    e.stopPropagation();
    e.preventDefault();
    
    $.ajax('submitpreferences.php',
      {type : 'POST',
       data : $('#preference-form').serialize(),
       cache : false,
       success : function(response){
         alert(response);
       },
       error : function(){
         alert('Something went wrong.');
       }
    });
  });
});