# Модуль 12 

LICENSE: [MIT](./license.md)

---
Здраствуйте, в данной работе продемострированна работа с функциями, масивами, циклами
1. Необходимо было из данного по умолчанию массива вычленить строки с ключом fullname. В отдельной
функции разбить строки на имя, фамилию и отчество. Так же необходимо, было сделать, склеивание имени, фамилии
отчества, в отдельный массив в отдельной функции. Рзделение сделал с помощью цикла forreach, так как надо было
пройти по масивом нескольких уровней, а для склеивания был сделан с помощью цикла for.
2. В следующем задании было необходимо было сделать функцию. Которая  сокращает имя 
до фамилии и первого инициала. Пробежавшись по предыдущемму массиву вычленил фамилию и первый символ с 
помощью встроенной функции mb_substr.
3. В данном задании необходимо определить пол по имени. Муж=1, жен=-1 неизвстно=0. Пробежавшись циклам 
forreach по массиву, вычленил фамилию, имя, отчество в отдельный массив для удобста. Сделал несколько проверок на окончания
и финальную проверку через switch.
4. Сделал статистику. Создал еще три массива отфильтровав основной массив с гендерами. Тем самым масив муж., жен. и т.д.
определил длинну этих масивов и раздел 100 на количество изначального масива и умножил на новые масивы ,и вывел результат.
5. Совместимость по гендеру. Создал два случайных числа в пределах от 0 до конца длинны масива из сокращенных имен. 
Потом с помощью цикла wile выполнил условие "проверяем с помощью getGenderFromName, что выбранное из Массива ФИО - 
противоположного пола, если нет, то возвращаемся к шагу 4, если да - возвращаем информацию" и за рандомил параметр сомвестимости и
вывел результат.

Пункты все выполнил и работу считаю законченной.

---

GiT logo by GitHub.Own work using: https://github.com/logos, 
license: [CC BY 3.0](https://creativecommons.org/licenses/by/3.0/deed.ru)