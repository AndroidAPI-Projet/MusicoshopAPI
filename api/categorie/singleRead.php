<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once __DIR__ .'/../../config/database.php';
    include_once __DIR__ .'/../../model/categorie.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Categorie($db);

    $arr1 = explode("/",$_GET["_url"]);

    $item->idCategorie = $arr1[2];
  
    $item->getSingleCategorie();

    if($item->idCategorie != null){
        // create array
        $Categorie_arr = array(
            "idCategorie" =>  $item->idCategorie,
            "libele" => $item->libele,
            "page" => $item->page
        );
      
        http_response_code(200);
        
        $ArrInti['SingleCategorie'] = $Categorie_arr;

        echo json_encode($ArrInti);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Categorie non trouvé");
    }
    
    $database->close();
?>