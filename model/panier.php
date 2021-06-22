<?php
    class Panier{

        // Connection
        private $conn;

        // Table
        private $db_table = "panier";

        // Columns
        public $Id_Panier;
        public $sessId;
        public $qtite_Art;
        public $Id_Article;
        public $prixT;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getPanier(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        //single
        public function getSinglePanier(){

            $sqlQuery = "SELECT * FROM `" . $this->db_table . "` WHERE Id_Panier=? LIMIT 0,1";
                      
            $stmt = $this->conn->prepare($sqlQuery);
            
            $stmt->bindParam(1, $this->Id_Panier);

            $stmt->execute();

            $itemCount = $stmt->rowCount();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->Id_Panier = $dataRow['Id_Panier'];
            $this->sessId = $dataRow['sessId'];
            $this->qtite_Art = $dataRow['qtite_Art'];
            $this->Id_Article = $dataRow['Id_Article'];
            $this->prixT = $dataRow['prixT'];
        }
    }     

?>

