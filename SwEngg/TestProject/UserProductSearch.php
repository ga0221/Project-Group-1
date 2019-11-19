<!-- This is a php code to retrieve list of products for the user when they try to search for products using the search bar in their home page. --> 
<?php
    session_start();
    
    if (!isset($_SESSION['id'])) {
        header('location:loginnew.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Gentium+Book+Basic&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="app new2.css">
    <title>Med-Anytime</title>
</head>

<body class="index-page sidebar-collapse">
    <nav  class="navbar navbar-dark navbar-expand-md pt-0 pb-0 fixed-top">
      <a href="userpage2.php" class="navbar-brand">Med-AnyTime</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navmenu" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
	  <!-- navbar-->
	  <div class="collapse navbar-collapse" id="navmenu">
    <ul class="navbar-nav mr-auto">
     
      <li class="nav-item">
      <form method="POST" action="UserProductSearch.php" class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-3" type="search" placeholder="Search" name="search" id="navBarSearchForm" aria-label="Search">
      <button class="btn btn-success my-2 my-sm-0" type="submit" name = "SearchButton" id="SearchButton">Search</button>
      </form>
      </li>
	 
	   <li class="nav-item">
        <a class="nav-link" href="UserProducts.php">Products</a>
      </li>
	    <li class="nav-item">
        <a class="nav-link" href="CartDetails.php">Cart</a>
      </li>
	  <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <i class="now-ui-icons users_circle-08"></i>
                            <?php
							     //Fetching the user details to display on the navbar
                                 include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php');
                                 $query=mysqli_query($dbConnection,"SELECT * FROM `userdetails` WHERE UserID='".$_SESSION['id']."'");
                                 $row=mysqli_fetch_assoc($query);
                                 echo ''.$row['FirstName'].'';
                            ?>
                        </a>
		<div class="dropdown-menu"  aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="Order_details_User.php">View Orders</a>
          <a class="dropdown-item" href="#">View Profile Information</a>
         <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
       </li>
    </ul>
  </div>
  </nav>    
  <!-- End Navbar -->
  <div class="image">
</div>
    <div class="wrapper">
        
        <br>
        <div class="main">
            <div class="section section-basic">
                <div class="container">
                    <br>
					 <h5><strong>Search Results for <?php echo $_POST['search'];?></strong></h5>
                    <br><hr color="orange">
					<div class ="col-md-12"></div>
                    <div class="tab-pane  active" id="">
                        <ul class="thumbnails">
                            <?php
                            if (isset($_POST['search'])){
                                                            
                            $search=$_POST['search'];
                     /* sql query to retrieve products from the databse */         $query="SELECT * FROM products WHERE ProductName LIKE '%$search%' OR CompanyName LIKE '%$search%' OR CureFor LIKE '%$search%'";
                            $result = mysqli_query($dbConnection,$query);
                            while($res=mysqli_fetch_array($result)){
                                $productID=$res['ID'];
                            ?> 

                            <div class="row-sm-4">
                                <div class="thumbnail">
                                    <img src="/SwEngg/upload/<?php echo $res['productImage']; ?>" width="300px" height="200px">
                                <div class="caption">
                                  <h5><b><?php echo $res['ProductName'];?></b></h5>
                                  <h6><a class="btn btn-success btn-round" title="Click for more details!" href="userProductDetails.php?ID=<?php echo $res['ID'];?>"><i class="now-ui-icons gestures_tap-01"></i>View</a><span style = "float: right;"><?php echo $res['Price']; ?></h6>
                                </div>

                                </div>
								<hr color="orange">
                              </div>
                                     
                                <?php }?> 
                            <?php }?> 

                        </ul>
                    </div>
		</div>
    </div>     
</div>
</div>
</body>
</html>
<!-- this is the end of this code-->
