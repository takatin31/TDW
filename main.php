
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="stylesheet" href="./assests/bootstrap/css/bootstrap-grid.min.css"/>
    <link rel="stylesheet" href="./assests/bootstrap/css/bootstrap-reboot.min.css"/>
    <link rel="stylesheet" href="./assests/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="./assests/light_slider/css/lightslider.css"/>
    <link rel="stylesheet" href="./assests/style/font-awesome.min.css"/>
    <link rel="stylesheet" href="./assests/style/semantic.min.css"/>
    <link rel="stylesheet" href="./assests/style/dataTables.semanticui.min.css"/>
    <link rel="stylesheet" href="./assests/style/adminDashboard.css"/>
    <link rel="stylesheet" href="home.css"/>

    <script type="text/javascript" src="./assests/scripts/jquery.min.js"></script>
    <script type="text/javascript" src="./assests/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="./assests/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assests/light_slider/js/lightslider.js"></script>
    <script type="text/javascript" src="./assests/scripts/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="./assests/scripts/dataTables.semanticui.min.js"></script>
    <script type="text/javascript" src="./assests/scripts/semantic.min.js"></script>
    <script type="text/javascript" src="assests/scripts/main.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    
    <title>DocTranslator</title>

    

    <script type="text/javascript">

        $(document).ready(function() {
            $("#lightSlider").lightSlider({
                auto:true,
                item:3,
                loop:true,
                slideMargin:1,
                enableDrag: false,
                adaptiveHeight:false,
                speed:600,
                pause:3000
            }); 

            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
        });

        function normalizeSlideHeights() {
            $('#lightSlider').each(function(){
            var items = $('li', this);
            // reset the height
            items.css('max-height', 1000);
            // set the height
            var maxHeight = Math.min.apply(null, 
                items.map(function(){
                    return $(this).outerHeight()}).get() );
            
            items.css('max-height', maxHeight + 'px');

            var images = $('li img', this);
            images.css('height', maxHeight + 'px');
            })
        }

        $(window).on(
            'load resize orientationchange', 
            normalizeSlideHeights);

    </script>

    
</head>
<body>
    <?php
        echo $_COOKIE['userid'];

    ?>
    <nav class="navbar navbar-expand-lg main-navbar">
        <a class="navbar-brand mr-5" href="#">
            <img src="./assests/images/logo2.svg" class="img-fluid"/>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <img src="assests/images/menu2.png"/>
        </button>
        <div class="collapse navbar-collapse row" id="navbarNavDropdown">
            <ul class="navbar-nav col-lg-8 col-md-6 col-sm-4">
                <li class="nav-item active">
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

    <div class="container-fluid main-container">
        
        <p class="text-center text-black title"><b>Traduisez</b> tous vos documents</p>
        <a href="#" data-toggle="modal" data-target="#modal_connexion">Connexion</a>
        <a href="#" data-toggle="modal" data-target="#modal_inscription">Inscription</a>
    
        <div class="container-fluid carousel">
            <ul id="lightSlider">
                <li>
                    <img src="./assests/images/1.jpg" class="d-block w-100"/>
                </li>
                <li>
                    <img src="./assests/images/2.JFIF" class="d-block w-100"/>
                </li>
                <li>
                    <img src="./assests/images/3.JFIF" class="d-block w-100"/>
                </li>
                <li>
                    <img src="./assests/images/4.JFIF" class="d-block w-100"/>
                </li>
                <li>
                    <img src="./assests/images/5.JFIF" class="d-block w-100"/>
                </li>
                <li>
                    <img src="./assests/images/6.JFIF" class="d-block w-100"/>
                </li>
                <li>
                    <img src="./assests/images/7.JFIF" class="d-block w-100"/>
                </li>
                <li>
                    <img src="./assests/images/8.JFIF" class="d-block w-100"/>
                </li>
            </ul>
        </div>
    
        <div class="container-fluid row mt-5 align-items-center">
            <div class="col-7">
                <div class="card card-container pt-3 pr-4 pl-2">
                    <div class="d-flex align-items-center">
                        <div class="col-6">
                            <img class="card-img-top" src="./assests/images/2.jpg" alt="Card image cap"/>
                        </div>
                        <p class="card-title text-center">Article 1: Venez voir nos travaux</p>
                    </div>
                    
                    <div class="card-body">
                      <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                          Maecenas in neque at urna ullamcorper dictum ut ut ex. Curabitur et aliquet nulla, nec porta libero. 
                          Nullam eget imperdiet lorem, quis condimentum tellus. Sed gravida risus orci. 
                          Sed ultrices sagittis ex, a vehicula .</p>
                    </div>
                    <div class="text-right mb-2">
                        <a class="card-link" href="#" data-toggle="modal" data-target="#modal_tab">Lire la suite</a>
                    </div>
                </div>
                <hr/>
                <div class="card card-container pt-3 pr-4 pl-2">
                    <div class="d-flex flex-row-reverse align-items-center">
                        <div class="col-6">
                            <img class="card-img-top" src="./assests/images/3.png" alt="Card image cap"/>
                        </div>
                        <p class="card-title text-center">Article2:<br/> Ne rattez pas l'occasion!!</p>
                    </div>
                    <div class="card-body">
                      <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                          Maecenas in neque at urna ullamcorper dictum ut ut ex. Curabitur et aliquet nulla, nec porta libero. 
                          Nullam eget imperdiet lorem, quis condimentum tellus. Sed gravida risus orci. 
                          Sed ultrices sagittis ex, a vehicula .</p>
                    </div>
                    <div class="text-right mb-2">
                        <a class="card-link" href="#" data-toggle="modal" data-target="#modal_tab">Lire la suite</a>
                    </div>
                </div>
                <hr/>
                <div class="card card-container pt-3 pr-4 pl-2">
                    <div class=" d-flex align-items-center">
                        <div class="col-6">
                            <img class="card-img-top" src="./assests/images/2.jpg" alt="Card image cap"/>
                        </div>
                        <p class="card-title text-center">Article 3: Venez voir nos traductions</p>
                    </div>
                    <div class="card-body">
                      <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                          Maecenas in neque at urna ullamcorper dictum ut ut ex. Curabitur et aliquet nulla, nec porta libero. 
                          Nullam eget imperdiet lorem, quis condimentum tellus. Sed gravida risus orci. 
                          Sed ultrices sagittis ex, a vehicula .</p>
                    </div>
                    <div class="text-right mb-2">
                        <a class="card-link" href="#" data-toggle="modal" data-target="#modal_tab">Lire la suite</a>
                    </div>
                </div>
            </div>

            <div class="col-5 div-form">
                <h2 class="text-center mt-3">Demande de devis de traduction</h2>
                <hr/>
                <form method="POST" id="demandeForm">
                    <div class="form-group">
                      <label for="nom">Nom :</label>
                      <input type="text" class="form-control" placeholder="Entrez Nom" name="nom" id="nomD">
                    </div>
                    <div class="form-group">
                      <label for="prenom">Prenom:</label>
                      <input type="text" class="form-control" placeholder="Entez prenom" name="prenom" id="prenomD">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" placeholder="Entez Email" name="email" id="emailD">
                    </div>
                    <div class="form-group">
                        <label for="numero de telephone">Numero de telephone:</label>
                        <input type="phone" class="form-control" placeholder="Numero de telephone" name="phone" id="phoneD">
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
                        <input type="text" class="form-control" placeholder="Entez l'adresse" name="adresse" id="adresseD" >
                    </div>
                    <div class="form-group">
                        <label for="origin-lang">Langue d'origine:</label>
                        <select class="custom-select" name="origin-lang" id="originL">
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
                    <div class="form-group">
                        <label for="desired-lang">Langue souhaitée:</label>
                        <select class="custom-select" name="desired-lang" id="DestinationL">
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
                    <div class="form-group">
                        <label for="traduction-type">Type de traduction:</label>
                        <select class="custom-select" name="traduction-type" id="typeD">
                          <option>Generale</option>
                          <option>Scientique</option>
                          <option>Site Web</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="comment">Comment:</label>
                        <textarea class="form-control" rows="5" name="comment" id="commentD"></textarea>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="pro-traductor" id="pro-traductorD">
                        <label class="custom-control-label" for="pro-traductorD">Traducteur assermenté</label>
                    </div>
                    <div class="custom-file mt-3" >
                        <form enctype="multipart/form-data" id="formdata">
                        <input type="file" class="custom-file-input" name="customFile" id="fileD">
                        </form>
                        <label class="custom-file-label" for="customFile">Importer le fichier</label>
                    </div>
                    <div class="form-group mt-3" enctype="multipart/form-data">
                        <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI" data-callback="verifyRecaptchaCallback" data-expired-callback="expiredRecaptchaCallback"></div>
                        <input class="form-control d-none" data-recaptcha="true"  data-error="Please complete the Captcha">
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="col text-center">
                        <button type="button" class="btn btn-primary mb-2" id="submit" data-toggle="modal" data-target="#modal_complete_info">Submit</button>
                    </div>
                  </form>
            </div>
        </div>
        <hr/>
        <div class="container-fluid row mt-5">
            <div class="col-4 ">
                <div class="card card-container mb-2">
                    <img class="card-img-top" src="./assests/images/4.jpg" alt="Card image cap"/>
                    <div class="card-body">
                      <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                          Maecenas in neque at urna ullamcorper dictum ut ut ex. Curabitur et aliquet nulla, nec porta libero. 
                          Nullam eget imperdiet lorem, quis condimentum tellus. Sed gravida risus orci. 
                          Sed ultrices sagittis ex, a vehicula .
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                          Maecenas in neque at urna ullamcorper dictum ut ut ex. Curabitur et aliquet nulla, nec porta libero. 
                          Nullam eget imperdiet lorem, quis condimentum tellus. Sed gravida risus orci. 
                          Sed ultrices sagittis ex, a vehicula .</p>
                    </div>
                    <div class="text-right mb-2 mr-2">
                        <a class="card-link" href="#" data-toggle="modal" data-target="#modal_tab">Lire la suite</a>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card card-container mb-2">
                    <img class="card-img-top" src="./assests/images/5.jpg" alt="Card image cap"/>
                    <div class="card-body">
                      <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                          Maecenas in neque at urna ullamcorper dictum ut ut ex. Curabitur et aliquet nulla, nec porta libero. 
                          Nullam eget imperdiet lorem, quis condimentum tellus. Sed gravida risus orci. 
                          Sed ultrices sagittis ex, a vehicula .
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                          Maecenas in neque at urna ullamcorper dictum ut ut ex. Curabitur et aliquet nulla, nec porta libero. 
                          Nullam eget imperdiet lorem, quis condimentum tellus. Sed gravida risus orci. 
                          Sed ultrices sagittis ex, a vehicula .</p>
                    </div>
                    <div class="text-right mb-2 mr-2">
                        <a class="card-link" href="#" data-toggle="modal" data-target="#modal_tab">Lire la suite</a>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card card-container mb-2">
                    <img class="card-img-top" src="./assests/images/6.jpg" alt="Card image cap"/>
                    <div class="card-body">
                      <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                          Maecenas in neque at urna ullamcorper dictum ut ut ex. Curabitur et aliquet nulla, nec porta libero. 
                          Nullam eget imperdiet lorem, quis condimentum tellus. Sed gravida risus orci. 
                          Sed ultrices sagittis ex, a vehicula .
                          Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                          Maecenas in neque at urna ullamcorper dictum ut ut ex. Curabitur et aliquet nulla, nec porta libero. 
                          Nullam eget imperdiet lorem, quis condimentum tellus. Sed gravida risus orci. 
                          Sed ultrices sagittis ex, a vehicula .</p>
                    </div>
                    <div class="text-right mb-2 mr-2">
                        <a class="card-link" href="#" data-toggle="modal" data-target="#modal_tab">Lire la suite</a>
                    </div>
                </div>
            </div>
        </div> 
    </div>

    <div class="modal fade" id="modal_tab" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modal_title">Article</h5>
              <button type="button" id="modal_close" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="modal_connexion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modal_title">Connexion</h5>
              <button type="button" id="modal_close" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <div class="modal-body">
                <form action="connexionHandler.php" method="POST">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" placeholder="Entez Email" name="email" >
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe:</label>
                        <input type="password" class="form-control" placeholder="Entez Password" name="password" >
                    </div>
                    <div class="col text-center">
                        <button type="submit" class="btn btn-primary mb-2 mt-5">Submit</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="modal_inscription" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modal_title">Inscription</h5>
              <button type="button" id="modal_close" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <div class="modal-body">
                <form action="inscriptionHandler.php" method="POST">
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
                          <select class="custom-select" name="wilaya" id="wilaya2">
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
                          <select class="custom-select" name="commune" id="commune2">
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
                      <div class="col text-center">
                        <button type="submit" class="btn btn-primary mb-2 mt-5">Submit</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
    </div>

    <div class="modal fade" id="modal_complete_info" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-demande modal-lg modal-dialog-centered" role="document">
          <div class="modal-content modal-content-demande">
            <div class="modal-header">
              <h5 class="modal-title" id="modal_title">Completer les informations</h5>
              <button type="button" id="modal_close" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <div class="modal-body demande-info">
                <div class="form-group">
                    <label for="traduction-type">Type de demande:</label>
                    <select class="custom-select" name="demande-type">
                        <option>Traduction</option>
                        <option>Devis</option>
                    </select>
                </div>
                <div class="col-md-12" class="height:80%">
                <label for="traduction-type">Choix du traducteur:</label>         
                <table id="example" class="ui celled table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Photo</th>
                            <th>Nom</th>
                            <th>Nombre de traudctions</th>
                            <th>Note</th>
                            <th>Choisi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="vertical-align: middle;">
                                <img src="./assests/images/personal.jpg" width="60px"/>
                            </td>
                            <td style="vertical-align: middle;">System Architect</td>
                            <td>Edinburgh</td>
                            <td>61</td>
                            <td>
                                <input type="checkbox">
                            </td>
                        </tr>
                        
                    </tbody>             
                </table>
                </div>
                <button class="btn btn-primary float-right mr-5 mt-3" id="validerDemande">Valider</button>
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
            <div class="nav-item col-lg-2 col-md-3 col-sm-3 d-none d-lg-block" >
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