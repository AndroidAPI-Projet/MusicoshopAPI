<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    include_once __DIR__ .'/../../config/database.php';
    include_once __DIR__ .'/../../model/instruments.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Instrument($db);

    $arr1 = explode("/",$_GET["_url"]);

    $item->Id_Instrument = $arr1[2];
  
    $item->getSingleInstrument();

    if($item->Id_Instrument != null){
        // create array
        $Instrument_arr = array(
            "Id_Instrument" => $item->Id_Instrument,
            "designation" => $item->designation,
            "img" => $item->img,
            "idCategorie" => $item->idCategorie
        );
      
        http_response_code(200);
        echo json_encode($Instrument_arr);
    }
      
    else{
        http_response_code(404);
        echo json_encode("Instrument non trouvé");
    }
    
    $database->close();
?>