<?php
if(isset($_POST['logout']))
{
    header("Location: ../Login_SignUp_Form.html?logout=Success");
    exit();
}