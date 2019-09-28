$(document).ready(function(){
    $("#register-but").prop('disabled',true)
    $("#RegisterButton").click(function(){
    if($("#checkemail").html() == "Valid E-mail")
        $("#register-but").prop('disabled',false)
    else
        $("#register-but").prop('disabled',true)
    });
  });