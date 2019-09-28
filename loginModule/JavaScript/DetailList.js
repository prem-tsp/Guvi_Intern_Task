$(document).ready(function() {


   // var details = [];
 
    $.getJSON('./Includes/28-09-19.json', function(data) {
        var tblRow = '';
        $.each(data, function(key,value) {
            tblRow = "<tr>" + "<td>" + value.uname + "</td>" +
            "<td>" + value.email + "</td>" + "<td>" + value.age + "</td>" + "<td>" + value.country + "</td>" + "<td>" + value.education + "</td>"+"<td>" + value.bio + "</td>"+"<td>" + value.favnum + "</td>"+"</tr>"
            $(tblRow).appendTo("#userdata");
      });
 
    });
 
 });