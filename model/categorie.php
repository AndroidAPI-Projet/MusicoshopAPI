<?php
    class Categorie{

        // Connection
        private $conn;

        // Table
        private $db_table = "categorie";

        // Columns
        public $idCategorie;
        public $libele;
        public $page;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getCategorie(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getSingleCategorie(){
            $sqlQuery = "SELECT
                        idCategorie, 
                        libele, 
                        page
                      FROM
                        ". $this->db_table ."
                    WHERE 
                        idCategorie = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->idCategorie);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);

            $itemCount = $stmt->rowCount();

            if($itemCount > 0){

                $this->libele = $dataRow['libele'];
                $this->page = $dataRow['page'];
                
            }else{

                $this->libele = "";
                $this->page = "";
            }
        }        
    }
    
?>

