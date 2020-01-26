$(document).on('click', ".btn-search", function () {
    let nom = $("#search").val();
    let type_traduction = $("#type_traduction").val();
    let type_traducteur = $("#type_traducteur").val();
    let langue = $("#langue").val();


    if (type_traducteur == "Assermente"){
        type_traducteur = "true";
    }else{
        type_traducteur = "false";
    }

    $.ajax({
        type: "POST",
        url: "MainRechercheHandler.php",
        data: {
            nom: nom,
            type_traduction: type_traduction,
            type_traducteur: type_traducteur,
            langue: langue
        },
        success: function (data) {
            $(".search-results").empty();
            $(".search-results").append(data);
            
        }
    });
  })

