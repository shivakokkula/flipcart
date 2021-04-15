<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../css/index.css?v=<?php echo time() ?>">
    <style>
        table{
            margin:5%;
            margin-left: auto;
            margin-right: auto;
            padding:1px;
            font-size: 18px;
            background-color: rgb(231, 220, 71);
            border-collapse:collapse;          
        }
        tr,td,th{
            padding:10px;
        }
        span{
            text-decoration:line-through;
        }
        body{
            text-align:center;
        }
        input{
            font-size: 20px;
        }
        table input{
            font-size: 16px;
        }
    </style>
    </head>
<body>
<header>
        <ul>
            <li><h3>flipcart</h3></li>
            <li><button name="home" onclick="window.location='../index.php'">Home</button></li>
            <li><button name="contact" onclick="contact()">Contact Us</button>
        </ul>
</header>
<script>
    function order(total)
    {
        alert("Order is placed successfully with amount Rs. "+total);
        window.location="../index.php";
    }
    </script>
</body>
</html>
<?php
include('database.php');
session_start();
$id=$_SESSION["id"];
if(isset($_POST['remove']))
{
    $arr=$_POST['remove'];
    $arr=explode(',',$arr);
    $sql = "delete from cart_$id where id=$arr[0] and category='$arr[1]'";
    if($result=mysqli_query($conn, $sql)){
        echo "<script>alert('Item deleted successfully')</script>";
    }
    else{
    echo "ERROR: Could not execute $sql. " . mysqli_error($conn);
    }

    $sql = "select * from cart_$id";
    echo '<table border='.'2'.'><tr><th>Product</th><th>Price</th><th>Remove</th>';
    if($result=mysqli_query($conn, $sql)){
        $total=0;
        while($rows=$result->fetch_assoc()){
            // $row=explode('-',$rows['id']);
            // echo $rows['id'];
            $id=$rows['id'];
            $category=$rows['category'];
            $sql = "select * from $category where id=$id";
            if($results=mysqli_query($conn, $sql)){
                $row = mysqli_fetch_array($results);
                $price=$row['price'];
                echo '<tr><td>'.$row['brand'].' '.$row['name'].'</td><td>Rs. '.$price.' <span>'.$row['netprice'].'</span></td><td><form action="cart.php" method="POST" ><button type="submit">Remove<input hidden name="remove" value="'.$row['id'],','.$category.'"/></button></form></td></tr>' ;
                $total=$total+$price;
            }
        }
    echo'<tr><td>Total</td><td colspan="2" >Rs. '.$total.'</td></tr><table><br/>'/*<form action="cart.php"><input type="submit" name="order" value="Place Order"></form>'*/;
    echo '<input type="submit" onclick="order('.$total.')" name="order" value="Place Order">';
} else{
    echo "ERROR: Could not execute insert $sql. " . mysqli_error($conn);
    }
    mysqli_close($conn);
}

if(isset($_POST['cart']))
{
    $arr=$_POST['cart'];
    $arr=explode(',',$arr);
    // $arrr="$arr[1] $arr[0]";
    if(isset($_SESSION["id"]))
    {
    $z=0;
    $sql = "select * from cart_$id";
    if($result=mysqli_query($conn, $sql)){
        while($rows=$result->fetch_assoc()){
            if($rows['id']==$arr[0] && $rows['category']==$arr[1])
                $z=1;
        }
    }
    if(!$z)
    {
    $sql = "INSERT INTO cart_$id(id,category) VALUES ($arr[0],'$arr[1]')";
    // $sql = "INSERT INTO cart_$id(id) VALUES ($arrr)";
    if(mysqli_query($conn, $sql)){
    } else{
    echo "ERROR: Could not execute insert $sql. " . mysqli_error($conn);
    }
    }
    $sql = "select * from cart_$id";
    echo '<table border='.'2'.'><tr><th>Product</th><th>Price</th><th>Remove</th>';
    if($result=mysqli_query($conn, $sql)){
        $total=0;
        while($rows=$result->fetch_assoc()){
            // $row=explode('-',$rows['id']);
            // echo $rows['id'];
            $id=$rows['id'];
            $category=$rows['category'];
            $sql = "select * from $category where id=$id";
            if($results=mysqli_query($conn, $sql)){
                $row = mysqli_fetch_array($results);
                $price=$row['price'];
                echo '<tr><td>'.$row['brand'].' '.$row['name'].'</td><td>Rs. '.$price.' <span>'.$row['netprice'].'</span></td><td><form action="cart.php" method="POST" ><input type="submit" value="Remove"/><input hidden name="remove" value="'.$row['id'],','.$category.'"/></form></td></tr>' ;
                $total=$total+$price;
            }
        }
    echo'<tr><td>Total</td><td colspan="2" >Rs. '.$total.'</td></tr><table><br/>'/*<form action="cart.php"><input type="submit" name="order" value="Place Order"></form>'*/;
    echo '<input type="submit" onclick="order('.$total.')" name="order" value="Place Order">';
    } else{
    echo "ERROR: Could not execute insert $sql. " . mysqli_error($conn);
    }
    mysqli_close($conn);
    }
}
if(isset($_POST['Cart']))
{
    $sql = "select * from cart_$id";
    echo '<table border='.'2'.'><tr><th>Product</th><th>Price</th><th>Remove</th>';
    if($result=mysqli_query($conn, $sql)){
        $total=0;
        while($rows=$result->fetch_assoc()){
            // $row=explode('-',$rows['id']);
            // echo $rows['id'];
            $id=$rows['id'];
            $category=$rows['category'];
            $sql = "select * from $category where id=$id";
            if($results=mysqli_query($conn, $sql)){
                $row = mysqli_fetch_array($results);
                $price=$row['price'];
                echo '<tr><td>'.$row['brand'].' '.$row['name'].'</td><td>Rs. '.$price.' <span>'.$row['netprice'].'</span></td><td><form action="cart.php" method="POST" ><button type="submit">Remove<input hidden name="remove" value="'.$row['id'],','.$category.'"/></button></form></td></tr>' ;
                $total=$total+$price;
            }
        }
    echo'<tr><td>Total</td><td colspan="2" >Rs. '.$total.'</td></tr><table><br/>'/*<form action="cart.php"><input type="submit" name="order" value="Place Order"></form>'*/;
    echo '<input type="submit" onclick="order('.$total.')" name="order" value="Place Order">';
} else{
    echo "ERROR: Could not execute insert $sql. " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>