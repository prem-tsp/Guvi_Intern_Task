<?php
Header("Access-Control-Allow-Origin: *");
if(isset($_POST['loginSubmit'])){
    require 'dbHandler.php';

    $usermail = $_POST['LoginEmail'];
    
    if(empty($usermail))
    {
        header("Location: ../Login_SignUp_Form.html?error=emptyfields");
        exit();
    }
    else{
        $sql = "SELECT Users_email FROM users WHERE Users_email = ?;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql))
        {
            header("Location: ../Login_SignUp_Form.html?error=sqlError");
            exit();
        }
        else{
                    mysqli_stmt_bind_param($stmt,"s",$usermail);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    $checkr = mysqli_stmt_num_rows($stmt);
                    if($checkr > 0)
                    {
                        header("Location: ../UserDetailsForm.html?login=Success");
                        exit(); 
                    }
                    else{
                        header("Location: ../Login_SignUp_Form.html?error=NoUserFound");
                        exit(); 
                    }
                }
        }
    }
else{
    header("Location: ../Login_SignUp_Form.html");
    exit();
}