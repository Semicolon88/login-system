<?php
    namespace App;
   

    class User{
        public $conn;
        public function __construct($DBCon){
            $this->conn = $DBCon;
        }

        public function addUser($userData){
            $keys = implode(',',array_keys($userData));
            $values = array_values($userData);
            $sequel = "SELECT * FROM users WHERE email = ?";
            $stmt = $this->conn->prepare($sequel);
            $stmt->execute([$userData['email']]);
            if($stmt->rowCount() > 0){
                echo "email can't be used";
            }else{
                $sql = "INSERT INTO users ($keys) VALUES(?,?,?)";
                $stmt = $this->conn->prepare($sql);
                $exec = $stmt->execute([...$values]);
                if($exec){
                    echo "User Added";
                }else{
                    echo "Something went wrong";
                }
            }
        }
        public function loginUser($reqBody){
            $user = [];
            $credentials = ['email' , 'password'];
            foreach ($reqBody as $key => $value) {
                # code...
                if(in_array($key, $credentials)){
                    $user[$key] = $value;
                }

            }
            $sql = "SELECT * FROM users WHERE email=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$user['email']]);
            $res = $stmt->fetch();
            if($stmt->rowCount() > 0){
                if(password_verify($user['password'],$res['password'])){
                    echo "User logged in SUCCESSFULLY";
                }else{
                    echo "something went wrong";
                }
            }else{
                echo "email is not registered on the server";
            }
        }
    }