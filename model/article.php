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
            
            $itemCount = $stmt->rowCount();

            if($itemCount > 0){

                $this->qtestock = $dataRow['qtestock'];
                $this->prix = $dataRow['prix'];
                $this->note = $dataRow['note'];
                $this->Id_Instrument = $dataRow['Id_Instrument'];

            }else{

                $this->qtestock = "";
                $this->prix = "";
                $this->note = "";
                $this->Id_Instrument = "";
            }
        }        

        // CREATE
        public function createArticle(){
            $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        Id_Article = :Id_Article,
                        qtestock = :qtestock, 
                        prix = :prix, 
                        note = :note,
                        Id_Instrument = :Id_Instrument";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            // sanitize
            $this->Id_Article=htmlspecialchars(strip_tags($this->Id_Article));
            $this->qtestock=htmlspecialchars(strip_tags($this->qtestock));
            $this->prix=htmlspecialchars(strip_tags($this->prix));
            $this->note=htmlspecialchars(strip_tags($this->note));
            $this->Id_Instrument=htmlspecialchars(strip_tags($this->Id_Instrument));
        
            // bind data
            $stmt->bindParam(":Id_Article", $this->Id_Article);
            $stmt->bindParam(":qtestock", $this->qtestock);
            $stmt->bindParam(":prix", $this->prix);
            $stmt->bindParam(":note", $this->note);
            $stmt->bindParam(":Id_Instrument", $this->Id_Instrument);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }

        // UPDATE
        public function updateArticle(){
            $sqlQuery = "UPDATE
                        ". $this->db_table ."
                    SET
                        qtestock = :qtestock, 
                        prix = :prix, 
                        note = :note, 
                        Id_Instrument = :Id_Instrument
                    WHERE 
                        Id_Article = :Id_Article";
        
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->Id_Article=htmlspecialchars(strip_tags($this->Id_Article));
            $this->qtestock=htmlspecialchars(strip_tags($this->qtestock));
            $this->prix=htmlspecialchars(strip_tags($this->prix));
            $this->note=htmlspecialchars(strip_tags($this->note));
            $this->Id_Instrument=htmlspecialchars(strip_tags($this->Id_Instrument));
        
            // bind data
            $stmt->bindParam(":Id_Article", $this->Id_Article);
            $stmt->bindParam(":qtestock", $this->qtestock);
            $stmt->bindParam(":prix", $this->prix);
            $stmt->bindParam(":note", $this->note);
            $stmt->bindParam(":Id_Instrument", $this->Id_Instrument);
        
            if($stmt->execute()){
               return true;
            }
            return false;
        }

        // DELETE
        function deleteArticle(){
            $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE Id_Article = ?";
            $stmt = $this->conn->prepare($sqlQuery);
        
            $this->Id_Article=htmlspecialchars(strip_tags($this->Id_Article));
        
            $stmt->bindParam(1, $this->Id_Article);
        
            if($stmt->execute()){
                return true;
            }
            return false;
        }    
    }
    
?>

