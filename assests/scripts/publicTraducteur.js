$(document).on("click", "#validerSignal", function(){
    

    let id = getUrlParameter('id');;
    let cause = $("#signalCause").val();
    
    $.ajax({
        type: "POST",
        url: "signalHandler.php",
        data: {
            traducteur: id,
            cause: cause
        },
        success: function (data) {
           console.log(data);
           $('#modal_signalement .close').click();
            
        }
    });
})

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};