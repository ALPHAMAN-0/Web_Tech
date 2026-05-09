<?php
// --- INTEGER ---
$age       = 25;
$negative  = -100;
$hexVal    = 0x1A;     // Hexadecimal = 26
$octVal    = 0755;     // Octal = 493
$binVal    = 0b1101;   // Binary = 13
$bigNum    = 1_000_000; // Underscore separator (PHP 7.4+)

// --- FLOAT ---
$price     = 19.99;
$pi        = 3.14159265;
$sci       = 2.5e3;    // 2500.0
$tiny      = 1.5E-4;   // 0.00015

// --- STRING ---
$firstName = "Alice";
$lastName  = 'Smith';
$full      = "Hello, $firstName!";   // "Hello, Alice!"  (double: parsed)
$raw       = 'Hello, $firstName!';   // "Hello, $firstName!" (single: literal)

// Heredoc (like double quotes, multiline)
$para = <<<EOT
My name is $firstName.
I live in Dhaka.
EOT;

// Nowdoc (like single quotes, multiline)
$para2 = <<<'EOT'
No $variable parsing here.
EOT;

// --- BOOLEAN ---
$isLoggedIn = true;
$isAdmin    = false;
$check      = (10 > 5);   // true
var_dump($check);          // bool(true)

// --- NULL ---
$data = null;
$x;                        // undefined = null in practice
unset($data);              // $data is now null

// --- ARRAY ---
$colors = ["red", "green", "blue"];
$person = ["name" => "Bob", "age" => 30];

// --- OBJECT ---
class Animal {
    public $name;
    public $sound;
    public function speak() {
        return "$this->name says $this->sound";
    }
}
$dog = new Animal();
$dog->name  = "Rex";
$dog->sound = "Woof";
echo $dog->speak();   // Rex says Woof

$val = 42;

// Check type
echo gettype($val);          // "integer"
var_dump($val);               // int(42)
print_r([1, "a", true]);     // human-readable array dump

// Type checking functions
is_int($val);       // true
is_float(3.14);     // true
is_string("hi");    // true
is_bool(false);     // true
is_null(null);      // true
is_array([1,2]);    // true
is_numeric("42");   // true  ← useful for form inputs
isset($val);        // true  ← variable exists and is not null
empty("");          // true  ← empty string, 0, null, [], false all = empty

$varName  = "city";
$$varName = "Dhaka";     // Creates variable $city = "Dhaka"

echo $city;              // Dhaka
echo $$varName;          // Dhaka

$a = "5";     // string
$b = 3;       // int

echo $a + $b;         // 8   ← string "5" auto-converted to int
echo $a . $b;         // "53" ← int 3 auto-converted to string

var_dump(0 == "foo"); // bool(false) in PHP 8  ← changed from PHP 7!
var_dump("1" == "01");// bool(true)  ← numeric string comparison
var_dump("" == false);// bool(true)  ← both "falsy"

// Safe comparison: always use ===
var_dump("1" === 1);  // bool(false) ← different types, no conversion


// Everything else is TRUTHY

if (0)      { } // false → skipped
if ("")     { } // false → skipped
if ("0")    { } // false → skipped
if ([])     { } // false → skipped
if ("false"){ } // TRUE! ← non-empty string is truthy
if (-1)     { } // TRUE! ← non-zero number is truthy

?>