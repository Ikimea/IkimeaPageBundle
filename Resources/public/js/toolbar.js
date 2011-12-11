$(document).ready(function(){
    
    
    $('#toolbar').draggable(
        {
            zIndex: 20,
            ghostig: false,
            opacity: 0.7,
            handle: '.toolbar-header'
        }
    );
    $('#toolbar .toolbar-header a').click(function(e){
        
        if($('#toolbar .toolbar-menu').is(":hidden")) {
            $("#toolbar .toolbar-menu").slideDown("slow");
        }else{
            $('#toolbar .toolbar-menu').hide('slow');

        }
               
    });
    
    $('#toolbar .toolbar-menu .parent li a').click(function(e){
        var box = $(this).parent().find('.box');
        if(box.is(":hidden")){
            box.show();
        }else{            
            box.hide();
        }
    });
    
    
    // Gestion des elements 
    $('#toolbar .toolbar-menu .parent ul li').draggable({
         opacity: 0.7,
         handle : 'a',
         helper: 'clone'
    });
    
    

});