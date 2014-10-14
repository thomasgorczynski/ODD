<html lang="en">
<head>
    
	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>Off Track Planet | Exploration Guide</title></title>
	<meta name="description" content="The fastest and easiest way to explore someplace new.">
	<meta name="author" content="S&T">
    <link rel="image_src" href="http://stugl.com/images/otp_logo.svg" />
    <meta property="og:image"content="http://stugl.com/images/otp_logo.svg" />

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS 
  ================================================== --
	<link rel="stylesheet" type="text/css" href="stylesheets/base.css">
	<link rel="stylesheet" type="text/css" href="stylesheets/skeleton.css">
	<link rel="stylesheet" type="text/css" href="stylesheets/layout.css">
    <link rel="stylesheet" type="text/css" href="stylesheets/styles.css">
    <link href='http://fonts.googleapis.com/css?family=Ubuntu:300,400,700' rel='stylesheet' type='text/css'>

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
    
    <style>
        .conversationBox, .noteBox {
            overflow: auto;
            width: 75%;
            height: 60%;
            margin: 1% auto;
            border: solid red 2px;
        }
        
        .success, .note_success {
            background: #CFFFF5;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #B9ECCE;
            border-radius: 5px;
            font-weight: normal;
        }

        .error, .note_error {
            background: #FFDFDF;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #FFCACA;
            border-radius: 5px;
            font-weight: normal;
        }
    
    </style>
    
    <!-- MAKE NOTE THAT THE PHP CODE THAT RETRIEVES THAT USER ID AND THEN THE USER PHONE NUMBER MUST BE ABOVE THE SCRIPT!!!!! -->    
    <?php
        $userID = $_GET['id'];   //get id from url
        $userName = $_GET['name']; //get name from url
        require 'connectParse.php'; //PARSE LIBRARY
            use Parse\ParseQuery;
            use Parse\ParseObject;
        
        $query = new ParseQuery("Patients");
        $query->equalTo("objectId", $userID);
        $results = $query->find();
        $currentUser = $results[0]; 
        $userPhone = $currentUser->get("phone");

    
    ?>
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $("#reply_btn").click(function() { 
            //get input field values
            var otp_reply      = $('textarea[name=reply]').val();
            var user_phone  = "<?php echo $userPhone; ?>";
            var userID = "<?php echo $userID; ?>";

            //data to be sent to server
            post_data = {'otpReply':otp_reply, 'userPhone':user_phone, 'userID':userID};

            //Ajax post data to server
            $.post('reply.php', post_data, function(response){  

                    //load json data from server and output message     
                    if(response.type == 'error')
                    {
                        output = '<div class="error">'+response.text+'</div>';
                    }else{
                        output = '<div class="success">'+response.text+'</div>';

                        //reset values in all input fields
                        $('#contact_form input').val(''); 
                        $('#contact_form textarea').val(''); 
                    }

                    $("#result").hide().html(output).slideDown();
                }, 'json');

        });
      
        
        $("#note_reply_btn").click(function() { 
            //get input field values
            var note_reply      = $('textarea[name=note_reply]').val();
            var userID = "<?php echo $userID; ?>";

            //data to be sent to server
            post_data = {'noteReply':note_reply, 'userID':userID};

            //Ajax post data to server
            $.post('note_reply.php', post_data, function(response){  

              output = '<div class="note_error">'+response.text+'</div>';
                    //load json data from server and output message     
                    if(response.type == 'note_error')
                    {
                        output = '<div class="note_error">'+response.text+'</div>';
                    }else{
                        output = '<div class="note_success">'+response.text+'</div>';

                        //reset values in all input fields
                        $('#note_form input').val(''); 
                        $('#note_form textarea').val(''); 
                    }

                    $("#note_result").hide().html(output).slideDown();
                }, 'json');

        });
    
            
        function loadmessages(){
            $(function() {

                // show that something is loading
                $('#response').html("<b>Loading response...</b>");

                /*
                 * 'post_receiver.php' - where you will pass the form data
                 * $(this).serialize() - to easily read form data
                 * function(data){... - data contains the response from post_receiver.php
                 */
                var user_id  = "<?php echo $userID; ?>";
                datas = {'userID':user_id};
            
                $.post('getstuff.php', datas, function(data){

                    // show the response
                    //$('#response').hide().html(data).slideDown();
                    $('#response').html(data);

                }).fail(function() {

                    // just in case posting your form failed
                    alert( "Posting failed." );

                });

                // to prevent refreshing the whole page page
                return false;

        });
        }
        
        setInterval( loadmessages, 10000 );
        
        $('#conversationBox').scrollTop(1000000);
                
        //reset previously set border colors and hide all message on .keyup()
        $("#contact_form input, #contact_form textarea").keyup(function() { 
            $("#contact_form input, #contact_form textarea").css('border-color',''); 
            $("#result").slideUp();
        });

    });
    </script>

    
</head>
<body>
	<div class="container">
        
      <h1 style="text-align: center"><?php echo $userName; ?></h1>
        <div class="conversationBox" id="conversationBox">
            <div id='response'></div>
        </div>
        
        <fieldset id="contact_form">
            <div id="result"></div>
            <textarea rows="4" cols="50" class="reply" name="reply" id="reply"/></textarea>
            <button class="reply_btn" id="reply_btn">Reply</button>
        </fieldset>
        
  
        <div class="noteBox" id="noteBox">
          <?php


             $currentUser = new ParseObject("Patients", $userID); //$currentTexter is set as the current Texter object
                $userID = $currentUser->getObjectId();

                $query = new ParseQuery("Notes"); //new query
                $query->equalTo("userID", $userID); //return all of the messages that are in the current chatroom
                $query->ascending("createdAt"); //sort by time
                $results = $query->find();

                //loop through the messages
                for ($i = 0; $i < count($results); $i++) { 
                    $object = $results[$i]; //object of type "Message" first message incremented up each time
                    $messageContent = $object->get("content"); //gets the content of the message
                    //query for Texter object info

                    echo $username.': <strong>'.$messageContent. '</strong></br></br>';
                }
          ?>
            <div id='noteResponse'></div>
        </div>
        
  <form id="signupForm" name="signupForm" action="http://odd.seanandthomas.com/postnote.php" method="post">
            <textarea rows="4" cols="50" class="note_reply" name="note_reply" id="note_reply"></textarea>
            <input type="hidden" id="id" name="id" value="<?php echo $userID; ?>"/>
            <input type="hidden" id="name" name="name" value="<?php echo $userName; ?>"/>
            <button class="note_reply_btn" id="note_reply_btn">NOTE Reply</button>
        </fieldset>
        <button class="refresh" id="refresh">Refresh</button>
        
        
    </div><!-- container -->
    
    <div class="bottom">A creation by S&amp;T</div>



<!-- End Document
================================================== -->
</body>
</html>