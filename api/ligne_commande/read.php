<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once __DIR__ .'/../../config/database.php';
    include_once __DIR__ .'/../../model/ligne_commande.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new LigneCommande($db);

    $stmt = $items->getLigneCommande();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $LigneCommandeArr = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $resArray = array(
                "idLigneCmd" => $idLigneCmd,
                "idCmd" => $idCmd,
                "Id_Article" => $Id_Article,
                "qtite" => $qtite
            );

            array_push($LigneCommandeArr, $resArray);
        }
        
        $ArrInti['LigneCommandes'] = $LigneCommandeArr;

        echo json_encode($ArrInti);

    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "Aucune LigneCommande trouvé")
        );
    }
    
    $database->close();
?>