<?php
interface PrepareArray{
    public function getArray();
}

class LuhnAlgo{
    private $preparedArray;

    public function __construct(PrepareArray $prepareArray){
        $this->preparedArray=$prepareArray;
    }

    public function validateNumbers(){
        $validatedNumbers=[];
        $numberArray=$this->preparedArray->getArray();
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
    }
}

class ValidateFromFile implements PrepareArray{
    public function getArray(){
        $numbers=file_get_contents('numbers.txt');
        return explode(',',$numbers);
    }
}





?>
