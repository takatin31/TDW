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

$(document).on("click", ".deniedPaiementTr .btn-secondary", function(){
    let parent = $(this).parent().parent().parent().attr('id');
    let demandeId = parent.replace("deniedPaiementTr", "");

    $("#modal_complete_paiementTr input[type='hidden']").attr("value", demandeId);
})

$(document).on("click", ".deniedPaiementDev .btn-secondary", function(){
    let parent = $(this).parent().parent().parent().attr('id');
    let demandeId = parent.replace("deniedPaiementDv", "");

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

    
    demandeId = demandeId.replace("deniedPaiementTr", "");

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
    
    demandeId = demandeId.replace("deniedPaiementDv", "");

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

$(document).on("click", ".accedptedTraduction .btn-warning" , function() {
    let parent = $(this).parent().parent().parent().attr('id');

    let demandeId = parent.replace("acceptedFinishedTraduction", "");

    let target = "traduction";
    let action = "finishedVu";
    
    
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

$(document).on("click", ".paimentRecievedTraduction .btn-warning" , function() {
    let parent = $(this).parent().parent().parent().attr('id');

    let demandeId = parent.replace("paimentRecievedTraduction", "");

    let target = "traduction";
    let action = "finishedVu";
    
    
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


$(document).on("click", ".paimentRecievedDevis .btn-warning" , function() {
    let parent = $(this).parent().parent().parent().attr('id');

    let demandeId = parent.replace("paimentRecievedDevis", "");

    let target = "devis";
    let action = "finishedVu";
    
    
    
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
            console.log(data);
            
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
            $("#demandeInfoBtn").trigger("click");
            
        }
    });

});


$(document).on("click", ".link_demande_2" , function() {
    let demandeId = $(this).text();
    let type = $(this).parent().next().text();
    console.log(type);
    
    
    console.log(demandeId+"   "+type);
    
    
    
    $.ajax({
        type: "POST",
        url: "getDemandeHandler.php",
        data: {
            id: demandeId,
            action: "accepted",
            type: type,
            prix: 0,
            fileExist: false
        },
        success: function (data) {
            
            $('#demandeInfo').empty();
            $('#demandeInfo').append(data);
            $("#demandeInfoBtn").trigger("click");
            
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

$(document).on("click", ".finishedTraduction .btn-warning", function(){
    let parent = $(this).parent().parent().parent().parent().attr('id');
    let type = "Traduction";


    let demandeId;

    console.log("tr");
    
    demandeId = parent.replace("finishedTraduction", "");
    

   

    $("#modal_note #idInputHidden").attr("value", demandeId);
    $("#modal_note #typeInputHidden").attr("value", type);
})

$(document).on("click", ".finishedDevis .btn-secondary", function(){
    let parent = $(this).parent().parent().parent().parent().attr('id');
    let type = "Devis";
    

    let demandeId;
    console.log("dv");
    
    
    demandeId = parent.replace("finishedDevis", "");
    

   

    $("#modal_note #idInputHidden").attr("value", demandeId);
    $("#modal_note #typeInputHidden").attr("value", type);
})


$(document).on("click", "#validerNote", function(){
    let demandeId = $("#modal_note #idInputHidden").attr("value");
    let type = $("#modal_note #typeInputHidden").attr("value");

    let note = $("#formeNote .note-select").val();
    
    
    $.ajax({
        type: "POST",
        url: "noteHandler.php",
        data: {
            demandeid: demandeId,
            type: type,
            note: note,
        },
        success: function (data) {
            console.log(data);
            update();
            $('#modal_note .close').click();
        }
    });
});



$(document).on("click", "#resfuserNote", function(){
    let demandeId = $("#modal_note #idInputHidden").attr("value");
    let type = $("#modal_note #typeInputHidden").attr("value");

    
    
    
    $.ajax({
        type: "POST",
        url: "noteHandler.php",
        data: {
            demandeid: demandeId,
            type: type,
        },
        success: function (data) {
            console.log(data);
            update();
            $('#modal_note .close').click();
        }
    });
});

$(document).on("change", "#profileImage", function(){
    let el = $('#profileImage').prop('files')[0];
   
    
    var formData = new FormData();

    formData.append('profileImage', el);  
    
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "ImageProfileHandler.php",
        processData: false,
        contentType : false,
        data: formData,
        success: function (data) {
            $("#profilePic").attr("src", "./uploads/profile_pics/"+data);
        }
    });
});