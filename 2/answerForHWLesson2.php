<a href="../">Вернуться на главную страницу</a><br><br>

<?php

echo "--- 1 задание --- <br>
Объявить две целочисленные переменные $a и $b и задать им произвольные начальные
значения. Затем написать скрипт, который работает по следующему принципу:
a. если $a и $b положительные, вывести их разность;
b. если $а и $b отрицательные, вывести их произведение;
c. если $а и $b разных знаков, вывести их сумму;
ноль можно считать положительным числом.";

$a = 4;
$b = 9;

if ( $a >= 0 and $b >= 0 ) {
	echo "a и b положительные, выводим разность a - b <br>";
	echo $a - $b;
}
else if ( $a < 0 and $b < 0 ) {
	echo "a и b отрицательные, выводим произведение <br>";
	echo $a * $b;
}
else {
	echo "a и b разных знаков, выводим сумму <br>";
	echo $a + $b;
}

echo "<br>--- 2 задание --- <br>
Присвоить переменной $а значение в промежутке [0..10]. С помощью оператора
switch организовать вывод чисел от $a до 10.<br>";

$a = 4;
switch ($a) {
	case 0:
		echo $a++ . '<br>';
	case 1:
		echo $a++ . '<br>';
	case 2:
		echo $a++ . '<br>';
	case 3:
		echo $a++ . '<br>';
	case 4:
		echo $a++ . '<br>';
	case 5:
		echo $a++ . '<br>';
	case 6:
		echo $a++ . '<br>';
	case 7:
		echo $a++ . '<br>';
	case 8:
		echo $a++ . '<br>';
	case 9:
		echo $a++ . '<br>';
	case 10:
		echo 10 . '<br>';	
};



// for ($x=3; $x > 0; $x--) {
// 	switch ($x) {
// 		case :
// 			echo $x;
// 		case '2':
// 			echo $x;
// 		case '3':
// 			echo $x;
// 	}
// }

echo "<br>--- 3 задание --- <br>
Реализовать операции сложени и деления в виде функций с двумя параметрами.<br>";

function sum( $a, $b ) {
	return $a + $b;
};

function del( $a, $b ) {
	return $a / $b;
};

echo sum(2,3) . "<br>";
echo del(6,3) . "<br>";


echo "<br>--- 4 задание --- <br>
Реализовать функцию с тремя параметрами: function mathOperation($arg1, $arg2, $operation),
где $arg1, $arg2 – значения аргументов, $operation – строка с названием операции. В
зависимости от переданного значения операции выполнить одну из арифметических
операций (использовать функции из пункта 3) и вернуть полученное значение (использовать
switch).<br>";

function mathOperation($arg1, $arg2, $operation) {
	switch ($operation) {
		case 'sum':
			echo sum($arg1, $arg2);
			break;
		case 'del':
			echo del($arg1, $arg2);
			break;
	}
}

echo mathOperation(9,3, del);

echo "<br>--- 6 задание --- <br>
Организовать функцию возведения числа в степень. Формат: function power($val, $pow), где $val – заданное число, $pow – степень.<br>";

function power($val, $pow) {
	for ($result=1; $pow > 0; $pow--) {
		$result = $result * $val; 
	}
	return $result;
};

echo power(2,4);

echo "<br>--- 7 задание --- <br>
Написать функцию, которая вычисляет текущее время и возвращает его в формате с правильными склонениями<br><br>";

$todayHour = date("H");
$todayMinut = date("i");

switch ($todayHour) {
	case '1': case '21':
		$hour = "час";
		break;
	case '2': case '3': case '4': case '22': case '23':
		$hour = "часа";
	default:
		$hour ="часов";
		break;
}

switch ($todayMinut) {
	case '1': case '21': case '31': case '41': case '51':
		$minut = "минута";
		break;
	case '2': case '3': case '4':case '22': case '23': case '24': case '32': case '33': case '34': case '42': case '43': 
	case '44': case '52': case '53': case '54':
		$minut = "минуты";
		break;
	default:
		$minut = "минут";
		break;
}

echo "Сейчас " . $todayHour . " " . $hour . " ";
echo $todayMinut . " " . $minut . " ";

?>