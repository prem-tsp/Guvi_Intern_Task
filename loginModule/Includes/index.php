<?php
header('Access-Control-Allow-Origin: *');
    if(isset($_POST["register-but"]))
    {
        require 'dbHandler.php';

        $email = $_POST['RegisterEmail'];
        
        if(empty($email))
        {
            header("Location: ../Login_SignUp_Form.html?error=emptyfields");
            exit();
        }
        else{
            $sql = "SELECT Users_email FROM users WHERE Users_email = ?";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt,$sql))
            {
                header("Location: ../Login_SignUp_Form.html?error=sqlError");
                exit();
            }
            else{
                mysqli_stmt_bind_param($stmt,"s",$email);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                $checkr = mysqli_stmt_num_rows($stmt);

                if($checkr > 0)
                {
                    header("Location: ../Login_SignUp_Form.html?error=UserExists");
                    exit(); 
                }
                else{
                    $sql = "INSERT INTO users(Users_email) VALUES (?)";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt,$sql))
                    {
                        header("Location: ../Login_SignUp_Form.html?error=sqlError");
                        exit();
                    }
                    else{
                        mysqli_stmt_bind_param($stmt,"s",$email);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_store_result($stmt);
                        if(file_exists('users.json'))
                        {
                            $current_data = file_get_contents('users.json');
                            $arrayj = json_decode($current_data,true);
                            $extra = array(
                                "email" => $_POST['RegisterEmail']
                            );
                            $array_data[] = $extra;
                            $finalj = json_decode($array_data);
                            if(file_put_contents('users.json',$finalj))
                            {
                                $msg = "Successful";
                            } 
                        }
                        else{
                            $error = "Json does not exist";
                        }
                        header("Location: ../Login_SignUp_Form.html?signUp=success");
                        exit();
                    }
                }
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
    else{
        header("Location: ../Login_SignUp_Form.html");
            exit();
    }
