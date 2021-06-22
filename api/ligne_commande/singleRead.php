<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once __DIR__ .'/../../config/database.php';
    include_once __DIR__ .'/../../model/ligne_commande.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new LigneCommande($db);

    $arr1 = explode("/",$_GET["_url"]);

    $item->idLigneCmd = $arr1[2];

    error_log("item->idLigneCmd".$item->idLigneCmd);
  
    $item->getSingleLigneCommande();

    if($item->idCmd != null){
        // create array
        $LigneCommande_arr = array(
            "idLigneCmd" => $item->idLigneCmd,
            "idCmd" => $item->idCmd,
            "Id_Article" => $item->Id_Article,
            "qtite" => $item->qtite
        );
      
        http_response_code(200);
        
        $ArrInti['SingleLigneCommande'] = $LigneCommande_arr;

        echo json_encode($ArrInti);

    }
      
    else{
        http_response_code(404);
        echo json_encode("LigneCommande non trouvé");
    }
    
    $database->close();
?>