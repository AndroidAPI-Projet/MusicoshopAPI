<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once __DIR__ .'/../../config/database.php';
    include_once __DIR__ .'/../../model/commande.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Commande($db);

    $arr1 = explode("/",$_GET["_url"]);

    $item->idCmd = $arr1[2];  
    
    $item->getSingleCommande();

    if($item->idCmd != null){
        // create array
        $Commande_arr = array(
            "idCmd" => $item->idCmd,
            "numCmd" => $item->numCmd,
            "idUtilisateur" => $item->idUtilisateur,
            "dateCmd" => $item->dateCmd,
            "description" => $item->description,
            "total" => $item->total
        );
      
        http_response_code(200);
        echo json_encode($Commande_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Commande non trouvé");
    }
    
    $database->close();
?>