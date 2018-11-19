
<!DOCTYPE html>
  <html>
    <head>
            <meta charset="utf-8">
      <!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>-->
      <!--<link rel="stylesheet" href="css/bootstrap.css">-->
      <link rel="icon" href="https://raw.githubusercontent.com/Gruuve/icon-source/master/icong.png">
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
      <link rel="stylesheet" href="css/custom.css">
      <link href="https://fonts.googleapis.com/css?family=Francois+One" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">


      <!--<meta name="viewport" content="width=device-width, initial-scale=1.0"/>-->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Search : Gruuve</title>
    </head>

    <body>
            <nav>
                    <div class="container nav-wrapper">
                      <a href="index.html" class="brand-logo"><font class="temp">Gruuve</font><font class="subtag"> Search</font></a>
                      <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a href="#">I'm Feeling Lucky</a></li>
                        <li><a href="#">Instant Search</a></li>
                        <li><a href="#">About</a></li>
                      </ul>
                    </div>
                  </nav>

            <nav>
                    <div class="container nav-wrapper">
                      <form method="POST" action="search.php">
                        <div class="input-field">
                          <input id="search" type="search" required name="query">
                          <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                          <i class="material-icons">close</i>
                          <button type="submit" name="submit" class="hide"></button>
                        </div>
                      </form>
                    </div>
                  </nav>

                  <br>
                  <div class="container">
                  <!--Searches-->


<?php
                  if(isset($_POST['submit'])){    

                      $qu = $_POST['query'];
                      $raw = $qu;
                      $qu = trim(preg_replace('/\s+/',' ', $qu));
                      $qu = str_replace(' ', '+', $qu);

                      $url = "https://gruuve-main.herokuapp.com/api/users?q=$qu";
                      $json = file_get_contents($url);
                      $res = json_decode($json);
                      
                      
                      include("db.php");
                      $q1 = "select * from websites where keywords like '%$raw%' order by clicks desc";
                      $r1 = mysqli_query($con,$q1);

                      while($ro1=mysqli_fetch_assoc($r1)){

                        echo "<a href=\"update.php?id=$ro1[id]\">
                                    <div class=\"card\">
                                    <div class=\"card-content\">
                                      <span class=\"card-title activator\" style=\"color: black;\">$ro1[header]<i class=\"material-icons right\">share</i></span>
                                      <p style=\"color: black;\">$ro1[content]</p>
                                      <div><p><img src=\"images/web.png\" height=\"20px\" width=\"20px\" style=\"margin-top:3px;\">
                                        <a href=\"#\" style=\"margin: 5px;\">$ro1[link]</a></p></div>
                                    </div>
                                    </div>
                             </a>";

                      }


                      foreach($res as $obj){
                      
                      $title = $obj->title;
                       $desc = $obj->rawDescription;
                       $icon = $obj->icon;
                       $link = $obj->url;



                          echo "<a href=\"$link\">
                                    <div class=\"card\">
                                    <div class=\"card-content\">
                                      <span class=\"card-title activator\" style=\"color: black;\">$title<i class=\"material-icons right\">share</i></span>
                                      <p style=\"color: black;\">$desc</p>
                                      <div><p><img src=\"$icon\" height=\"20px\" width=\"20px\" style=\"margin-top:3px;\">
                                        <a href=\"#\" style=\"margin: 5px;\">$link</a></p></div>
                                    </div>
                                    </div>
                             </a>";

                      }

                  }
?>

                             
                        


                                


                    <!--Search end-->

                    </div>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    </body>
    </html>

  
