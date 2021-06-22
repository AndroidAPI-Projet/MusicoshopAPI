<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once __DIR__ .'/../../config/database.php';
    include_once __DIR__ .'/../../model/article.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Article($db);

    $data = json_decode(file_get_contents("php://input"));

    $item->Id_Article = $data->Id_Article;
    $item->qtestock = $data->qtestock;
    $item->prix = $data->prix;
    $item->note = $data->note;
    $item->Id_Instrument = $data->Id_Instrument;
    
    if($item->createArticle()){
        echo "L'article a été créé avec succès";
    } else{
        echo "L'article n'a pas pu être créé";
    }
?>