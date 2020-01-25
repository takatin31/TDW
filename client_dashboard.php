<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="stylesheet" href="./assests/bootstrap/css/bootstrap-grid.min.css"/>
    <link rel="stylesheet" href="./assests/bootstrap/css/bootstrap-reboot.min.css"/>
    <link rel="stylesheet" href="./assests/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="./assests/style/font-awesome.min.css"/>
    <link rel="stylesheet" href="./assests/style/LineIcons.css">
    <link rel="stylesheet" href="./assests/style/semantic.min.css"/>
    <link rel="stylesheet" href="./assests/style/dataTables.semanticui.min.css"/>
    <link rel="stylesheet" href="./assests/style/adminDashboard.css"/>
    <link rel="stylesheet" href="./assests/style/client_dashboard.css"/>

    <script type="text/javascript" src="./assests/scripts/jquery.min.js"></script>
    <script type="text/javascript" src="./assests/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="./assests/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assests/scripts/recrutement.js"></script>
    <script type="text/javascript" src="./assests/scripts/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="./assests/scripts/dataTables.semanticui.min.js"></script>
    <script type="text/javascript" src="./assests/scripts/semantic.min.js"></script>
    <script type="text/javascript" src="./assests/scripts/notification_dashboard.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>
    <title>DocTranslator</title>


    
</head>
<body>
    <nav class="navbar navbar-expand-lg main-navbar">
        <a class="navbar-brand mr-5" href="#">
            <img src="./assests/images/logo2.svg" class="img-fluid"/>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <img src="assests/images/menu2.png"/>
        </button>
        <div class="collapse navbar-collapse row" id="navbarNavDropdown">
            <ul class="navbar-nav col-lg-8 col-md-6 col-sm-4">
                <li class="nav-item">
                    <a class="nav-link" href="main.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="type_traductions.html">Types de traduction</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="traducteurs.html">Traducteurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="blog.php">Blog</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="recrutement.php">Recrutement</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.html">A propos</a>
                </li>
            </ul>
            <div class="navbar-nav col-lg-4 col-md-6 col-sm-8 justify-content-end">
                <div class="nav-item col-lg-2 col-md-3 col-sm-3 d-none d-lg-block">
                    <a class="nav-link" href="#">
                        <img src="./assests/images/facebook.png" class="img-fluid"/>
                    </a>
                </div>
                <div class="nav-item col-lg-2 col-md-3 col-sm-3 d-none d-lg-block">
                    <a class="nav-link" href="#">
                        <img src="./assests/images/instagram.png" class="img-fluid"/>
                    </a>
                </div>
                <div class="nav-item col-lg-2 col-md-3 col-sm-3 d-none d-lg-block">
                    <a class="nav-link" href="#">
                        <img src="./assests/images/twitter.png" class="img-fluid"/>
                    </a>
                </div>
                <div class="nav-item col-lg-2 col-md-3 col-sm-3 d-none d-lg-block">
                    <a class="nav-link" href="#">
                        <img src="./assests/images/linkedin.png" class="img-fluid"/>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    

    <div class="container user_bloc mt-5 mb-5 py-5">
        <div class="row my-2">
            <div class="col-lg-8 order-lg-2">
                <h5 class="mb-3">User Profile</h5>
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a href="" data-target="#profile" data-toggle="tab" class="nav-link active">Historique</a>
                    </li>
                    <li class="nav-item">
                        <a href="" data-target="#messages" data-toggle="tab" class="nav-link">Notifications</a>
                    </li>
                    <li class="nav-item">
                        <a href="" data-target="#edit" data-toggle="tab" class="nav-link">Edit</a>
                    </li>
                    <li class="nav-item float-right">
                        <a href="" data-target="#demandeInfo" data-toggle="tab" class="nav-link" id="demandeInfoBtn">Traductions</a>
                    </li>
                </ul>
                <div class="tab-content py-4">
                    <div class="tab-pane active" id="profile">
                        
                        <div class="row profile">
                            <div class="col-md-12">
                                <h5 class="mt-2"><span class="fa fa-clock-o ion-clock float-right"></span> Recent Activity</h5>
                                <table id="example" class="ui celled table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Type de demande</th>
                                            <th>Traducteur</th>
                                            <th>Date</th>
                                            <th>Prix</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            require_once("controller.php");
                                            $hc = new HistoryController();
                                            $r = $hc->getHistoryClient($_COOKIE["userid"]);
                                            foreach($r as $lg){
                                                echo '<tr>
                                                        <td><a class="link_demande_2" href="#">'.$lg["Id"].'</a></td>
                                                        <td>'.$lg["Type"].'</td>
                                                        <td>'.$lg["Nom"].'</td>
                                                        <td>'.$lg["Date"].'</td>
                                                        <td>'.$lg["Prix"].'</td>
                                                        </tr>';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--/row-->
                    </div>
                    <div class="tab-pane overflow-auto" id="messages">
                        <table class="table mainTable">
                            <tbody>                                    
                                
                            </tbody> 
                        </table>
                    </div>
                    <div class="tab-pane" id="edit">
                        <form role="form">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">First name</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" value="Jane">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Last name</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" value="Bishop">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="email" value="email@gmail.com">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Company</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Website</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="url" value="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Address</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" value="" placeholder="Street">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                <div class="col-lg-6">
                                    <input class="form-control" type="text" value="" placeholder="City">
                                </div>
                                <div class="col-lg-3">
                                    <input class="form-control" type="text" value="" placeholder="State">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Time Zone</label>
                                <div class="col-lg-9">
                                    <select id="user_time_zone" class="form-control" size="0">
                                        <option value="Hawaii">(GMT-10:00) Hawaii</option>
                                        <option value="Alaska">(GMT-09:00) Alaska</option>
                                        <option value="Pacific Time (US &amp; Canada)">(GMT-08:00) Pacific Time (US &amp; Canada)</option>
                                        <option value="Arizona">(GMT-07:00) Arizona</option>
                                        <option value="Mountain Time (US &amp; Canada)">(GMT-07:00) Mountain Time (US &amp; Canada)</option>
                                        <option value="Central Time (US &amp; Canada)" selected="selected">(GMT-06:00) Central Time (US &amp; Canada)</option>
                                        <option value="Eastern Time (US &amp; Canada)">(GMT-05:00) Eastern Time (US &amp; Canada)</option>
                                        <option value="Indiana (East)">(GMT-05:00) Indiana (East)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Username</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" value="janeuser">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Password</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="password" value="11111122333">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label">Confirm password</label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="password" value="11111122333">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                <div class="col-lg-9">
                                    <input type="reset" class="btn btn-secondary" value="Cancel">
                                    <input type="button" class="btn btn-primary" value="Save Changes">
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="tab-pane ml-5" id="demandeInfo">
                        <div class="row">
                            <div>
                                <label class="titre">Nom du client</label>
                            </div>
                            <div>
                                <label class="valeur"></label>
                            </div>
                        </div>
                        <div class="row">
                            <div>
                                <label class="titre">Nom du client</label>
                            </div>
                            <div>
                                <label class="valeur"></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 order-lg-1 text-center">
                <img src="//placehold.it/150" class="mx-auto img-fluid img-circle d-block" alt="avatar">
                <h6 class="mt-2">Upload a different photo</h6>
                <label class="custom-file">
                    <input type="file" id="file" class="custom-file-input">
                    <span class="custom-file-control">Choose file</span>
                </label>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal_complete_paiementTr" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modal_title">Connexion</h5>
              <button type="button" id="modal_close" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <div class="modal-body">
                <form enctype="multipart/form-data" id="formePriceTr">
                    <div class="custom-file mt-3" >
                        <input type="file" class="custom-file-input" name="customFile" id="filePriceTr">
                        <label class="custom-file-label" for="customFile">Importer le fichier qui prouve le paiement</label>
                        <input type="hidden" value="0"></input>
                    </div>
                    <div class="col text-center">
                        <button type="button" class="btn btn-primary mb-2 mt-5" id="validerPayerTr">Valider Paiement</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="modal_complete_paiementDv" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modal_title">Connexion</h5>
              <button type="button" id="modal_close" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <div class="modal-body">
                <form enctype="multipart/form-data" id="formePriceDv">
                    <div class="custom-file mt-3" >
                        <input type="file" class="custom-file-input" name="customFile" id="filePriceDv">
                        <label class="custom-file-label" for="customFile">Importer le fichier qui prouve le paiement</label>
                        <input type="hidden" value="0"></input>
                    </div>
                    <div class="col text-center">
                        <button type="button" class="btn btn-primary mb-2 mt-5" id="validerPayerDv">Valider Paiement</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="modal_note" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modal_title">Connexion</h5>
              <button type="button" id="modal_close" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <div class="modal-body">
                <form enctype="multipart/form-data" id="formeNote">
                    <div class="custom-file mt-3" >
                        <label for="notes">Donner une note au traducteur:</label>
                        <div class="col-md-12 col-lg-8">
                            <select class="custom-select note-select" name="note">
                                <option>0</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                        <input type="hidden" id="idInputHidden" value="0"></input>
                        <input type="hidden" id="typeInputHidden" value="Traduction"></input>
                    </div>
                    <div class="col text-center">
                        <button type="button" class="btn btn-primary mb-2 mt-5" id="validerNote">Valider Note</button>
                        <button type="button" class="btn btn-warning mb-2 mt-5" id="resfuserNote">Ne pas noter</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
    </div>


    <div class="navbar navbar-expand-lg nav-footer">
        <ul class="navbar-nav col-lg-8 col-md-6 col-sm-4 pt-2">
            <li class="nav-item">
                <a class="nav-link" href="main.php">Accueil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="type_traductions.html">Type de traducteurs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="traducteurs.html">Traducteurs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="blog.php">Blog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="recrutement.php">Recrutement</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about.html">A propos</a>
            </li>
        </ul>

        <div class="navbar-nav col-lg-4 col-md-6 col-sm-8 justify-content-end">
            <div class="nav-item col-lg-2 col-md-3 col-sm-3 d-none d-lg-block">
                <a class="nav-link" href="#">
                    <img src="./assests/images/facebook2.png" class="img-fluid"/>
                </a>
            </div>
            <div class="nav-item col-lg-2 col-md-3 col-sm-3 d-none d-lg-block">
                <a class="nav-link" href="#">
                    <img src="./assests/images/instagram2.png" class="img-fluid"/>
                </a>
            </div>
            <div class="nav-item col-lg-2 col-md-3 col-sm-3 d-none d-lg-block">
                <a class="nav-link" href="#">
                    <img src="./assests/images/twitter2.png" class="img-fluid"/>
                </a>
            </div>
            <div class="nav-item col-lg-2 col-md-3 col-sm-3 d-none d-lg-block">
                <a class="nav-link" href="#">
                    <img src="./assests/images/linkedin2.png" class="img-fluid"/>
                </a>
            </div>
        </div>
        
    </div>
</body>
</html>