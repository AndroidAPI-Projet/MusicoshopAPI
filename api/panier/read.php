<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once __DIR__ .'/../../config/database.php';
    include_once __DIR__ .'/../../model/panier.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Panier($db);

    $stmt = $items->getPanier();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $PanierArr = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $resArray = array(
                "Id_Panier" => $Id_Panier,
                "sessId" => $sessId,
                "qtite_Art" => $qtite_Art,
                "Id_Article" => $Id_Article,
                "prixT" => $prixT
            );

            array_push($PanierArr, $resArray);
        }
        
        $ArrInti['Paniers'] = $PanierArr;

        echo json_encode($ArrInti);

    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "Aucun Panier trouvé")
        );
    }
    
    $database->close();
?>