<?php
    class Instrument{

        // Connection
        private $conn;

        // Table
        private $db_table = "instruments";

        // Columns
        public $Id_Instrument;
        public $designation;
        public $img;
        public $idCategorie;

        // Db connection
        public function __construct($db){
            $this->conn = $db;
        }

        // GET ALL
        public function getInstrument(){
            $sqlQuery = "SELECT * FROM " . $this->db_table . "";
            $stmt = $this->conn->prepare($sqlQuery);
            $stmt->execute();
            return $stmt;
        }

        public function getSingleInstrument(){
            $sqlQuery = "SELECT
                        Id_Instrument, 
                        designation, 
                        img, 
                        idCategorie
                      FROM
                        ". $this->db_table ."
                    WHERE 
                        Id_Instrument = ?
                    LIMIT 0,1";

            $stmt = $this->conn->prepare($sqlQuery);

            $stmt->bindParam(1, $this->Id_Instrument);

            $stmt->execute();

            $dataRow = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $this->designation = $dataRow['designation'];
            $this->img = $dataRow['img'];
            $this->idCategorie = $dataRow['idCategorie'];
        }        
    }
    
?>

