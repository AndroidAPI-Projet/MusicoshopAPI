<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once __DIR__ .'/../../config/database.php';
    include_once __DIR__ .'/../../model/categorie.php';

    $database = new Database();
    $db = $database->getConnection();

    $items = new Categorie($db);

    $stmt = $items->getCategorie();
    $itemCount = $stmt->rowCount();

    if($itemCount > 0){
        
        $CategorieArr = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $resArray = array(
                "idCategorie" => $idCategorie,
                "libele" => $libele,
                "page" => $page
            );

            array_push($CategorieArr, $resArray);
        }
       
         $ArrInti['Categories'] = $CategorieArr;

        echo json_encode($ArrInti);
    }

    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "Aucune Categorie trouvé")
        );
    }
    
    $database->close();
?>