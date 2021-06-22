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

    $arr1 = explode("/",$_GET["_url"]);
    
    $item->Id_Article = $arr1[2];
  
    $item->getSingleArticle();

    if($item->qtestock != null){
        // create array
        $article_arr = array(
            "Id_Article" =>  $item->Id_Article,
            "qtestock" => $item->qtestock,
            "prix" => $item->prix,
            "note" => $item->note,
            "Id_Instrument" => $item->Id_Instrument
        );
      
        http_response_code(200);

        $ArrInti['SingleArticle'] = $article_arr;

        echo json_encode($ArrInti);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Article non trouvé");
    }
    
    $database->close();
?>