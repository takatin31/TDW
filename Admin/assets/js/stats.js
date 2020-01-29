$(document).on("click", "#recherche", function(){
    let client = $("#client").val();
    let traducteur = $("#traductor").val(); 
    let date1 =  $("#date-time1").val();
    let date2 =  $("#date-time2").val();

    var formData = new FormData();

    if (client != ""){
        formData.append("client", client);
    }

    if (traducteur != ""){
        formData.append("traducteur", traducteur);
    }

    if (date1 = "" || date2 == ""){
        alert("Veuillez specifier les dates");
    }else{

        formData.append("dateD", date1);
        formData.append("dateF", date2);
    
        $.ajax({
            type: "POST",
            url: "../Handlers/StatsHandler.php",
            data: formData,
            processData: false,
            contentType : false,
            success: function (data) {
                $("#myChart1").empty();
                $("#myChart2").empty();


                
                let dataS = data.split("|");
                var info = [parseInt(dataS[0]),parseInt(dataS[1])];
                var types = ["Traduction", "Devis"];
                

                var ctx = document.getElementById("myChart1");
                var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: types,
                    datasets: [{
                        backgroundColor: [
                            "#2ecc71",
                            "#3498db"
                          ],
                        data: info
                    }],
                    
                },
                  options: {
                    scales: {
                      yAxes: [{
                        ticks: {
                          beginAtZero: true
                        }
                      }]
                    }
                  }
            });
                
                var ctx2 = document.getElementById("myChart2");
                var myChart2 = new Chart(ctx2, {
                type: 'pie',
                data: {
                    labels: types,
                    datasets: [{
                        backgroundColor: [
                            "#2ecc71",
                            "#3498db"
                          ],
                        data: info
                    }],
                    
                }
            });
                
            }
        });
    }

})

$( document ).ready(function() {
    
});
