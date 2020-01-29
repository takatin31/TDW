<!DOCTYPE html>
<html lang="en">
<head>
  <title>
    Gestion des Traducteurs
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <link href="../assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
    <link href="../assets/css/sign.css" rel="stylesheet" />

</head>
<body>
    <div class="container-fluid row justify-content-center align-items-center main-container">
        <div class="col-lg-5">
            <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title text-center">Connexion pour les Administrateurs</h4>
            </div>
            <form class="card-body px-5 d-flex justify-content-around flex-column">
                
                    <div class="form-group mx-5">
                        <label class="bmd-label-floating">Email</label>
                        <input type="text" id="email" class="form-control" require>
                    </div>

                    <div class="form-group mx-5">
                        <label class="bmd-label-floating">Password</label>
                        <input type="password" id="password" class="form-control" require>
                    </div>
                    
                    <?php
                        if (isset($_COOKIE["adminId"])){
                            header('location: ../Vues/dashboard.php');
                        }else{
                            require_once("../ControllerAdmin.php");
                            $ac = new AdminController();
                            $r = $ac->getNbrAdminList();
                            if (strcmp($r, "0") == 0){
                                echo '<div class="d-flex justify-content-center">
                                        <button type="button" id="inscription" class="btn btn-primary">Inscription</button>
                                    </div>';
                            }else{
                                echo '<div class="d-flex justify-content-center">
                                        <button type="button" id="connexion" class="btn btn-primary">Connexion</button>
                                    </div>';
                            }
                            
                        }
                    ?>
                
            
            </form>
        </div>
    </div>

    <script src="../assets/js/core/jquery.min.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap-material-design.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <script src="../assets/js/plugins/moment.min.js"></script>
    <script src="../assets/js/plugins/sweetalert2.js"></script>
    <script src="../assets/js/plugins/jquery.validate.min.js"></script>
    <script src="../assets/js/plugins/jquery.bootstrap-wizard.js"></script>
    <script src="../assets/js/plugins/bootstrap-selectpicker.js"></script>
    <script src="../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
    <script src="../assets/js/plugins/jquery.dataTables.min.js"></script>
    <script src="../assets/js/plugins/bootstrap-tagsinput.js"></script>
    <script src="../assets/js/plugins/jasny-bootstrap.min.js"></script>
    <script src="../assets/js/plugins/fullcalendar.min.js"></script>
    <script src="../assets/js/plugins/jquery-jvectormap.js"></script>
    <script src="../assets/js/plugins/nouislider.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    <script src="../assets/js/plugins/arrive.min.js"></script>
    <script src="../assets/js/plugins/chartist.min.js"></script>
    <script src="../assets/js/plugins/bootstrap-notify.js"></script>
    <script src="../assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
    <script src="../assets/js/sign.js" type="text/javascript"></script>
</body>
</html>