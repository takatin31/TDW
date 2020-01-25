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
    <link rel="stylesheet" href="./assests/style/blog.css"/>

    <script type="text/javascript" src="./assests/scripts/jquery.min.js"></script>
    <script type="text/javascript" src="./assests/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="./assests/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assests/scripts/blog.js"></script>
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
                <li class="nav-item active">
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

    <div class="container-fluid text-center page blog-post-list">
        <div class="clean-block clean-blog-list">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">Blog</h2>
                    <h4>Vous trouverez ici tous les archives des articles les plus importants.</h4>
                    <input type="hidden" value="0"></input>
                </div>
                <div class="block-content">
                    <?php
                        require_once("controller.php");
                        $ac = new ArticleController();
                        $r = $ac->getArticles(0, 3);
                        foreach($r as $lg){
                            echo ' <div class="clean-blog-post">
                                    <div class="row">
                                        <div class="col-lg-5"><img class="rounded img-fluid" src="uploads/Articles/'.$lg["Image"].'"></div>
                                        <div class="col-lg-7">
                                            <h3>'.$lg["Titre"].'</h3>
                                            <div class="info"><span class="text-muted">'.$lg["Date"].' by&nbsp;<a href="#">'.$lg["auteur"].'</a></span></div>
                                            <p class="body-article">'.$lg["body"].'</p>
                                            <button class="btn btn-outline-primary btn-sm" type="button">Read More</button>
                                        </div>
                                    </div>
                                </div>
                                <hr/>';
                        }
                    ?>
                    
                </div>
            </div>
        </div>
    </div>

    <ul class="pagination justify-content-center">
        <li class="page-item"><a class="page-link" id="prev" href="#">Previous</a></li>
        <li class="page-item"><a class="page-link" id="next" href="#">Next</a></li>
      </ul>

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