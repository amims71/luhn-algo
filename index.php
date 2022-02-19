<?php
$numbers=file_get_contents('numbers.txt');
$numberArray=explode(',',$numbers);
$validatedNumbers=[];

foreach($numberArray as $number){
    $digits=str_split($number);
    krsort($digits);

    $sum = 0;
    $isSecond = false;

    foreach ($digits as $digit){
        if ($isSecond) $digit *= 2;
        if ($digit>9) $digit -= 9;
        $sum += $digit;
        $isSecond = !$isSecond;
    }

    if ($sum%10==0) array_push($validatedNumbers,$number);
}
$numbers = implode(',',$validatedNumbers);
file_put_contents('filtered numbers.txt',$numbers);

?>
