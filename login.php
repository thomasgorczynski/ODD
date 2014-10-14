<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" >

<head>
<meta charset="utf-8">
<!-- If you delete this meta tag World War Z will become a reality -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<title>ODD</title>

<!-- If you are using the CSS version, only link these 2 files, you may add app.css to use for your overrides if you like -->
<link rel="stylesheet" href="css/normalize.css">
<link rel="stylesheet" href="css/foundation.css">

<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
  <script src="js/jquery.mask.min.js" type="text/javascript"></script>
  
<!-- If you are using the gem version, you need this only -->
<link rel="stylesheet" href="css/app.css">
  
</head>
<body>
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
  
  
  <form id="signupForm" name="signupForm" action="http://odd.seanandthomas.com/parseLogin.php" method="post">
    <div class="labels">
      <div class="row">
        <h2>What's your mom call you?</h2>
        <div class="medium-4 medium-offset-4 small-10 small-offset-1">
          <input id="name" name="userName" type="text" placeholder="" maxlength="25" autofocus/>
        </div>
      </div>

      <div class="space"></div>
    
      <div class="row">
          <h2>Enter your phone no.</h2>
          <div class="medium-4 medium-offset-4 small-10 small-offset-1">
            <input id="phone" name="userPass" type="text" placeholder=""/>
          </div>
      </div>
      
      <input type="submit" class="button" id="activate" value="Activate" />
      
    </div>
  </form>
  
    <style>
    body {
      background-color: #23272b;
    }
  </style>

</body>
</html>