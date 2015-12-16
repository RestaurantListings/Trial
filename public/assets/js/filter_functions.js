/**
 * Created by Abu Isaac on 10/31/15.
 */

$(function () {
    $('[data-toggle="tooltip"]').tooltip();

    $("#basic-location-icon").click(function(event) {
        event.preventDefault();
        var addressId = this.id.substring(0, this.id.indexOf("-"));

        navigator.geolocation.getCurrentPosition(function(position) {
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({
                        "location": new google.maps.LatLng(position.coords.latitude, position.coords.longitude)
                    },
                    function(results, status) {

                        //console.log(results);
                        if (status == google.maps.GeocoderStatus.OK){

                            for (var key in results[0].address_components) {
                                if (results[0].address_components.hasOwnProperty(key)) {
                                    if(results[0].address_components[key]['types'].indexOf("postal_code") != -1){
                                        $("#locations").val(results[0].address_components[key]['short_name']);
                                        $("#current_location").val(results[0].address_components[key]['short_name']);

                                    }

                                }
                            }
                        }
                        else{
                            $("#error").append("Unable to retrieve your address<br />");
                        }
                    });
            },
            function(positionError){
                $("#error").append("Error: " + positionError.message + "<br />");
            },
            {
                enableHighAccuracy: true,
                timeout: 10 * 1000 // 10 seconds
            });
    });
    $(".cuisine-icon").click(function(event) {
        event.preventDefault();
        var addressId = this.id.substring(0, this.id.indexOf("-"));
        var cuisine = this.id;

        navigator.geolocation.getCurrentPosition(function(position) {
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({
                        "location": new google.maps.LatLng(position.coords.latitude, position.coords.longitude)
                    },
                    function(results, status) {

                        //console.log(results);
                        if (status == google.maps.GeocoderStatus.OK){

                            for (var key in results[0].address_components) {
                                if (results[0].address_components.hasOwnProperty(key)) {
                                    if(results[0].address_components[key]['types'].indexOf("postal_code") != -1){
                                        $("#current_location").val(results[0].address_components[key]['short_name']);
                                        window.location="category/"+cuisine+"/"+results[0].address_components[key]['short_name'];
                                    }

                                }
                            }
                        }
                        else{
                            window.location="category/"+cuisine;
                        }
                    });
            },
            function(positionError){
                $("#error").append("Error: " + positionError.message + "<br />");
                window.location="category/"+cuisine;
            },
            {
                enableHighAccuracy: true,
                timeout: 10 * 1000 // 10 seconds
            });
    });
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
function IsNumber(fldId)
{
    var fld=document.getElementById(fldId).value;

    if(isNaN(fld))
    {
        document.getElementById(fldId).value=fld.substring(0, fld.length-1);
        var newvalue=document.getElementById(fldId).value;
        IsNumber(fldId);
    }

    return;
}


function FtToCm(ftfld,infld,savefld)
{
    var ft=document.getElementById(ftfld).value;
    var inch=document.getElementById(infld).value;

    if(!isNaN(ft) && !isNaN(inch))
    {
        var allinch= ft * 12;
        allinch= parseInt(allinch) + parseInt(inch);

        var cm =allinch * 2.54;

        document.getElementById(savefld).value=Math.round(cm);
    }
    else
    {
        document.getElementById("feet").value=ft.substring(0, ft.length-1);
        document.getElementById("inch").value=inch.substring(0, inch.length-1);
    }
    //form2.field.value =lbs;
    //alert(field);
    return;
}

function CmToFt(cm,ftfld,infld)
{
    if(!isNaN(cm))
    {
        var newcm=cm * 0.3937;

        var ft = newcm / 12;
        var remain= newcm % 12;
        var inchs= remain;

        document.getElementById(ftfld).value=Math.round(ft);
        document.getElementById(infld).value=Math.round(inchs);
    }
    else
    {
        document.getElementById("cm").value=cm.substring(0, cm.length-1);
    }
    //form2.field.value =lbs;
    //alert(field);
    return;
}


function KgToLbs(kg,field)
{
    if(!isNaN(kg))
    {
        var lbs= kg * 2.2;
        document.getElementById(field).value=Math.round(lbs);
    }
    else
    {
        document.getElementById("kg").value=kg.substring(0, kg.length-1);
    }
    //form2.field.value =lbs;
    //alert(field);
    return;
}

function LbsToKg(lbs,field)
{
    if(!isNaN(lbs))
    {
        var kg= lbs / 2.2;
        document.getElementById(field).value=Math.round(kg);
    }
    else
    {
        document.getElementById("lbs").value=lbs.substring(0, lbs.length-1);
    }
    return;
}
function validateForm(frm)
{

    age=frm.age.value;
    kg=frm.kg.value;
    cm=frm.cm.value;

    if(age=="" || kg=="" || cm=="" )
    {
        alert('Error: all fields are required!');
        return false;
    }

    return;
}

function showHide(fldshow,fldhide,label,labelfld)
{
    var myTextelemShow = document.getElementById(fldshow);
    var myTextelemLabel = document.getElementById(labelfld);
    var myTextelemHide = document.getElementById(fldhide);
    if(myTextelemShow.style.display == 'none')
    {
        myTextelemShow.style.display = 'inline' ;
        myTextelemLabel.innerHTML = label;
    }
    if(myTextelemHide.style.display != 'none')
    {
        myTextelemHide.style.display = 'none';
    }
}






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

function activate_emotion(val){
    $("#emo"+val).addClass('active-emotion');
}
