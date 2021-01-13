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

          <h2 class="classBlue">Sign up form for events and exhibitions </h2>


          

          <?php
          // define variables and set to empty values
          $firstname = $lastname = $email = $address = $phone=  "";
          $other_events = $newsletter = $register_event ="";
          $signup_check="checked";
          $under5_age = $between5_12 = $between13_17 = $above_18 = "0" ;
          $total_attendees = "0";
          $total_of_subcategories = "0";
         
          $firstnameErr = $lastnameErr = $emailErr = $addressErr = $phoneErr ="";
          $register_eventErr =  $under5_ageErr = $between5_12Err = $between13_17Err = $above_18Err =  "";
          $total_attendeesErr = "";
          
         //function to check data
          function test_input($data) {
                     $data = trim($data);
                     $data = stripslashes($data);
                     $data = htmlspecialchars($data);
                     return $data;
         } 
          
         
         if ($_SERVER["REQUEST_METHOD"] == "POST") {
         
            $valid = true;
            /****First Name required field allows alphabet and - and '  */
            if (empty(filter_input(INPUT_POST, "firstname"))) {
                $valid = false;
                $firstnameErr = "First name is required";
                }
            else{
                $firstname = test_input(filter_input(INPUT_POST, "firstname"));
                if (!preg_match("/^[a-zA-Z-' ]*$/",$firstname)) {
                    $valid = false;
                    $firstnameErr = "Only alphabets(a-z), white space hyphen(-) and apostrophe (') allowed";
                 }
                 else{
                    $_SESSION['firstname'] = test_input(filter_input(INPUT_POST, "firstname"));
                 }   
             }
              
             /****Last Name required field allows alphabet and - and '  */
            if (empty(filter_input(INPUT_POST, "lastname"))) {
                $valid = false;
                $lastnameErr = "Last name is required";
            }else {
              $lastname = test_input(filter_input(INPUT_POST, "lastname"));
              if (!preg_match("/^[a-zA-Z-' ]*$/",$lastname)) {
                $valid = false;
                $lastnameErr = "Only alphabets(a-z), white space hyphen(-) and apostrophe (') allowed";
             }
             else{
              $_SESSION['lastname'] = test_input(filter_input(INPUT_POST, "lastname"));
             }   

            }
             
            
            /****Address optional field */                            
            if(empty(filter_input(INPUT_POST,"address"))) {
            
            $_SESSION['address'] ="" ;

            }else{
              $address =test_input(filter_input(INPUT_POST,"address"));
              if (!preg_match("/^[a-zA-Z0-9-'( ):,.#_@]*$/", $address)) {
                $valid = false;
                $addressErr = "only a-z 0-9 - ' ( ) : _ , . # @ allowed in address ";
              }else{
                $_SESSION['address'] = test_input(filter_input(INPUT_POST,"address"));                
              }

              
            
            }

            /****Phone optional field : 000-000-0000 format allowed*/   

            if(empty(filter_input(INPUT_POST,"phone"))) {
              $_SESSION['phone'] ="" ;
            }else{
              $phone =test_input(filter_input(INPUT_POST,"phone"));

              if(preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $phone)) {
                // $phone is valid
                $_SESSION['phone'] = test_input(filter_input(INPUT_POST,"phone"));
              }
              else{
                $valid = false;
                $phoneErr= "please add right phone no.in format 000-000-0000 ";
              }
            }

            /*** Email is required using filter_var function to validate email */
            if (empty(filter_input(INPUT_POST, "email"))) {
              $valid = false;
              $emailErr = "Email is required";
            }else {
                  $_SESSION['email'] = test_input(filter_input(INPUT_POST, "email"));
                  $email = test_input(filter_input(INPUT_POST, "email"));
                  
                  // check if e-mail address is well-formed 
                  if (!filter_var($_SESSION['email'], FILTER_VALIDATE_EMAIL)) {
                      $valid = false;
                      $emailErr = "Invalid email format, please enter valid email"; 
                  }
              }

              /** Register Event required  */
              if(empty(filter_input(INPUT_POST, "register_event"))){
              $valid=false;
              $register_eventErr = "Please select an event to register";
              }else{
                $register_event = test_input(filter_input(INPUT_POST, "register_event"));
                $_SESSION['register_event'] = test_input(filter_input(INPUT_POST, "register_event"));
                
              }

              /**Total number of attendees must be equal to the sub categories. 
               * Total number of attendees must not be zero.
               * subcategories must hold 0 or any value
               * when all sub categories have value and all conditions are true .ie. valid =true then 
               * lastly validate total_of_subcategories = under5_age + between5_12 + between13_17 + above_18;
               *  */
              /*Note: when we input 0 it doesn't make difference btw 0 and empty   
                Then we condition to check if 0 then no err msg displayed
              */

           
              if(empty(filter_input(INPUT_POST, "total_attendees")) || filter_input(INPUT_POST, "total_attendees") =="00" || filter_input(INPUT_POST, "total_attendees") =="000"){
                $valid=false;
                $total_attendeesErr ="Please Enter for minimum of 1 attendee in the above sub-categories ";
              }else{
                  
                  if(preg_match("/^[0-9]{1,3}$/", $total_attendees)) { 
                      // $valid number
                      $total_attendees = test_input(filter_input(INPUT_POST, "total_attendees"));
                      
                      $_SESSION['total_attendees'] = test_input(filter_input(INPUT_POST,"total_attendees"));
                  }
                  else{
                        $valid = false;
                        $total_attendeesErr= "only numbers 1 - 396 can be entered ";
                      }
              }

              if(empty(filter_input(INPUT_POST, "under5_age")) && filter_input(INPUT_POST, "under5_age") != 0 ){
                $valid=false;
                $under5_ageErr ="Please Enter no. of atendees if none then enter 0 ";
                }else{
                $under5_age = test_input(filter_input(INPUT_POST, "under5_age")); 
                  if(preg_match("/^[0-9]{1,2}$/", $under5_age)) {
                    // $valid number
                $_SESSION['under5_age'] = test_input(filter_input(INPUT_POST,"under5_age"));
                    
                  }
                  else{
                    $valid = false;
                      //for list input to be empty
                    if(empty(filter_input(INPUT_POST, "under5_age")))
                      $under5_ageErr ="Please Enter no. of atendees if none then enter 0 ";
                    else
                      $under5_ageErr= "only numbers 0 - 99 can be entered ";
                  }
              }

              if(empty(filter_input(INPUT_POST, "between5_12")) && filter_input(INPUT_POST, "between5_12") != 0){
                  $valid=false;
                  $between5_12Err ="Please Enter no. of atendees if none then enter 0 ";
                  }else{
                    $between5_12 = test_input(filter_input(INPUT_POST, "between5_12"));
                    if(preg_match("/^[0-9]{1,2}$/", $between5_12)) {
                    // $valid number
                    $_SESSION['between5_12'] = test_input(filter_input(INPUT_POST,"between5_12"));
                      }
                        else{
                        $valid = false;
                        //for list input to be empty
                        if(empty(filter_input(INPUT_POST, "between5_12")))
                          $between5_12Err ="Please Enter no. of atendees if none then enter 0 ";
                        else                         
                          $between5_12Err= "only numbers 0 - 99 can be entered ";
                      }
              }

              if(empty(filter_input(INPUT_POST, "between13_17")) && filter_input(INPUT_POST, "between13_17") != 0){
                $valid=false;
                $between13_17Err ="Please Enter no. of atendees if none then enter 0 ";
                }else{
                  $between13_17 = test_input(filter_input(INPUT_POST, "between13_17"));
                  if(preg_match("/^[0-9]{1,2}$/", $between13_17)) {
                    // $valid number
                    $_SESSION['between13_17'] = test_input(filter_input(INPUT_POST,"between13_17"));
                  }
                  else{
                    $valid = false; 
                    //for list input to be empty
                    if(empty(filter_input(INPUT_POST, "between13_17")))
                      $between13_17Err ="Please Enter no. of atendees if none then enter 0 ";
                    else      
                    $between13_17Err= "only numbers 0 - 99 can be entered ";
                  }
            }

              if(empty(filter_input(INPUT_POST, "above_18")) && filter_input(INPUT_POST, "above_18") != 0){
              $valid=false;
              $above_18Err ="Please Enter no. of atendees if none then enter 0 ";
              }else{
              $above_18 = test_input(filter_input(INPUT_POST, "above_18"));
              if(preg_match("/^[0-9]{1,2}$/", $above_18)) {
                  // $valid number
                  $_SESSION['above_18'] = test_input(filter_input(INPUT_POST,"above_18"));
                  }
                else{
                  $valid = false;
                    //for list input to be empty
                    if(empty(filter_input(INPUT_POST, "above_18")))
                    $above_18Err ="Please Enter no. of atendees if none then enter 0 ";
                  else    
                  $above_18Err= "only numbers 0 - 99 can be entered ";
                }
              }

              /****Sign Up for newsletter optional checkbox preselected */

              if(empty(filter_input(INPUT_POST,"newsletter"))){
                $_SESSION['newsletter']= "";
                $signup_check="";
              }else{ 
                $signup_check="checked";                    
                $_SESSION['newsletter']=test_input(filter_input(INPUT_POST,"newsletter"));
              }

              /***Other Events optional */
              if (empty(filter_input(INPUT_POST, "other_events"))) {
                $_SESSION['other_events'] = "";
              } else {
                $_SESSION['other_events'] = test_input(filter_input(INPUT_POST, "other_events"));
                $other_events = test_input(filter_input(INPUT_POST, "other_events"));
                }


// Condition to test only when any of the subcategories field is not empty to avoid errors.
              if($valid)
              {
                  $total_of_subcategories = $under5_age + $between5_12 + $between13_17 + $above_18;

                    if($total_attendees != $total_of_subcategories)
                  {
                              $total_attendeesErr = " Total attendess and sub category do not match";
                              $valid = false;
                  }else{
                    $_SESSION['$total_attendees'] = test_input(filter_input(INPUT_POST,"$total_attendees"));
                  }
              }


              if($valid){
                header("location:php_confirmation_page.php");
                    exit();
                }
         }
         ?>





          
           <form name="newsletter" action= "<?php 
          echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"> 

          
          <fieldset>
        
            <legend>Personal information:</legend>
        
            <label for="firstname">First name<span class="required" >*</span>:</label><br>
            <input type="text" name="firstname" id="firstname" oninput="this.value=this.value.replace(/[^a-zA-z' -]/g,'');" onChange="return nameCapitalized('firstname')" size="40"  maxlength="40" value="<?php echo $firstname; ?>" ><span class = "error"><?php echo " " . $firstnameErr;?></span>
            <br><br>
            
            
        
            <label for="lastname">Last name<span class="required">*</span>:</label><br>
            <input type="text" name="lastname" id="lastname" oninput="this.value=this.value.replace(/[^a-zA-z' -]/g,'');" size="40" onChange="return nameCapitalized('lastname')"  maxlength="40" value="<?php echo $lastname; ?>" ><span class = "error"><?php echo " " . $lastnameErr;?></span>
            
            <br ><br >
            

                  
            <label for="address">Address</label><br>
            <input type="text" name="address" id="address" size= "60" maxlength="200"value="<?php echo $address; ?>" >
            <span class="error"><?php echo $addressErr  ?></span><br><br>
        
            <label for="phone">Phone</label><br>
            <input type="text" name="phone" id="phone" maxlength="20" placeholder="000-0000-0000" value="<?php echo $phone; ?>" >
            <span class="error"><?php echo $phoneErr ?></span><br><br>

            <label for="email">Email<span class="required">*</span>:</label><br />
            <input type="text" name="email" id="email" size="80"  maxlength="255" value="<?php echo $email; ?>" ><span class = "error"><?php echo " " . $emailErr;?></span>
            <br><br >

        </fieldset>

        <fieldset>
          <legend>Event information</legend>
        <label for="register_event" >Select Event to register<span class="required">*</span></label><br>
            <select name="register_event" id="register_event">
            <option value="" selected></option>
	          <option value="Hidden Gems" <?php if (isset($register_event) && $register_event == "Hidden Gems") echo"selected" ?>>Hidden Gems</option>
	          <option value="Baja Wild" <?php if (isset($register_event) && $register_event == "Baja Wild") echo"selected" ?> >Baja's Wild side</option>
	          <option value="Cerrutti Mastadon" <?php if (isset($register_event) && $register_event == "Cerrutti Mastadon") echo"selected" ?> >The Cerrutti Mastodon</option>
	          <option value="Butterfly Garden" <?php if (isset($register_event) && $register_event == "Butterfly Garden") echo"selected" ?> >Butterfly Garden</option>
            </select>
            <span class = "error"><?php echo $register_eventErr; ?></span>
            <br><br>

            <!-- Changing code in this part than it was from php assignment -->

            
            <!-- ($under5_age + $between5_12 + $between13_17 + $above_18) -->
            
            <!-- Using reg exp on oninput event to let user input only numbers and not text in the fields -->
            <label for="under5_age" >Number of attendees under 5 years old:<span class="required">*</span></label>  
            <input type="text" name="under5_age" id="under5_age" onChange="return total_attend()" size="2" maxlength="2" oninput="this.value=this.value.replace(/[^0-9]/g,'');"  value="<?php echo $under5_age; ?>" >
            <span class = "error"><?php echo " " . $under5_ageErr;?></span>
            <span id="under5-error"></span>
            <br><br>
            
            <label for="between5_12">Number of attendees 5 to 12 years old:<span class="required">*</span></label>
            <input type="text" name="between5_12" id="between5_12" onChange="return total_attend()" size="2" maxlength="2" oninput="this.value=this.value.replace(/[^0-9]/g,'');"  value="<?php echo $between5_12; ?>" >
            <span class = "error"><?php echo " " . $between5_12Err;?></span>
            <br><br>
           
            
            <label for="between13_17" >Number of attendees 13 to 17 years old:<span class="required">*</span></label>
            <input type="text" name="between13_17" id="between13_17" onChange="return total_attend()" size="2" maxlength="2" oninput="this.value=this.value.replace(/[^0-9]/g,'');"  value="<?php echo $between13_17; ?>" >
            <span class = "error"><?php echo " " . $between13_17Err;?></span>
            <br><br>

            <label for="above_18" >Number of attendees 18+ years old:<span class="required">*</span></label>
            <input type="text" name="above_18" id="above_18" onChange="return total_attend()" size="2" maxlength="2" oninput="this.value=this.value.replace(/[^0-9]/g,'');"  value="<?php echo $above_18; ?>" >
            <span class = "error"><?php echo " " . $above_18Err;?></span>
            <br><br>

            <label for="total_attendees" class="indented">Total Number of Attendees:</label>
            <input type="text" name="total_attendees" id="total_attendees" size="3" maxlength="3" readonly
            value="<?php echo $total_attendees  ; ?>" class="disableField">
            <span class = "error"><?php echo " " . $total_attendeesErr;?></span>
            <br><br>

            <!-- Changes end -->

            
        </fieldset>

        <fieldset>
            <legend>Interests:</legend>
            
            <label for="newsletter">Signup for Newsletter</label>
            <input type="checkbox" name="newsletter" id="newsletter" value="newsletter"<?php echo $signup_check; ?>> <br><br>

            <label for="other_events">What other events interest you?</label><br />
            <textarea name="other_events" id="other_events" rows="5" cols="60"  maxlength="80"><?php echo $other_events; ?></textarea>
        </fieldset>
  
        <input type="submit" value="Submit" class="size">
        <input type="reset" class="size"><br><br>
      </form> 
      
      <!-- Javascript for functions nameCapitalized(name) and total_attendees() -->
      <script>

          /* function to capitalize first char of each word and rest to lowercase in name also capitalizing alphabet following hypen '-'  */
          function nameCapitalized(name){
            
            if(document.getElementById(name).value == ""){
              return false;
            }else{

              myName = document.getElementById(name).value;
              myNameSplit = myName.split(" ");
              
              /* 1. a)for each word capitalize first alphabet
                   b)convert rest other alphabets to lowercase
                  2. find hyphen in name and replace the following alphabet with uppercase
               */   
              var i;
              myNameCap = "";
              for (i = 0; i < myNameSplit.length; i++) {
                  firstChar = myNameSplit[i].substring(0, 1);
                  myNameSplit[i] = firstChar.toUpperCase() + (myNameSplit[i].substring(1, myNameSplit[i].length).toLowerCase());
                  myNameCap += myNameSplit[i] + " ";
              }
              var length = myNameCap.length;
              
              myNewName="";
              if(length>3){
                for (i=0; i < length-2;i++){
                     if((myNameCap[i]=="-") )
                     {
                       firstPart = myNameCap.substring(0, i+1);
                       lastPart = myNameCap.substring(i+2, length);
                       firstChar = myNameCap.substring(i+1, i+2);
                       myNewName = firstPart + firstChar.toUpperCase() + lastPart;
                       myNameCap = myNewName;
                     }
               }

              }

                  document.getElementById(name).value = myNameCap;
              return true;
            }

          }


          /* Function to calculate total number of attendees */
          function total_attend()
          {
            a=0;
            b=0;
            c=0;
            d=0;

           if(document.getElementById('under5_age').value == "")
              a=0;
            else
              a = document.getElementById('under5_age').value;

            if(document.getElementById('between5_12').value == "")
              b = 0;
            else
              b = document.getElementById('between5_12').value;   

            if(document.getElementById('between13_17').value == "")
              c = 0;
            else
             c = document.getElementById('between13_17').value;  
            
            if(document.getElementById('above_18').value == "")
              d = 0;
            else
              d = document.getElementById('above_18').value;

              total = parseInt(a)+parseInt(b)+parseInt(c)+parseInt(d);
              $total_attendees = total;

            document.getElementById("total_attendees").value =total ;
            //document.getElementById("under5-error").innerHTML = "On change event triggered on under5";
            return true;      
            }
      </script>
      <!-- end script -->

          
  
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