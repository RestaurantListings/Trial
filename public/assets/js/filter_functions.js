/**
 * Created by Abu Isaac on 10/31/15.
 */

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})

var tags = [ "c++", "java", "php", "coldfusion", "javascript", "asp", "ruby" ];
$( "#llocations" ).autocomplete({
    source: function( request, response ) {
        var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( request.term ), "i" );
        response( $.grep( tags, function( item ){
            return matcher.test( item );
        }) );
    }
});
$( "#locations" ).autocomplete({
    source: function( request, response ) {
        $.ajax({
            url: 'search/autocomplete',
            type: "post",
            data: {'term':request.term, '_token': $('input[name=_token]').val()},
            success: function(data){
                return data;
            }
        });
    }
});






$(document).ready(function(){
    if($('input[name="open_now"]').prop("checked") == true){
        $('#open_now').addClass('btn-default-active');
    }
    if($('input[name="reservation"]').prop("checked") == true){
        $('#reservation').addClass('btn-default-active');
    }
    if($('input[name="price_1"]').prop("checked") == true){
        $('#price_1').addClass('btn-default-active');
    }
    if($('input[name="price_2"]').prop("checked") == true){
        $('#price_2').addClass('btn-default-active');
    }
    if($('input[name="price_3"]').prop("checked") == true){
        $('#price_3').addClass('btn-default-active');
    }
    if($('input[name="price_4"]').prop("checked") == true){
        $('#price_4').addClass('btn-default-active');
    }


});

function filter(filter_type){
    $.ajax({
        url: 'search/filter',
        type: "post",
        data: {'keywords':$('input[name=keywords]').val(), 'location':$('input[name=location]').val(),'type':filter_type, '_token': $('input[name=_token]').val()},
        success: function(data){
            //alert('Thanks for requesting. Will let this know to the store owner.');
            //window.location.reload();
        }
    });
}
