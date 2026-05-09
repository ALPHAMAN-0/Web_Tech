<?php
// --- Basic if ---
$age = 20;
if ($age >= 18) {
    echo "You are an adult.";   // ← runs
}

// --- if / else ---
$balance = 50;
if ($balance >= 100) {
    echo "Sufficient balance.";
} else {
    echo "Insufficient balance.";   // ← runs
}

// --- Nested if ---
$score = 85;
$attended = true;

if ($attended) {
    if ($score >= 80) {
        echo "Pass with distinction!";   // ← runs
    } else {
        echo "Pass.";
    }
} else {
    echo "Cannot be graded — absent.";
}

// --- Single-line if (no braces) ---
// Only safe for single statements
if ($age >= 18) echo "Adult";

// ⚠️ RULE: Always use braces {} even for single lines
// This prevents bugs when you add more lines later

// --- if / elseif / else ---
$score = 72;

if ($score >= 90) {
    echo "Grade: A";
} elseif ($score >= 80) {
    echo "Grade: B";
} elseif ($score >= 70) {
    echo "Grade: C";   // ← runs (72 >= 70 is true)
} elseif ($score >= 60) {
    echo "Grade: D";
} else {
    echo "Grade: F";   // fallback if nothing matched
}

// Once one condition matches → PHP STOPS checking the rest
// So order matters! Put the most specific/restrictive condition FIRST

$day = "Wed";

switch ($day) {
    case "Mon":
        echo "Monday";
        break;        // ← MUST have break or it falls through!
    case "Tue":
        echo "Tuesday";
        break;
    case "Wed":
        echo "Wednesday";   // ← runs
        break;
    case "Thu":
        echo "Thursday";
        break;
    default:
        echo "Unknown day";  // runs if NO case matches
}

$day = "Sat";

switch ($day) {
    case "Mon":
    case "Tue":
    case "Wed":
    case "Thu":
    case "Fri":
        echo "Weekday";   // runs for Mon-Fri
        break;
    case "Sat":
    case "Sun":
        echo "Weekend!";  // ← runs (Sat falls through to Sun block)
        break;
}

$val = "0";

switch ($val) {
    case false:
        echo "Matched false!";   // ← runs! because "0" == false
        break;
    case 0:
        echo "Matched 0";
        break;
}

// ⚠️ switch uses == not ===
// Use match for strict comparison (see below)

$status = 2;

// match returns a value directly
$label = match($status) {
    1       => "Active",
    2       => "Inactive",    // ← matches (2 === 2)
    3       => "Banned",
    default => "Unknown"
};
echo $label;   // Inactive

// Multiple conditions per arm
$code = 404;
$message = match($code) {
    200, 201        => "Success",
    301, 302        => "Redirect",
    400             => "Bad Request",
    401, 403        => "Auth Error",
    404             => "Not Found",     // ← matches
    500, 502, 503   => "Server Error",
    default         => "Other"
};
echo $message;   // Not Found

// match is strict — no type juggling!
$n = "1";  // string
$result = match($n) {
    1       => "Integer one",    // ← won't match ("1" !== 1)
    "1"     => "String one",     // ← matches
    default => "Other"
};
echo $result;   // String one

// ⚠️ match throws UnhandledMatchError if no arm matches and no default!
// Always add default => ... to be safe

$age = 25;

// match(true) — use match like if/elseif
$group = match(true) {
    $age < 13           => "Child",
    $age < 18           => "Teenager",
    $age < 65           => "Adult",      // ← matches
    default             => "Senior"
};
echo $group;   // Adult


// Syntax: condition ? valueIfTrue : valueIfFalse

$age    = 20;
$status = ($age >= 18) ? "Adult" : "Minor";
echo $status;   // Adult

// Used inside echo directly
echo ($age >= 18) ? "Can vote" : "Cannot vote";   // Can vote

// Nesting ternaries (avoid if possible — hard to read)
$score = 75;
$grade = ($score >= 90) ? "A"
       : (($score >= 70) ? "B"    // ← matches
       : (($score >= 50) ? "C"
       : "F"));
echo $grade;   // B

// ✅ Better to use if/elseif for complex logic
// Ternary is best for simple two-option choices

// Without ?? (old way)
$username = isset($_GET["user"]) ? $_GET["user"] : "Guest";

// With ?? (new way — cleaner)
$username = $_GET["user"] ?? "Guest";

// Chain multiple ??
$config  = null;
$default = null;
$fallback = "system-default";

$value = $config ?? $default ?? $fallback;
echo $value;   // system-default

// ??= assignment (PHP 7.4+)
$settings = [];
$settings["theme"] ??= "light";    // sets it (was missing)
$settings["theme"] ??= "dark";     // does NOT change it (already set)
echo $settings["theme"];           // light

$username = $_POST["username"] ?? "";
$password = $_POST["password"] ?? "";
$isAdmin  = false;

if (empty($username) || empty($password)) {
    echo "Please fill in all fields.";
} elseif ($username === "admin" && $password === "secret123") {
    $isAdmin = true;
    echo "Welcome, Admin!";
} elseif (strlen($password) < 6) {
    echo "Password too short.";
} else {
    echo "Invalid credentials.";
}

$statusCode = 404;

$response = match($statusCode) {
    200     => ["status" => "ok",    "msg" => "Request successful"],
    201     => ["status" => "ok",    "msg" => "Resource created"],
    400     => ["status" => "error", "msg" => "Bad request"],
    401     => ["status" => "error", "msg" => "Unauthorized"],
    403     => ["status" => "error", "msg" => "Forbidden"],
    404     => ["status" => "error", "msg" => "Not found"],      // ← matches
    500     => ["status" => "error", "msg" => "Server error"],
    default => ["status" => "error", "msg" => "Unknown error"]
};

echo $response["msg"];   // Not found

$role = "editor";

switch ($role) {
    case "admin":
        echo "Full access: read, write, delete, settings";
        break;
    case "editor":
        echo "Access: read, write";      // ← runs
        break;
    case "viewer":
        echo "Access: read only";
        break;
    default:
        echo "No access";
}

?>