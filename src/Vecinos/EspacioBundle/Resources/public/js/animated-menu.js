    $(document).ready(function(){  
      
        //When mouse rolls over  
        $("li.header1").mouseover(function(){  
            $(this).stop().animate({height:'150px'},{queue:false, duration:600, easing: 'easeOutBounce'})  
        });  
      
        //When mouse is removed  
        $("li.header1").mouseout(function(){  
            $(this).stop().animate({height:'50px'},{queue:false, duration:600, easing: 'easeOutBounce'})  
        });  
      
    });  