$( document ).ready(function() {
    setInterval(function(){update();}, 10000);
    update();
});

function update(){
    let tbody = $("#messages .mainTable tbody");

    tbody.empty();


    $.ajax({
        type: "POST",
        url: "NotificationUpdateHandler.php",
        success: function (data) {
            tbody.append(data);
        }
    });
}

$(document).on("click", ".demandeTraduction .btn-success", function(){
    let parent = $(this).parent().parent().parent().attr('id');
    let demandeId = parent.replace("demandeTraduction", "");

    $("#modal_complete_demandeTr input[type='hidden']").attr("value", demandeId);
})

$(document).on("click", ".demandeDevis .btn-success", function(){
    let parent = $(this).parent().parent().parent().attr('id');
    let demandeId = parent.replace("demandeDevis", "");

    $("#modal_complete_demandeDv input[type='hidden']").attr("value", demandeId);
})

$(document).on("click", ".acceptedTraduction .btn-secondary", function(){
    let parent = $(this).parent().parent().parent().attr('id');
    let demandeId = parent.replace("acceptedDemandeTraduction", "");

    $("#modal_complete_paiementTr input[type='hidden']").attr("value", demandeId);
})

$(document).on("click", ".acceptedDevis .btn-secondary", function(){
    let parent = $(this).parent().parent().parent().attr('id');
    let demandeId = parent.replace("acceptedDemandeDevis", "");

    $("#modal_complete_paiementDv input[type='hidden']").attr("value", demandeId);
})






$(document).on("click", "#validerPrixTr" , function() {
    let parent = $("#modal_complete_demandeTr input[type='hidden']").attr("value");

    
    let demandeId = parent.replace("demandeTraduction", "");

    let target = "traduction";
    let action = "accept";
    let prix = $("#priceTr").val();

    console.log(prix);
    
    
    $.ajax({
        type: "POST",
        url: "Notification_NoFile_Handler.php",
        data: {
            id: demandeId,
            action: action,
            target: target,
            prix: prix,
            fileExist: false
        },
        success: function (data) {
            update();
            $('#modal_complete_demandeTr .close').click();
        }
    });

});

$(document).on("click", "#validerPrixDv" , function() {
    let parent = $("#modal_complete_demandeDv input[type='hidden']").attr("value");

    let demandeId = parent.replace("demandeDevis", "");

    let target = "devis";
    let action = "accept";

    let prix = $("#priceDv").val();
    
    
    $.ajax({
        type: "POST",
        url: "Notification_NoFile_Handler.php",
        data: {
            id: demandeId,
            action: action,
            target: target,
            prix: prix,
            fileExist: false
        },
        success: function (data) {
            console.log(data);
            
            update();
            $('#modal_complete_demandeDv .close').click();
        }
    });

});

$(document).on("click", "#validerPayerTr" , function() {
    let parent = $("#modal_complete_paiementTr input[type='hidden']").attr("value");

    let demandeId = parent.replace("acceptedDemandeTraduction", "");

    let target = "traduction";
    let action = "vu";


    var formData = new FormData($('#formePriceTr').get(0));
    
    formData.append("id", demandeId);
    formData.append("action", action);
    formData.append("target", target);
    formData.append("prix", 0);
    formData.append("fileExist", true);
    
    
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "Notification_NoFile_Handler.php",
        processData: false,
        contentType : false,
        data: formData,
        success: function (data) {
            console.log(data);
            
            update();
            $('#modal_complete_paiementTr .close').click();
        }
    });

});

$(document).on("click", "#validerPayerDv" , function() {
    let parent = $("#modal_complete_paiementDv input[type='hidden']").attr("value");

    let demandeId = parent.replace("acceptedDemandeDevis", "");

    let target = "devis";
    let action = "vu";
    
    var formData = new FormData($('#formePriceTr').get(0));
    
    formData.append("id", demandeId);
    formData.append("action", action);
    formData.append("target", target);
    formData.append("prix", 0);
    formData.append("fileExist", true);
    
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "Notification_NoFile_Handler.php",
        processData: false,
        contentType : false,
        data: formData,
        success: function (data) {
            console.log(data);
            update();
            $('#modal_complete_paiementDv .close').click();
        }
    });

});

$(document).on("click", ".acceptedPaiementTr .btn-secondary" , function() {
    let parent = $(this).parent().parent().parent().attr('id');

    let demandeId = parent.replace("acceptedPaiementTr", "");

    let target = "traduction";
    let action = "vuPaiementClient";
    
    
    $.ajax({
        type: "POST",
        url: "Notification_NoFile_Handler.php",
        data: {
            id: demandeId,
            action: action,
            target: target,
            prix: 0,
            fileExist: false
        },
        success: function (data) {
            update();
            
        }
    });

});

$(document).on("click", ".acceptedPaiementDev .btn-secondary" , function() {
    let parent = $(this).parent().parent().parent().attr('id');

    let demandeId = parent.replace("acceptedPaiementDev", "");

    let target = "devis";
    let action = "vuPaiementClient";
    
    
    $.ajax({
        type: "POST",
        url: "Notification_NoFile_Handler.php",
        data: {
            id: demandeId,
            action: action,
            target: target,
            prix: 0,
            fileExist: false
        },
        success: function (data) {
            update();
            
        }
    });

});


$(document).on("click", ".receivedMTr .btn-secondary" , function() {
    let parent = $(this).parent().parent().parent().attr('id');

    let demandeId = parent.replace("recievedPaiementTr", "");

    let target = "traduction";
    let action = "startWork";
    
    
    $.ajax({
        type: "POST",
        url: "Notification_NoFile_Handler.php",
        data: {
            id: demandeId,
            action: action,
            target: target,
            prix: 0,
            fileExist: false
        },
        success: function (data) {
            update();
            
        }
    });

});

$(document).on("click", ".receivedMTDv .btn-secondary" , function() {
    let parent = $(this).parent().parent().parent().attr('id');

    let demandeId = parent.replace("recievedPaiementDv", "");

    let target = "devis";
    let action = "startWork";
    
    
    $.ajax({
        type: "POST",
        url: "Notification_NoFile_Handler.php",
        data: {
            id: demandeId,
            action: action,
            target: target,
            prix: 0,
            fileExist: false
        },
        success: function (data) {
            update();
            
        }
    });

});



$(document).on("click", ".beganTraduction .btn-secondary" , function() {
    let parent = $(this).parent().parent().parent().attr('id');

    let demandeId = parent.replace("beganTraduction", "");

    let target = "traduction";
    let action = "startVu";
    
    
    $.ajax({
        type: "POST",
        url: "Notification_NoFile_Handler.php",
        data: {
            id: demandeId,
            action: action,
            target: target,
            prix: 0,
            fileExist: false
        },
        success: function (data) {
            update();
            
        }
    });

});

$(document).on("click", ".beganDevis .btn-secondary" , function() {
    let parent = $(this).parent().parent().parent().attr('id');

    let demandeId = parent.replace("beganDevis", "");

    let target = "devis";
    let action = "startVu";
    
    
    $.ajax({
        type: "POST",
        url: "Notification_NoFile_Handler.php",
        data: {
            id: demandeId,
            action: action,
            target: target,
            prix: 0,
            fileExist: false
        },
        success: function (data) {
            update();
            
        }
    });

});

$(document).on("click", ".link_demande" , function() {
    let parent = $(this).parent().parent().attr('id');
    let type = "Traduction";
    
    
    if (parent.includes("Devis") || parent.includes("Dv") || parent.includes("Dev")){
        type = "Devis";
    }
    
    let action = "recieved";

    if (parent.includes("acceptedDemande")){
        action = "accepted";
    }

    if (parent.includes("Paiement")){
        action = "paiement";
    }

    if (parent.includes("began")){
        action = "started";
    }

    if (parent.includes("finished")){
        action = "finished";
    }


    let demandeId = parent.match(/\d+/)[0];

    if (type == "Traduction"){
        $("#modalfinalFileTraduction input[type='hidden']").attr("value", demandeId);
    }else{
        $("#modalfinalFileDevis input[type='hidden']").attr("value", demandeId);
    }
    
    
    $.ajax({
        type: "POST",
        url: "getDemandeHandler.php",
        data: {
            id: demandeId,
            action: action,
            type: type,
            prix: 0,
            fileExist: false
        },
        success: function (data) {
            update();
            $('#demandeInfo').empty();
            $('#demandeInfo').append(data);
            
        }
    });

});




$(document).on("click", "#validerFinalTr" , function() {
    
    let demandeId = $("#modalfinalFileTraduction input[type='hidden']").attr("value");
    console.log(demandeId);
    
    let target = "traduction";
    let action = "sendFile";
    
    var formData = new FormData($('#formeFinalTr').get(0));
    
    formData.append("id", demandeId);
    formData.append("action", action);
    formData.append("type", target);
    formData.append("fileExist", true);
    
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "FinalTraductionHandler.php",
        processData: false,
        contentType : false,
        data: formData,
        success: function (data) {
            console.log(data);
            update();
            $('#modalfinalFileTraduction .close').click();
        }
    });

});


$(document).on("click", "#validerFinaleDv" , function() {
    
    let demandeId = $("#modalfinalFileDevis input[type='hidden']").attr("value");

    let target = "devis";
    let action = "sendFile";
    
    var formData = new FormData($('#formeFinalDv').get(0));
    
    formData.append("id", demandeId);
    formData.append("action", action);
    formData.append("type", target);
    formData.append("fileExist", true);
    
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "FinalTraductionHandler.php",
        processData: false,
        contentType : false,
        data: formData,
        success: function (data) {
            console.log(data);
            update();
            $('#modalfinalFileDevis .close').click();
        }
    });

});