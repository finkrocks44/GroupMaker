$(document).ready(function () {

    function getRandomColor() {
        var letters = '0123456789ABCDEF';
        var color = '#';
        for (var i = 0; i < 6; i++ ) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
    
    var info;
    
    $("#classroom div").hover(function(){
        if ($(this).attr('id')){
            var getinfo = true;
            var group; 
            var region;
            var student;
            
            if (getinfo){
                $.ajax('GetSeatInfo.php', {
                    type : 'POST',
                    data : { seatid : $(this).attr('id')},
                    cache : false,
                    async : false,
                    success : function(response){
                        //alert(response);
                        //alert(typeof(response));
                        var string = response.split(" ");
                        
                        for (var j = 0; j < string.length; j++){
                            //alert(string[j]);
                            string[j] = string[j].replace(/['"]+/g, '');
                            string[j] = string[j].replace(' ', '');
                        }
                        //group = JSON.parse(response);
                        group = string[0];
                        region = string[1];
                        student = string[2];
                        getinfo = false;
                    }
                });
            }
            info = $(this).popover({
                title: 'Information',
                content: 'Region: ' + region + '<br />' + 'Group: ' + group + '<br />' + 'Seat: ' + $(this).attr('id') + '<br /> Student: ' + student,
                container: 'body',
                placement: 'top',
                html: true //can use <br /> now in content to add line breaks
            });
            $(this).popover("show");
        }
    }, function(){
        $(this).popover("hide");
        $('.popover').remove();
    });
    
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
    
    $('#Survey_Form').on('submit', function(e){
    
        e.stopPropagation();
        e.preventDefault();
    
        $.ajax('sendsurvey.php',{
            type : 'POST',
            data : $('#Survey_Form').serialize(),
            cache : false,
            success : function(response){
                alert("Survey has been enabled");
                //alert(response);
                $('Survey_Form').trigger('reset');
                //window.location="http://groupmaker.cloudapps.unc.edu/TeacherHome.php#home";
            },
            error : function(){
                alert('Survey Upload Failed');
            }
        });
    });
    
    $('#disablesurvey').on('submit', function(e){
        
        e.stopPropagation();
        e.preventDefault();
        
        $.ajax('disablesurvey.php',{ 
            type : 'POST',
            cache : false,
            success : function(response){
                //alert(response);
                alert("Survey has been disabled.");
            }
        });
    });
    
    $('#assignseats').on('submit', function(e){
        
        e.stopPropagation();
        e.preventDefault();
        
        for (var i = 1; i <= 6; i++){
            $.ajax('assignseats.php',{
               type : 'POST',
               data : {region : i},
               cache : false,
               success : function(response){
                   //alert(response);
               }
            });
        }
    });
    
    for (var i = 1; i <= 81; i++){
        var getinfo = true;
        if (getinfo){
            $.ajax('GetGroupInfo.php', {
                type : 'POST',
                data : { groupid : i},
                cache : false,
                success : function(response){
                    //alert(response);
                    var string = response.split(" ");
                    var color = getRandomColor();
                    for (var j = 0; j < string.length; j++){
                        //alert(string[j]);
                        string[j] = string[j].replace(/['"]+/g, '');
                        string[j] = string[j].replace(' ', '');
                        document.getElementById(string[j]).style.background = color;
                    }
                    getinfo = false;
                }
            });
        }
    }
});