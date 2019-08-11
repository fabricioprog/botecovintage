$(document).ready(function(){
    $("#btn-main-menu").on('click', function(){         
        let icon = $("#btn-main-menu").find('i');                
        if(icon.hasClass('fa-bars')){
            icon.removeClass("fa-bars");
            icon.addClass("fa-angle-left");
        }else{            
            icon.addClass("fa-bars");
            icon.removeClass("fa-angle-left");
        }
    });
});
