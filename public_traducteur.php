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
    <link rel="stylesheet" href="./assests/style/public_traducteur.css"/>

    <script type="text/javascript" src="./assests/scripts/jquery.min.js"></script>
    <script type="text/javascript" src="./assests/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="./assests/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assests/scripts/publicTraducteur.js"></script>
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

    <?php  
    require_once("controller.php");
    $id = $_GET["id"];
    $tc = new traductor_controller();
    $lg = $tc->getTraductorData($id);
    $r = $tc->getTypes($id);

    
   
    echo    '<div class=" row translator_bloc my-5 mx-5 pl-3 py-5">
                <div class="col-md-5 col-sm-12">
                    <img src="./uploads/profile_pics/'.$lg["Image"].'" alt="" class="img-fluid mt-3">
                </div>
                <div class="col-md-7 col-sm-12">
                    <div>';

    foreach($r as $type){
        echo '<div class="btn btn-default my-3 '.$type["Type"].'-tag">'.$type["Type"].'</div>';
    }                

    if ($lg["Assermente"] == 1)
        echo '<div class="btn btn-default assermente-tag my-3 float-right">Assermenté</div>';

    echo    '</div>
            <div class="d-flex flex-row justify-content-between">
                <div>
                    <span style="color: blue;">'.$lg["nbr"].'</span> Traductions
                </div>
                <div class="float-right">';

    for ($i =0; $i < $lg["note"]; $i++){
        echo '<i class="fa fa-star active-star"></i>';
    }

    for ($i = $lg["note"]; $i < 5; $i++){
        echo ' <i class="fa fa-star"></i>';
    }
    
    echo '
                </div>
            </div>
            
            <div class="personal_text">
                <h6>Hello Everybody, i am</h6>
                <h3>'.$lg["Nom"].' '.$lg["Prenom"].'</h3>
                <h4>Traducteur chez Doc-Translator</h4>
                <p>Je cherche a faire le meilleur de moi memem pour vous satisfaire</p>
                <ul class="list basic_info">
                    <li><a href="#"><i class="fa fa-phone mr-2"></i> '.$lg["Email"].'</a></li>
                    <li><a href="#"><i class="fa fa-envelope mr-2"></i> '.$lg["Phone"].'</a></li>
                    <li><a href="#"><i class="fa fa-home mr-2"></i> '.$lg["wilaya"].' '.$lg["commune"].'</a></li>
                </ul>
                <ul class="list personal_social row">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li class="ml-3"><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li class="ml-3"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                </ul>
                
            </div>
            <div class="btn btn-danger mt-3 float-right" data-toggle="modal" data-target="#modal_signalement">Signaler</div>
        </div>';
        ?>
    </div>

    <div class="modal fade" id="modal_signalement" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modal_title">Signler</h5>
              <button type="button" id="modal_close" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <div class="modal-body">
                <form >
                    <div class="form-group">
                            <label for="comment">Veuillez nous dire pourquoi :</label>
                            <textarea class="form-control" rows="5" name="signal" id="signalCause"></textarea>
                        </div>
                    <div class="col text-center">
                        <button type="button" class="btn btn-primary mb-2 mt-5" id="validerSignal">Envoyer</button>
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