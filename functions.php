<?php


    class Trails {

        public function getTrails($params=[]){
        
            if ($params['limit'] && intval($params['limit']) > 0){                                 
                $limitSql = " LIMIT " . intval($params['limit']);   
                                            
            } 

            else{
                $limitSql = "";
            }


            include('connection.php');                                   
            $sql = "SELECT * FROM trasee ".$limitSql."";  
            $traseuId=array_key_exists('id',$_SESSION) ? $_SESSION['id'] : ""  ;                                                            
            $result = $conn->query($sql);                                            
            $conn->close();                            
            return $result;                                                           
        }




        public function getTrail($params=""){  

            $traseuId = intval($params['traseuId']);
                          
            if (!$traseuId){
                return false;
            }

            include('connection.php'); 
            $sql ="SELECT t.*, (SELECT r.id FROM  rezultate AS r  WHERE r.traseuID = t.id AND r.inchis = 0  ORDER BY r.id DESC LIMIT 1) AS existaStartPeTraseu FROM trasee AS t
                   WHERE  t.id='".$traseuId."' LIMIT 1";
            $result = $conn->query($sql);  
            $conn->close();
            return $result;   

        }

    }



    class User {

        public $nume     = "";
        public $sex      = ""; 
        public $fumator  = "";
        public $nivel    = "";
        public $varsta   = ""; 
        public $greutate = "";
        public $email    = "";
        public $telefon  = "";
        public $parola   = "";      
        public $parola2  = "";
        public $result   = null;


        public function __construct(){

            $this->nume     = array_key_exists("nume", $_REQUEST) ? $_REQUEST['nume'] :"";
            $this->prenume  = array_key_exists("prenume", $_REQUEST) ? $_REQUEST['prenume'] :"";
            $this->sex      = array_key_exists("sex", $_REQUEST) ? $_REQUEST['sex'] : ""; 
            $this->fumator  = array_key_exists("fumator", $_REQUEST) ? $_REQUEST['fumator'] : "";
            $this->nivel    = array_key_exists("nivel", $_REQUEST) ? $_REQUEST['nivel'] : "";
            $this->varsta   = array_key_exists("varsta", $_REQUEST) ? $_REQUEST['varsta'] : "";
            $this->greutate = array_key_exists("greutate", $_REQUEST) ? $_REQUEST['greutate'] : "";
            $this->email    = array_key_exists("email", $_REQUEST) ? $_REQUEST['email'] : "";
            $this->telefon  = array_key_exists("telefon", $_REQUEST) ? $_REQUEST['telefon'] : "";
            $this->parola   = array_key_exists("parola", $_REQUEST) ? $_REQUEST['parola'] : "";    
            $this->parola2  = array_key_exists("parola2", $_REQUEST) ? $_REQUEST['parola2'] : "";
            $this->result   = ["success"=>false, "url"=>""];

        }


        private function getUserByEmail($email){ 

            include("connection.php");
            $sql = "SELECT email FROM users WHERE email = '".$email."'";      
            $res = $conn->query($sql);       
            return mysqli_fetch_assoc($res);

        }


        public function addUser() {

            include ("connection.php");
            $userTmp = $this->getUserByEmail($this->email);     

            if ($userTmp){
                echo "<script>alert('Exista deja un utilizator inregistrat cu acest email')</script>";
                return false;  
            }

            if ($this->parola != $this->parola2){
                echo "<script>alert('Parolele nu coincid!')</script>";
                return $this->result;  
            }



            if ($this->nume && $this->prenume && $this->sex && $this->varsta && $this->greutate && $this->nivel && $this->email && $this->telefon && $this->parola){ 

                $nume     = mysqli_real_escape_string($conn, strip_tags($this->nume));
                $prenume  = mysqli_real_escape_string($conn, strip_tags($this->prenume));
                $sex      = mysqli_real_escape_string($conn, strip_tags($this->sex));
                $varsta   = intval($this->varsta);
                $greutate = floatval($this->greutate);
                $fumator  = intval($this->fumator);
                $nivel    = intval($this->nivel);
                $email    = mysqli_real_escape_string($conn, strip_tags($this->email));
                $telefon  = mysqli_real_escape_string($conn, strip_tags($this->telefon));
                $parola   = mysqli_real_escape_string($conn, strip_tags($this->parola));
                    
                $sql = "INSERT INTO users SET 
                        nume    = '$nume', 
                        prenume = '$prenume',                  
                        sex     = '$sex', 
                        varsta  = '$varsta', 
                        greutate= '$greutate',  
                        fumator = '$fumator', 
                        nivel   = '$nivel', 
                        email   = '$email', 
                        telefon = '$telefon',
                        parola  = MD5('$parola') ";  

                $res = $conn->query($sql);  

                if (!$res){
                    die('Error: ' . mysqli_error());
                }

               
                $this->result['success'] = true;          
                $this->result['url'] = 'http://localhost/drumetii/index.php';   
                echo"<script> alert('Userul a fost inregistrat cu succes') </script>";

            }

            else{
                echo "Nu ai completat toate câmpurile! ";  
                return $this->result; 
            }

            $this->userLogin($this->email);
            return $this->result;

        }


        public function userLogin(){

            include("connection.php");

            if ( !$this->email || !$this->parola){
                    echo "Nu ai completat toate campurile!";
                    return $this->result;             
            }

            if ($this->email && $this->parola){   
            
                $email  = mysqli_real_escape_string($conn, strip_tags($this->email));
                $parola = mysqli_real_escape_string($conn, strip_tags($this->parola));

                $sql = "SELECT * FROM users WHERE email ='".$email."'AND parola=MD5('".$parola."')";  
                $result = $conn->query($sql);
                
                
                if ($result->num_rows > 0) {

                     while($row = $result->fetch_assoc()){
                        $_SESSION['userID'] = $row['id'];
                    }

                    $this->result['success'] = true;          
                    $this->result['url'] = 'http://localhost/drumetii/'; 

                } 

                else{
                echo "<script>alert('Email sau parola incorecta')</script>";
                }
            
                return $this->result;

            }

        }

    }


    ?>
