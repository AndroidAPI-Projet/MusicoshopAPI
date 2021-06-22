<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once __DIR__ .'/../../config/database.php';
    include_once __DIR__ .'/../../model/commande.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Commande($db);

    $stmt = $items->getCommande();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $CommandeArr = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $resArray = array(
                "idCmd" => $idCmd,
                "numCmd" => $numCmd,
                "idUtilisateur" => $idUtilisateur,
                "dateCmd" => $dateCmd,
                "description" => $description,
                "total" => $total
            );

            array_push($CommandeArr, $resArray);
        }
        
         $ArrInti['Commandes'] = $CommandeArr;

        echo json_encode($ArrInti);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "Aucune Commande trouvé")
        );
    }
    
    $database->close();
?>