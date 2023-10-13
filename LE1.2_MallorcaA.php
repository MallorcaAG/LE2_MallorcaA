<?php

use function PHPSTORM_META\type;

    class Person
    {
        private $fname;
        private $lname;
        private $birthday;
        private $myZodiac;

        function __construct($fn,$ln,$bd)
        {
            $this->fname = $fn;
            $this->lname = $ln;
            $this->birthday = $bd;
            $this->myZodiac = new Zodiac($bd);

            
        }

        function GetFullName()
        {
            $fullname = trim($this->lname) . ", " . trim($this->fname);

            return $fullname;
        }

        function getMyZodiac()
        {
            return $this->myZodiac;
        }

        function GetNameArray()
        {
            $n = trim(strtoupper($this->fname . $this->lname));
            
            $n_arr = str_split($n);
            $n_arr = array_diff($n_arr, [" ",",","."]);
            $n_arr = array_values(array_filter($n_arr));

            return $n_arr;
        }

        

    }

    class Zodiac
    {
        private $file = "Zodiac.txt";
        private $ZodiacSign;
        private $Symbol;
        private $StartDate;
        private $EndDate;

        private $ZodiacSignData;

        function __construct($date = null)
        {
        if($date != null)
        {
            List($yyyy,$mm,$dd) = explode('-', $date);
            
            $mm = $this->getMonth($mm);
            $dd = (int)$dd;
        

            if(file_exists($this->file))
            {
                $data = file($this->file);
                foreach ($data as $line)
                {
                    List($a,$b,$c,$d) = explode(';', $line);
                    List($e,$f) = explode(' ',trim($c));
                    List($j,$k) = explode(' ',trim($d));
                    if($mm == $e)
                    {
                        if($dd >= (int)$f)
                        {
                            $this->ZodiacSign = $a;
                            $this->Symbol = $b;
                            $this->StartDate = $c;
                            $this->EndDate = $d;
                            break;
                        }
                    }
                    else if($mm == $j)
                    {
                        if($dd <= (int)$k)
                        {
                            $this->ZodiacSign = $a;
                            $this->Symbol = $b;
                            $this->StartDate = $c;
                            $this->EndDate = $d;
                            break;
                        }
                    }

                }
            }
            else
            {
                die("Could not find file");
            }
        }
        }

        public static function ComputeZodiacCompatibility($ZodiacSign1, $ZodiacSign2)
        {
            $compatibility_array = array(
                            //   [0,1,2,3,4,5,6,7,8,9,10,11]
            /*Aries*/       array(2,2,2,0,0,0,2,2,2,0, 0, 1),
            /*Leo*/         array(2,2,2,0,0,0,2,2,2,1, 1, 1),
            /*Sagittarius*/ array(2,2,2,0,0,0,2,2,2,1, 1, 1),
            /*Taurus*/      array(0,1,0,2,2,2,0,1,0,2, 2, 2),
            /*Virgo*/       array(0,1,0,2,2,2,0,0,1,2, 2, 1),
            /*Capricorn*/   array(0,1,0,2,2,2,0,1,0,2, 2, 2),
            /*Gemini*/      array(2,2,1,0,1,1,2,2,2,0, 0, 0),
            /*Libra */      array(1,2,2,1,0,0,2,2,2,0, 0, 1),
            /*Aquarius*/    array(2,2,2,0,0,0,2,2,2,0, 1, 1),
            /*Cancer*/      array(0,1,1,2,2,2,0,0,0,2, 2, 2),
            /*Scorpio*/     array(1,1,0,2,2,2,0,0,0,2, 2, 2),
            /*Pisces */     array(1,1,1,2,1,2,0,0,0,2, 2, 2),
            );

            $z1 = Zodiac::getZodiacIndex($ZodiacSign1);
            $z2 = Zodiac::getZodiacIndex($ZodiacSign2);

            $comp = $compatibility_array[$z1][$z2];

            switch ($comp) {
                case 0:
                    return 'Not Favorable Match';
                    break;
                
                case 1:
                    return 'Favorable Match';
                    break;
                    
                default:
                    return 'Great Match';
                    break;
            }
        }

        public function getZodiacSign()
        {
            return $this->ZodiacSign;
        }
        

        function getMonth($monthStr)
        {
            switch ($monthStr) {
                case '01':
                    return 'January';
                    break;
                
                case '02':
                    return 'February';
                    break;

                case '03':
                    return 'March';
                    break;

                case '04':
                    return 'April';
                    break;

                case '05':
                    return 'May';
                    break;

                case '06':
                    return 'June';
                    break;

                case '07':
                    return 'July';
                    break;

                case '08':
                    return 'August';
                    break;

                case '09':
                    return 'September';
                    break;

                case '10':
                    return 'October';
                    break;

                case '11':
                    return 'November';
                    break;

                default:
                    return 'December';
                    break;

            }
        }

        private static function getZodiacIndex($z)
        {
            switch ($z) {
                case 'Aries':
                    return 0;
                    break;
                
                case 'Taurus':
                    return 3;
                    break;

                case 'Gemini':
                    return 6;
                    break;

                case 'Cancer':
                    return 9;
                    break;

                case 'Leo':
                    return 1;
                    break;

                case 'Virgo':
                    return 4;
                    break;

                case 'Libra':
                    return 7;
                    break;

                case 'Scorpio':
                    return 10;
                    break;

                case 'Sagittarius':
                    return 2;
                    break;

                case 'Capricornus':
                    return 5;
                    break;

                case 'Aquarius':
                    return 8;
                    break;

                default:
                    return 11;
                    break;

            }
        }

    }

    class FLAMES
    {
        // $val corresponds with a letter in FLAMES. (F=1, L=2, A=3, M=4, E=5, S=0)
        public static function compute_FLAMES($val)
        {
            switch ($val) {
                case 0:
                    return "Soulmates";
                    break;
                
                case 1:
                    return "Friends";
                    break;
                case 2:
                    return "Lovers";
                    break;
                case 3:
                    return "Anger";
                    break;
                case 4:
                    return "Married";
                    break;
                case 5:
                    return "Engaged";
                    break;
            }
        }

        public static function CountCommonLetters($common_letters, $name)
        {
            $num = 0;
            for ($i=0; $i < sizeof($common_letters); $i++) 
            { 
                $key = $common_letters[$i];
                foreach ($name as $x) 
                {
                    if($key==$x)
                    {
                        $num++;
                    }
                }
            }
            return $num;
        }

        public static function GetCommonLetters($name1_arr,$name2_arr)
        {
            //Gets common letters array
            $common_arr = str_split(implode(array_unique(array_intersect($name1_arr, $name2_arr))));
            //Format array (remove empty elements, white spaces, etc.)
            $common_arr = array_diff($common_arr, [" ",","]);
            $common_arr = array_values(array_filter($common_arr));
            
            return $common_arr;
        }

        public static function DisplayCommonLetters($common)
        {
            for($i=0;$i<sizeof($common);$i++)
            {
                echo"'$common[$i]' ";
            }
        }
    }

/////////////////////////////////////////////////////////////////////////////////////////////////

        // Adds two numbers together        
    function add($num1,$num2)
    {
        return $num1 + $num2;
    }

        // Gets the remainder when divided by 6
    function modulo($val, $div)
    {
        return $val % $div; 
    }

?>