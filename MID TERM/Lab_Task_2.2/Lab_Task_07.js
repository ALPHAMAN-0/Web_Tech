function calculateSum(num1, num2) {
	return num1 + num2;
}

let result = calculateSum(15, 25);
document.write("<h3>Part A: Functions</h3>");
document.write("<p>Sum of 15 and 25 is: " + result + "</p>");

document.write("<h3>Part B: Loops</h3>");

document.write("<p>For loop (1 to 10): ");
for (let i = 1; i <= 10; i++) {
	document.write(i + " ");
}
document.write("</p>");

document.write("<p>While loop (even numbers 1 to 20): ");
let num = 2;
while (num <= 20) {
	document.write(num + " ");
	num += 2;
}
document.write("</p>");

document.write("<h3>Part C: String Operations</h3>");

let fullName = "Siam Ahmed";
let upperCaseName = fullName.toUpperCase();
let nameLength = fullName.length;
let firstName = fullName.split(" ")[0];

document.write("<p>Full Name: " + fullName + "</p>");
document.write("<p>Uppercase: " + upperCaseName + "</p>");
document.write("<p>String Length: " + nameLength + "</p>");
document.write("<p>First Name: " + firstName + "</p>");

document.write("<h3>Part D: Function with User Input</h3>");

function checkStringLength() {
	let userInput = prompt("Enter a string:");

	if (userInput !== null) {
		if (userInput.length > 5) {
			document.write("<p>The string length is greater than 5.</p>");
		} else {
			document.write("<p>The string length is 5 or less.</p>");
		}
	} else {
		document.write("<p>No input provided.</p>");
	}
}

checkStringLength();
