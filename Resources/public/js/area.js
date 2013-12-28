$(function(){

    $(".area").droppable({
        hoverClass: 'droppable-hover',
        drop: function( event, ui ) {

            var composant =  jQuery(ui.draggable.clone());
            var area = jQuery(this);

            switch(composant.attr('id')){
                case 'component-text':
                    jQuery.post('/page/component/'+ area.attr('rel') +'/new', function(data) {
                        area.append(data);
                    });
                    break;
                default:
            }
        }
    });

    jQuery('.area a.open-config').click(function(e){
        var parent = jQuery(this).parent();
        var option = parent.find('.option');

        jQuery(this).addClass('active');

        if (option.is(":hidden")) {
            option.toggle('show');
            jQuery(this).addClass('active');
        } else {
            option.toggle('hide');
            jQuery(this).removeClass('active');
        }
    });

    if( $('.area.get').length > 0 ){
        var area  = jQuery('.area.get').attr('rel');
        var area_route = Routing.generate('area_get', { name: area });

        jQuery.get(area_route , function(data) {
            jQuery('.zone .content').html(data);

            jQuery('.area .content .component .controls .edit').click(function (e) {
                e.preventDefault();

                var component_id = $(this).attr('rel');
                jQuery('#component' + component_id + ' .ikp-controls').hide();
                jQuery('#component' + component_id + ' .component-content').load('/page/component/' + component_id + '/edit');
            });

        });
    }
});

Teresa.area  = {
    init : function(){
      this.send();
    },
    send : function(){
        Teresa.log('data modify');

        jQuery('.component-form .submit').on('click', function(e){
            e.preventDefault();
            var form_data = jQuery(this).parent('form');
            var form_action = form_data.attr('action');
            var update = form_data.parent().parent().parent();

            jQuery.ajax({
                type: 'POST',
                url: form_action,
                dataType: 'html',
                data: form_data.serialize(),
                success: function(data){
                    update.html(data);
                    update.parent().find('.controls').show();
                    form_data.parent().html(data);
                }
            });
        });
    }
}

Teresa.area.init();
