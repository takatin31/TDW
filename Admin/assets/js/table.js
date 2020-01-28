
$(document).on("click", ".modifyInfoTraducteur", function(){
    let container = $("#modifyContainer");

    container.css("display", "inline");

    $(".InfoContainer").css("display", "none");

    let userId = $(this).parent().parent().parent().parent().find(".userId").text();

    $.ajax({
        type: "POST",
        url: "../Handlers/InfoHandler.php",
        data: {
            typeUser: "traducteur",
            idUser: userId,
            action: "modify"
        },
        success: function (data) {
            $("#modifyContainerBody").empty();
            $("#modifyContainerBody").append(data);
        }
    });
})

$(document).on("click", ".modifyInfoClient", function(){
    let container = $("#modifyContainer");

    container.css("display", "inline");

    $(".InfoContainer").css("display", "none");

    let userId = $(this).parent().parent().parent().parent().find(".userId").text();

    
    $.ajax({
        type: "POST",
        url: "../Handlers/InfoHandler.php",
        data: {
            typeUser: "client",
            idUser: userId,
            action: "modify"
        },
        success: function (data) {
            $("#modifyContainerBody").empty();
            $("#modifyContainerBody").append(data);
        }
    });
})

$(document).on("click", ".showInfoTraducteur", function(){
    let container = $(".InfoContainer");

    container.css("display", "inline");

    
    let userId = $(this).parent().parent().parent().parent().find(".userId").text();

    console.log(userId);
    

    $("#modifyContainer").css("display", "none");

    $.ajax({
        type: "POST",
        url: "../Handlers/InfoHandler.php",
        data: {
            typeUser: "traducteur",
            idUser: userId,
            action: "view"
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
            idUser: userId,
            typeDemande: "traduction"
        },
        success: function (data) {
            
            $("#traductionHistory").empty();
            $("#traductionHistory").append(data);
        }
    });

    $.ajax({
        type: "POST",
        url: "../Handlers/HistoryHandler.php",
        data: {
            typeUser: "traducteur",
            idUser: userId,
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
            idUser: userId,
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
            idUser: userId,
        },
        success: function (data) {
            $("#signalementHistory").empty();
            $("#signalementHistory").append(data);
        }
    });
})

$(document).on("click", ".showInfoClient", function(){
    let container = $(".InfoContainer");

    container.css("display", "inline");

    let userId = $(this).parent().parent().parent().parent().find(".userId").text();

    $("#modifyContainer").css("display", "none");

    $.ajax({
        type: "POST",
        url: "../Handlers/InfoHandler.php",
        data: {
            typeUser: "client",
            idUser: userId,
            action: "view"
        },
        success: function (data) {
            $("#formDataClient").empty();
            $("#formDataClient").append(data);
        }
    });

    $.ajax({
        type: "POST",
        url: "../Handlers/HistoryHandler.php",
        data: {
            typeUser: "client",
            idUser: userId,
            typeDemande: "traduction"
        },
        success: function (data) {
            
            $("#traductionHistory").empty();
            $("#traductionHistory").append(data);
        }
    });

    $.ajax({
        type: "POST",
        url: "../Handlers/HistoryHandler.php",
        data: {
            typeUser: "client",
            idUser: userId,
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
            typeUser: "client",
            idUser: userId,
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
            typeUser: "client",
            idUser: userId,
        },
        success: function (data) {
            $("#signalementHistory").empty();
            $("#signalementHistory").append(data);
        }
    });

})


$(document).on("click", ".deleteUser", function(){

    let userId = $(this).parent().parent().parent().parent().find(".userId").text();

    $.ajax({
        type: "POST",
        url: "../Handlers/UserStateHandler.php",
        data: {
            idUser: userId,
            action: "delete"
        },
        success: function (data) {
        }
    });
});


$(document).on("click", ".blockUser", function(){

    let userId = $(this).parent().parent().parent().parent().find(".userId").text();

    $.ajax({
        type: "POST",
        url: "../Handlers/UserStateHandler.php",
        data: {
            idUser: userId,
            action: "block"
        },
        success: function (data) {
        }
    });
});


$(document).on("click", ".deblockUser", function(){

    let userId = $(this).parent().parent().parent().parent().find(".userId").text();

    $.ajax({
        type: "POST",
        url: "../Handlers/UserStateHandler.php",
        data: {
            idUser: userId,
            action: "deblock"
        },
        success: function (data) {
        }
    });
});