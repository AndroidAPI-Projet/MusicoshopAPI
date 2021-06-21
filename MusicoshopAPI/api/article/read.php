<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once __DIR__ .'/../../config/database.php';
    include_once __DIR__ .'/../../model/article.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Article($db);

    $stmt = $items->getArticle();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $ArticleArr = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $resArray = array(
                "Id_Article" =>  $Id_Article,
                "qtestock" => $qtestock,
                "prix" => $prix,
                "note" => $note,
                "Id_Instrument" => $Id_Instrument
            );

            array_push($ArticleArr, $resArray);
        }
        echo json_encode($ArticleArr);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "Aucun article trouvé")
        );
    }

    $database->close();
?>