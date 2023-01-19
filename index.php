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
 //разбиваю изначальный масив на части и извлекаю surname,name,patronomyc
 function person (){
     global $example_persons_array;
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
 function getFullnameFromParts ($dataSurnameNamePatronomyc){
     $person = $dataSurnameNamePatronomyc;
     $pieces = [];
     foreach ($person as $key => $array){
         $pieces[$key][0] = $person[$key]['surname'];
         $pieces[$key][1] = $person[$key]['name'];
         $pieces[$key][2] = $person[$key]['patronomyc'];
         $my_fullname[$key] = $pieces[$key][0]." ".$pieces[$key][1]." ".$pieces[$key][2];
     }
     echo '<pre>';
     echo var_export($my_fullname);
     echo '</pre>';
     return $my_fullname;


 }


 //разбиваю строку на три строки surname,name,patronomyc(пункт из задания)
 function getPartsFromFullname ($getFullnameFromParts1){
     $my_fullname = $getFullnameFromParts1;

     for ($i = 0; $i < count($my_fullname); $i++){
         $pieces = explode(" ", $my_fullname[$i]);
         $personality[$i]['surname'] = $pieces[0];
         $personality[$i]['name'] = $pieces[1];
         $personality[$i]['patronomyc'] = $pieces[2];
     }
     echo '<pre>';
     echo var_export($personality);
     echo '</pre>';
     return $personality;

 }



 //функция сокращения имени
 function getShortName ($personality){
     $personality;
     for ($i = 0; $i < count($personality); $i++){

         $pieces[0] = $personality[$i]['surname'];
         $pieces[1] = mb_substr(( $personality[$i]['name']),0,1,"UTF-8");
         $shortName[$i] = $pieces[0]." ". $pieces[1];
     }
     echo '<pre>';
     echo var_export($shortName);
     echo '</pre>';
     return $shortName;
 }





  //функция определения пола
  function getGenderFromName($personality){

      $personality;

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
      echo '<pre>';
      echo var_export($array_floor);
      echo '</pre>';
      return $array_floor;
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

function getPerfectPartner($shortName, $array_floor){

    $shortName;
    $array_floor;

    $randon_number1 =  (rand(0, (count($shortName)-1)));
    $randon_number2 =  (rand(0, (count($shortName)-1)));

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

    echo "$chose_people1 + $chose_people2 = <br>";
    echo "Идеально на $prochent%";

}


?>
<!--//////////////////////////////////////////////////////////////////////////////-->
<h2>Массив с собранными именим и т.д</h2>
 <?php
 $fullNameFunction = getFullnameFromParts(person());
 ?>
 <h2>Массив с разделенными именами и т.д</h2>
  <?php
 $nameAndFunction = getPartsFromFullname ($fullNameFunction);
  ?>
 <h2>Массив с сокращенными фамилиями и инициалами</h2>
 <?php
 $shortName = getShortName($nameAndFunction);
 ?>
 <h2>Функция определения пола</h2>
 <?php
 $manOrGerl = getGenderFromName($nameAndFunction);
 ?>
 <h2>Статистика</h2>
 <?php
 getGenderDescription($manOrGerl);
 ?>
 <h2>Совместимость</h2>
 <?php
 getPerfectPartner($shortName, $manOrGerl);
 ?>
 <br>
 <br>
 <br>
 <br>
 <br>
 </body>
</html>