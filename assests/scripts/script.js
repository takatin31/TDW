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