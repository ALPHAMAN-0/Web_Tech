<?php
echo "Arithmetic Operations in PHP:\n";
$a = 10;
$b = 3;

echo $a + $b;   // 13  → Addition
echo $a - $b;   // 7   → Subtraction
echo $a * $b;   // 30  → Multiplication
echo $a / $b;   // 3.333... → Division
echo $a % $b;   // 1   → Modulus (remainder of 10 ÷ 3)
echo $a ** $b;  // 1000 → Exponentiation (10³)

// Real use: check even or odd
$num = 7;
if ($num % 2 == 0) {
    echo "Even";
} else {
    echo "Odd";   // ← prints this
}

echo "\nAssignment Operations in PHP:\n";
$x = 10;        // Assign 10

$x += 5;        // Same as: $x = $x + 5  → 15
$x -= 3;        // Same as: $x = $x - 3  → 12
$x *= 2;        // Same as: $x = $x * 2  → 24
$x /= 4;        // Same as: $x = $x / 4  → 6
$x %= 4;        // Same as: $x = $x % 4  → 2
$x **= 3;       // Same as: $x = $x ** 3 → 8

// String assignment
$str  = "Hello";
$str .= " World";  // Same as: $str = $str . " World"
echo $str;         // Hello World

echo "\nComparison Operations in PHP:\n";
$a = 10;
$b = "10";
$c = 20;

// == loose equal (only compares VALUE, ignores type)
var_dump($a == $b);   // bool(true)  ← "10" converted to int

// === strict equal (compares VALUE + TYPE)
var_dump($a === $b);  // bool(false) ← int vs string, different!

// != not equal (loose)
var_dump($a != $c);   // bool(true)

// !== not identical (strict)
var_dump($a !== $b);  // bool(true)  ← different types

// < > <= >=
var_dump($a < $c);    // bool(true)
var_dump($a >= 10);   // bool(true)
var_dump($c > 100);   // bool(false)

echo "\nType Juggling and Truthiness in PHP:\n";
var_dump(0 == false);    // true  ← both "falsy"
var_dump(0 === false);   // false ← different types (int vs bool)

var_dump("" == false);   // true
var_dump("" === false);  // false

var_dump(null == false); // true
var_dump(null === false);// false

var_dump("1" == 1);      // true  ← string "1" converted to int
var_dump("1" === 1);     // false ← string != int

// RULE: Always use === unless you specifically need type juggling
echo "\nLogical Operations in PHP:\n";
$age     = 20;
$hasID   = true;
$isBanned = false;

// && → AND: both must be true
if ($age >= 18 && $hasID) {
    echo "Entry allowed";   // ← prints
}

// || → OR: at least one must be true
if ($age < 18 || $isBanned) {
    echo "Entry denied";
}

// ! → NOT: flips true to false, false to true
if (!$isBanned) {
    echo "Not banned";     // ← prints
}

// Combining multiple
if ($age >= 18 && $hasID && !$isBanned) {
    echo "Welcome!";       // ← prints
}
// && has HIGH precedence (evaluates before =)
$result = true && false;
var_dump($result);   // bool(false) ✅ works as expected

// 'and' has LOW precedence (evaluates AFTER =)
$result = true and false;
var_dump($result);   // bool(true) ← $result = true, THEN 'and false' is ignored!

// RULE: Always use && and || in conditions
//       'and'/'or' are mostly used in special control structures
echo "\nString Operations in PHP:\n";
$first = "Hello";
$last  = "World";

// . concatenation operator
$full = $first . " " . $last;
echo $full;   // Hello World

// .= append operator
$msg  = "Good ";
$msg .= "morning";
$msg .= "!";
echo $msg;    // Good morning!

// Concatenating different types
$name = "Alice";
$age  = 25;
echo $name . " is " . $age . " years old.";
// Alice is 25 years old.

// Embedding in double quotes (no . needed)
echo "$name is $age years old.";   // same result

echo "\nIncrement/Decrement and Ternary Operations in PHP:\n";
$a = 5;

// Pre-increment: increments FIRST, then returns new value
echo ++$a;   // 6  (adds 1, then echoes)
echo $a;     // 6

// Post-increment: returns current value FIRST, then increments
$a = 5;
echo $a++;   // 5  (echoes first, then adds 1)
echo $a;     // 6

// Pre-decrement
$a = 5;
echo --$a;   // 4

// Post-decrement
$a = 5;
echo $a--;   // 5
echo $a;     // 4

// Think of it as: WHERE is the ++ relative to $a?

echo "\nTernary and Null Coalescing Operations in PHP:\n";
$x = 10;
$y = ++$x;   // First $x becomes 11, THEN assigned to $y
echo $x;     // 11
echo $y;     // 11

$x = 10;
$y = $x++;   // First $x(=10) assigned to $y, THEN $x becomes 11
echo $x;     // 11
echo $y;     // 10  ← gets the OLD value

echo "\nTernary Operations in PHP:\n";
// --- TERNARY: condition ? valueIfTrue : valueIfFalse ---
$age    = 20;
$status = ($age >= 18) ? "Adult" : "Minor";
echo $status;   // Adult

// Shorthand ternary ?: (Elvis operator)
// Returns left side if truthy, otherwise right side
$name   = "";
$result = $name ?: "Guest";
echo $result;   // Guest  ← $name is empty so falls back

$name   = "Alice";
$result = $name ?: "Guest";
echo $result;   // Alice

// --- NULL COALESCING: ?? ---
// Returns left side if it EXISTS and is NOT null, otherwise right
$user = $_GET["username"] ?? "Guest";
// If $_GET["username"] exists → use it
// Otherwise → "Guest"

$config = null;
echo $config ?? "default";   // default


// Chaining ??
$a = null;
$b = null;
$c = "Found!";
echo $a ?? $b ?? $c;         // Found!

// --- NULL COALESCING ASSIGNMENT: ??= (PHP 7.4+) ---
$settings = [];
$settings["theme"] ??= "light";   // Assigns only if null/missing
echo $settings["theme"];           // light

$settings["theme"] ??= "dark";    // Already set, won't change
echo $settings["theme"];           // light  ← unchanged

echo "\nSpaceship Operator in PHP:\n";
// Returns:
//  -1 if left < right
//   0 if left == right
//   1 if left > right

echo (1 <=> 2);    // -1
echo (2 <=> 2);    //  0
echo (3 <=> 2);    //  1

echo ("a" <=> "b");  // -1
echo ("b" <=> "a");  //  1

// Best use: custom sorting with usort()
$people = [
    ["name" => "Charlie", "age" => 30],
    ["name" => "Alice",   "age" => 25],
    ["name" => "Bob",     "age" => 35],
];

// Sort by age ascending
usort($people, fn($a, $b) => $a["age"] <=> $b["age"]);

foreach ($people as $p) {
    echo $p["name"] . ": " . $p["age"] . "\n";
}
// Alice: 25
// Charlie: 30
// Bob: 35

echo "\nOperator Precedence in PHP:\n";
// Higher precedence evaluates first

echo 2 + 3 * 4;      // 14  (not 20!) — * before +
echo (2 + 3) * 4;    // 20  — parentheses override

echo 10 - 2 + 3;     // 11  — left to right
echo 2 ** 3 ** 2;    // 512 — right to left (2 ** 9)

// Logical precedence trap
$x = true;
$y = false;

if ($x || $y && !$y) {  // && evaluated before ||
    echo "Yes";          // Yes ← prints
}
// Same as: if ($x || ($y && !$y))

// RULE: Use parentheses to make intent clear
if ($x || ($y && !$y)) {   // ✅ readable and safe
    echo "Yes";
}
?>