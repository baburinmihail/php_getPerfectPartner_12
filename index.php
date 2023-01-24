<!DOCTYPE html>
<html>
 <head>
   <title>!DOCTYPE</title>
   <meta charset="utf-8">
 </head>
 <body>
 <?php
 /*
 echo '<pre>';
 echo var_export($person);
 echo '</pre>';
 */

 $floor = 0;
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
 //сама функция склеивания
 function getFullnameFromParts($stroka1,$stroka2,$stroka3){
     $my_fullname = $stroka1." ".$stroka2." ".$stroka3;
     return $my_fullname;
 }

 //Функция разбития строки на три элемента для массива surname,name,patronomyc
 function getPartsFromFullname($fullNameFunction){

         $pieces = explode(" ", $fullNameFunction);
 //        $personality[$i]['surname'] = $pieces[0];
 //        $personality[$i]['name'] = $pieces[1];
 //        $personality[$i]['patronomyc'] = $pieces[2];

     echo '<pre>';
     echo var_export($pieces);
     echo '</pre>';
     return $pieces;
 }

 //функция сокращения имени
 function getShortName ($fullNameFunction){

     $pieces = explode(" ", $fullNameFunction);

//   $pieces[0];
     $pieces[1] = mb_substr(( $pieces[1]),0,1,"UTF-8");
     $shortName = $pieces[0]." ". $pieces[1];

     return $shortName;

 }

 //функция определения пола
 function getGenderFromName($fullNameFunction){

      $floor = 0;
      $pieces = explode(" ", $fullNameFunction);

//      $pieces[$key][0] = $personality[$key]['surname'];
//      $pieces[$key][1] = $personality[$key]['name'];
//      $pieces[$key][2] = $personality[$key]['patronomyc'];

      //проверка на фамилии
        if ( (substr( ( $pieces[0]), -4) ) == "ва" ){
            $floor--;
        }elseif( ( (substr( ( $pieces[0]), -2) ) == "в" ) ){
            $floor++;
        }else{}

      //проверка на имени
        if ( (substr( ( $pieces[1]), -2) ) == "а" ){
            $floor--;
        }elseif(  ( (substr( ( $pieces[1]), -2) ) == "й" ) ||  ( (substr( ( $pieces[1]), -2) ) == "н" )  ){
            $floor++;
        }else{}


        //проверка на отчество
        if ((substr( ( $pieces[2]), -6) ) == "вна" ){
            $floor--;
        }elseif(  ((substr( ( $pieces[2]), -4) ) == "ич" )  ){
            $floor++;
        }else{}


        //вычисление пола
        switch ($floor){
            case ( $floor >= 0 ):
                //муж
                $floor = 1;
                break;
            case ( $floor <= 0 ):
                //жен
                $floor = -1;
                break;
            default :
                $floor = 0;
         }

     return $floor;
 }

 //функция статистики
 function getGenderDescription($array_floor)
 {
     $array_floor;
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


     $statistic = [$all_man , $all_gerl , $all_ono];

     echo "Гендерный состав аудитории:<br>";
     echo "---------------------------<br>";
     echo "Мужчины - $all_man%<br>";
     echo "Женщины  - $all_gerl%<br>";
     echo "Не удалось определить - $all_ono%<br>";
 }


 //функция идеальной пары
 function getPerfectPartner($surname,$name,$patronomyc,$example_persons_array)
 {
     //склеил
     $love_fullName_person1 = getFullnameFromParts($surname,$name,$patronomyc);

     //сократил
     $sokratil_love_fullName_person1 = getShortName($love_fullName_person1);

     //определяю пол первого человека
     $gender_poName_person1 = getGenderFromName($love_fullName_person1);

     ////////////////////////////////////////////////////
     //перебераю второй масив , вычленяю второго человека
     foreach ($example_persons_array as $key => $array) {
         //присвоил в отдельный масив полные имена
         $myString[$key] = $array['fullname'];
         // разбил на куски
         $pieces = explode(" ", $myString[$key]);
         $person[$key]['surname'] = $pieces[0];
         $person[$key]['name'] = $pieces[1];
         $person[$key]['patronomyc'] = $pieces[2];
         //склеил
         $my_fullname[$key] = $pieces[$key][0] . " " . $pieces[$key][1] . " " . $pieces[$key][2];
         //сократил
         $shortSurname = $person[$key]['surname'];
         $shortN = mb_substr(($person[$key]['name']), 0, 1, "UTF-8");
         $shortSurnameN[$key] = $shortSurname . " " . $shortN;
     }
     //строю масив полов для второго возможного человека
     foreach ($person as $key => $array) {

         $floor = 0;

         $pieces[$key][0] = $person[$key]['surname'];
         $pieces[$key][1] = $person[$key]['name'];
         $pieces[$key][2] = $person[$key]['patronomyc'];

         //проверка на фамилии
         if ((substr(($pieces[$key][0]), -4)) == "ва") {
             $floor--;
         } elseif (((substr(($pieces[$key][0]), -2)) == "в")) {
             $floor++;
         } else {
         }

         //проверка на имени
         if ((substr(($pieces[$key][1]), -2)) == "а") {
             $floor--;
         } elseif (((substr(($pieces[$key][1]), -2)) == "й") || ((substr(($pieces[$key][1]), -2)) == "н")) {
             $floor++;
         } else {
         }

         //проверка на отчество
         if ((substr(($pieces[$key][2]), -6)) == "вна") {
             $floor--;
         } elseif (((substr(($pieces[$key][2]), -4)) == "ич")) {
             $floor++;
         } else {
         }

         //вычисление пола
         switch ($floor) {
             case ($floor >= 0):
                 $floor = 1;
                 break;
             case ($floor <= 0):
                 $floor = -1;
                 break;
             default :
                 $floor = 0;
         }
         $array_floor[$key] = $floor;
     }

     /////////////////////////////////////////////


     //расчет идеальной пары
     $randon_number2 =  (rand(0, (count($shortSurnameN)-1)));

     //подбор идеальной пары через цикл. Первый человек статичный, второй динамический
     while (($gender_poName_person1 == $array_floor[$randon_number2]) || ($array_floor[$randon_number2] == 0) ){
         $randon_number2 =  (rand(0, (count($shortSurnameN)-1)));
     }

     $chose_people1 = $sokratil_love_fullName_person1;
     $chose_people2 = $shortSurnameN[$randon_number2];

     $number1 = 5000;
     $number2 = 10000;
     $prochent = (rand($number1, $number2) )/100;

     echo "$chose_people1 + $chose_people2 = <br>";
     echo "Идеально на $prochent%<br>";
     echo "<br><br><br><br>";

 }


 //разбиваю изначальный масив на части (начало программы)
     foreach ($example_persons_array as $key => $array) {

         //присвоил в отдельный масив полные имена
         $myString[$key] = $array['fullname'];
         // разбил на куски
         $pieces = explode(" ", $myString[$key]);

         //вызов функции склеивания
         $fullNameFunction = getFullnameFromParts($pieces[0], $pieces[1], $pieces[2]);
         echo $fullNameFunction."<br>";

         //вызов функции разбиения
         $partsFromFullname  = getPartsFromFullname ($fullNameFunction);

         //вызов функции сокращенного имени
         $shortName = getShortName($fullNameFunction);
         echo "$shortName <br>";

         //вызов функции определения пола
         $genderFromName = getGenderFromName($fullNameFunction);
         echo "пол данного субъекта: $genderFromName <br><br>";

         //масив полов для статы
         $array_floor[$key] = $genderFromName;

         //масив масивов имен с сокращенными именами
         $personality[$key] = $partsFromFullname;

         //вызов функции идеальной пары
         getPerfectPartner($personality[$key][0],$personality[$key][1],$personality[$key][2],$example_persons_array);

     }

        //вызов функции определения пола
        getGenderDescription($array_floor);

 ?>
 <br>
 <br>
 <br>
 <br>
 <br>
 </body>
</html>