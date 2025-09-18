# Operatory

-------------

1. [Operatory arytmetyczne](#operatory-arytmetyczne)
2. [Operatory inkrementacji i dekrementacji](#operatory-inkrementacji-i-dekrementacji)
3. [Operatory przypisania, ciągu](#operatory-przypisania-ciągu)
4. [Operatory porównania](#operatory-porównania)
5. [Operatory logiczne](#operatory-logiczne)
6. [Operator warunkowy](#operator-warunkowy)

-------------

## Operatory arytmetyczne

- `+` - dodawanie
- `-` - odejmowanie
- `*` - mnożenie
- `/` - dzielenie
- `%` - reszta z dzielenia
- `**` - potęgowanie

```php
$dodawanie = 5 + 5;
$odejmowanie = 5 - 4;
$mnożenie = 5 * 5;
$dzielenie = 10 / 5;
$resztaZDzielenia = 11 % 5;
$potegowanie = 2 ** 3;

echo "Wynik dodawania: {$dodawanie}" . PHP_EOL;
echo "Wynik odejmowania: {$odejmowanie}" . PHP_EOL;
echo "Wynik mnożenia: {$mnożenie}" . PHP_EOL;
echo "Wynik dzielenia: {$dzielenie}" . PHP_EOL;
echo "Reszta z dzielenia: {$resztaZDzielenia}" . PHP_EOL;
echo "Wynik potegowania: {$potegowanie}" . PHP_EOL;
```

-------------

## Operatory inkrementacji i dekrementacji

- `++` - inkrementacja
    - `$variable++` - post-inkrementacja
    - `++$variable` - pre-inkrementacja
- `--` - dekrementacja
    - `$variable--` - post-dekrementacja
    - `--$variable` - pre-inkrementacja

```php
$postInkrementacja = 5;
echo "Zmienna ma wartość: " . $postInkrementacja++ . PHP_EOL;

$preInkrementacja = 5;
echo "Zmienna ma wartość: " . ++$preInkrementacja . PHP_EOL;

$postDekrementacja = 5;
echo "Zmienna ma wartość: " . $postDekrementacja-- . PHP_EOL;

$preDekrementacja = 5;
echo "Zmienna ma wartość: " . --$preDekrementacja . PHP_EOL;
```

-------------

## Operatory przypisania, ciągu

- `=` - operator przypisania `$variable = 5;`
- `+=` - operator przypisania z dodawaniem
- `-=` - operator przypisania z odejmowaniem
- `*=` - operator przypisania z mnożeniem
- `/=` - operator przypisania z dzieleniem
- `.=` - operator ciągu


```php
$variable = 5; // operator przypisania
echo "operator przypisania: {$variable}" . PHP_EOL;

$variable += 5; // $variable = $variable + 5;
echo "operator przypisania z dodawaniem: {$variable}" . PHP_EOL;

$variable -= 5; // $variable = $variable - 5;
echo "operator przypisania z odejmowaniem: {$variable}" . PHP_EOL;

$variable *= 2; // $variable = $variable * 5;
echo "operator przypisania z mnożeniem: {$variable}" . PHP_EOL;

$text = "Jakiś tekst";
$text .= "!!!"; // $text = $text . "!!!";
echo "operator ciągu: {$text}" . PHP_EOL;
```

-------------

## Operatory porównania

- `==` - równy
- `===` - identyczny
- `!=` - różny
- `!==` - nieidentyczny
- `>` - większy
- `>=` - większy bądź równy
- `<` - mniejszy
- `<=` - mniejszy bądź równy

```php
var_dump(12 == '12');        // bool(true)
var_dump(12 === '12');       // bool(false)

var_dump(10 != '0');   // bool(true)
var_dump(10 != 12);    // bool(true)
var_dump(10 != 10);    // bool(false)
var_dump(10 != '10');  // bool(false)

var_dump(10 !== '0');   // bool(true)
var_dump(10 !== 12);    // bool(true)
var_dump(10 !== 10);    // bool(false)
var_dump(10 !== '10');  // bool(true)
```

-------------

## Operatory logiczne

[Dokumentacja](https://www.php.net/manual/en/language.operators.logical.php)

- `&&` - oraz
- `||` - lub
- `!` - negacja

```php
var_dump(true && true);   // true
var_dump(true && false);   // false
var_dump(false && true);   // false

var_dump(true || true);   // true
var_dump(true || false);   // true
var_dump(false || true);   // true
var_dump(false || false);   // false

var_dump(!false);      // true
var_dump(!true);       // false
```

-------------

## Operator warunkowy

- `$varunek ? PRAWDA : FAŁSZ`

![Image](https://wswiecieit.dev/wp-content/uploads/2023/03/Zrzut-ekranu-2023-03-29-o-19.28.37.png)

```php
<?php 
$a = true;
$b = false;

$variable1 = $a ? 'TAK' : 'NIE';
$variable2 = $b ? 'TAK' : 'NIE';

var_dump($variable1);   // TAK
var_dump($variable2);   // NIE
```