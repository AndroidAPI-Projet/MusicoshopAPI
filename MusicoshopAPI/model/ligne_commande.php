<?php
    class LigneCommande{

        // Connection
        private $conn;

        // Table
        private $db_table = "ligne_commande";

        // Columns
        public $idLigneCmd;
        public $idCmd;
        public $Id_Article;
        public $qtite;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getLigneCommande(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getSingleLigneCommande(){
            $sqlQuery = "SELECT
                        idLigneCmd, 
                        idCmd,
                        Id_Article,
                        qtite
                      FROM
                        ". $this->db_table ."
                    WHERE 
                    idLigneCmd = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->idLigneCmd);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->idCmd = $dataRow['idCmd'];
            $this->Id_Article = $dataRow['Id_Article'];
            $this->qtite = $dataRow['qtite'];
        }        
    }
    
?>

