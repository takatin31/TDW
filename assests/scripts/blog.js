$(document).on("click", "#prev", function(){
    let index = parseInt($(".block-heading input[type='hidden']").val());
    
    index = Math.max(0, index-1);

    $(".block-heading input[type='hidden']").attr("value",index);
    
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
    });

})

$(document).on("click", "#next", function(){
    let index = parseInt($(".block-heading input[type='hidden']").val());
    
    index = index + 1;

    $(".block-heading input[type='hidden']").attr("value",index);

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
    });
})


