<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once __DIR__ .'/../../config/database.php';
    include_once __DIR__ .'/../../model/panier.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Panier($db);

    $arr1 = explode("/",$_GET["_url"]);

    $item->Id_Panier = $arr1[2];
  
    $item->getSinglePanier();

    if($item->Id_Panier != null){
        // create array
        $Panier_arr = array(
            "Id_Panier" => $item->Id_Panier,
            "sessId" => $item->sessId,
            "qtite_Art" => $item->qtite_Art,
            "Id_Article" => $item->Id_Article,
            "prixT" => $item->prixT
        );
      
        http_response_code(200);
        echo json_encode($Panier_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Panier non trouvé");
    }
    
    $database->close();
?>