$(document).ready(function(){
    

    /*********************Start Username************************/
    $("#checkUsername").keyup(function (){
       var username = document.forms["myForm"]["username"].value;
       var error = document.getElementById("eUsername");
       var check = false;
       var str = username.replace(/\s+/g, '');
       str = str.replace(/[^a-zA-Z ]/g, "");
       if(str != "")
       {
           if(isNaN(str))
           {
            if(str.length < 5)
            {
                error.innerHTML = "<i class='fa fa-exclamation-triangle' style='color:red'></i>";
                check = false;
            }
            else
            {
                $.post('js/ajax.php',{username:myForm.username.value},function(data){
                if(data == '0')
                {
                    error.innerHTML = "<i class='fa fa-exclamation-triangle' style='color:red'></i>";
                    check = false;
                }
                else
                {
                   error.innerHTML = "<i class='fa fa-check-square' style='color:green'></i>";
                   check = true; 
                }
               });
            }
          }
          else
          {
           error.innerHTML = "<i class='fa fa-exclamation-triangle' style='color:red'></i>";
           check = false;
          }
        }
        else
        {
            error.innerHTML = "<i class='fa fa-exclamation-triangle' style='color:red'></i>";
            check = false;
        }
        submit(check);
       
    });
    /*********************End Username**************************/
       
   /********************Start Password********************/
   
   
   $("#checkPassword").keyup(function (){
       var password = document.forms["myForm"]["password"].value;
       var error = document.getElementById("ePassword");
       var check = false; 
       var str = password.replace(/\s+/g, '');
       if(str != "")
       {
           if(str.length < 5)
           {
               error.innerHTML = "<i class='fa fa-exclamation-triangle' style='color:red'></i>";
               check = false;
           }
           else
           {
               error.innerHTML = "<i class='fa fa-check-square' style='color:green'></i>";
               check = true;
           }
       }
       else
       {
         error.innerHTML = "<i class='fa fa-exclamation-triangle' style='color:red'></i>";
         check = false;  
       }
        submit(check);
       
   });
   
   /********************End Password********************/
   
   
   
   /********************Start Confirm Password********************/
      
      $("#checkConfirmPassword").keyup(function (){
          var password = document.forms["myForm"]["password"].value;
          var confirmPassword = document.forms["myForm"]["confirmPassword"].value;
          var error = document.getElementById("eConfirmPassword");
          var check = false;
          if(confirmPassword == password)
          {
            error.innerHTML = "<i class='fa fa-check-square' style='color:green'></i>";
            check = true;   
          }
          else
          {
           error.innerHTML = "<i class='fa fa-exclamation-triangle' style='color:red'></i>";
           check = false;   
          }
          submit(check);
      });
      
      
   /********************End Confirm Password********************/
   
    /********************Start FullName********************/
    
    $("#checkFullname").keyup(function (){
        var fullname = document.forms["myForm"]["fullname"].value;
        var error = document.getElementById("eFullname");
        var check = false; 
        var str = fullname.replace(/\s+/g, '');
        str = str.replace(/[^a-zA-Z ]/g, "");
       if(str != "")
       {
           if(isNaN(str))
           {
                if(str.length < 5)
                {
                    error.innerHTML = "<i class='fa fa-exclamation-triangle' style='color:red'></i>";
                    check = false;
                }
                else
                {
                    error.innerHTML = "<i class='fa fa-check-square' style='color:green'></i>";
                    check = true;
                }
            }
            else
            {
                error.innerHTML = "<i class='fa fa-exclamation-triangle' style='color:red'></i>";
                check = false;
            }
        }
        else
        {
            error.innerHTML = "<i class='fa fa-exclamation-triangle' style='color:red'></i>";
            check = false;
        }
        submit(check);
    });
    
    /*********************End Fullname**************************/
    
    /*********************Start Telephone**************************/
    $("#checkTele").keyup(function (){
        var telephone = document.forms["myForm"]["telephone"].value;
        var error = document.getElementById("eTelephone");
        var check = false;
   //errorTelephone.innerHTML = "<i class='fa fa-exclamation-triangle' style='color:green'></i>";
   if (telephone != "")
    {  
      if(!isNaN(telephone))
        {
            if(getlength(telephone) != 11)
            {
                error.innerHTML = "<i class='fa fa-exclamation-triangle' style='color:red'></i>";
                check =  false;
            }
            else
            {
                error.innerHTML = "<i class='fa fa-check-square' style='color:green;'></i>";
                check = true;
            }
        }
        else
        {
            error.innerHTML = "<i class='fa fa-exclamation-triangle' style='color:red'></i>";
            check = false;
        }
            submit(check);
    }
    else
    {
        error.innerHTML = "<i class='fa fa-exclamation-triangle' style='color:red'></i>";
        check = false;
    }
    });
    /***********************End Telephone************************************/
    
    
    
    $('[placeholder]').focus(function(){
        $(this).attr('data-text',$(this).attr('placeholder'));
        $(this).attr('placeholder','');
    }).blur(function(){
        $(this).attr('placeholder',$(this).attr('data-text'));
    });
    /*
    $('#show').click(function (){
       $('#password').attr('type',$(this).is(':checked')?'text' : 'password'); 
    });*/
    
   $("html").niceScroll();
   $(window).scroll(function (){
      console.log($(this).scrollTop());
   });
   /*$('.active-now').click(function () {
        $('.cont-online').toggle('slow');
    });*/
    
    $('.active-now').click(function (){
        $.post('ajax.php',{name:name},function(data){
            //alert(data);
            var sup = document.getElementById('navlist');
           
            if($('#foo').is(':hidden'))
            {
            var res = [];
            res = data.split(".");
            //alert(res.length);
            for(var j=0;j<res.length;j++)
            {
                if(res[j] == "")
                {
                    res.splice(j,1);
                }
            } 
                //alert(res);
            for(var i = 0; i < res.length; i++) 
            {
                var online = document.createElement('i');
                var attr = document.createAttribute('class');
                attr.value = "fa fa-dot-circle-o";
                online.setAttributeNode(attr);
                var item = document.createElement('li');
                item.appendChild(document.createTextNode(res[i]));
                item.appendChild(online);
                sup.appendChild(item);
            }
           $('#foo').toggle('slow');
           }
           else
           {
             $('#foo').toggle('slow');
             var myNode = document.getElementById("navlist");
             while (myNode.firstChild) {
             myNode.removeChild(myNode.firstChild);
           }
           
           }
           
        });
    });
    var scrolling = $("#scroll-top");
    
    scrolling.click(function () {
        $("body").animate({scrollTop : 0}, 2000);
    });
    $(window).scroll(function () {
    $(this).scrollTop() >= 907 ? scrolling.show() : scrolling.hide();
});
$("#upfile").click(function () {
    $("#file").trigger('click');
});
$("#upcover").click(function () {
    $("#cover").trigger('click');
});
$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').focus()
})
});
$(":file").filestyle({icon: false});



$("#menu-toggle").click(function(e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
    });



function getlength(number) {
    return number.toString().length;
}

function validateForm(){
  var validation = true;
  validation = validateTelephone();
  if(validation == true)
  {
      validation = validateUser();
  }
    return validation;
}

function validateTelephone()
{
    var telephone = document.forms["myForm"]["telephone"].value;
    var errorTelephone = document.getElementById("checkTele");
    errorTelephone.style.color="#f25b5b";
    if (telephone != "")
    {  
      if(!isNaN(telephone))
        {
            if(getlength(telephone) != 11)
            {
                errorTelephone.innerHTML = "<i class='fa fa-exclamation-triangle' style='color:#f25b5b'></i>";
                return false;
            }
            else
            {
                errorTelephone.innerHTML = "<i class='fa fa-exclamation-triangle' style='color:green'></i>";
            }
        }
        else
        {
            errorTelephone.innerHTML = "<i class='fa fa-exclamation-triangle' style='color:red'></i>";
            return false;
        }
        
    }
    else
    {
        errorTelephone.innerHTML = "Telephone Must Not Be Empty";
        return false;
    }
}

function submit(check)
{
    if(check == true)
        {
            $('input[type="submit"]').removeAttr('disabled');
        }
        else
        {
            $('input[type="submit"]').attr('disabled','disabled');    
        }
}









