$(function(){  
    var zone  = $('.zone').attr('rel');

    $.get('/page/zone/'+ zone + '/get' , function(data) {

        $('.zone .content').html(data);
       
         $('.zone .content .component .ikp-controls .edit').click(function(e){
            e.preventDefault();
            e.stopPropagation();
            
            $('.ikp-controls').hide();
            var component_id = $(this).attr('rel');
            $('#component'+component_id + ' .ikp-content').load('/page/component/'+ component_id +'/edit');
            $('#component-'+component_id).attr('style', 'width:650px; height: 300px;');
         });
       
    });
   
    
    $('form').submit(function(){
        alert('Handler for .submit() called.');
        return false;
    });
    
});


function ikpRemoteSubmit(thas){
    var Btn = $(thas).find('.submit');
    var iForm = $(thas);
    var iFormURL = iForm.attr('action');
    Btn.click(function(event){
        event.preventDefault();
        var update = $(thas).parent('.ikp-content');
        console.log(update);
        $.ajax({
            type: 'POST',
            url: iFormURL,
            dataType: 'html',
            data: iForm.serialize(),
            success: function(data){
                $(update).html(data);
                $('.ikp-controls').hide();
            }
        });
    });
}

 $('form input:submit').click(function(){
       console.log('dd'); 
 });
    