<?php
    session_start();
    if (!isset($_SESSION['id'])) {
        header('location:loginnew.php');
        exit();
    }

// including the database connection file
include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php');
if(isset($_POST['update']))
{   
    $id = mysqli_real_escape_string($dbConnection, $_POST['ID']);
    $ProductName = mysqli_real_escape_string($dbConnection, $_POST['ProductName']);
    $CompanyName = mysqli_real_escape_string($dbConnection, $_POST['CompanyName']);
    $CureFor = mysqli_real_escape_string($dbConnection, $_POST['CureFor']);
    $Price = mysqli_real_escape_string($dbConnection, $_POST['Price']); 
    $OtcFlag = mysqli_real_escape_string($dbConnection, $_POST['OtcFlag']); 
    $ExpiryDate = mysqli_real_escape_string($dbConnection, $_POST['ExpiryDate']); 
    $quantity = mysqli_real_escape_string($dbConnection, $_POST['quantity']);
    $FeaturedFlag = mysqli_real_escape_string($dbConnection, $_POST['FeaturedFlag']);
	

    // checking empty fields
    if(empty($ProductName) || empty($CompanyName) || empty($CureFor) || empty($Price) || empty($OtcFlag) || empty($ExpiryDate) || empty($quantity) || empty($FeaturedFlag)) {    
            
        if(empty($ProductName)) {
            echo "<font color='red'>Product name field is empty!</font><br/>";
        }
        
        if(empty($CompanyName)) {
            echo "<font color='red'>Company Name field is empty!</font><br/>";
        }

        if(empty($CureFor)) {
            echo "<font color='red'>Cure for field is empty!</font><br/>";
        }
        
        if(empty($Price)) {
            echo "<font color='red'>Product price field is empty!</font><br/>";
        }    

        if(empty($OtcFlag)) {
            echo "<font color='red'>Over the counter is empty!</font><br/>";
        }  

        if(empty($ExpiryDate)) {
            echo "<font color='red'>Expiry date field is empty!</font><br/>";
        }  

        if(empty($quantity)) {
            echo "<font color='red'>Quantity in stock field is empty!</font><br/>";
        }

		if(empty($FeaturedFlag)) {
            echo "<font color='red'>Product featured flag field is empty!</font><br/>";
        }
       
    } else {    
        //updating the table
        $query = "UPDATE products SET ProductName='$ProductName',CompanyName='$CompanyName',CureFor='$CureFor',Price='$Price',OtcFlag='$OtcFlag',
                ExpiryDate='$ExpiryDate',NumberInStock='$quantity',Featured_Flag='$FeaturedFlag' WHERE ID=$id";
        $result = mysqli_query($dbConnection,$query);
        
        if($result){
            //redirecting to the display page. In our case, it is index.php
        header("Location: inventory.php");
        }
        
    }
}
?>






<?php
//getting id from url
$ID=isset($_GET['ID']) ? $_GET['ID'] : die('ERROR: Record ID not found.');
//selecting data associated with this particular id
$result = mysqli_query($dbConnection, "SELECT * FROM products WHERE ID=$ID");
while($res = mysqli_fetch_array($result))
{	
    $CompanyName = $res['CompanyName'];
    $ProductName = $res['ProductName'];
    $CureFor = $res['CureFor'];
    $Price = $res['Price'];
    $OtcFlag = $res['OtcFlag'];
    $ExpiryDate = $res['ExpiryDate'];
    $quantity = $res['NumberInStock'];
    $FeaturedFlag = $res['Featured_Flag'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link href="https://fonts.googleapis.com/css?family=Gentium+Book+Basic&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="app new2.css">

    <title>Med-Anytime</title>

</head>

<body class="index-page sidebar-collapse">
<div class="wrapper">
<br>
        <div class="main">
            <div class="section section-basic">
                <div class="container">
                      <h2>Product Information</h2>
                      <br>
                      <a href='inventory.php' class='btn btn-success btn-round'>Back to Index</a>
                <br>
                <div class="col-md-12">

    <div class="panel panel-success panel-size-custom">
  <div class="panel-heading"><h3>Update Product</h3></div>
  <div class="panel-body">
    <form action="product_update.php" method="post">
        <div class="form group">
            <input type="hidden" class="form-control" id="ID" name="ID" value=<?php echo $_GET['ID'];?>>
            <label>Company Name:</label>
            <input type="text" class="form-control" id="CompanyName" name="CompanyName" value="<?php echo $CompanyName;?>">
            <label>Product Name:</label>
            <input type="text" class="form-control" id="ProductName" name="ProductName" value="<?php echo $ProductName;?>">
            <label>Cure For:</label>
            <input type="text" class="form-control" id="CureFor" name="CureFor" value="<?php echo $CureFor;?>">
            <label>Price :</label>
            <input type="text" class="form-control" id="Price" name="Price" value="<?php echo $Price;?>">
            <label>Over the Counter or Not:</label>
            <input type="text" class="form-control" id="OtcFlag" name="OtcFlag" value="<?php echo $OtcFlag;?>">
			<label>Featured Product or Not:</label>
            <input type="text" class="form-control" id="FeaturedFlag" name="FeaturedFlag" value="<?php echo $FeaturedFlag;?>">
			<label>Expiry Date:</label>
            <input type="text" class="form-control" id="ExpiryDate" name="ExpiryDate" value="<?php echo $ExpiryDate;?>">
			<label>Quantity in stock:</label>
            <input type="text" class="form-control" id="quantity" name="quantity" value="<?php echo $quantity;?>">
                </div>            
             </div>
            </div>
            <br>
            <div class="form group">
                <button type="submit" class="btn btn-success btn-round" id="submit" name="update">
                    <i class="now-ui-icons ui-1_check"></i> Update Product
                </button>
            </div>
    </form>
  </div>
</div>
</div>
    </div>
</body>

</html>