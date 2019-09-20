<a href="../">Вернуться на главную страницу</a><br>	

<p><b>1. </b>С помощью цикла while вывести все числа в промежутке от 0 до 100, которые делятся на 3 без
остатка. </p>

<?
$i = 1;
$n = 100;
while ($i <= $n) {
	if ( $i % 3 == 0)	{
		echo $i++ . ' ';	
	}
	else $i++;
};
?>

<p><b>2.</b> С помощью цикла do…while написать функцию для вывода чисел от 0 до 10, чтобы результат
выглядел так:
<pre>
0 – это ноль.
1 – нечетное число.
2 – четное число.
3 – нечетное число.
…
10 – четное число.
</pre></p>

<?
$i = 0;
$n = 10;
do {
	if ($i == 0) {
		echo $i++ . ' - это ноль. <br>';
	}
	elseif ($i % 2 == 0) {
		echo $i++ . ' - это четное число. <br>';
	}
	elseif ($i % 2 == 1) {
		echo $i++ . ' - это нечетное число. <br>';
	}
} while ( $i <= $n);
?>

<p><b>3</b>. Объявить массив, в котором в качестве ключей будут использоваться названия областей, а в
качестве значений – массивы с названиями городов из соответствующей области.
Вывести в цикле значения массива, чтобы результат был таким:
<pre>
Московская область:
Москва, Зеленоград, Клин
Ленинградская область:
Санкт-Петербург, Всеволожск, Павловск, Кронштадт
</pre></p>

<?
$town = [];
$town['Московская область'] = ['Москва', 'Зеленоград', 'Клин'];
$town['Ленинградская область'] = ['Санкт-Петербург', 'Всеволожск', 'Павловск', 'Кронштадт'];

foreach ($town as $key => $value) { 
        echo $key . ': <br>';
        $city = implode(", ", $value);
		echo $city . '<br>';
};
?>

<p><b>4. </b> Объявить массив, индексами которого являются буквы русского языка, а значениями –
соответствующие латинские буквосочетания (‘а’=> ’a’, ‘б’ => ‘b’, ‘в’ => ‘v’, ‘г’ => ‘g’, …, ‘э’ => ‘e’,
‘ю’ => ‘yu’, ‘я’ => ‘ya’). </p>
<p>Написать функцию транслитерации строк.</p>

<?
function transliteration($string) {
	$words = [
		'а' => 'a',
		'б' => 'b', 
		'в' => 'v', 
		'г' => 'g',
		'д' => 'd',
		'е' => 'e',
		'ё' => 'e',
		'ж' => 'zh',
		'з' => 'z',
		'и' => 'i',
		'й' => 'y',
		'к' => 'k',
		'л' => 'l', 
		'м' => 'm',
		'н' => 'n',
		'о' => 'o',
		'п' => 'p', 
		'р' => 'r',
		'с' => 's',
		'т' => 't',
		'у' => 'u',
		'ф' => 'f',
		'х' => 'kh',
		'ц' => 'ts',
		'ч' => 'ch',
		'ш' => 'sh',
		'щ' => 'shch',
		'ь' => '',
		'ы' => 'y',
		'Ъ' => '',
		'э' => 'e',
		'ю' => 'yu', 
		'я' => 'ya',
		' ' => ' '
	];

	$chars = preg_split('//u', $string, NULL, PREG_SPLIT_NO_EMPTY);	// разбиваем слово на массив

	foreach ($chars as $key => $value) { 							// проходим по всему массиву из строки
	    if (array_key_exists($value, $words)) {						// если найден ключ, то
		 	echo $words[$value];									// выводим значение массива по этому ключу
		};
	};
};

$str = 'сиамский кот';								// строка на русском языке
echo $str . '<br>';									// вывод строки на русском языке
transliteration($str);								// строка в транслитерации

?>

<p><b>5.</b> Написать функцию, которая заменяет в строке пробелы на подчеркивания и возвращает видоизмененную строчку. </p>
<?

function changeSpace($string) {
	$stringArray = explode(" ", $string);
	$strNew = implode("_", $stringArray);
	print_r($strNew);
};

$str = 'сиамский кот пришёл к бабушке за куском пирога';	// заданная строка 
echo $str . '<br>';									// вывод исходной строки
changeSpace($str);									// вывод строки с подчёркиванием вместо пробелов
?>

 
<p></b>7.* </b> Вывести с помощью цикла for числа от 0 до 9, НЕ используя тело цикла. <br>
То есть выглядеть должно так: for (…){ // здесь пусто}</p>

<?
for ($i = 0; $i <= 9; print_r($i++)) {
}
?>


<p><b>9.*</b> Объединить две ранее написанные функции в одну, которая получает строку на русском языке, производит транслитерацию
и замену пробелов на подчеркивания (аналогичная задача решается при конструировании url-адресов на основе названия статьи в блогах).</p>

<?

function transliterationNew($string) {
	$wordsNew = [
		'а' => 'a',
		'б' => 'b', 
		'в' => 'v', 
		'г' => 'g',
		'д' => 'd',
		'е' => 'e',
		'ё' => 'e',
		'ж' => 'zh',
		'з' => 'z',
		'и' => 'i',
		'й' => 'y',
		'к' => 'k',
		'л' => 'l', 
		'м' => 'm',
		'н' => 'n',
		'о' => 'o',
		'п' => 'p', 
		'р' => 'r',
		'с' => 's',
		'т' => 't',
		'у' => 'u',
		'ф' => 'f',
		'х' => 'kh',
		'ц' => 'ts',
		'ч' => 'ch',
		'ш' => 'sh',
		'щ' => 'shch',
		'ь' => '',
		'ы' => 'y',
		'Ъ' => '',
		'э' => 'e',
		'ю' => 'yu', 
		'я' => 'ya',
		' ' => '_'
	];

	$chars = preg_split('//u', $string, NULL, PREG_SPLIT_NO_EMPTY);	// разбиваем слово на массив

	foreach ($chars as $key => $value) { 							// проходим по всему массиву из строки
	    if (array_key_exists($value, $wordsNew)) {						// если найден ключ, то
		 	echo $wordsNew[$value];									// выводим значение массива по этому ключу
		};
	};
};

$str = 'сиамский кот пришёл к бабушке за куском пирога';				// исходная строка 
echo $str . '<br>';											// вывод исходной строки
transliterationNew($str);									// строка в транслитерации c подчеркиванием

?>