<?php

/*
echo '<pre>';
echo var_export($person);
echo '</pre>';
*/

$personality=[];
$person=[];
$my_fullname=[];
$shortName=[];
$floor = 0;
$array_floor = [];
$example_persons_array = [
    [
        'fullname' => 'Иванов Иван Иванович',
        'job' => 'tester',
    ],
    [
        'fullname' => 'Степанова Наталья Степановна',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Пащенко Владимир Александрович',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Громов Александр Иванович',
        'job' => 'fullstack-developer',
    ],
    [
        'fullname' => 'Славин Семён Сергеевич',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Цой Владимир Антонович',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Быстрая Юлия Сергеевна',
        'job' => 'PR-manager',
    ],
    [
        'fullname' => 'Шматко Антонина Сергеевна',
        'job' => 'HR-manager',
    ],
    [
        'fullname' => 'аль-Хорезми Мухаммад ибн-Муса',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Бардо Жаклин Фёдоровна',
        'job' => 'android-developer',
    ],
    [
        'fullname' => 'Шварцнегер Арнольд Густавович',
        'job' => 'babysitter',
    ],
];

//разбиваю изначальный масив на части и извлекаю surname,name,patronomyc
function person (){
    global $example_persons_array;
    global $person;
    foreach ($example_persons_array as $key => $array) {
        //присвоил в отдельный масив полные имена
        $myString[$key] = $array['fullname'];
        // разбил на куски
        $pieces = explode(" ", $myString[$key]);
        $person[$key]['surname'] = $pieces[0];
        $person[$key]['name'] = $pieces[1];
        $person[$key]['patronomyc'] = $pieces[2];
    }
    return $person;
}
person ();


//собираю строки в месте
function getFullnameFromParts (){
    global $person;
    global $my_fullname;
    $pieces = [];

    foreach ($person as $key => $array){
        $pieces[$key][0] = $person[$key]['surname'];
        $pieces[$key][1] = $person[$key]['name'];
        $pieces[$key][2] = $person[$key]['patronomyc'];
        $my_fullname[$key] = $pieces[$key][0]." ".$pieces[$key][1]." ".$pieces[$key][2];
    }

}


//разбиваю строку на три строки surname,name,patronomyc(пункт из задания)
function getPartsFromFullname (){
    getFullnameFromParts ();
    global $my_fullname;
    global $personality;

    for ($i = 0; $i < count($my_fullname); $i++){
        $pieces = explode(" ", $my_fullname[$i]);
        $personality[$i]['surname'] = $pieces[0];
        $personality[$i]['name'] = $pieces[1];
        $personality[$i]['patronomyc'] = $pieces[2];
    }

    return $personality;
}
getPartsFromFullname ();


//функция сокращения имени
function getShortName (){
    global $shortName;
    global $personality;
    for ($i = 0; $i < count($personality); $i++){
        $pieces[0] = $personality[$i]['surname'];
        $pieces[1] =mb_substr(( $personality[$i]['name']),0,1,"UTF-8");
        $shortName[$i] = $pieces[0]." ". $pieces[1];
    }
}
getShortName();



//функция определения пола
function getGenderFromName(){
    global $personality;
    global $floor;
    global $array_floor;

    foreach ($personality as $key => $array){

        $floor = 0;

        $pieces[$key][0] = $personality[$key]['surname'];
        $pieces[$key][1] = $personality[$key]['name'];
        $pieces[$key][2] = $personality[$key]['patronomyc'];

        //проверка на фамилии
        if ( (substr( ( $pieces[$key][0]), -4) ) == "ва" ){
            $floor--;
        }elseif( ( (substr( ( $pieces[$key][0]), -2) ) == "в" ) ){
            $floor++;
        }else{}


        //проверка на имени
        if ( (substr( ( $pieces[$key][1]), -2) ) == "а" ){
            $floor--;
        }elseif(  ( (substr( ( $pieces[$key][1]), -2) ) == "й" ) ||  ( (substr( ( $pieces[$key][1]), -2) ) == "н" )  ){
            $floor++;
        }else{}


        //проверка на отчество
        if ((substr( ( $pieces[$key][2]), -6) ) == "вна" ){
            $floor--;
        }elseif(  ((substr( ( $pieces[$key][2]), -4) ) == "ич" )  ){
            $floor++;
        }else{}


        //вычисление пола
        switch ($floor){
            case ( $floor >= 0 ):
                $floor = 1;
                break;
            case ( $floor <= 0 ):
                $floor = -1;
                break;
            default :
                $floor = 0;
        }

        $array_floor[$key] = $floor;
    }
}

getGenderFromName();



//функция статистики
function getGenderDescription()
{
    global $array_floor;
    //Фильтры для статистики
//мужицкий фильтр
    function filterArrayMan($value)
    {
        return ($value == 1);
    }

    $filteredArrayMan = array_filter($array_floor, 'filterArrayMan');
//женский
    function filterArrayGerl($value)
    {
        return ($value == -1);
    }

    $filteredArrayGerl = array_filter($array_floor, 'filterArrayGerl');

//третий фильтр
    function filterArrayOno($value)
    {
        return ($value == 0);
    }

    $filteredArrayOno = array_filter($array_floor, 'filterArrayOno');

//сама статистика
    $all_man = round(((100 / (count($array_floor))) * count($filteredArrayMan)), 1);
    $all_gerl = round(((100 / (count($array_floor))) * count($filteredArrayGerl)), 1);
    $all_ono = round(((100 / (count($array_floor))) * count($filteredArrayOno)), 1);


    echo $all_man . "<br>";
    echo $all_gerl . "<br>";
    echo $all_ono . "<br>";


    echo '<pre>';
    echo var_export($filteredArrayMan);
    echo '</pre>';

    echo '<pre>';
    echo var_export($filteredArrayGerl);
    echo '</pre>';

    echo '<pre>';
    echo var_export($filteredArrayOno);
    echo '</pre>';

}

getGenderDescription();


function getPerfectPartner(){
   global $shortName;
   global $array_floor;

   $randon_number1 =  (rand(0, (count($shortName)-1)));
   $randon_number2 =  (rand(0, (count($shortName)-1)));

   echo '$randon_number1='.$randon_number1."<br>";
   echo '$randon_number2='.$randon_number2."<br>";
   echo '$array_floor[$randon_number1]='.$array_floor[$randon_number1]."<br>";
   echo '$array_floor[$randon_number2]='.$array_floor[$randon_number2]."<br>";

   //подбор идеальной пары через цикл
   while (($array_floor[$randon_number1] == $array_floor[$randon_number2]) || ($array_floor[$randon_number1] == 0) || ($array_floor[$randon_number2] == 0) ){
       $randon_number1 =  (rand(0, (count($shortName)-1)));
       $randon_number2 =  (rand(0, (count($shortName)-1)));
   }

    $chose_people1 = $shortName[$randon_number1];
    $chose_people2 = $shortName[$randon_number2];


    $number1 = 5000;
    $number2 = 10000;
    $prochent = (rand($number1, $number2) )/100;


    echo "$chose_people1 + $chose_people2 = Идеальность на .$prochent".'%';

}
getPerfectPartner();


//масив полных имен
echo '<pre>';
echo var_export($my_fullname);
echo '</pre>';
//масив разделенных имен
echo '<pre>';
echo var_export($personality);
echo '</pre>';
//масив сокращенных имен
echo '<pre>';
echo var_export($shortName);
echo '</pre>';
//масив полов
echo '<pre>';
echo var_export($array_floor);
echo '</pre>';



?>
<!DOCTYPE html>
<html>
 <head>
   <title>!DOCTYPE</title>
   <meta charset="utf-8">
 </head>
 <body>
  <p>Разум — это Будда, а прекращение умозрительного мышления — это путь.
  Перестав мыслить понятиями и размышлять о путях существования и небытия,
  о душе и плоти, о пассивном и активном и о других подобных вещах,
  начинаешь осознавать, что разум — это Будда,
  что Будда — это сущность разума,
  и что разум подобен бесконечности.</p>


 </body>
</html>