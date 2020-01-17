
$(document).on("click", ".add_input" , function() {

    let element = $('#languages_input > div').eq(0).clone();
        
    $('#languages_input').append(element);
    
});

$(document).on("click", ".delete_input" , function() {
    let nbr = $(".mastered_lang").length;

    if (nbr > 1)
        $(this).parent().parent().remove();
});

$(document).on("click", ".add_input_fax" , function() {

    let element = $('#fax-input > div').eq(0).clone();
    
    $('#fax-input').append(element);
    
});

$(document).on("click", ".delete_input_fax" , function() {
    let nbr = $(".fax").length;

    if (nbr > 1)
        $(this).parent().parent().remove();
});

$(document).on("click", ".add_input_type" , function() {

    let nbr = $('#types_input > div').length;

    let v = $('.mastered_types option:selected').text();

   
    

    if (nbr < 3){
        let tab = ['Generale', 'Scientique', 'Site Web'];

        let element = $('#types_input > div').eq(0).clone();

        element.find('.custom-select').empty();

        for (let i = 0 ; i < 3; i++){
            if (!v.includes(tab[i])){
                element.find('.custom-select').append('<option>'+tab[i]+'</option>');
            }
        }
    
        $('#types_input').append(element);
    }


    
});

$(document).on("click", ".delete_input_type" , function() {
    let nbr = $(".mastered_types").length;

    if (nbr > 1)
        $(this).parent().parent().remove();
});

$(document).on("change", "#wilaya" , function() {
    
    $('#commune').empty();

    $.ajax({
        type: "POST",
        data: {
          wilaya:this.value
        },
        url: "communeHandler.php",

        dataType: "html",
        success : function(result){
            
            $("#commune").append(result);
        }
      }); 
});

$(document).on("click", "#pro-traductor" , function() {
    let checked = ($(this).is(":checked"));
    if (checked)
        $('#assermentationP').parent().css('display', 'block');
    else
        $('#assermentationP').parent().css('display','none');
});


