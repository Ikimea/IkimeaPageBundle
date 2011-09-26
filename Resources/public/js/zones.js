$(document).ready(function(){
    
    var zone  = $('.zone').attr('rel');

    $.get('/page/zone/'+ zone + '/get' , function(data) {
    
        $('.zone .content').html(data);
       
         $('.zone .content .component').click(function(e){
             
            component_id = $(this).attr('rel');
            $('<div>').dialog({
                modal: true,
                open: function ()
                {
                    $(this).load('/page/component/'+ component_id +'/edit');
                },         
                height: 180,
                width: 600,
                title: 'Ajax Page'
            });
               /* jQuery.facebox(function() {
                    jQuery.get('/page/component/'+ component_id +'/edit', function(data) {
                        jQuery.facebox(data );
                    })
                }); */
         });
       
    });
    
});

