<?php
header('Access-Control-Allow-Origin: *');
if(isset($_POST['subBut']))
{
    require 'dbHandler.php';

    $uname = $_POST['userName'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $country = $_POST['country'];
    $education = $_POST['education'];
    $bio = $_POST['bio'];
    $favnum = $_POST['favNumber'];

    if(empty($uname) || empty($email) || empty($age) || empty($country) || empty($education) || empty($bio) || empty($favnum))
    {
        header("Location: ../UserDetailsForm.html?error=EmptyFields&userName=".$uname."&email=".$email."&age=".$age."&country=".$country."&education=".$education."&bio=".$bio."&favNumber=".$favnum);
        exit();
    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../UserDetailsForm.html?error=EmailIdWrong&userName=".$uname."&age=".$age."&country=".$country."&education=".$education."&bio=".$bio."&favNum=".$favnum);
    }
    else{
        $sql = "INSERT INTO details(uname,email,age,country,education,bio,favnum) VALUES (?,?,?,?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql))
        {
            header("Location: ../UserDetailsForm.html?error=sqlError");
            exit();
        }
        else{
        mysqli_stmt_bind_param($stmt,"ssissss",$uname,$email,$age,$country,$education,$bio,$favnum);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        
        $query = "SELECT * from details";
        $res = mysqli_query($conn,$query);
        $additionalArray = array();
        while($row = mysqli_fetch_array($res))
        {
            $additionalArray[] = array(
                'uname' => $row["uname"],
                'email' => $row["email"],
                'age' => $row["age"],
                'country' => $row["country"],
                'education' => $row["education"],
                'bio' => $row["bio"],
                'favnum' => $row["favnum"]
            );
        }
        $jsonfileform = json_encode($additionalArray);
        $file_name = date('d-m-y').'.json';
        
        if(file_put_contents($file_name,$jsonfileform))
        {
            echo 'File Created';
        }
        else{
            echo 'error';
        }

        header("Location: ../DetailsList.html?dataEntry=success");
        exit();
        }
    }
}
else{
    header("Location: ../UserDetailsForm.html");
    exit();
}