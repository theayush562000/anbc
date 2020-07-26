<?php 

    session_start();
    require_once("../connection.php");
    if(isset($_SESSION['username']) and isset($_GET['user'])){
    	if(isset($_POST['text'])){
           //now check for empty message
    		if($_POST['text'] !=''){
             //now from here we can insert
    			//data into the database

    			$sender_name = $_SESSION['username'];
    			$reciever_name = $_GET['user'];
    			$message = $_POST['text'];
    			$date = date("Y-m-d h:i:sa");

    		$q = 'INSERT INTO  `messages` (`id`, `sender_name`, `reciever_name`, `message_text`, `date_time`)
             VALUES("", "'.$sender_name.'", "'.$reciever_name.'", "'.$message.'", "'.$date.'" )';
            $r = mysqli_query($con, $q);
            
            if($r){
            	//message sent
            	 ?>
                  <div class="grey-message">
                     <a href="#">Me</a>
                      <p><?php echo $message; ?></p>
                  </div>
                  <?php 
            } else {
            	//problem in query
            	echo $q;
            }


    		}else{
    			echo 'please write something first';
    		}


    	}else{
    		echo 'problem with text';
    	}

    }else{

    	echo 'Please login or select a user to send a message';
    }

?>
