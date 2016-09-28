$(function() {
$( "#datepicker" ).datepicker();
});


//For showing course title in a option

$(document).ready(function(){
   var i;
   var output="";
   $.ajax({
    type: "POST",
    dataType: "json",
    url: "http://localhost/lu/dept_admin/ppp.php",
    success: function(result){
        for(i=0; i<result.length; i++){
            if(result[i].course_name==''){
                continue;
            }else{
                output+='<option value="'+result[i].course_auto_id+'">'+result[i].course_name+'</option>'; 
            }
            
        }
        $('#std_coursedd').html(output);
        
        var myvals2=$('#std_coursedd').val();
        valueChange(myvals2);
    }
    });
   
});


//For Changing of value in option changing valuse in other field
$(document).ready(function(){
    
$('#std_coursedd').change(function(){
    var myvals=$('#std_coursedd').val();
    valueChange(myvals);
});
   
});



function valueChange(myVal){
  $.ajax({
    type: "POST",
    dataType: "json",
    data: {'abds':myVal},
    url: "http://localhost/lu/dept_admin/ppp2.php",
    success: function(result){
        $('#showh').html(result[0].course_code);
        $('#showh1').html(result[0].course_credit);
    }
    });
}


//For Inserting Values we save
$(document).ready(function(){
    $('#forsv').click(function(){
        
    var teacher=$('#std_courseyy').val();
    var swmistwer=$('#std_depta').val();
    var seassion=$('#std_depts').val();
    var years=$('#std_deptm').val();
    var corsecode=$('#std_coursedd').val();
   if(teacher!="" && swmistwer!="" && seassion!="")

   $.ajax({
    type: "POST",
    data: {'offer_teacher_id':teacher,'offer_semester':swmistwer,'course_auto_id':corsecode,'year':years,'session':seassion},
    url: "http://localhost/lu/dept_admin/ppp4.php",
    success: function(result){
      autoUpdateReselt();
        }
     });
  });
   
});

//For Showing Saved values
function autoUpdateReselt(){
  $.ajax({
    type: "POST",
    url: "http://localhost/lu/dept_admin/ppp5.php",
    success: function(result){
        $("#forDiscrip").html(result);
        }
    });
}



























