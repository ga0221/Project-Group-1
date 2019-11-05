//checking the doctor details

<?php
    session_start();
    
    if (!isset($_SESSION['id'])) {
        header('location:loginnew.php');
        exit();
    }
	
//function to check the details of doctor which are entered by the user
	class CheckDocDetails{
		
		public function CheckDoc(){
				
				include('C:/xampp/htdocs/SwEngg/Config/dbConnection.php');
				if (isset($_POST['submit'])) { 
				//Fetching all the values to be checked in the doctor's table
				$dName = $_POST['dName'];
				$dNPINum = $_POST['dNPINum'];
				$dEmailId = $_POST['dEmailId'];
				$prescription = $_POST["prescription"];
				$UserId = $_SESSION['id'];
				// checking empty fields
				if (empty($dName) || empty($dNPINum) || empty($prescription) || empty($dEmailId) || empty($UserId)) {
					
					if (empty($dName)) {
						$_SESSION['msg'] = "Address Saved!";
						$_SESSION['msg1'] = "Doctor's Name field is empty!";
					}
					
					if (empty($dNPINum)) {
						$_SESSION['msg'] = "Address Saved!";
						$_SESSION['msg1'] = "Doctor's NPI number field is empty!";
					}
					
					if (empty($dEmailId)) {
						$_SESSION['msg'] = "Address Saved!";
						$_SESSION['msg1'] = "Doctor's Email ID field is empty!";
					}
					
					//For testing purpose
					//return 1;
				} 
				
				else {
					//echo "check 3--$streetAddress--$county--$shipCity--$shipState--$zipCode--$UserId";
					$chkquery = "SELECT * FROM docdetails where NPINum = '$dNPINum' AND emaiID = '$dEmailId'";
					$chkResult = mysqli_query($dbConnection, $chkquery);
					if ((mysqli_num_rows($chkResult) <= 0)){
						$_SESSION['msg'] = "Address Saved!";
						$_SESSION['msg1'] = "The given doctor is not registered with us. Please provide the details of a registered doctor with valid NPI number and corresponding EmailID.";
						//For testing purpose
						//return 2;
						header("Location: checkForOtc.php", true, 301);
					}
					else{
						$updtResult = mysqli_query($dbConnection, "UPDATE `order details` SET docEmailId='$dEmailId' , docNPInum='$dNPINum' WHERE UserID='$UserId' AND OrderStatus='Cart' AND OtcFlag='N'");
						if($updtResult){
							//For testing purpose
							//return 3;
							header("Location: OrderPlaced.php");
							exit();
						}
					}
				}
				}
			}
			
		}
		
		$obj = new CheckDocDetails;
		$obj->CheckDoc();
		
		
	
	
?>

