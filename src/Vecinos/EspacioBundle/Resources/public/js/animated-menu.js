    $(document).ready(function(){  
      
        //When mouse rolls over  
        $("#header1 li").mouseover(function(){  
            $(this).stop().animate({height:'150px'},{queue:false, duration:600, easing: 'easeOutBounce'})  
        });  
      
        //When mouse is removed  
        $("#header1 li").mouseout(function(){  
            $(this).stop().animate({height:'50px'},{queue:false, duration:600, easing: 'easeOutBounce'})  
        });  
      
    });  