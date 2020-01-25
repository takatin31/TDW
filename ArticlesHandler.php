<?php
require_once("controller.php");
$ac = new ArticleController();
$start = $_POST["start"];
$limit = $_POST["limit"];

$max = $ac->getNbrArticles();

if ($start >= $max){
    $start = $max - $limit;
}

$r = $ac->getArticles($start, $limit);

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