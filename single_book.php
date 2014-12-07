<?php 
session_start();
include_once 'require/config.php';
include $header_loc;

$current_url = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);

$isbn = '';
if (isset($_GET['ISBN'])) {
    $isbn = $_GET['ISBN'];
}
?>

<div id="book-wrapper container">
    <div class="book col-md-8 col-md-offset-2">

	<?php
    
    $customer = $_SESSION['login_user']; // current user
    // $isbn = '978-0393317558'; // current book
	$results = $mysqli->query("SELECT * FROM books WHERE ISBN='$isbn'");
    if ($results) {
        //fetch results set as object and output HTML
        while($obj = $results->fetch_object())
        {   
        ?>
        <h3><?php echo $obj->title; ?></h3>
        <h4><?php echo $obj->authors; ?></h4>
        <p>
            <span>Published by <?php echo $obj->publisher; ?></span><br>
            <span>ISBN: <?php echo $obj->ISBN; ?></span><br>
            <span>Quantity Available: <strong><?php echo $obj->copies; ?></strong></span><br>
            <span>Year: <?php echo $obj->year; ?></span><br>
            <span>Format: <?php echo $obj->format; ?></span><br>
        </p>
        
        <?php 
        if ($obj->subject) {
            echo '<p>Subject: '.$obj->subject.'</p>';
        }
        ?>
        <div class="product">
            <form method="post" action="functions/feedback_update.php" id="feedback">
                <label for="">Feedback</label><br>
                <textarea name="feedback"></textarea><br>
                <label for="">Score</label>
                <select name="score" form="feedback">
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select><br>
                <br>
                <?php if (isset($_GET['error']) && !isset($_GET['ratefail'])): ?>
                    <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        <?php echo $_GET['error']; ?>
                    </div>
                <?php endif ?>
                <input type="submit" value="Add Feedback">
                <input type="hidden" name="book_isbn" value="<?php echo $obj->ISBN ?>"/>
                <input type="hidden" name="customer" value="<?php echo $customer ?>" />
                <input type="hidden" name="type" value="add" />
                <input type="hidden" name="return_url" value="<?php echo $current_url ?>" />
            </form>
        </div>
        <?php
        }
    
    }
    ?>
	</div>

    <div class="feedback col-md-8 col-md-offset-2">
    <?php
    if (isset($_GET['limit'])) {
        $query = "SELECT * FROM feedback WHERE book='$isbn' ORDER BY usefulness DESC limit ".$_GET['limit'].";";
    } else {
        $query = "SELECT * FROM feedback WHERE book='$isbn' ORDER BY usefulness DESC";
    }

    $feedbacks = $mysqli->query($query);
    if ($feedbacks->num_rows > 0) {
        echo "<h4>Feedbacks</h4>";
    ?>
    <form action="functions/feedback_update.php" method="post">
        <label for="">Number of feedbacks: </label>
        <input type="number" name="limit">
        <input type="submit"  name="submit" value="go">
        <input type="hidden" name="type" value="limit">
        <input type="hidden" name="return_url" value="<?php echo $current_url ?>" />
    </form>
    <?php if (isset($_GET['ratefail'])): ?>
        <div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            <?php echo $_GET['ratefail']; ?>
        </div>
    <?php endif ?>
    <?php
        echo '<ul>';
        while($obj = $feedbacks->fetch_object()) {
    ?>
        <div class="panel panel-default">
            <li class="feedback panel-body">
                <p><?php echo $obj->opinion ?></p>
                <strong class="rating"><?php echo $obj->score ?></strong><br>
                by <strong><?php echo $obj->author ?></strong><br>
                <span>Rating usefulness: <?php echo $obj->usefulness ?></span>
                <form action="functions/feedback_update.php" method="post" id="rateuseful-<?php echo $obj->author;?>">
                    <span>Do you think this feedback useful</span>
                    <select name="usefulness" form="rateuseful-<?php echo $obj->author;?>">
                        <option value="0">useless</option>
                        <option value="1">useful</option>
                        <option value="2">very userful</option>
                    </select> 
                    <button class="add_usefulness">Add</button>
                    <input type="hidden" name="reviewer" value="<?php echo $customer ?>" />
                    <input type="hidden" name="book" value="<?php echo $isbn ?>" />
                    <input type="hidden" name="author" value="<?php echo $obj->author ?>" />
                    <input type="hidden" name="type" value="review" />
                    <input type="hidden" name="return_url" value="<?php echo $current_url ?>" />
                </form>
            </li>
        </div>
    <?php
        }
        echo '</ul>';
    } else {
        echo '<div class="alert alert-warning" role="alert">There is no feedback</div>';        
    }
    ?>
    </div>
</div>

<?php include $footer_loc; ?>