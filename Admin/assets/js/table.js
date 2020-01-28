
$(document).on("click", ".modify", function(){
    let container = $("#modifyContainer");

    container.css("display", "inline");

/*
    $.ajax({
        type: "POST",
        url: "ArticlesHandler.php",
        data: {
            start: index*3,
            limit: 3
        },
        success: function (data) {
            $(".block-content").empty();
            $(".block-content").append(data);
            
        }
    });*/
})

$(document).on("click", ".showInfo", function(){
    let container = $(".InfoContainer");

    container.css("display", "inline");

    $.ajax({
        type: "POST",
        url: "../Handlers/InfoHandler.php",
        data: {
            typeUser: "traducteur",
            idUser: 33
        },
        success: function (data) {
            $("#formDataTraducteur").empty();
            $("#formDataTraducteur").append(data);
        }
    });

    $.ajax({
        type: "POST",
        url: "../Handlers/HistoryHandler.php",
        data: {
            typeUser: "traducteur",
            idUser: 33,
            typeDemande: "traduction"
        },
        success: function (data) {
            console.log(data);
            
            $("#traductionHistory").empty();
            $("#traductionHistory").append(data);
        }
    });

    $.ajax({
        type: "POST",
        url: "../Handlers/HistoryHandler.php",
        data: {
            typeUser: "traducteur",
            idUser: 33,
            typeDemande: "devis"
        },
        success: function (data) {
            $("#devisHistory").empty();
            $("#devisHistory").append(data);
        }
    });

    $.ajax({
        type: "POST",
        url: "../Handlers/NoteHandler.php",
        data: {
            typeUser: "traducteur",
            idUser: 33,
        },
        success: function (data) {
            $("#noteHistory").empty();
            $("#noteHistory").append(data);
        }
    });

    $.ajax({
        type: "POST",
        url: "../Handlers/SignalementHandler.php",
        data: {
            typeUser: "traducteur",
            idUser: 36,
        },
        success: function (data) {
            $("#signalementHistory").empty();
            $("#signalementHistory").append(data);
        }
    });
})

$(document).on("click", ".showInfo", function(){
    let container = $(".InfoContainer");

    container.css("display", "inline");

    $.ajax({
        type: "POST",
        url: "../Handlers/InfoHandler.php",
        data: {
            typeUser: "client",
            idUser: 32
        },
        success: function (data) {
            $("#formDataClient").empty();
            $("#formDataClient").append(data);
        }
    });

})
