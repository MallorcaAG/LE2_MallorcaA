<!-- 
    Name: Mallorca, Angelo Gabriel
    Date: 09/09/2023
    Lab Exercise #1

    1 Intelligent naming of variables and use of comment                          /10
    2 Layout and Design of Screen                                                 /30
    3 Correct computation and display of output                                   /20
    4 Intelligent use of conditionals, loops, operators, and functions            /30
    5 Correct filename and followed instructions                                  /10
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FLAMES Form</title>
    <style>
        body
        {
            margin: 0; 
            background-image: linear-gradient(white,magenta,white); 
            background-attachment: fixed, scroll;
            background-position: center, left;
            background-repeat: no-repeat, repeat;
            background-size: cover;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12pt;
        }
        header 
        {
            border-radius: 0px 0px 100px 100px;
            background-image: linear-gradient(white,white,white,rgba(255,255,255,0));
            padding: 20px;
            padding-bottom: 70px;
            text-align: center;
        }
        section
        {
        padding: 20px;
        text-align: center;
        background-image: linear-gradient(rgba(255, 255, 255,0),rgba(255, 186, 255,1),
                                            rgba(255, 186, 255,1),rgba(255,255,255,0)); 
        }
        h3
        {
            color: red;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <br />
        <h1 style="color:rgb(230, 47, 47);margin-top: 25px; display: inline;">FLAMES CALCULATOR</h1>
        <h4> F - Friends, L - Lovers, A - Anger, M - Married, E - Engaged, S - Soulmates </h4>
    </header>

    <!-- Body -->
    <section>
        <form action="index.php" method="post">
            <label>Your Name :</label><br />
            <label for="P1firstname">First name</label><input type="text" name="P1firstname" required><br />
            <label for="P1lastname">Last name</label><input type="text" name="P1lastname" required><br />
            <label>Your birthdate</label><input type="date" name="P1bday" required><br />      
            <br />
            <label>Crush's Name:</label><br />
            <label for="P2firstname">First name</label> <input type="text" name="P2firstname" required><br />
            <label for="P2lastname">Last name</label> <input type="text" name="P2lastname" required><br />
            <label>Crush's birthdate</label><input type="date" name="P2bday" required><br /> 
            <br />
            <input type="submit" value="Submit" >
        </form> 
    </section>

    <!-- PHP output -->
    <section>
        <?php
        require 'LE1.2_MallorcaA.php';
            
        if(isset($_POST["P1firstname"], $_POST["P1firstname"], $_POST["P2firstname"], $_POST["P2firstname"]
               , $_POST["P1bday"], $_POST["P2bday"]))  //Blocks rest of code from running if nothing submitted
        {
            //Create Person object
            $P1 = new Person($_POST["P1firstname"],$_POST["P1lastname"],$_POST["P1bday"]);
            $P2 = new Person($_POST["P2firstname"],$_POST["P2lastname"],$_POST["P2bday"]);

            $arr1 = $P1->GetNameArray();
            $arr2 = $P2->GetNameArray();

            $common_arr = FLAMES::GetCommonLetters($arr1,$arr2);

            $num1 = FLAMES::CountCommonLetters($common_arr,$arr1);
            $num2 = FLAMES::CountCommonLetters($common_arr,$arr2);

            $total = modulo(add($num1,$num2),6);
            $Flames_compatible = FLAMES::compute_FLAMES($total);

            $P1Zodiac = $P1->getMyZodiac()->getZodiacSign();
            $P2Zodiac = $P2->getMyZodiac()->getZodiacSign();

            $Zodiac_compatible = Zodiac::ComputeZodiacCompatibility($P1Zodiac,$P2Zodiac);
        
            if($arr1!=null && $arr2!=null && $common_arr!=null &&$Flames_compatible!=null&&$Zodiac_compatible!=null)
            {
            //Display output
                //Displays if input is not empty
                echo"<br> <b>RESULT:<br> ";
                echo "{$P1->GetFullName()} <em><u>({$P1Zodiac}</u>)</em> and {$P2->GetFullName()} <em><u>({$P2Zodiac}</u>)</em>";
                echo " are <h3>{$Flames_compatible}</h3> and a ";
                echo "<h3>{$Zodiac_compatible}</h3></b><br><br>";
                echo"Note: Their common letters are: ";
                FLAMES::DisplayCommonLetters($common_arr);
                echo"<br>{$P1->GetFullName()} has {$num1} common letters, and ";
                echo"{$P2->GetFullName()} has {$num2} common letters<br>";
                echo"Their total (modulo 6) is {$total}; hence <b>{$Flames_compatible}</b><br /><br/>";
                echo"Refer to the chart below for their zodiac compatibility:<br/>";
                echo "<img src=\"zodiacchart.png\" alt=\"Zodiac Compatibility Chart\"><br/>";
                echo "{$P1->GetFullName()} (Column) is compared to {$P2->GetFullName()} (Row); hence <b>{$Zodiac_compatible}</b><br /><br/>";
                
            }
        }

        ?>
    </section>
    <footer></footer>
    <br />
    <br />
</body>
</html>
