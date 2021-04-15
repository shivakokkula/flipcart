<?php
require('database.php');
if($_POST['submit']=='LOGIN')
{
    $email=$_POST['email'];
    $password=$_POST['password'];
    $sql = "SELECT user_password,id from user where user_email='$email' or mobile='$email' ";
    if($result=mysqli_query($conn, $sql)){ 
        if(mysqli_num_rows($result)>0){
            $row = mysqli_fetch_array($result);
            if($row["user_password"]==$password){
                session_start();
                $_SESSION['id']=$row['id'];
                header('location:../index.php?id='.$row['id']);
            }
            else{
                header('location:../login.html?error');
            }
        }
        else{
            header('location:../login.html?error');
        }
    } else{
    echo "ERROR: Could not execute  $sql. " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
else
{
    $name=$_POST['name'];
    $email=$_POST['email'];
    $mobile=$_POST['mobile'];
    $password=$_POST['password'];
    $sql = "SELECT count(*) from user";
    $con=mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($con);
    $id=$row[0]+1;
    $sql = "INSERT INTO user(id,user_name,user_email,mobile,user_password) VALUES ($id,'$name','$email','$mobile','$password')";
    if(mysqli_query($conn, $sql)){
        $sqll = "CREATE TABLE cart_$id(id int(20) NOT NULL,category varchar(50) NOT NULL);";
        if(mysqli_query($conn, $sqll)){
            $sqlll = "CREATE TABLE order_$id(id int(20) NOT NULL,category varchar(50) NOT NULL);";
            if(mysqli_query($conn, $sqlll)){
                header('location:../login.html');
            }
            else{
                echo "ERROR: Could not execute $sqlll. " . mysqli_error($conn);
            }
        }
        else{
            echo "ERROR: Could not execute $sqll. " . mysqli_error($conn);
        }
    } 
    else{
    echo "ERROR: Could not execute insert $sql. " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>
