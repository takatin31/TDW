$( document ).ready(function() {
    setInterval(function(){update();}, 10000);
});

function update(){
    let tbody = $("#messages .table tbody");

    tbody.empty();


    $.ajax({
        type: "POST",
        url: "NotificationUpdateHandler.php",
        success: function (data) {
            tbody.append(data);
            console.log(data);
            
        }
    });
}


$(document).on("click", ".demandeTraduction .btn-success" , function() {
    let parent = $(this).parent().parent().parent().attr('id');

    let demandeId = parent.replace("demandeTraduction", "");

    let target = "traduction";
    let action = "accept";
    
    
    $.ajax({
        type: "POST",
        url: "Notification_NoFile_Handler.php",
        data: {
            id: demandeId,
            action: action,
            target: target
        },
        success: function (data) {
            update();
            
        }
    });

});

$(document).on("click", ".demandeDevis .btn-success" , function() {
    let parent = $(this).parent().parent().parent().attr('id');

    let demandeId = parent.replace("demandeDevis", "");

    let target = "devis";
    let action = "accept";
    
    
    $.ajax({
        type: "POST",
        url: "Notification_NoFile_Handler.php",
        data: {
            id: demandeId,
            action: action,
            target: target
        },
        success: function (data) {
            update();
            
        }
    });

});

$(document).on("click", ".acceptedTraduction .btn-secondary" , function() {
    let parent = $(this).parent().parent().parent().attr('id');

    let demandeId = parent.replace("acceptedDemandeTraduction", "");

    let target = "traduction";
    let action = "vu";
    
    
    $.ajax({
        type: "POST",
        url: "Notification_NoFile_Handler.php",
        data: {
            id: demandeId,
            action: action,
            target: target
        },
        success: function (data) {
            update();
            
        }
    });

});

$(document).on("click", ".acceptedDevis .btn-secondary" , function() {
    let parent = $(this).parent().parent().parent().attr('id');

    let demandeId = parent.replace("acceptedDemandeDevis", "");

    let target = "devis";
    let action = "vu";
    
    
    $.ajax({
        type: "POST",
        url: "Notification_NoFile_Handler.php",
        data: {
            id: demandeId,
            action: action,
            target: target
        },
        success: function (data) {
            update();
            
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
            target: target
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
            target: target
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
            target: target
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
            target: target
        },
        success: function (data) {
            update();
            
        }
    });

});



$(document).on("click", ".beganTraduction .btn-secondary" , function() {
    let parent = $(this).parent().parent().parent().attr('id');

    let demandeId = parent.replace("demandeTraduction", "");

    let target = "traduction";
    let action = "startVu";
    
    
    $.ajax({
        type: "POST",
        url: "Notification_NoFile_Handler.php",
        data: {
            id: demandeId,
            action: action,
            target: target
        },
        success: function (data) {
            update();
            
        }
    });

});

$(document).on("click", ".beganDevis .btn-secondary" , function() {
    let parent = $(this).parent().parent().parent().attr('id');

    let demandeId = parent.replace("demandeDevis", "");

    let target = "devis";
    let action = "startVu";
    
    
    $.ajax({
        type: "POST",
        url: "Notification_NoFile_Handler.php",
        data: {
            id: demandeId,
            action: action,
            target: target
        },
        success: function (data) {
            update();
            
        }
    });

});