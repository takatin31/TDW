$(document).on('click', ".btn-search", function () {
    let nom = $("#search").val();
    let type_traduction = $("#type_traduction").val();
    let type_traducteur = $("#type_traducteur").val();
    let langue = $("#langue").val();


    $.ajax({
        type: "POST",
        url: "MainRechercheHandler.php",
        data: {
            nom: nom,
            type_traduction: type_traduction,
            target: target,
            type_traducteur: type_traducteur,
            langue: langue
        },
        success: function (data) {
            console.log(data);
            
        }
    });
  })