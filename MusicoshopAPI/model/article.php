<?php
    class Article{

        // Connection
        private $conn;

        // Table
        private $db_table = "article";

        // Columns
        public $Id_Article;
        public $qtestock;
        public $prix;
        public $note;
        public $Id_Instrument;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getArticle(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getSingleArticle(){
            $sqlQuery = "SELECT
                        *
                      FROM
                        ". $this->db_table ."
                    WHERE 
                        Id_Article = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->Id_Article);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);            

            $this->qtestock = $dataRow['qtestock'];
            $this->prix = $dataRow['prix'];
            $this->note = $dataRow['note'];
            $this->Id_Instrument = $dataRow['Id_Instrument'];
        }        
    }
    
?>

