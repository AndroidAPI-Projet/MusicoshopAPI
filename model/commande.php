<?php
    class Commande{

        // Connection
        private $conn;

        // Table
        private $db_table = "commande";

        // Columns
        public $idCmd;
        public $numCmd;
        public $idUtilisateur;
        public $dateCmd;
        public $description;
        public $total;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getCommande(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getSingleCommande(){
            $sqlQuery = "SELECT
                        idCmd, 
                        numCmd, 
                        idUtilisateur,
                        dateCmd,
                        description,
                        total
                      FROM
                        ". $this->db_table ."
                    WHERE 
                        idCmd = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->idCmd);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $itemCount = $stmt->rowCount();

            if($itemCount > 0){

                $this->numCmd = $dataRow['numCmd'];
                $this->idUtilisateur = $dataRow['idUtilisateur'];
                $this->dateCmd = $dataRow['dateCmd'];
                $this->description = $dataRow['description'];
                $this->total = $dataRow['total'];

            }else{

                $this->numCmd = "";
                $this->idUtilisateur = "";
                $this->dateCmd = "";
                $this->description = "";
                $this->total = "";
            }
        }        
    }
    
?>

