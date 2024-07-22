<?php
// Arraies----------------------------------------------------------------
/*$array = [
    'a' => 'Mohammad' ,
    'b' => 'Johne' ,
    0 => 'Kaser',
    true => 'Yousef',
    'Mohammad',
    'names' => [
        1 => 'Nazal',
        '0' => 'Kaser',
        1,
    ]
];

echo '<pre>';
print_r($array);
echo '</pre>';*/

//----------------------------------------------------------------------
/*define("ELZERO", 1 );
$a = "Elzero";
$b = "Web";
$c = "School";

echo "$a $b $c " .ELZERO .hello();
echo "<br>";
echo "{$a} {$b} {$c} " .hello() .ELZERO;
echo "<br>";
echo $a . " " .$b . " " .$c . " " .ELZERO . " " .hello();

function hello() {
    echo "Goodbye World! ";
}*/

// 27, 40: Array's Operators - foreach Loops -------------------------------------------------
/*$array1 = [1 => 'a', 2 => 'b', 3 => 'c', 4 => 'd'];
$array2 = [1 => 'e', 2 => 'e', 3 => 'g'];
$arr3 = $array1 + $array2;

echo '<pre>';
print_r($arr3);
echo '</pre>';
echo '<pre>';
print_r($arr3);
echo '</pre>';

foreach( $array1 as $ke => $val ){
    echo $ke . " =>". $val . "<br>";
}*/
// 45: Function's return value------------------------------------------------
/*function getNumber($num1, $num2)
{
    $prizes = ["Apple TV", "IPad", "IPohne", "IPod"];
    $num = $num1 + $num2;
    foreach ($prizes as $index => $prize) {
        if($num < count($prizes)) {
            if ($index == $num) {
            return $prizes[$index];
        }
    } else {
        echo nl2br("Sorry, You lost!
        try Again");
        die();
    }
        
    }
    echo $prizes[$num];
}

print_r(getNumber(0, 0));*/

// 46: Function's default's Values ------------------------------------------------
/*function getData($name, $place = "Private", $age="Not your Busniss"){
    echo " You are {$name} from {$place} and your age is {$age}";
}

getData('Mohammad', age : 31); */
// 47: Function variable Arguments List.
//  func_num_args()
//  func_get_args()
//  func_get_arg(index)
//  Spread Syntax (next function)
/*function calculate(...$nums){
    $res = 0;
    foreach($nums as $key => $value){
        $res += $value;
    }
    echo $res;
    echo "<pre>";
    print_r($nums);
    echo "</pre>";
    echo func_get_arg(6);
}
calculate(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);*/
//https://www.php.net/manual/de/migration56.new-features.php : Splat Operators 
/*const ONE = 1;
const TWO = ONE * 2;

class C
{
    const THREE = TWO + 1;
    const ONE_THIRD = ONE / self::THREE;
    const SENTENCE = 'Der Wert von THREE ist ' . self::THREE;

    public function f($a = ONE + self::THREE)
    {
        return $a;
    }
}

echo (new C)->f() . "\n";
echo C::SENTENCE;

function f($req, $opt = null, ...$params) {
    // $params ist ein Array welches die übrigen Parameter enthält.
    header('Content-type: text/plain');
    printf('$req: %d; $opt: %d; Anzahl Parameter: %d'."\n",
           $req, $opt, count($params));
}

f(1);
f(1, 1);
f(1, 0, 3);
f(1, 2, 3, 4);
f(2, 2, 3, 4, 5);*/
