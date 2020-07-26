<div id="left-col-container">
		<div style="cursor: pointer;" class="white-back" onclick="document.getElementById('new-message').style.display='block'">
			<p align="center">New message</p>
		</div>


<?php

  $q='SELECT DISTINCT `reciever_name`, `sender_name`
     FROM `messages` WHERE
     `sender_name`= "'.$_SESSION['username'].'" OR 
      `reciever_name`= "'.$_SESSION['username'].'"
      ORDER BY `date_time` DESC';
  $r = mysqli_query($con, $q); 
  if($r) {
  	   if(mysqli_num_rows($r)>0){
          
          $counter = 0;
  	   	  $added_user = array();
           while($row= mysqli_fetch_assoc($r)){
           	$sender_name= $row['sender_name'];
           	$reciever_name= $row['reciever_name'];

           	if($_SESSION['username']== $sender_name) {
           		//add the reciever name but only once
           		//so to do that check the user in array
           		if(in_array($reciever_name, $added_user)) {
           			//dont add reciever_name because
           			//he is already added
           		}else {
           			//add the reciever_name
           			?>

                 <div class="grey-back">
			      <img src="images/profile.png" class="image">
			       <?php echo '<a href="?user='.$reciever_name.'">'.$reciever_name.'</a>'; ?>
		        </div>

           			<?php
           			//as reciever_name added so
           			//add it to the array as well
           			$added_user = array($counter => $reciever_name);
           			//increment the counter
           			$counter++;

           		}
           	}elseif($_SESSION['username']== $reciever_name) {
           		//add the sender_name but only once
           		//so to do that check the user in array
           		if(in_array($sender_name, $added_user)) {
           			//dont add sender_name because
           			//he is already added
           		}else {
           			//add the sender_name
           			?>

                 <div class="grey-back">
			      <img src="images/profile.png" class="image">
			       <?php echo '<a href="?user='.$sender_name.'">'.$sender_name.'</a>'; ?>
		        </div>

           			<?php
           			//as sender_name added so
           			//add it to the array as well
           			$added_user = array($counter => $sender_name);
           			//increment the counter
           			$counter++;

           		}
           	}
                 
        }
  	   }else {
  	   	//no message sent
  	   	echo 'no user';
  	   }

  }else{
  	//query problem
  	echo $q;
  }   

?>




		
<!--end of left-col-container -->
</div>