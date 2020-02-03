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
            <?php
                require_once("controller.php");
                $uc = new users_controller();
                $nom_prenom = $uc->getName($_COOKIE["userid"]);
                echo '<h5 class="mb-3">'.$nom_prenom["Nom"].' '.$nom_prenom["Prenom"].'</h5>';
            ?>
                
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
                        <form action="modificationProfile.php" method="POST">
                            <?php
                                require_once("controller.php");
                                $uc = new users_controller();
                                $r = $uc->getUserData($_COOKIE["userid"]);

                            
                                echo '<div class="form-group">
                                        <label for="nom">Nom :</label>
                                        <input type="text" class="form-control" placeholder="Entrez Nom" value="'.$r["Nom"].'" name="nom" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="prenom">Prenom:</label>
                                        <input type="text" class="form-control" placeholder="Entez prenom" value="'.$r["Prenom"].'" name="prenom" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control" placeholder="Entez Email" value="'.$r["Email"].'" name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="Mot de passe">Mot de passe:</label>
                                        <input type="password" class="form-control" placeholder="Mot de passe" value="'.$r["Password"].'" name="password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="numero de telephone">Numero de telephone:</label>
                                        <input type="phone" class="form-control" placeholder="Numero de telephone" value="'.$r["Phone"].'" name="phone" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="wilaya">Wilaya:</label>
                                        <select class="custom-select" name="wilaya" id="wilaya">';
                                            
                                            
                                            $cf = new adresse_controller();
                                            $qtf = $cf->get_wilayas();
                                            foreach($qtf as $rs){
                                                echo '<option>'.$rs['Nom'].'</option>';
                                            }
                                            
                                    echo '</select>
                                    </div>
                                    <div class="form-group">
                                        <label for="commune">Commune:</label>
                                        <select class="custom-select" name="commune" id="commune">';
                                            
                                            
                                            $qtf = $cf->get_commune('Adrar');
                                            foreach($qtf as $rs){
                                                echo '<option>'.$rs['Nom'].'</option>';
                                            }
                                            
                                    echo '</select>
                                    </div>
                                    <div class="form-group">
                                        <label for="adresse">Adresse:</label>
                                        <input type="text" class="form-control" placeholder="Entez l\'adresse" value="'.$r["Adresse"].'" name="adresse" required>
                                    </div>';
                        ?>
                        <div class="col text-center">
                            <button type="submit" class="btn btn-primary mb-2 mt-5">Submit</button>
                        </div>
                    </form>
                    </div>

                    <div class="tab-pane ml-5" id="demandeInfo">
                        
                    </div>
                </div>
            </div>
            <div class="col-lg-4 order-lg-1 text-center">
            <?php
                require_once("controller.php");
                $uc = new users_controller();
                $image = $uc->getPhoto($_COOKIE["userid"]);
                echo '<img src="./uploads/profile_pics/'.$image.'" id="profilePic" class="mx-auto img-fluid img-circle d-block" alt="avatar">'
            ?>
                
                <h6 class="mt-2">Upload a different photo</h6>
                <label class="custom-file">
                    <input type="file" id="profileImage" name="profilePicInput" class="custom-file-input">
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