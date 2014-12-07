<?php
session_start();
include_once '../require/config.php';

// Filter number of feedback
if(isset($_POST["type"]) && $_POST["type"]=='limit') {
	$return_url = base64_decode($_POST["return_url"]);
	$limit = filter_var($_POST["limit"], FILTER_SANITIZE_NUMBER_INT);
	header('location: '.$return_url.'&limit='.$limit);
}

//add new feedback to a book
if(isset($_POST["type"]) && $_POST["type"]=='add')
{
	$book_isbn 	= filter_var($_POST["book_isbn"], FILTER_SANITIZE_STRING); //product code
	$score 		= filter_var($_POST["score"], FILTER_SANITIZE_NUMBER_INT); //product code
	$customer 	= filter_var($_POST["customer"], FILTER_SANITIZE_STRING);
	$opinion 	= filter_var($_POST["feedback"], FILTER_SANITIZE_STRING);
	$return_url = base64_decode($_POST["return_url"]); //return url

	// Add new feedback
    $query = "INSERT INTO feedback (author, opinion, book, score) VALUES (?, ?, ?, ?)";
	$stmt = $mysqli->prepare($query);
	$stmt->bind_param("sssi", $customer, $opinion, $book_isbn, $score);
    if ($stmt->execute() === True) {
    	header('Location:'.$return_url);
    } else {
    	header('Location:'.$return_url.'&error=You have already added feed back');
    }
	//redirect back to original page
}
// review feedback
if(isset($_POST["type"]) && $_POST["type"]=='review') {
	$reviewer 	= filter_var($_POST["reviewer"], FILTER_SANITIZE_STRING);
	$book 		= filter_var($_POST["book"], FILTER_SANITIZE_STRING);
	$author 	= filter_var($_POST["author"], FILTER_SANITIZE_STRING);
	$usefulness = filter_var($_POST["usefulness"], FILTER_SANITIZE_NUMBER_INT);
	$return_url = base64_decode($_POST["return_url"]); //return url

	// Add feedback usefulness if author != reviewer
	if (strcmp($author, $reviewer) !== 0) {
		$query = "INSERT INTO usefulness (author, book, reviewer, usefulness) VALUES (?, ?, ?, ?)";
		$stmt = $mysqli->prepare($query);
		$stmt->bind_param("sssi", $author, $book, $reviewer, $usefulness);
	    if ($stmt->execute() === True) {
	    	// printf("Feedback inserted successfully.\n");

	    	// Update feedback usefulness
			$query2 = "UPDATE feedback SET usefulness = (SELECT AVG(usefulness) FROM usefulness GROUP BY book, author HAVING feedback.book = ? AND author = ?)
		    	WHERE feedback.book = ? AND author = ?";
		    $stmt = $mysqli->prepare($query2);
		    $stmt->bind_param("ssss", $book, $author, $book, $author);
		    if ($stmt->execute() === True) {
		    	// printf("Feedback updated successfully.\n");
		    	header('Location:'.$return_url);
		    } else {
		    	printf($stmt->error);
		    }
	    } else {
	    	// Duplicate result
	    	header('Location:'.$return_url.'&ratefail=You have rated this feedback');
	    }
	} else {
		header('Location:'.$return_url.'&ratefail=You can not rate your own feedback');
	}
}

?>