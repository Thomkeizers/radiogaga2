<?php
//Start session. To save calculated values.
    session_start();

    //When not set we create a new session in which we store a array.
    if(!isset($_SESSION['History']))
    {
        $_SESSION['History'] = [];
    }

    if(isset($_POST['submit']))
    {
        $numberOne = $_POST['number-one'];
        $numberTwo = $_POST['number-two'];
        $decimals = $_POST['sliderDecimals'];
        
        if($_POST['operator'] == 'Plus')
        {
         $uitkomst = $numberOne + $numberTwo; 
         $uitkomstplus = $uitkomst; 
        }
       
        elseif($_POST['operator'] == 'Minus')
        {
         $uitkomst = $numberOne - $numberTwo; 
         $uitkomstmin = $uitkomst;  
        }
                      
        elseif($_POST['operator'] == 'Multiply')
        {     
         $uitkomst = $numberOne * $numberTwo; 
        }

        elseif($_POST['operator'] == 'Division')
        {
            if($numberOne == 0 && $numberTwo == 0)
            {
             $uitkomst = "Niet deelbaar";
            }
            elseif($decimals == 0)
            {
             $uitkomst = $numberOne / $numberTwo;
            }
            else
            {
             $uitkomst = $numberOne / $numberTwo;
             $uitkomst = round($uitkomst, $decimals);
            } 
        }
        
        elseif($_POST['operator'] == 'Square')
        {
         $uitkomst = $numberOne * $numberOne;  
        }

        elseif($_POST['operator'] == 'Squareroot')
        {   
            if($decimals == 0)
            {
             $uitkomst = sqrt($numberOne);
            }
            else
            {
             $uitkomst = sqrt($numberOne);
             $uitkomst = round($uitkomst, $decimals);
            }  
        }

        elseif($_POST['operator'] == 'tokm')
        {
            $calculation = $numberOne * 1.60934;
            if($decimals == 0)
            {
             $uitkomst = $calculation . " " . "km";
            }
            else
            {
             $uitkomst = (round($calculation, $decimals)) . " " . "km";
            }
        }

        elseif($_POST['operator'] == 'toml')
        {
            $calculation = $numberOne / 1.60934;
            if($decimals == 0)
            {
             $uitkomst = $calculation . " " . "mile";
            }
            else
            {
             $uitkomst = round($calculation, $decimals) . " " . "mile";
            }
        }

        //Here I put my calculations in the session array.
        if($_POST['operator'] == "Plus")
        {
            $_SESSION['History'] [] = $numberOne . " " . "+" . " " . $numberTwo . " " . "=" . " " . $uitkomst;
        }
        elseif($_POST['operator'] == "Minus")
        {
            $_SESSION['History'] [] = $numberOne . " " . "-" . " " . $numberTwo . " " . "=" . " " . $uitkomst;
        }
        elseif($_POST['operator'] == "Multiply")
        {
            $_SESSION['History'] [] = $numberOne . " " . "*" . " " . $numberTwo . " " . "=" . " " . $uitkomst;
        }
        elseif($_POST['operator'] == "Division")
        {
            $_SESSION['History'] [] = $numberOne . " " . "/" . " " . $numberTwo . " " . "=" . " " . $uitkomst;
        }
        elseif($_POST['operator'] == "Square")
        {
            $_SESSION['History'] [] = $numberOne . " " . "tot de macht 2" . " " . "=" . " " . $uitkomst; 
        }
        elseif($_POST['operator'] == "Squareroot")
        {
            $_SESSION['History'] [] = "De wortel van " . $numberOne . " = " . $uitkomst;
        }
        elseif($_POST['operator'] == "toml")
        {
            $_SESSION['History'] [] = $numberOne . " km  = " . $uitkomst;
        }
        elseif($_POST['operator'] == "tokm")
        {
            $_SESSION['History'] [] = $numberOne . "  mile = " . $uitkomst;
        }
    }
      
    // Here I reset the calculator.
    if(isset($_POST['reset']))
    {
        $numberOne = "";
        $numberTwo = "";
      
        if($_POST['operator'] =! "Plus")
        {
         $_POST['operator'] == "Plus";
        }
    }
?>
            

        
       
<!DOCTYPE html> <!--Dit geeft het documenttype aan.-->
<html lang="en"> <!---geeft de taal aan-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="discription" content="My first website">
    <title>Calculator ++</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Container with everything inside it. !-->

    <div class="container">

       <!-- A div with the calculator form inside of it. With this div I can style the height and width for the form. !-->

        <div class="calculator-form">

            <!-- Here I put a form with input-fields and buttons. Classes for styling and names for PHP usage. Also I use my value to store
            PHP data in it. !-->

            <form action="index.php" method="post">
                <input class="sum-part color" name="sumpart" type="text" value= "<?php if(isset($uitkomst)) echo $uitkomst ?>" placeholder = "0" disabled><br>
                
                <label class="label">Number one:</label>
                <input class="input-style" name="number-one" type="text" value="<?php if(isset($numberOne)) {echo $numberOne;} ?>" placeholder= "Number one" required><br>
                
                <label class="label">Operator:</label>
                <select class="input-style" id= "operator-list" name="operator">
                    <option value="Plus" <?php if(isset($_POST['operator']) && $_POST['operator'] == 'Plus') echo 'selected= "selected"';?> selected >Plus</option>
                    <option value="Minus" <?php if(isset($_POST['operator']) && $_POST['operator'] == 'Minus') echo 'selected= "selected"';?>>Minus</option>
                    <option value="Multiply" <?php if(isset($_POST['operator']) && $_POST['operator'] == 'Multiply') echo 'selected= "selected"';?>>Multiply</option>
                    <option value="Division" <?php if(isset($_POST['operator']) && $_POST['operator'] == 'Division') echo 'selected= "selected"';?>>Divison</option>
                    <option value="Square" <?php if(isset($_POST['operator']) && $_POST['operator'] == 'Square') echo 'selected= "selected"';?>>Root</option>
                    <option value="Squareroot" <?php if(isset($_POST['operator']) && $_POST['operator'] == 'Squareroot') echo 'selected= "selected"';?>>Squareroot</option>
                    <option value="tokm" <?php if(isset($_POST['operator']) && $_POST['operator'] == 'tokm') echo 'selected= "selected"';?>>ML to KM</option>
                    <option value="toml" <?php if(isset($_POST['operator']) && $_POST['operator'] == 'toml') echo 'selected= "selected"';?>>KM to ML</option>
                </select><br>

                <label class= "label" id= "secondlabel">Number two:</label>
                <input class= "input-style" id = "second-input" name= "number-two" type= "text" value= "<?php if(isset($numberTwo)) {echo $numberTwo;} ?>" placeholder= "Number two" required ><br>

                <label class= "label">Decimals:</label>
                <input class= "input-style" id= "decimals-input" name= "sliderDecimals" type= "text" placeholder= "How many decimals?"><br>
                
                <input style= "color: red;" class= "input-style slider-color" id= "decimals-slider" type= "range" value= "1" min= "1" max= "10" step= "1" ><br>

                <label class = "label">Calculation history:</label>
                
                <div class= "div-style"> 
                     <?php 
                      //Here I check if the values inside the array are no more than five. If so I shift the last one out and replace it with a new value to be stored inside array.
                      foreach($_SESSION['History'] as $item)
                      {
                        $count = count($_SESSION['History']);
                        if(isset($_POST['submit']) && $count > 4)
                        {
                            array_shift($_SESSION['History']);
                        }
                        echo $item;
                        echo "<br>";
                      }
                    ?>
                </div>
    
                <button class= "button-calculate" name = "submit">Calculate</button><br>
                <button class= "button-reset" name = "reset">Reset</button><br>
            </form>
        </div>
    </div>    
                
<!-- Javascript for disabling the second input !-->

 <script type= "text/javascript">
    let operatorlist = document.getElementById("operator-list");
    let secondinput = document.getElementById("second-input");
    let secondlabel = document.getElementById("secondlabel");

    operatorlist.oninput = function() {
    let selectedOperator = this.value;

    if(selectedOperator == "Squareroot" || selectedOperator == "Square" || selectedOperator == "tokm" || selectedOperator == "toml")
    {
        secondinput.style.display = "none";
        secondlabel.style.display = "none";
    }
    else
    {
        secondlabel.style.display = "block";
        secondinput.style.display = "inline-block";
    }
 }
 </script>

<!-- Javascript for determining decimal user input. !-->

<script type= "text/javascript">
   let decimalslider = document.getElementById("decimals-slider");
   let decimalsinput = document.getElementById("decimals-input");

   decimalslider.oninput = function() {
   decimalsinput.value = this.value;
}
</script>
</body>
</html>

            

            

    

    
    







                            


                    
     






