<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<!--
Saravgi, Shilpi
CS545_00
Assignment #4 (java script)
Instructor: Cyndi Chie
Fall 2020
-->

<head>
  <title>SDSU Natural History Museum | Exhibition</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../styles/main_index.css">
 
</head>

<body>
  <div class="wrapper">
    <!--header starts-->
    <header class="header">
      <!--div first starts-->
      <div class="first">
        <a href="https://www.sdsu.edu" target="_blank"><img class="fltleft" src="../images/SDSUlogo.png"
            alt="Click here to go to sdsu website" width="163" height="144" /></a>
        <h1>San Diego State University <br>Natural History Museum</h1>

      </div>
      <!--div first ends-->

      <!--website navigation-->
      <nav id="navContainer" class="clrflt">
        <ul class="HNav1">
          <li><a href="../index.html">Home</a></li>
          <li><a href="exhibits.html">Exhibits</a></li>
          <li><a href="events.html">Events</a></li>
          <li><a href="science.html">Science</a></li>
          <li><a href="join.html">Join</a></li>
          <li><a href="about.html">About Us</a></li>
        </ul>
      </nav>
    </header>

    <!--div layout_two_column starts-->
    <div class="layout_two_column">

        <article class="col1">
           <!-- Java Script Changes for last modified date on page . Date formatting done -->
           <p id="lastModDate">This Page was last modified on:
                <script class="textColor">
                    //document.write(document.lastModified);
                    var mydate = new Date(document.lastModified);
                    var month = ["January", "February", "March", "April", "May", "June",
                        "July", "August", "September", "October", "November", "December"
                    ][mydate.getMonth()];
                    var str = ' ' + month + ' ' + mydate.getDate() + ", " + mydate.getFullYear();
                    if (mydate.getSeconds() < 10) {
                        Seconds = "0" + mydate.getSeconds();
                    } else {
                        Seconds = mydate.getSeconds();
                    }
                    if (mydate.getMinutes() < 10) {
                        Minutes_double_digit = "0" + mydate.getMinutes();
                    } else {
                        Minutes_double_digit = mydate.getMinutes();
                    }
                    document.write(str);
                    //var CurTime = " @ " + mydate.getHours() + ":" + mydate.getMinutes() + ":" + Seconds;
                    var CurTime = " @ " + mydate.getHours() + ":" + Minutes_double_digit + ":" + Seconds;
                    document.write(CurTime);
                </script>
            </p>
            <!-- Java Script Changes for last modified end -->

          <h2 class="classBlue">Sign up form for Events and Exhibitions</h2>
            <h3>Thank You for Sign Up !</h3><br> 
            <div class = "confirmation">

            
            <?php

             /*Initializing all the variables with the session variables i.e form values */
                $firstname = $_SESSION['firstname'];
                $lastname = $_SESSION['lastname'];
                $address= $_SESSION['address'];
                $phone = $_SESSION['phone'];
                $email = $_SESSION['email']; 
                $other_events = $_SESSION['other_events'];               
                $newsletter = $_SESSION['newsletter'];
                $register_event = $_SESSION['register_event'];
                
                $total_attendees =  $_SESSION['total_attendees'];
                $under5_age = $_SESSION['under5_age'];
                $between5_12 =  $_SESSION['between5_12'];
                $between13_17 =  $_SESSION['between13_17'];
                $above_18 =  $_SESSION['above_18'];


               
                
                
                echo "Name: " . $firstname . " " . $lastname . "<br>";
                if($address != null)
                  echo "Address: " . $address . "<br>";
                
                if($phone != null)
                    echo" Phone no: " . $phone . "<br>";
                
                  echo $email . "<br>";

                  echo "Event registered: " . $register_event . "<br>";
                
                 
                echo "Total number of attendees: " . $total_attendees ;
                echo " <ul>"; /* using <ul> to display sub categories of attendees */

                if( $under5_age!= 0 )
                 echo "<li>" ."Attendees under 5 years: " . $under5_age . "</li>";
                if($between5_12 != 0 )
                  echo "<li>" . "Attendees 5 - 12 years: " .  $between5_12 . "</li>";
                if($between13_17 != 0)
                  echo "<li>" . "Attendees 13 - 17 years: " . $between13_17 . "</li>";
                if($above_18 != 0)
                  echo "<li>" . "Attendees above 18: " . $above_18 . "</li>";

                 echo "</ul>"; 

                 if($newsletter != null)
                 echo "Signed up for newsletter : Yes" . "<br>";

                if($other_events != null)
                 echo "Other Events of Interest: " . $other_events . "<br>";


             ?>   

             </div>
        


          
  
        </article>
  
        <aside class="col2">
          <br>
          <h2>SDSU NHM</h2>
          <h3>Address</h3>
          <address>
          San Diego State University<br>
          Natural History Museum<br>
          San Diego, CA 92182-0000<br>
          (619) 594-5200<br>
          <a href="mailto:nhmuseum@sdsu.edu">nhmuseum@sdsu.edu</a>
          </address>
          
          <h2>Donate Now!</h2>
         <h3>Make a difference</h3>
        <p>Call <strong>619.594.5200</strong> to give over the phone or to make a gift of stock</p>
        <p>Mail to: <strong><a href="mailto:nhmuseum@sdsu.edu">nhmuseum@sdsu.edu</a></strong></p>

  
        </aside>
  
      </div> <!--div layout_two_column ends-->

    <!--footer starts -->
    <footer class="footer">
      <div class="fcolumn1">
        <address>
          San Diego State University<br>
          Natural History Museum<br>
          San Diego, CA 92182-0000<br>
          (619) 594-5200<br>
          <a href="mailto:nhmuseum@sdsu.edu">nhmuseum@sdsu.edu</a>
        </address>
      </div>
      <!--div class fcolumn1 ends-->
      <div class="fcolumn2 ">
        <p>
          Museum Hours<br>
          Daily 10:00am to 5:00pm<br>
          Closed when the campus is closed<br>
          Hours subject to change<br>
        </p>
        <!--div class fcolumn2 ends-->
      </div>
    </footer>
    <!--footer ends-->

  </div>

</body>

</html>