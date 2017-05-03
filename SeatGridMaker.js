$(document).ready(function(){
  try {
    var classroom = new Grid($('#classroom'));
  }
  catch(err){
    alert(err);
  }
});