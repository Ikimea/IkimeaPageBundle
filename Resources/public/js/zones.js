$(function(){ 
    
    $(".zone").droppable({
        hoverClass: 'droppable-hover',
        drop: function( event, ui ) {

            composant=  ui.draggable.clone();
            composant = $(composant);
        
            zone = $(this);
        
            switch(composant.attr('id')){
                case 'component-text':
                    $.post('/page/component/'+ zone.attr('rel') +'/new', function(data) {
                        zone.append(data);     
                    });
                    break;
            
                default:
            }   
        }
    });   
    
    $('.zone a.open-config').click(function(e){
        var parent = $(this).parent();
        var option = parent.find('.option');

        $(this).addClass('active');

        if(option.is(":hidden")){
            option.toggle('show');
            $(this).addClass('active');
        }else{
            option.toggle('hide');
            $(this).removeClass('active');
        }

    });
    
    if( $('.zone.get').length > 0 ){
        var zone  = $('.zone.get').attr('rel');
        $.get('/page/zone/'+ zone + '/get' , function(data) {
                $('.zone .content').html(data);

                $('.zone .content .component .ikp-controls .edit').click(function(e){
                    e.preventDefault();
                    e.stopPropagation();
                    
                    console.log($('#component'+component_id));

                    var component_id = $(this).attr('rel');
                    $('#component'+component_id + ' .ikp-controls').hide();
                    $('#component'+component_id + ' .ikp-content').load('/page/component/'+ component_id +'/edit');
                    $('#component-'+component_id).attr('style', 'width:650px; height: 300px;');
                });

         });

    }

}); 
    function ikpRemoteSubmit(thas){
 
        var Btn = $(thas).find('.submit');
        var iForm = $(thas);
        var iFormURL = iForm.attr('action');
        Btn.click(function(event){
            event.preventDefault();
            var update = $(thas).parent('.ikp-content');
            $.ajax({
                type: 'POST',
                url: iFormURL,
                dataType: 'html',
                data: iForm.serialize(),
                success: function(data){
                    $(update).html(data);
                    console.log(data);
                    $(update).parent().find('.ikp-controls').show();
                }
            });
        });
    }

   