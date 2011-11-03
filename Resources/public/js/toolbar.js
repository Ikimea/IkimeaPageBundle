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
    
    $(".zone").droppable({
    	drop: function( event, ui ) {

        composant=  ui.draggable.clone()
        composant = $(composant);
        
        zone = $(this);
        
        
        switch(composant.attr('id')){
            case 'component-text':                
                $.post('/page/component/'+ zone.attr('rel') +'/new', function(data) {
                    zone.append(data);
                    
                });
            break;
            
            default:
                //code to be executed if n is different from case 1 and 2
       }   
        
        
	//$( this ).addClass( "ui-state-highlight" ).html( "Dropped!" );
    }});
    
    
    $('.zone a.config').click(function(e){
        var parent = $(this).parent();
        var option = parent.find('.option');
        
        if(option.is(":hidden")){
            option.show();
        }else{
            option.hide();
        }
        
        

    });
    

});