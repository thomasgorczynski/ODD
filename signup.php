<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" >

<head>
<meta charset="utf-8">
<!-- If you delete this meta tag World War Z will become a reality -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<title>Alice | Off Track Planet</title>

<!-- If you are using the CSS version, only link these 2 files, you may add app.css to use for your overrides if you like -->
<link rel="stylesheet" href="css/normalize.css">
<link rel="stylesheet" href="css/foundation.css">

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
  <script src="js/jquery.mask.min.js" type="text/javascript"></script>
  
<!-- If you are using the gem version, you need this only -->
<link rel="stylesheet" href="css/app.css">
  

<script src="js/vendor/modernizr.js"></script>
  
   <script type="text/javascript">
     
     
    $(document).ready(function() {
        $('.css-typing').hide();
      
        $("#activate").click(function() { 
          
          //get input field values
            var user_name       = $('input[name=name]').val(); 
            var user_phone      = $('input[name=phone]').val();
            var user_phone      = user_phone.replace(/[^0-9]/g, '');
          
          if ( user_name.length < 2 && user_phone.length != 10 ) {
            $("input#name").css('background-color', 'rgba(255,140,140,.9)').focus();
            $("input#phone").css('background-color', 'rgba(255,140,140,.9)');
            return false;
          } else if ( user_name.length < 2 && user_phone.length == 10 ) {
            $("input#name").css('background-color', 'rgba(255,140,140,.9)').focus(); 
            $("input#phone").css('background-color', 'rgba(140,255,140,.9)');
            return false;
          } else if ( user_name.length > 1 && user_phone.length != 10 ) {
            $("input#name").css('background-color', 'rgba(140,255,140,.9)');
            $("input#phone").css('background-color', 'rgba(255,140,140,.9)').focus(); 
            return false;
          } else if ( user_name.length > 1 && user_phone.length == 10 ) {
            
            
            
            post_data = {'userName':user_name, 'userPhone':user_phone};

                //Ajax post data to server
                $.post('activate.php', post_data, function(response){  

                    //load json data from server and output message     
                    if(response.type == 'error')
                    {
                        output = response.text;
                        $("#result").hide().html(output).slideDown();
                    }else{
                        output = response.text;

                        //reset values in all input fields
                        $('fieldset#signupForm').delay(500).fadeOut( "slow");
                        $('#bottom-safe').delay(500).fadeOut( "slow");
                        $('#hello').delay(500).fadeOut("slow");
                        $(".css-typing span").html(user_name);
                        $('.css-typing').delay(1500).fadeIn("slow");
                        
                    }

                    
                }, 'json');
          }

        });
         
        });
      </script>
          
</head>
<body>
<div class="signup">
  <div class="row">
    <div class="small-12 columns">
      <img id="alicelogo" src="/img/aliceLogo.png"/>
    </div>
  </div>
  
  <div class="row">
    <div class="small-12 columns">
      <h1 id="title_signup">Off Track Planet</h1>
    </div>
  </div>
  
  <div class="row">
    <div class="small-12 columns">
      <div class="bars"></div>
    </div>
  </div>
  
  <div class="row">
    <div class="small-12 columns">
      <div id="hello">
        <h1>Hi, my name is Alice.</h1>
        <p>I am a portal to unique and undiscovered experiences. If you dare chase the rabbit, please proceed ...</p>
      </div>
    </div>
  </div>
  
  <div id="result" style="color: white; text-align: center;"></div>
  
  <fieldset id="signupForm" name="signupForm">
    <div class="labels">
      <div class="row">
        <h2>What's your mom call you?</h2>
        <div class="medium-4 medium-offset-4 small-10 small-offset-1">
          <input id="name" name="name" type="text" placeholder="" maxlength="25" autofocus/>
        </div>
      </div>

      <div class="space"></div>
    
      <div class="row">
          <h2>Enter your phone no.</h2>
          <div class="medium-4 medium-offset-4 small-10 small-offset-1">
            <input id="phone" name="phone" type="tel" placeholder="(___) ___-____"/>
          </div>
      </div>
      
      <input type="submit" class="button" id="activate" value="Activate" />
      
    </div>
  </fieldset>
  
  <div class="row">
    <div class="small-12 columns">
      <h1 id="bottom-safe">Is this safe?</h1>
    </div>
  </div>

  
  <div class="row">
    <div class="medium-6 medium-offset-3 small-12 columns">
      <div class="css-typing">
        <h3>Hi <span></span>,</h3>
        <h3>Welcome to the rabbit chase.</h3>
        <h3 id="alice">-Alice</h3>
      </div>
    </div>
  </div>
  
  
  <!-- body content here -->

  <script src="js/vendor/jquery.js"></script>
  <script src="js/foundation.min.js"></script>
  <script>
    $(document).foundation();
    
    //This only allows entering in numbers into the field
    $(document).ready(function() {
	$("#phone").keydown(function(event) {
		// Allow only backspace and delete
		if ( event.keyCode == 46 || event.keyCode == 8 ||  event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 9 || event.keyCode == 13 ) {
			// let it happen, don't do anything
		}
		else {
			// Ensure that it is a number and stop the keypress
			if (event.keyCode < 48 || event.keyCode > 57 ) {
				event.preventDefault();	
        }	
      }
    });
  });
    
    $('#name').bind('keyup blur', function () { $(this).val($(this).val().replace(/[^A-Za-z]/g, '')) });
    
  </script>
  
<script type="text/javascript" src="js/jquery.mask.min.js"></script>

<script type="text/javascript">
  $(function() {
    
    $('#phone').mask('(000) 000-0000');
  });
</script>
</div>

</body>
  <style>
    body {
      background-color: #23272b;
    }
  </style>
</html>