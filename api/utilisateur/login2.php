<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    include_once __DIR__ .'/../../config/database.php';
    include_once __DIR__ .'/../../model/utilisateur.php';

    $database = new Database();
    $db = $database->getConnection();

    $item = new Utilisateur($db);

    @$email=$_GET["email"];
	@$password=$_GET["password"];

    if(isset($email) && isset($password) ){
   
        $item->email = $email;
        $item->password = $password;

    }else{

        $item->email = "";
        $item->password = "";
    }

    $conexionArr = array();
    
    if($item->loginUtilisateur() != ""){
        http_response_code(200);

        $utilisateur_arr = array(
            "idUtilisateur" => $item->idUtilisateur,
            "userName" => $item->userName,
            "email" => $item->email,
            "type" => $item->type ,
            "password" => $item->password,
            "valideuser" => $item->valideuser,
            "changepwd" => $item->changepwd,
            "sexe" => $item->sexe,
            "nom" => $item->nom,
            "prenom" => $item->prenom,
            "tel" => $item->tel,
            "adresse" => $item->adresse,
            "ville" => $item->ville,
            "codePostal" => $item->codePostal
        );
      
        http_response_code(200);
    
        $ArrInti['UserLogged'] = $utilisateur_arr;
        echo json_encode($ArrInti);


    } else{
        http_response_code(200);
        ///echo json_encode("Mot de passe ou login erroné");
        $resArray = array("conexion" => "Mot de passe ou login erroné");

        array_push($conexionArr, $resArray);

        $ArrInti['UserLogged'] = $conexionArr;
        
        echo json_encode($ArrInti);
    }
?>