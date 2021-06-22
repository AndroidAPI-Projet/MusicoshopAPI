<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once __DIR__ .'/../../config/database.php';
    include_once __DIR__ .'/../../model/instruments.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Instrument($db);

    $stmt = $items->getInstrument();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $InstrumentArr = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $resArray = array(
                "Id_Instrument" => $Id_Instrument,
                "designation" => $designation,
                "img" => $img,
                "idCategorie" => $idCategorie
            );

            array_push($InstrumentArr, $resArray);
        }
        
        $ArrInti['Instruments'] = $InstrumentArr;

        echo json_encode($ArrInti);

    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "Aucun Instrument trouvé")
        );
    }
    
    $database->close();
?>