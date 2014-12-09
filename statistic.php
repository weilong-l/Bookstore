<?php 
session_start();
include_once 'require/config.php';
include $header_loc;

$current_url = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
?>
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
<h3>
	MONTHLY STATISTICS

</h3>

<!--- (11) STATISTICS  -->


<form action="statistic.php" method="POST">

<div class="form-group">
    <label>Top</label>
    <input type="number" name="m" class="form-control" placeholder="">
</div>
<div class="form-group">
    <label>From:</label>
    <input type="text" id="from" name="from_date" class="form-control" placeholder="">
</div>
<div class="form-group">
    <label>To:</label>
    <input type="text" id="to" name="to_date" class="form-control" placeholder="">
</div>
<div class="form-group">
    <label>Type of statistics:</label>
    <select name="type_of_statistics">
      <option value="most_popular_books">Most Popular Books</option>
      <option value="most_popular_authors">Most Popular Authors</option>
      <option value="most_popular_publishers">Most Popular Publishers</option>
    </select>
</div>

<input type="hidden" name="statistics">
<input class="btn btn-default" type="submit" value="Get Statistics">
</form>

<?php 
if (isset($_POST['statistics'])) {
	$m = $_REQUEST['m'];
	$from_date = $_REQUEST['from_date'];
	$to_date = $_REQUEST['to_date'];
	$type_of_statistics = $_REQUEST['type_of_statistics'];

	// Creating SQL queries: UPDATE
	if ($type_of_statistics == "most_popular_books"){
		$header_str =  sprintf("These are the top %d popular books", $m);
		$sql = sprintf(
			"SELECT book, sum(copy) FROM orders
			WHERE date >= '%s' and date< '%s'
			group by book
			order by sum(copy) desc
			limit $m"
			, $from_date, $to_date);
		
	}
	elseif ($type_of_statistics == "most_popular_authors"){
		$header_str = sprintf("These are the top %d popular authors", $m);
		$sql = sprintf(
			"SELECT authors, sum(copy) from books, orders 
			where books.ISBN = orders.book
			and orders.date >= '%s' and orders.date<'%s'
			group by authors
			order by sum(copy) DESC
			limit $m"
			, $from_date, $to_date);
		
	}
	elseif($type_of_statistics == "most_popular_publishers"){
		$header_str =  sprintf("These are the top %d popular publishers", $m);
		$sql = sprintf(
			"SELECT publisher, sum(copy) from books, orders 
			where books.ISBN = orders.book
			and orders.date >= '%s' and orders.date<'%s'
			group by publisher
			order by sum(copy) desc
			limit $m"
			, $from_date, $to_date);
	}

	$result = mysqli_query($mysqli, $sql); //result is an object type
	
	// Populating data into table
	if (mysqli_num_rows($result) > 0) {
		echo '<div class="panel panel-default">';
 
  		echo '<div class="panel-heading">'.$header_str.'</div>';

		echo '<table class="table">'; //create table

		if ($type_of_statistics == "most_popular_books"){
			echo '<tr> <th> ISBN </th><th> Total copies sold </th> </tr>'; // create header for table
		    // output data of each row
		    while($row = mysqli_fetch_assoc($result)) {
		    	// In the event of NULL
		    	if ( is_null($row["book"]) ){ 
		    		$row["book"]="NULL";
		    	}
		    	// Enter data into table
		    	echo '	<tr> 	
		    				<td>'. $row["book"]. '</td>
         					<td>'. $row["sum(copy)"]. '</td>
         				</tr>'; 
		    	
		    }
		}

		elseif ($type_of_statistics == "most_popular_authors"){
			echo '<tr> <th> Author </th><th> Total copies sold </th> </tr>'; // create header for table
			// output data of each row
		    while($row = mysqli_fetch_assoc($result)) {
		    	// In the event of NULL
		    	if ( is_null($row["authors"]) ){ 
		    		$row["authors"]="NULL";
		    	}
		    	// Enter data into table
				echo '	<tr> 	
		    				<td>'. $row["authors"]. '</td>
         					<td>'. $row["sum(copy)"]. '</td>
         				</tr>'; 
		        
		    }
		}

		elseif ($type_of_statistics == "most_popular_publishers"){
			echo '<tr> <th> Publisher </th><th> Total copies sold </th> </tr>'; // create header for table
			// output data of each row
		    while($row = mysqli_fetch_assoc($result)) {
		    	// In the event of NULL
		    	if ( is_null($row["publisher"]) ){ 
		    		$row["publisher"]="NULL";
		    	}
		    	// Enter data into table
				echo '	<tr> 	
		    				<td>'. $row["publisher"]. '</td>
         					<td>'. $row["sum(copy)"]. '</td>
         				</tr>'; 
         	}
		}
		echo '</tr></table>';
	} else {
	    echo "0 results";
	}
}
 ?>
 </div>
 		</div>
 	</div>
 </div>

<?php include $footer_loc; ?>