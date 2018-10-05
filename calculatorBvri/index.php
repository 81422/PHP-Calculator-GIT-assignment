<?php

//create variables that are needed
$number1 = false;
$number2 = false;
$operator = "";
$result = 0;
$calculation = false;

//uses POST method to calculate numbers
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    //get posted values
    $number1 = $_POST['number1'];
    $number2 = $_POST['number2'];

    $operator = $_POST['operator'];

    //addition
    if($operator == "addition")
    {
        //if $number2 is empty it will give a message instead of a coding error
        if($number2 == "")
        {
            $result = "Insert 2nd number!";
        }
        //if all inputs are filled out it will calculate them
        else
        {
            //$calculation shows the entire calculation
            $calculation = "$number1 + $number2 = ";
            //$result is the result of the actual calculation
            $result = $number1 + $number2;
        }
    }

    //most operators work exactly the same, so there's no need to repeat myself. I will add comments at places where pieces of code are different

    //substraction
    if($operator == "substraction")
    {
        if($number2 == "")
        {
            $result = "Insert 2nd number!";
        }
        else
        {
            $calculation = "$number1 - $number2 = ";
            $result = $number1 - $number2;
        }
    }

    //multiplication
    if($operator == "multiplication")
    {
        if($number2 == "")
        {
            $result = "Insert 2nd number!";
        }
        else
        {
            $calculation = "$number1 * $number2 = ";
            $result = $number1 * $number2;
        }
    }

    //divide
    if($operator == "division")
    {
        if($number2 == "")
        {
            $result = "Insert 2nd number!";
        }
        //dividing $number1 with "0" is not possible, that's why it shows an error message
        else if($number2 == 0)
        {
            $result = "This calculation is not possible!";
        }
        else
        {
            $calculation = "$number1 / $number2 = ";
            $result = $number1 / $number2;
        }
    }

    //square root
    if($operator == "sqroot")
    {
        //if $number1 is tinier than "0", it will show "NAN" which means "Not a number"
        if($number1 < 0)
        {

        }

        //calculates square root, it looks a bit different than the other operators
        $calculation = "√ $number1 = ";
        $result = sqrt($number1);
    }

    //power
    if($operator == "power")
    {
        if($number2 == "")
        {
            $result = "Insert 2nd number!";
        }
        else
        {
            //calculates power, it looks a bit different than the other operators
            $calculation = "$number1 ^ $number2 = ";
            $result = pow($number1, $number2);
        }
    }

    /*mile to km
    one mile is equal to 1.609344 km */
    if($operator == "miletokm")
    {
        $calculation = "$number1 * 1.609344 = ";
        $result = $number1 * 1.609344;
    }

    /*km to mile
    one km is equal to 0.62137119 miles */
    if($operator == "kmtomile")
    {
        $calculation = "$number1 * 0.62137119 = ";
        $result = $number1 * 0.62137119;
    }
}

?>
<!--start html-->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My calculator</title>
    <!--link to css file-->
    <link href="css/style.css" type="text/css" rel="stylesheet" />
    <!--website icon-->
    <link href="icon/calculator_icon.png" type="image/png" rel="icon"/>
</head>
<body>
    <!--create one big division including two divisions within this division-->
    <div class="container">
        <div class="result">
        <!--Shows result-->
            <?php
                //result when calculating with "miletokm"
                if($operator == "miletokm")
                {
                    echo $calculation . $result . "KM";
                }
                //result when calculating with "kmtomile"
                else if($operator == "kmtomile")
                {
                    echo $calculation . $result . "Miles";

                }
                //every result with the other operators
                else
                {
                    echo $calculation . $result;

                }
            ?>
        </div>
        <div class="calculator">
            <!--The start of the form-->
            <form action = "index.php" method = "POST">
            <!--unordered list which makes styling with css easier-->
            <ul>
                <li>
                    <!--first input, the "required" attribute makes sure the user types inside the input field-->
                    <label>Number One:</label>
                    <input type="text" name="number1" autocomplete="off" placeholder="1st Number" required/>
                </li>
                <li>
                    <!--operator list-->    
                    <select name="operator" id="operator-list">
                        <option value="addition">+</option>
                        <option value="substraction">-</option>
                        <option value="multiplication">*</option>
                        <option value="division">/</option>
                        <option value="sqroot">√</option>
                        <option value="power">a^b</option>
                        <option value="miletokm">Mile to Km</option>
                        <option value="kmtomile">Km to mile</option>
                    </select>
                </li>
                <!--second input-->
                <li id="second-input">
                    <label>Number Two:</label>
                    <input type="text" name="number2" autocomplete="off" placeholder="2nd Number"/>           
                </li>
                <li>
                    <!--submit and reset button-->
                    <input type="submit" value="Calculate" name="mySubmit" />
                    <input type="reset" value="Reset" name="reset" onclick="location = 'index.php'"/>
                </li>
            </ul>  
            </form>
        </div>
        <!--footer to show who made the calculator-->
        <footer>
            <p>©2018 Ben de Vries</p>
        </footer>
        <!--begin javascript-->
        <script type="text/javascript">

            //create variables that connect with the operator and second input
            let operatorlist = document.getElementById("operator-list")
            let secondInput = document.getElementById("second-input")

            //hide second input
            operatorlist.oninput = function()
            {
                let selectedOperator = this.value;

                if(selectedOperator == "sqroot")
                {
                    secondInput.style.display = "none";
                }
                else if(selectedOperator == "miletokm")
                {
                    secondInput.style.display = "none";
                }
                else if(selectedOperator == "kmtomile")
                {
                    secondInput.style.display = "none";
                }
                else
                {
                    secondInput.style.display = "block";
                }
            }

        </script>
    </div>
</body>
</html>