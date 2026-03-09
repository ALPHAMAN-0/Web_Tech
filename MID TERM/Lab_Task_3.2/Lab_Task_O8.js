document.write("<h3>Part A: Arrays</h3>");

let courses = ["Web Technology", "Data Structures", "Database Systems", "Operating Systems", "Software Engineering"];

document.write("<p>Course names using for loop:</p>");
document.write("<ul>");
for (let i = 0; i < courses.length; i++) {
	document.write("<li>" + courses[i] + "</li>");
}
document.write("</ul>");

courses.push("Computer Networks");

document.write("<p>Updated course list after adding a new course:</p>");
document.write("<ul>");
for (let i = 0; i < courses.length; i++) {
	document.write("<li>" + courses[i] + "</li>");
}
document.write("</ul>");

document.write("<h3>Part B: Array Operations</h3>");

let arrayLength = courses.length;
document.write("<p>Array length: " + arrayLength + "</p>");

let removedCourse = courses.pop();
document.write("<p>Removed last element using pop(): " + removedCourse + "</p>");

courses.unshift("Artificial Intelligence");
document.write("<p>Added new element at beginning using unshift(): Artificial Intelligence</p>");

document.write("<p>Final array contents:</p>");
document.write("<ul>");
for (let i = 0; i < courses.length; i++) {
	document.write("<li>" + courses[i] + "</li>");
}
document.write("</ul>");

document.write("<h3>Part C: Basic Objects</h3>");

let student = {
	name: "Roshni motu",
	id: "24-5555-1",
	department: "CSE",
	cgpa: 3.75
};

document.write("<p>Name: " + student.name + "</p>");
document.write("<p>ID: " + student.id + "</p>");
document.write("<p>Department: " + student.department + "</p>");
document.write("<p>CGPA: " + student.cgpa + "</p>");

document.write("<h3>Part D: Array of Objects</h3>");

let students = [
	{ name: "Siam Ahmed", id: "24-56637-1", department: "CSE", cgpa: 2.01 },
	{ name: "Sumaiya ", id: "23-55555-1", department: "CSE", cgpa: 2.00 },
	{ name: "Muhammad Ali", id: "000-0000-000", department: "CSE", cgpa: 3.68 }
];

for (let i = 0; i < students.length; i++) {
	document.write("<p><strong>Student " + (i + 1) + "</strong><br>");
	document.write("Name: " + students[i].name + "<br>");
	document.write("ID: " + students[i].id + "<br>");
	document.write("Department: " + students[i].department + "<br>");
	document.write("CGPA: " + students[i].cgpa + "</p>");
}
