$(document).on("click", "#connexion", function(){
    let email = $("#email").val();
    let pass =  $("#pass").val();

    if (email == "" || pass == ""){
        alert("Veuillez remplir tous les champs");
    }else{
          
    $.ajax({
        type: "POST",
        url: "../Handlers/SignHandler.php",
        data: {
            email: email,
            pass: pass,
            action: "connexion"
        },
        success: function (data) {
            if (data == "problem"){
                alert("Il y'a une erreur dans les informations que vous avez inserées");
            }else{
                window.location = "dashboard.php";
            }
            
            
        }
    });
    }
    
});

$(document).on("click", "#inscription", function(){
    let email = $("#email").val();
    let pass =  $("#pass").val();

    if (email == "" || pass == ""){
        alert("Veuillez remplir tous les champs");
    }else{
        $.ajax({
            type: "POST",
            url: "../Handlers/SignHandler.php",
            data: {
                email: email,
                pass: pass,
                action: "inscription"
            },
            success: function (data) {
                if (data == 'ok'){
                    location.reload();
                }
                
            }
        });
    }


    
});