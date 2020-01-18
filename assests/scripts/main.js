$(document).on("click", ".card-link" , function() {
    let card = $(this).parent().parent();
    
    let title = card.find(".card-title").text();
    if (title == ""){
        title = "Article"
    }
    

    let image = card.find(".card-img-top").clone();

    let body = card.find(".card-body").clone();

    $("#modal_title").text(title);
    $(".modal-body").append(image);
    $(".modal-body").append(body);
    

});

$(document).on("click", "#modal_close" , function() {
    $(".modal-body").empty();    
})

$(document).on("click", ".add_input_fax" , function() {

    let element = $('#fax-input > div').eq(0).clone();
    
    $('#fax-input').append(element);
    
});

$(document).on("click", ".delete_input_fax" , function() {
    let nbr = $(".fax").length;

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