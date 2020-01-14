var langues = ["Albanais","Allemand","Amazigh","Anglais","Arabe","Arménien","Aymara","Bengali","Catalan","Chinois","Coréen","Croate","Danois","Espagnol","Français","Guarani","Grec","Hongrois","Italien","Kikongo","Kiswahili","Lingala","Malais","Mongol","Néerlandais","Occitan","Ourdou","Persan","Portugais","Quechua","Roumain","Russe","Samoan","Serbe","Sesotho","Slovaque","Slovène","Suédois","Tamoul","Turc"];

$(document).ready(function(){

    let list = $('.mastered_lang')
    for (let i = 0; i < langues.length; i++) {
        list.append('<option>'+langues[i]+'</option>')
    }
})


$(document).on("click", ".add_input" , function() {
    let parent = $('<div class="row custom-input mt-2 justify-content-center">'+
                '<div class="col-8">'+
                    '<select class="custom-select mastered_lang"></select>'+
                '</div>'+
                '<div class="col-md-12 col-lg-3 d-flex align-items-center justify-content-around">'+
                    '<div class="btn btn-default add_input"><i class="fa fa-plus"></i></div>'+
                    '<div class="btn btn-default delete_input"><i class="fa fa-trash-o"></i></div>'+
                '</div>'+
            '</div>'
        ).appendTo("#languages_input");

    let list = parent.find( "select" )
    for (let i = 0; i < langues.length; i++) {
        list.append('<option>'+langues[i]+'</option>')
    }
});

$(document).on("click", ".delete_input" , function() {
    let nbr = $(".custom-input").length;

    if (nbr > 1)
        $(this).parent().parent().remove();
});