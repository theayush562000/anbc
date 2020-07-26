<div id="right-col-container">
 <div id="messages-container">


      <?php

        $no_message = false;
       if(isset($_GET['user'])) {
           $_GET['user'] = $_GET['user'];

       }else{
            //user variable is not in the url bar
            //so select the last user, you have sent message
            $q='SELECT `sender_name`, `reciever_name` FROM `messages`
               WHERE `sender_name` = "'.$_SESSION['username'].'"
               or `reciever_name` = "'.$_SESSION['username'].'" 
               ORDER BY `date_time` DESC LIMIT 1';

            $r = mysqli_query($con, $q);
            if($r){
               if(mysqli_num_rows($r)>0){
                  while ($row =mysqli_fetch_assoc($r)) {
                        $sender_name = $row['sender_name'];
                        $reciever_name = $row['reciever_name'];

                  if($_SESSION['username'] == $sender_name){
                        $_GET['user'] = $reciever_name;
                  }else {
                        $_GET['user'] = $sender_name;
                  }

                  }
               }else{
                  //this user have not send any message
                  echo 'no messages from you';
                  $no_message = true;
               }
            }else {
                  //query problem
                  $q;
            }  
       }
       


       if($no_message == false){

       $q='SELECT * FROM `messages` WHERE
          `sender_name`= "'.$_SESSION['username'].'"
           AND `reciever_name` = "'.$_GET['user'].'"
           OR 
           `sender_name`= "'.$_GET['user'].'"
           And `reciever_name`= "'.$_SESSION['username'].'" ';
      $r= mysqli_query($con, $q);

      if ($r) {
            //query successful
            while($row = mysqli_fetch_assoc($r)) {
                  $sender_name = $row['sender_name'];
                  $reciever_name = $row['reciever_name'];
                  $message = $row['message_text'];

                  //check who is the sender of the message
                  if($sender_name == $_SESSION['username']) {
                        //show the message with grey back
                        ?>
                  <div class="grey-message">
                     <a href="#">Me</a>
                      <p><?php echo $message; ?></p>
                  </div>
                  <?php 
                  }else {
                        //show the message with white back

                        ?>
                  <div class="white-message">
                     <a href="#"><?php echo $sender_name; ?></a>
                     <p><?php echo $message; ?></p>
                  </div>

                        <?php
                  }
            }
      }else {
            //query problem
            echo $q;

      }

    //end of no_message
}

       ?>
	<!--end of messages container -->
	</div>
      <form method="post" id="message-form"></form>
	      <textarea class="textarea" placeholder="write your message" id="message_text"></textarea>

		<!--end of right-col-container -->
	</div>


      <script type="text/javascript" src="sub_file/jquery-3.5.1.min.js"></script>
      <script type="text/javascript">
            
            $("document").ready(function(event){
              
              //now if the form is submitted
              
              $("#right-col-container").on('submit', '#message-form' fuction(){
                //take the data from textarea
                var message_text = $("#message_text").val();
                //send the data to sending_process.php file
                $.post("sub_file/sending_process.php?user=<?php echo $_GET['user'];?>",
                  {
                        text: message_text,
                  },
                   //in return we  will  get 
                   function(data, status){
                        alert(data);
                        //first remove the text from
                        //message_text so
                        $("#message_text").val("");

                        //now add  the data inside 
                        //the message container
                        document.getElementById("messages-container").innerHTML += data;
                   }
                  );
              });

              //if any button is clicked inside
              //right-col-container
              $("#right-col-container").keypress(function(e){
                 //as we submit the form with enter button so
                 if(e.keyCode == 13 && !e.shiftKey){
                    //it means entered is clicked without shift key
                    //so submit the  form
                    $("#message-form").submit();
                 }
              });


      </script>
