<?php
include('php/database.php');
session_start();
if(isset($_POST['category']))
{
$category=$_POST['category'];
$sql = "SELECT * from $category";
    if($result=mysqli_query($conn, $sql)){ 
        /*if(mysqli_num_rows($result)>0){
            $row = mysqli_fetch_array($result);
        }
        else{
            echo "No mobiles available";
        }*/
    } else{
    echo "ERROR: Could not execute  $sql. " . mysqli_error($conn);
   }
   mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flipcart</title>
    <link rel="stylesheet" type="text/css" href="css/index.css?v=<?php echo time() ?>">
</head>
<body>
    <header>
        <ul>
            <li><h3>flipcart</h3></li>
            <li><button name="home" onclick="home()">Home</button></li>
            <li><button name="contact" onclick="contact()">Contact Us</button>
            <li><button onclick="window.location='login.html'">Login</button>
            <?php if(isset($_SESSION['id'])) {?>
            <li><form method="POST" action="php/cart.php"><button type="submit"><svg class="V3C5bO" width="14" height="14" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"><path class="_1bS9ic" d="M15.32 2.405H4.887C3 2.405 2.46.805 2.46.805L2.257.21C2.208.085 2.083 0 1.946 0H.336C.1 0-.064.24.024.46l.644 1.945L3.11 9.767c.047.137.175.23.32.23h8.418l-.493 1.958H3.768l.002.003c-.017 0-.033-.003-.05-.003-1.06 0-1.92.86-1.92 1.92s.86 1.92 1.92 1.92c.99 0 1.805-.75 1.91-1.712l5.55.076c.12.922.91 1.636 1.867 1.636 1.04 0 1.885-.844 1.885-1.885 0-.866-.584-1.593-1.38-1.814l2.423-8.832c.12-.433-.206-.86-.655-.86" fill="#fff"></path></svg>Cart</button><input hidden id="Cart" name="Cart" /></form></li>
            <?php } ?>
        </ul>
    </header>
    <div class="header">
        <form method="POST" action="index.php">
        <ul>
            <li><input type="submit" name="category" value="Mobiles"></li>
            <li><input type="submit" name="category" value="Laptops"></li>
            <li><input type="submit" name="category" value="Grocery"></li>
            <li><input type="submit" name="category" value="MenWear"></li>
            <li><input type="submit" name="category" value="FootWear"></li>
        </ul>
        </form>
    </div>
    <div class="products">
	<?php 
    if(isset($_POST['category']))
    {
        while($rows=$result->fetch_assoc())
    { $id=$rows['id']; ?>
    <div class="product">
        <div><?php echo $rows['brand'];?> <?php echo $rows['name'];?></div>
        <div class="price">Rs.<?php echo $rows['price'];?> <span class="net"><?php echo $rows['netprice'];?></span></div>
        <form method="POST" action="php/cart.php">
            <input hidden value="<?php echo $rows['id'];?>,<?php echo $category;?>" id="cart" name="cart" />
            <?php if(isset($_SESSION['id'])) {?>
            <input type="submit" value="add to cart" class="cart" />
            <?php } ?>
        </form>
    </div>
    <?php }} ?>
    </div>
    <div id="footer">@flipcart</div>
    <script>
        Cart=document.getElementById("Cart");
        Cart.value=localStorage.getItem("id");
    </script>
</body>
</html>