$(document).on("click", ".card-link" , function() {
    let card = $(this).parent().parent();
    
    let title = card.find(".card-title").text();
    if (title == ""){
        title = "Article"
    }
    

    let image = card.find(".card-img-top").clone();

    let body = card.find(".card-body").clone();

    $("#modal_tab #modal_title").text(title);
    $("#modal_tab .modal-body").append(image);
    $("#modal_tab .modal-body").append(body);
    

});

$(document).on("click", "#modal_tab #modal_close" , function() {
    $("#modal_tab .modal-body").empty();    
})

$(document).on("click", ".add_input_fax" , function() {

    let element = $('#fax-input > div').eq(0).clone();
    
    $('#fax-input').append(element);
    
});

$(document).on("click", ".delete_input_fax" , function() {
    let nbr = $(".fax").length;

    if (nbr > 1)
        $(this).parent().parent().remove();
});

$(document).on("change", "#wilaya" , function() {
    
    $('#commune').empty();

    $.ajax({
        type: "POST",
        data: {
          wilaya:this.value
        },
        url: "communeHandler.php",

        dataType: "html",
        success : function(result){
            
            $("#commune").append(result);
        }
      }); 
});


$(document).on("change", "#wilaya2" , function() {
    
    $('#commune2').empty();

    $.ajax({
        type: "POST",
        data: {
          wilaya:this.value
        },
        url: "communeHandler.php",

        dataType: "html",
        success : function(result){
            
            $("#commune2").append(result);
        }
      }); 
});

$(document).on("click", "#submit" , function() {
    let nom = $('#nomD').val();
    let prenom = $('#prenomD').val();
    let email = $('#emailD').val();
    let phone = $('#phoneD').val();
    let wilaya = $('#wilaya').val();
    let commune = $('#commune').val();
    let adresseD = $('#adresseD').val();
    let originL = $('#originL').val();
    let DestinationL = $('#DestinationL').val();
    let typeD = $('#typeD').val();
    let commentD = $('#commentD').val();
    let pro_traductorD = $('#pro-traductorD').prop('checked');
    let fileD = $('#fileD').val();

    
    $('#example tbody').empty();


    
    $.ajax({
        type: "POST",
        data: {
            originL:originL,
            DestinationL:DestinationL,
            typeD:typeD,
            protraductorD:pro_traductorD
        },
        url: "rechercheHandler.php",

        dataType: "html",
        success : function(result){
            $('#example tbody').append(result);
            $('#example').DataTable();
        }
      }); 
    
})

$(document).on("click", "#validerDemande" , function() {

    

    var formData = new FormData($('#demandeForm').get(0));
    
    let child = $('.traductor input:checked');
    let listTraductor = [];
    
    for (let i = 0 ; i < child.length; i++){
        let id = child.eq(i).parent().parent().find('a').text();
        formData.append("traducteurs[]", id);
    }

    let type = $('.demande-info .custom-select').val();
    
    
    

    let assermente = $('#pro-traductorD').prop('checked');
    
    

     formData.append("typeDemande", type);
     
     formData.append("assermente", assermente);

  
    
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "demandeTraductionHandler.php",
        data: formData,
        processData: false,
        contentType : false,
        success: function (data) {
            console.log("SUCCESS : ", data);
            $('#modal_complete_info .close').click();
        }
    });
    
    
    
});