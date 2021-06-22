<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once __DIR__ .'/../../config/database.php';
    include_once __DIR__ .'/../../model/utilisateur.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Utilisateur($db);

    $arr1 = explode("/",$_GET["_url"]);

    $item->idUtilisateur = $arr1[2];
  
    $item->getSingleUtilisateur();

    if($item->idUtilisateur != null){
        
        $utilisateur_arr = array(
            "idUtilisateur" =>  $item->idUtilisateur,
            "email" => $item->email,
            "password" => $item->password,
            "type" => $item->type,
            "userName" => $item->userName
        );
      
        http_response_code(200);
    
        $ArrInti['SingleUtilisateur'] = $utilisateur_arr;
        echo json_encode($ArrInti);

    }
      
    else{
        http_response_code(404);
        echo json_encode("Utilisateur non trouvé");
    }
?>