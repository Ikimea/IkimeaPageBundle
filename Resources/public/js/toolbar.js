var Teresa = Teresa || { 'settings': {}};

Teresa.log = function() {
    var msg = '[Teresa.CMS] ' + Array.prototype.join.call(arguments,', ');
    if (window.console && window.console.log) {
        window.console.log(msg);
    } else if (window.opera && window.opera.postError) {
        window.opera.postError(msg);
    }
};

Teresa.toolbar = {

    that : this,
    init : function(){
        Teresa.log('init');

        jQuery('#teresa-toolbar').draggable({
            zIndex: 20,
            ghostig: false,
            opacity: 0.7,
            handle: '.toolbar-header'
        });

        jQuery('#teresa-toolbar .box.components li.component').draggable({
            revert: "invalid"
        });
    },
    item: function(){
        jQuery('#teresa-toolbar .toolbar-header a').click(function(e){

            jQuery.cookie('toolbar', 'close');

            if (jQuery('#toolbar .toolbar-menu').is(":hidden") && jQuery.cookie('toolbar')) {
                jQuery("#toolbar .toolbar-menu").slideDown("slow");
            } else {
                jQuery('#toolbar .toolbar-menu').hide('slow');
                jQuery.cookie('toolbar', 'open');

            }

        });
        jQuery('#teresa-toolbar .toolbar-menu .parent li a').click(function(e){
            var box = jQuery(this).parent().find('.box');

            if (box.is(":hidden")) {
                box.show();
            } else {
                box.hide();
            }
        });

        // Management Elements
        jQuery('#teresa-toolbar .toolbar-menu .parent ul li').draggable({
            opacity: 0.7,
            handle : 'a',
            helper: 'clone'
        });
    }
}

Teresa.toolbar.init();
