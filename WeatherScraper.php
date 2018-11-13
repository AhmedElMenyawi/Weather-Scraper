<?php
$weather = "";
$error = "";
error_reporting(E_ERROR | E_PARSE);
if( $_GET['city'] )
{
    $urlContents = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['city'])."&appid=d32a8733f341f695a45be3b9492e77c8");
    
    $weatherArray = json_decode($urlContents,true);
    
    if ( $weatherArray['cod'] == 200 )
    {
    
    $weather = "The Weather In ".$_GET['city']." Is ".$weatherArray['weather'][0]['description']." .";
    
    $tempInCelcius = round($weatherArray['main']['temp'] - 273);
    
    $weather .= "The Temperature Is ".$tempInCelcius." &deg;C";
    
    $windSpeed = $weatherArray['wind']['speed'];
    
    $weather .= "With A Wind Speed Of ".$windSpeed." meter/second";
    
    }
    else
    {
     $error = "City Is Not Found - Please Try Again Later";   
    }
} 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Weather Scraper</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  </head>
    <style type="text/css">
         html { 
          background: url(https://images.unsplash.com/photo-1420136390439-1482fc2ce4b9?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=40ff66ea7a3cfcbea7faf12cfa4391b6&auto=format&fit=crop&w=755&q=80) no-repeat center center fixed; 
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
          }
          body {    
              background: none;   
          }
          .container {   
              text-align: center;
              margin-top: 100px;
              width: 450px;
          }
          input {   
              margin: 20px 0;
          }
          #weather {   
              margin-top:15px;
          }
    </style>
    
  <body>
      
        <div class="container">
      
          <h1>What's The Weather?</h1>
           
          <form>
  <fieldset class="form-group">
    <label for="city">Enter the name of a city.</label>
    <input type="text" class="form-control" name="city" id="city" placeholder="Eg. London, Tokyo" value = "">
  </fieldset>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
      
        <div id="weather">
            <?php 
            if ($weather != "")
            {
                echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';
            }
            ?>
        </div>
            
        <div id="error">
            <?php 
            if( $error != "")
            {
                echo "<div class='alert alert-danger' role='alert'>".$error."</div>";
            }
            ?>
        </div>        
        </div>
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
          
          
      <script type="text/javascript">
      </script>
          
  </body>
</html>