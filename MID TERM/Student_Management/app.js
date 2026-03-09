// DOM Elements
var nameInput = document.getElementById("nameInput");
var rollInput = document.getElementById("rollInput");
var addBtn = document.getElementById("addBtn");
var studentList = document.getElementById("studentList");
var totalCount = document.getElementById("totalCount");
var attendanceStats = document.getElementById("attendanceStats");
var searchInput = document.getElementById("searchInput");
var sortBtn = document.getElementById("sortBtn");
var highlightBtn = document.getElementById("highlightBtn");


// Feature 3: Disable "Add" when input is empty

nameInput.addEventListener("input", function () {
    addBtn.disabled = nameInput.value.trim() === "";
});


// Feature 1 & 7: Add student with Name + Roll No.

addBtn.addEventListener("click", function () {
    var name = nameInput.value.trim();
    var roll = rollInput.value.trim();

    if (name === "") {
        alert("Please enter a student name.");
        return;
    }

    addStudentToList(roll, name);

    // Clear inputs and disable button again
    nameInput.value = "";
    rollInput.value = "";
    addBtn.disabled = true;
    nameInput.focus();

    updateStats();
    applySearchFilter();
});

// Allow pressing Enter to add
nameInput.addEventListener("keydown", function (e) {
    if (e.key === "Enter" && !addBtn.disabled) {
        addBtn.click();
    }
});

rollInput.addEventListener("keydown", function (e) {
    if (e.key === "Enter" && !addBtn.disabled) {
        addBtn.click();
    }
});


// Create a student list item

function addStudentToList(roll, name) {
    var li = document.createElement("li");
    li.setAttribute("data-name", name.toLowerCase());
    li.setAttribute("data-roll", roll);

    // Student info span
    var infoSpan = document.createElement("span");
    infoSpan.className = "student-info";
    infoSpan.textContent = roll ? roll + " \u2013 " + name : name;

    // Actions container
    var actionsDiv = document.createElement("div");
    actionsDiv.className = "student-actions";

    // Feature 5: Present/Absent button
    var presentBtn = document.createElement("button");
    presentBtn.className = "btn-present";
    presentBtn.textContent = "Present";
    presentBtn.addEventListener("click", function () {
        li.classList.toggle("present");
        if (li.classList.contains("present")) {
            presentBtn.textContent = "Absent";
            presentBtn.classList.add("marked");
        } else {
            presentBtn.textContent = "Present";
            presentBtn.classList.remove("marked");
        }
        updateStats();
    });

    // Feature 12: Edit button
    var editBtn = document.createElement("button");
    editBtn.className = "btn-edit";
    editBtn.textContent = "Edit";
    editBtn.addEventListener("click", function () {
        enterEditMode(li, infoSpan, actionsDiv);
    });

    // Feature 7: Delete button with confirm
    var deleteBtn = document.createElement("button");
    deleteBtn.className = "btn-delete";
    deleteBtn.textContent = "Delete";
    deleteBtn.addEventListener("click", function () {
        if (confirm("Are you sure you want to delete this student?")) {
            studentList.removeChild(li);
            updateStats();
        }
    });

    actionsDiv.appendChild(presentBtn);
    actionsDiv.appendChild(editBtn);
    actionsDiv.appendChild(deleteBtn);

    li.appendChild(infoSpan);
    li.appendChild(actionsDiv);

    studentList.appendChild(li);
}


// Feature 1 (edit): Edit mode for a student

function enterEditMode(li, infoSpan, actionsDiv) {
    var currentRoll = li.getAttribute("data-roll");
    var currentName = li.getAttribute("data-name");

    // Replace info span with input fields
    infoSpan.style.display = "none";

    var rollEditInput = document.createElement("input");
    rollEditInput.className = "edit-input";
    rollEditInput.value = currentRoll;
    rollEditInput.placeholder = "Roll No.";

    var nameEditInput = document.createElement("input");
    nameEditInput.className = "edit-input name-edit";
    // Use data-name which is lowercase; get the original display text instead
    var displayText = infoSpan.textContent;
    if (currentRoll && displayText.indexOf(" \u2013 ") !== -1) {
        nameEditInput.value = displayText.split(" \u2013 ")[1];
    } else {
        nameEditInput.value = displayText;
    }
    nameEditInput.placeholder = "Name";

    // Hide existing action buttons
    var existingButtons = actionsDiv.querySelectorAll("button");
    for (var i = 0; i < existingButtons.length; i++) {
        existingButtons[i].style.display = "none";
    }

    // Save button
    var saveBtn = document.createElement("button");
    saveBtn.className = "student-actions btn-save";
    saveBtn.textContent = "Save";

    // Cancel button
    var cancelBtn = document.createElement("button");
    cancelBtn.className = "student-actions btn-cancel";
    cancelBtn.textContent = "Cancel";

    function saveEdit() {
        var newName = nameEditInput.value.trim();
        var newRoll = rollEditInput.value.trim();

        if (newName === "") {
            alert("Student name cannot be empty.");
            return;
        }

        li.setAttribute("data-name", newName.toLowerCase());
        li.setAttribute("data-roll", newRoll);
        infoSpan.textContent = newRoll ? newRoll + " \u2013 " + newName : newName;

        exitEditMode();
    }

    function exitEditMode() {
        // Remove edit inputs and save/cancel buttons
        if (rollEditInput.parentNode) rollEditInput.parentNode.removeChild(rollEditInput);
        if (nameEditInput.parentNode) nameEditInput.parentNode.removeChild(nameEditInput);
        if (saveBtn.parentNode) saveBtn.parentNode.removeChild(saveBtn);
        if (cancelBtn.parentNode) cancelBtn.parentNode.removeChild(cancelBtn);

        // Show info span and action buttons again
        infoSpan.style.display = "";
        for (var i = 0; i < existingButtons.length; i++) {
            existingButtons[i].style.display = "";
        }
    }

    saveBtn.addEventListener("click", saveEdit);
    cancelBtn.addEventListener("click", exitEditMode);

    nameEditInput.addEventListener("keydown", function (e) {
        if (e.key === "Enter") saveEdit();
        if (e.key === "Escape") exitEditMode();
    });

    rollEditInput.addEventListener("keydown", function (e) {
        if (e.key === "Enter") saveEdit();
        if (e.key === "Escape") exitEditMode();
    });

    // Insert edit inputs before the actions div
    li.insertBefore(rollEditInput, actionsDiv);
    li.insertBefore(nameEditInput, actionsDiv);

    // Add save/cancel to actions div
    actionsDiv.appendChild(saveBtn);
    actionsDiv.appendChild(cancelBtn);

    rollEditInput.focus();
}


// Feature 2: Update total student count
// Feature 5: Update present/absent counts

function updateStats() {
    var items = studentList.querySelectorAll("li");
    var total = items.length;
    var presentCount = 0;

    for (var i = 0; i < items.length; i++) {
        if (items[i].classList.contains("present")) {
            presentCount++;
        }
    }

    var absentCount = total - presentCount;

    totalCount.textContent = "Total students: " + total;
    attendanceStats.textContent = "Present: " + presentCount + ", Absent: " + absentCount;
}


// Feature 4: Search/filter students

searchInput.addEventListener("input", function () {
    applySearchFilter();
});

function applySearchFilter() {
    var query = searchInput.value.trim().toLowerCase();
    var items = studentList.querySelectorAll("li");

    for (var i = 0; i < items.length; i++) {
        var name = items[i].getAttribute("data-name");
        if (query === "" || name.indexOf(query) !== -1) {
            items[i].style.display = "";
        } else {
            items[i].style.display = "none";
        }
    }
}


// Feature 6: Sort students alphabetically

sortBtn.addEventListener("click", function () {
    var items = studentList.querySelectorAll("li");
    var itemsArray = [];

    for (var i = 0; i < items.length; i++) {
        itemsArray.push(items[i]);
    }

    itemsArray.sort(function (a, b) {
        var nameA = a.getAttribute("data-name");
        var nameB = b.getAttribute("data-name");
        if (nameA < nameB) return -1;
        if (nameA > nameB) return 1;
        return 0;
    });

    // Re-append sorted items
    for (var i = 0; i < itemsArray.length; i++) {
        studentList.appendChild(itemsArray[i]);
    }
});


// Feature 8: Highlight first student

highlightBtn.addEventListener("click", function () {
    var items = studentList.querySelectorAll("li");

    // Remove highlight from all
    for (var i = 0; i < items.length; i++) {
        items[i].classList.remove("highlighted");
    }

    // Highlight the first visible item
    if (items.length > 0) {
        items[0].classList.add("highlighted");
    }
});
