<?php
	require_once 'dbconnect.php';
	error_reporting(0);
		
//adding
	if (isset($_POST['btn_add']) ) {
		
		// clean user inputs to prevent sql injections
		$cashDetail = $_POST['cashDetail'];
		$cashDebit = $_POST['cashDebit'];
		$cashCredit = $_POST['cashCredit'];
		

		$sql_add = "INSERT INTO cashpayment(curDate,cashDetail,cashCredit,cashDebit) VALUES(CURDATE(),'$cashDetail','$cashCredit','$cashDebit')";
		
		if (mysqli_query($dbhandle, $sql_add)) {
				echo "Added"; header("Refresh:0"); 
				
			} 
			else {echo "Adding Fail". mysqli_error($dbhandle);}
		
	}
	
	
//updating		
		
	if ( isset($_POST['btn_update']) ) 
	{	
		$cashId = $_POST['cashId'];		
		$cashDetail = $_POST['cashDetail'];
		$cashDebit = $_POST['cashDebit'];
		$cashCredit = $_POST['cashCredit'];
		
	
			$sql = "UPDATE cashpayment SET cashId= '".$cashId."',cashCredit= '".$cashCredit."',cashDebit= '".$cashDebit."',cashDetail= '".$cashDetail."' WHERE cashId = '".$cashId."' ";

	
				
			if (mysqli_query($dbhandle, $sql)) {
	
			echo "Updated"; header("Refresh:0"); 
				
			} 
			else {echo "Updation Fail". mysqli_error($dbhandle);}
		
		
	}
	
	//deleting payment
		
if (isset($_POST['btn_del'])) {	
    $cashId = $_POST['cashId'];
	// Delete the payment record
        $sqldel = "DELETE FROM cashpayment WHERE cashId = '".$cashId."'";
        if (mysqli_query($dbhandle, $sqldel)) {
            echo "Deleted"; 
		header("Refresh:0");}
}

	
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	
     <title>Accounts Management</title>

     <!-- Bootstrap CSS CDN--> 
	
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

  <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


</head>

<body>
<div style="margin:20px;">
    <div class="wrapper">
          <!-- Page Content Holder -->
        <div id="content" class="row">
		<div class="col-md-12">
		
            <div><br></div>
<!--form-->

<div class="container">
	<div class="row bhoechie-tab-container">
            
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab">
               
                <!-- payment update -->
		<table style="margin-top:20px;" width="100%"><tr><td><h5 style="color:black;font-weight:bold;">Accounts Management</h5></td>
		<td><button id="editBtn" style="color:white;background-color:black;" class="btn btn-block">Edit</button></td><td><button id="downloadBtn" style="color:white;background-color:black;" class="btn btn-block" onclick="downloadTables()">Download</button></td></tr></table>
		<hr>
                <div class="bhoechie-tab-content active">
<table class="cc" width="100%" border="1" id="tableOne" style="display: table;">
    <thead>
        <tr>
            <th>Date</th>
            <th>Details</th>
            <th>Debit</th>
            <th>Credit</th>
            <th>Balance</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query_rec = "SELECT 
            cashId, 
            curDate, 
            cashCredit, 
            cashDebit, 
            cashDetail
        FROM 
            cashpayment 
        ORDER BY 
            cashId";

        if ($result_rec = mysqli_query($dbhandle, $query_rec)) {
            $balance = 0; // Initialize balance variable
            $rowNum = 1; // Initialize row counter for numbering

            // Check if records were returned
            if (mysqli_num_rows($result_rec) > 0) {
                while($row_rec = mysqli_fetch_assoc($result_rec)) {
                    $cashId = $row_rec['cashId'];
                    $curDate_org = $row_rec['curDate'];
                    $curDate = date("d-M-Y", strtotime($curDate_org));
                    $cashDetail = $row_rec['cashDetail'];
                    $cashCredit = $row_rec['cashCredit'];
                    $cashDebit = $row_rec['cashDebit'];

                    // Update balance
                    $balance += $cashCredit - $cashDebit;

                    if ($cashId == "") {
                        echo "<tr><td colspan='8' style='text-align:center;'>No records found</td></tr>";
                    } else {
        ?>
                        <tr>
                          
                            <td><?php echo $curDate; ?></td>
                            <td><?php echo $cashDetail; ?></td>
                            <td><?php echo $cashDebit; ?></td>
                            <td><?php echo $cashCredit; ?></td>
                            <td><?php echo number_format($balance, 2); ?></td>
                        </tr>
        <?php
                    }
                }
            } else {
                echo "<tr><td colspan='8' style='text-align:center;'>No records found</td></tr>";
            }
        } else {
            echo "Error: " . mysqli_error($dbhandle);
        }
        ?>
    </tbody>
</table>


                         <table class="cc" width="100%" border="1" id="tableTwo" style="display: none;">		
				 
						
						 <tr> <th>Date</th> <th>Details</th> <th>Debit</th> <th>Credit</th> <th>Balance</th> </tr>
<?php


 $query_rec = "SELECT 
        cashId, 
        curDate, 
        cashCredit, 
        cashDebit, 
        cashDetail
    FROM 
        cashpayment 
    ORDER BY 
        cashId";
if ($result_rec = mysqli_query($dbhandle, $query_rec)) {
    $balance = 0; // Initialize balance variable

    // Check if records were returned
    if (mysqli_num_rows($result_rec) > 0) {
        while($row_rec = mysqli_fetch_assoc($result_rec)) {
            $cashId = $row_rec['cashId'];
            $curDate_org = $row_rec['curDate'];
            $curDate = date("d-M-Y", strtotime($curDate_org));
            $cashDetail = $row_rec['cashDetail'];
            $cashCredit = $row_rec['cashCredit'];
            $cashDebit = $row_rec['cashDebit'];
			
            // Update balance
            $balance += $cashCredit - $cashDebit;

            if ($cashId == "") {
                echo "<tr><td colspan='7' style='text-align:center;'>No records found</td></tr>";
            } else {
?>							 

						<form method="post" action="" autocomplete="on" enctype="multipart/form-data">
						<tr>
						<input hidden type="text" id="cashId" name="cashId" class="form-control" value="<?php echo $cashId;?>">	
						 <td><?php echo $curDate;?></td>
						 <td><input type="text" id="cashDetail" name="cashDetail" class="form-control" style="border:none;" value="<?php echo $cashDetail;?>"></td>
						 <td><input type="number" id="cashDebit" name="cashDebit" class="form-control" style="border:none;" step="0.01" value="<?php echo $cashDebit;?>"></td>
						 <td><input type="number" id="cashCredit" name="cashCredit" class="form-control" style="border:none;" step="0.01" value="<?php echo $cashCredit;?>"></td>
						 <td><?php echo number_format($cashBalance, 2); ?></td>
						 <td><input style="font-weight: bold; color:black;background-color:white;" name="btn_update" type="submit" value="Update" class="btn btn-block"> 
						 <input style="font-weight: bold; color:black;background-color:white;" name="btn_del" type="submit" value="Delete" class="btn btn-block"> 						
						 </tr>
						 </form>
						
<?php	
}}}}

?>
 </table> 
				
				
				
					<!-- payment Add -->
					<hr>
					<form method="post" action="" autocomplete="on" enctype="multipart/form-data" style="padding-bottom:20px;">
					<h5 style="padding-top:20px;color:black;">Add New Record</h5>
						 <table border="1" class="cc" width="100%" id="scroll">						 
						
						 <tr> <th>Details</th> <th>Debit</th> <th>Credit</th> </tr>
						 <tr>
						
						 <td><input type="text" id="cashDetail" name="cashDetail" class="form-control"></td>
						 <td><input type="number" id="cashDebit" name="cashDebit" class="form-control" step="0.01"></td>
						 <td><input type="number" id="cashCredit" name="cashCredit" class="form-control" step="0.01"></td>
						 <input hidden type="number" id="cashBalance" name="cashBalance" class="form-control">
						 <td><input style='font-weight: bold; background-color:white;' name="btn_add" type="submit" value="Add" class="btn btn-block"></td>
						 </table>
					</form>	
                </div>
    </div>
  </div>
  </div>
</div>
         
<!--form end-->


        </div>
    </div>
</div>
</div>

			<!--download-->
			<table hidden id="dwnld" width="100%"><tr><td colspan="7"><h5 style="color:black;font-weight:bold;">Accounts Management</h5></td></tr>
		<hr>
				 <tr><td colspan="7"></td></tr>
			
						
						 <tr> <th>Date</th> <th>Details</th> <th>Debit</th> <th>Credit</th> <th>Balance</th> </tr>
<?php


 $query_rec  = "SELECT 
        cashId, 
        curDate, 
        cashCredit, 
        cashDebit, 
        cashDetail
    FROM 
        cashpayment 
    ORDER BY 
        cashId";
if ($result_rec = mysqli_query($dbhandle, $query_rec)) {
    $balance = 0; // Initialize balance variable

    // Check if records were returned
    if (mysqli_num_rows($result_rec) > 0) {
        while($row_rec = mysqli_fetch_assoc($result_rec)) {
            $cashId = $row_rec['cashId'];
            $curDate_org = $row_rec['curDate'];
            $curDate = date("d-M-Y", strtotime($curDate_org));
            $cashDetail = $row_rec['cashDetail'];
            $cashCredit = $row_rec['cashCredit'];
            $cashDebit = $row_rec['cashDebit'];
			
            // Update balance
            $balance += $cashCredit - $cashDebit;
?>						 

						 <tr>						
						 <td><?php echo $curDate;?></td>
						 <td><?php echo $cashDetail;?></td>
						 <td><?php echo $cashDebit;?></td>
						 <td><?php echo $cashCredit;?></td>
						 <td><?php echo number_format($balance, 2); ?></td>
						 </tr>
						
<?php	
            }
        }
	}
?>
 </table> 
 
 <!--download ends-->
         </div>
    </div>
</div>
</div>
</div>

<script type="text/javascript">
  
 $("#editBtn").click(function() {
        // Use jQuery toggle() to hide one table and show the other
        $("#tableOne").toggle(1000); // Toggle visibility with 1 second duration
        $("#tableTwo").toggle(1000); // Toggle visibility with 1 second duration
    });

// Download whole page
function downloadTables() {
    var wb = XLSX.utils.book_new(); // Create a new workbook

    // Table 1 (Check if the table exists and is not null)
    var tableOne = document.getElementById('dwnld');
    if (tableOne) {
        try {
            var ws1 = XLSX.utils.table_to_sheet(tableOne); // Convert table to sheet

            // Adjust column width for better display
            ws1['!cols'] = [{wch: 20}, {wch: 50}, {wch: 20}, {wch: 20}, {wch: 20}, {wch: 50}, {wch: 20}]; // Adjust width for columns

            // Format specific columns to accept fractional numbers (adjust indexes based on your table structure)
            var fractionColumns = [2, 3, 4]; // Assuming 3rd, 4th, and 5th columns are cashDebit, cashCredit, cashBalance

            fractionColumns.forEach(function(colIndex) {
                // Loop through each row in the column
                for (var rowIndex = 1; rowIndex <= tableOne.rows.length; rowIndex++) { // Start from 1 to skip header
                    var cellAddress = XLSX.utils.encode_cell({c: colIndex, r: rowIndex}); // Get cell address
                    var cell = ws1[cellAddress];

                    if (cell) {
                        // Set the number format for the cell to allow decimals
                        cell.z = '0.00'; // Format as decimal with 2 places
                    }
                }
            });

            XLSX.utils.book_append_sheet(wb, ws1, 'Cash-Acc'); // Add to workbook
        } catch (error) {
            console.error("Error converting Table to sheet: ", error);
        }
    } else {
        console.error("Table not found");
    }

    // Download the Excel file
    XLSX.writeFile(wb, "cash.xlsx");
}

// Scroll to the element with id "scroll" when the page loads
        window.onload = function () {
            const element = document.getElementById('scroll');
            if (element) {
                element.scrollIntoView({ behavior: 'smooth' });
            }
        };
</script>
</body>

</html>