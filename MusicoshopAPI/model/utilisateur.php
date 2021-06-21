<?php
    class Utilisateur{

        // Connection
        private $conn;

        // Table
        private $db_table = "utilisateur";

        // Columns
        public $idUtilisateur;
        public $userName;
        public $email;
        public $type;
        public $password;
        public $valideuser;
        public $changepwd;
        public $sexe;
        public $nom;
        public $prenom;
        public $tel;
        public $adresse;
        public $ville;
        public $codePostal;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getUtilisateur(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getSingleUtilisateur(){
            $sqlQuery = "SELECT
                        idUtilisateur,
                        userName,
                        email,
                        type,
                        password,
                        valideuser,
                        changepwd,
                        sexe,
                        nom,
                        prenom,
                        tel,
                        adresse,
                        ville,
                        codePostal
                      FROM
                        ". $this->db_table ."
                    WHERE 
                        idUtilisateur = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->idUtilisateur);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->email = $dataRow['email'];
            $this->password = $dataRow['password'];
            $this->type = $dataRow['type'];
            $this->userName = $dataRow['userName'];
        }     
        
        public function loginUtilisateur() {
            $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE email = ?  AND password = ? AND Statut = true LIMIT 0,1";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->email=htmlspecialchars(strip_tags($this->email));
            $this->password=htmlspecialchars(strip_tags($this->password));

            $stmt->bindParam(1, $this->email);
            $stmt->bindParam(2, $this->password);

            $stmt->execute();
            
            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $id = $dataRow['IdUtilisateur'];

            if ($dataRow) {
                $this->idUtilisateur = $dataRow['idUtilisateur'];
                $this->userName = $dataRow['userName'];
                $this->email = $dataRow['email'];
                $this->type = $dataRow['type'];
                $this->password = $dataRow['password'];
                $this->valideuser = $dataRow['valideuser'];
                $this->changepwd = $dataRow['changepwd'];
                $this->sexe = $dataRow['sexe'];
                $this->nom = $dataRow['nom'];
                $this->prenom = $dataRow['prenom'];
                $this->tel = $dataRow['tel'];
                $this->adresse = $dataRow['adresse'];
                $this->ville = $dataRow['ville'];
                $this->codePostal = $dataRow['codePostal'];
            }

            return $id;
        }
    }
    
?>

