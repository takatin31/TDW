<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="stylesheet" href="./assests/bootstrap/css/bootstrap-grid.min.css"/>
    <link rel="stylesheet" href="./assests/bootstrap/css/bootstrap-reboot.min.css"/>
    <link rel="stylesheet" href="./assests/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="./assests/style/font-awesome.min.css"/>
    <link rel="stylesheet" href="./assests/style/LineIcons.css">
    <link rel="stylesheet" href="./assests/style/recrutement.css"/>

    <script type="text/javascript" src="./assests/scripts/jquery.min.js"></script>
    <script type="text/javascript" src="./assests/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="./assests/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assests/scripts/recrutement.js"></script>
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
                    <a class="nav-link" href="blog.html">Blog</a>
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

    

    <div class="container-fluid mb-5 mt-5 col-md-8 col-lg-5 col-sm-10 form">
            <h2 class="text-center mt-3">Demande de recrutement</h2>
            <hr/>
            <form  method="POST" action="recrutementHandler.php" enctype = "multipart/form-data">
                <div class="form-group">
                  <label for="nom">Nom :</label>
                  <input type="text" class="form-control" placeholder="Entrez Nom" name="nom" required>
                </div>
                <div class="form-group">
                  <label for="prenom">Prenom:</label>
                  <input type="text" class="form-control" placeholder="Entez prenom" name="prenom" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" placeholder="Entez Email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="Mot de passe">Mot de passe:</label>
                    <input type="password" class="form-control" placeholder="Mot de passe" name="password" required>
                </div>
                <div class="form-group">
                    <label for="numero de telephone">Numero de telephone:</label>
                    <input type="phone" class="form-control" placeholder="Numero de telephone" name="phone" required>
                </div>
                <div class="form-group" id="fax-input">
                    <label for="fax">Fax:</label>
                    <div class="row custom-input mt-2 justify-content-center">
                        <div class="col-md-12 col-lg-8">
                            <input type="phone" class="form-control fax" placeholder="Numero de Fax" name="fax[]" required>
                        </div>
                        <div class="col-md-12 col-lg-3 d-flex align-items-center justify-content-around">
                            <div class="btn btn-default add_input_fax"><i class="fa fa-plus"></i></div>
                            <div class="btn btn-default delete_input_fax"><i class="fa fa-trash-o"></i></div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="wilaya">Wilaya:</label>
                    <select class="custom-select" name="wilaya" id="wilaya">
                        <?php
                        require_once('controller.php');
                        $cf = new adresse_controller();
                        $qtf = $cf->get_wilayas();
                        foreach($qtf as $rs){
                            echo '<option>'.$rs['Nom'].'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="commune">Commune:</label>
                    <select class="custom-select" name="commune" id="commune">
                        <?php
                        require_once('controller.php');
                        $cf = new adresse_controller();
                        $qtf = $cf->get_commune('Adrar');
                        foreach($qtf as $rs){
                            echo '<option>'.$rs['Nom'].'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="adresse">Adresse:</label>
                    <input type="text" class="form-control" placeholder="Entez l'adresse" name="adresse" required>
                </div>
                <div class="form-group" id="languages_input">
                    <label for="origin-lang">Langues maitrisées:</label>
                    <div class="row custom-input mt-2 justify-content-center">
                        <div class="col-md-12 col-lg-8">
                            <select class="custom-select mastered_lang" name="langues[]">
                                <?php
                                require_once('controller.php');
                                $cf = new langues_controller();
                                $qtf = $cf->get_langues();
                                foreach($qtf as $lg){
                                    echo '<option>'.$lg['Nom'].'</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-12 col-lg-3 d-flex align-items-center justify-content-around">
                            <div class="btn btn-default add_input"><i class="fa fa-plus"></i></div>
                            <div class="btn btn-default delete_input"><i class="fa fa-trash-o"></i></div>
                        </div>
                    </div>
                </div>
                <div class="form-group" id="types_input">
                    <label for="types_traduction">Types de traduction maitrisés:</label>
                    <div class="row custom-input mt-2 justify-content-center">
                        <div class="col-md-12 col-lg-8">
                            <select class="custom-select mastered_types" name="types[]">
                                <option>Generale</option>
                                <option>Scientique</option>
                                <option>Site Web</option>
                            </select>
                        </div>
                        <div class="col-md-12 col-lg-3 d-flex align-items-center justify-content-around">
                            <div class="btn btn-default add_input_type"><i class="fa fa-plus"></i></div>
                            <div class="btn btn-default delete_input_type"><i class="fa fa-trash-o"></i></div>
                        </div>
                    </div>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="pro-traductor" id="pro-traductor">
                    <label class="custom-control-label" for="pro-traductor">Traducteur assermenté</label>
                </div>
                <div class="custom-file mt-3" style="display: none;">
                    <input type="file" class="custom-file-input" name="assermentationP" id="assermentationP">
                    <label class="custom-file-label" for="customFile">Preuve d'assermentation</label>
                </div>
                <div class="custom-file mt-3">
                    <input type="file" class="custom-file-input" name="cv" required>
                    <label class="custom-file-label" for="customFile">CV</label>
                </div>
                <div class="mt-3 row justify-content-around">
                    <div class="custom-file col-md-3 col-sm-10 mt-2">
                        <input type="file" class="custom-file-input" name="reference1">
                        <label class="custom-file-label" for="customFile">Ref1</label>
                    </div>
                    
                    <div class="custom-file col-md-3 col-sm-10 mt-2">
                        <input type="file" class="custom-file-input" name="reference2">
                        <label class="custom-file-label" for="customFile">Ref2</label>
                    </div>

                    <div class="custom-file col-md-3 col-sm-10 mt-2">
                        <input type="file" class="custom-file-input" name="reference3">
                        <label class="custom-file-label" for="customFile">Ref3</label>
                    </div>
                </div>
                <div class="col text-center">
                    <button type="submit" class="btn btn-primary mb-2 mt-5">Submit</button>
                </div>
              </form>
        

       
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
                <a class="nav-link" href="blog.html">Blog</a>
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