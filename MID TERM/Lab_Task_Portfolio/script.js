// ===== Project Data (Dynamic Content) =====
var projects = [
    {
        title: "Student Management System",
        description: "A web-based application to manage student records including adding, editing, and deleting student information. Built using HTML, CSS and JavaScript.",
        image: "https://images.unsplash.com/photo-1501504905252-473c47e087f8?w=600&h=400&fit=crop",
        link: "#"
    },
    {
        title: "Weather App",
        description: "A simple weather application that fetches real-time data from an API and displays current temperature, humidity, and forecast for any city.",
        image: "https://images.unsplash.com/photo-1504608524841-42fe6f032b4b?w=600&h=400&fit=crop",
        link: "#"
    },
    {
        title: "Quiz Game",
        description: "An interactive quiz game with multiple-choice questions, score tracking, and a timer. Features different categories and difficulty levels.",
        image: "https://images.unsplash.com/photo-1606326608606-aa0b62935f2b?w=600&h=400&fit=crop",
        link: "#"
    }
];

// ===== Interactive Service Details =====
function setupServiceInteraction() {
    var serviceItems = document.querySelectorAll(".service-item");
    
    serviceItems.forEach(function(item) {
        item.addEventListener("click", function() {
            var service = this.getAttribute("data-service");
            
            // Remove active class from all items
            serviceItems.forEach(function(si) {
                si.classList.remove("active");
            });
            
            // Add active class to clicked item
            this.classList.add("active");
            
            // Hide all service details
            var details = document.querySelectorAll(".service-detail");
            details.forEach(function(d) {
                d.style.display = "none";
            });
            
            // Show selected service detail
            var selectedDetail = document.getElementById("detail-" + service);
            if (selectedDetail) {
                selectedDetail.style.display = "block";
            }
        });
    });
}

// ===== Render Project Cards Dynamically =====
function renderProjects() {
    var grid = document.getElementById("project-grid");
    grid.innerHTML = "";

    for (var i = 0; i < projects.length; i++) {
        var project = projects[i];

        var card = document.createElement("div");
        card.className = "project-card";

        var img = document.createElement("img");
        img.src = project.image;
        img.alt = project.title;

        var info = document.createElement("div");
        info.className = "project-info";

        var title = document.createElement("h3");
        title.textContent = project.title;

        var desc = document.createElement("p");
        desc.textContent = project.description;

        var link = document.createElement("a");
        link.href = project.link;
        link.className = "project-link";
        link.textContent = "View Project →";

        info.appendChild(title);
        info.appendChild(desc);
        info.appendChild(link);
        card.appendChild(img);
        card.appendChild(info);
        grid.appendChild(card);
    }
}

// ===== Typing Animation =====
var typingTexts = ["Web Developer", "CSE Student", "Problem Solver", "NewWork Enthusiast"];
var textIndex = 0;
var charIndex = 0;
var isDeleting = false;

function typeEffect() {
    var tagline = document.getElementById("tagline");
    var currentText = typingTexts[textIndex];

    if (isDeleting) {
        tagline.textContent = currentText.substring(0, charIndex - 1);
        charIndex--;
    } else {
        tagline.textContent = currentText.substring(0, charIndex + 1);
        charIndex++;
    }

    var speed = 100;

    if (isDeleting) {
        speed = 50;
    }

    if (!isDeleting && charIndex === currentText.length) {
        speed = 1500;
        isDeleting = true;
    } else if (isDeleting && charIndex === 0) {
        isDeleting = false;
        textIndex = (textIndex + 1) % typingTexts.length;
        speed = 300;
    }

    setTimeout(typeEffect, speed);
}

// ===== Dark/Light Mode Toggle =====
var themeToggle = document.getElementById("theme-toggle");

// check saved preference (default is dark)
var savedTheme = localStorage.getItem("theme");
if (savedTheme === "light") {
    document.body.classList.remove("dark-mode");
    themeToggle.innerHTML = "&#9790;"; // moon icon for light mode
} else {
    // dark is default
    document.body.classList.add("dark-mode");
    themeToggle.innerHTML = "&#9788;"; // sun icon for dark mode
}

themeToggle.addEventListener("click", function () {
    document.body.classList.toggle("dark-mode");

    if (document.body.classList.contains("dark-mode")) {
        localStorage.setItem("theme", "dark");
        themeToggle.innerHTML = "&#9788;"; // sun
    } else {
        localStorage.setItem("theme", "light");
        themeToggle.innerHTML = "&#9790;"; // moon
    }
});

// ===== Mobile Menu Toggle =====
var menuBtn = document.getElementById("menu-btn");
var navLinks = document.querySelector(".nav-links");

menuBtn.addEventListener("click", function () {
    navLinks.classList.toggle("active");
});

// close menu when a link is clicked
var allNavLinks = document.querySelectorAll(".nav-links a");
for (var i = 0; i < allNavLinks.length; i++) {
    allNavLinks[i].addEventListener("click", function () {
        navLinks.classList.remove("active");
    });
}

// ===== Contact Form Validation =====
var contactForm = document.getElementById("contact-form");

contactForm.addEventListener("submit", function (e) {
    e.preventDefault();

    // get values
    var name = document.getElementById("name").value.trim();
    var email = document.getElementById("email").value.trim();
    var subject = document.getElementById("subject").value.trim();
    var message = document.getElementById("message").value.trim();

    // get error elements
    var nameError = document.getElementById("name-error");
    var emailError = document.getElementById("email-error");
    var subjectError = document.getElementById("subject-error");
    var messageError = document.getElementById("message-error");
    var successMsg = document.getElementById("form-success");

    // clear previous errors
    nameError.textContent = "";
    emailError.textContent = "";
    subjectError.textContent = "";
    messageError.textContent = "";
    successMsg.textContent = "";

    var isValid = true;

    // validate name
    if (name === "") {
        nameError.textContent = "Please enter your name.";
        isValid = false;
    }

    // validate email
    if (email === "") {
        emailError.textContent = "Please enter your email.";
        isValid = false;
    } else {
        // simple email check
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            emailError.textContent = "Please enter a valid email address.";
            isValid = false;
        }
    }

    // validate subject
    if (subject === "") {
        subjectError.textContent = "Please enter a subject.";
        isValid = false;
    }

    // validate message
    if (message === "") {
        messageError.textContent = "Please enter your message.";
        isValid = false;
    }

    // if all valid, show success
    if (isValid) {
        successMsg.textContent = "Thank you! Your message has been sent successfully.";
        contactForm.reset();

        // hide success message after 3 seconds
        setTimeout(function () {
            successMsg.textContent = "";
        }, 3000);
    }
});

// ===== Scroll to Top Button =====
var scrollTopBtn = document.getElementById("scroll-top");

window.addEventListener("scroll", function () {
    if (window.scrollY > 400) {
        scrollTopBtn.style.display = "block";
    } else {
        scrollTopBtn.style.display = "none";
    }
});

scrollTopBtn.addEventListener("click", function () {
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });
});

// ===== Initialize =====
renderProjects();
typeEffect();
setupServiceInteraction();
