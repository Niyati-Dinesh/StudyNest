//-------TOGGLES BETWEEN DARK AND LIGHT MODE---------
function changeTheme() {
  // Toggles between dark and light themes by adding/removing a class
  document.body.classList.toggle("darktheme");

  // If dark theme is applied, save this choice in local storage
  if (document.body.classList.contains("darktheme")) {
    localStorage.setItem('theme', 'dark');
  } else {
    // If light theme is selected, remove the theme setting from local storage
    localStorage.removeItem('theme');
  }
}

//-------APPLYS CURRENT THEME ON PAGE RELOAD---------
window.onload = () => {
// Check if dark theme was previously saved in local storage
if (localStorage.getItem('theme') === 'dark') {
  document.body.classList.add("darktheme");  // Immediately apply dark theme
}
};

//-------ADDS CURRENT DATE AND SWITCHES GIFS ON DASHBOARD BASED ON TIME OF THE DAY---------
function datetime(user) {
    const date = new Date();
    const item = document.getElementById("dates");
  
    // If the element doesn't exist on the page, exit early
    if (!item) return;
  
    const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    const months = [
      "January", "February", "March", "April", "May", "June",
      "July", "August", "September", "October", "November", "December"
    ];
  
    // Get the current day, month, and year
    const dayName = days[date.getDay()];
    const day = date.getDate();
    const monthName = months[date.getMonth()];
    const year = date.getFullYear();
  
    const formattedDate = `${dayName}, ${day} ${monthName} ${year}`;
    item.innerHTML = formattedDate;
  
    const greeting = document.querySelector(".welcome h2");
    const hour = date.getHours();
  
    // Set the default message and GIF source
    let msg = "Hey " + user + " <3 Ready to conquer the day?";
    let gifSrc = "pictures/girlcats.gif"; // default
  
    // Modify message and GIF depending on the time of the day
    if (hour >= 6 && hour < 12) {
      msg = "Good morning, " + user + " 💖 Let's win the day!";
      gifSrc = "pictures/morning.gif";
    } else if (hour >= 12 && hour < 18) {
      msg = "Good afternoon, " + user + " 🌞 Keep going!";
      gifSrc = "pictures/afternoon.gif";
    } else if (hour >= 18 && hour < 23) {
      msg = "Good evening, " + user + " 🌙 You’ve done great today!";
      gifSrc = "pictures/evening.gif";
    } else {
      msg = "Good Night, " + user + " ✨ Sweet dreams <3";
      gifSrc = "pictures/night.gif";
    }
  
    // Update the greeting message
    if (greeting) {
      greeting.innerHTML = msg;
    }

    // 🌠 Switch the gif based on time
    const girlcat = document.getElementById("girlcat");
    if (girlcat) {
      girlcat.src = gifSrc;
    }
}
  
//-------CANCEL BUTTON---------
function cancel(){
  // Redirect to dashboard page
  window.location.href='dashboard.php';
}

//-------REMOVES THE TASK ON showtaks.php page dynamically---------
function complete_task(tid) {
console.log("Inside complete_task");
var task = document.getElementById(tid);

fetch('remove_task.php', {
    method: "POST",
    headers: {
        "Content-Type": "application/x-www-form-urlencoded"
    },
    body: "tasks=" + encodeURIComponent(tid)
})
.then(function(response) {
    return response.json();
})
.then(function(data) {
    if (data.success) {
        task.style.transition = "opacity 0.5s ease";
        task.style.opacity = 0;
        setTimeout(function() {
            task.remove();
            // If all tasks are cleared, show the "All Tasks Completed!" message
            if (data.allCleared) {
                document.getElementById('tasks').innerHTML = "<h1>All Tasks Completed! Yay!</h1>";
            }
        }, 500);
    } else {
        alert("Error deleting the task: " + data.error);
    }
})
.catch(function(error) {
    console.log("AJAX error: ", error);
});
}

//-------REMOVES THE SUBJECT ON showsub.php page dynamically---------
function complete_sub(buttonElement, subpassed) {
const subDiv = buttonElement.parentElement;

fetch('remove_sub.php', {
  method: "POST",
  headers: { "Content-Type": "application/x-www-form-urlencoded" },
  body: "subs=" + encodeURIComponent(subpassed)
})
.then(response => response.json())
.then(data => {
  if (data.success) {
    subDiv.style.transition = "opacity 0.5s ease";
    subDiv.style.opacity = 0;
    setTimeout(() => {
      subDiv.remove();
      if (data.allCleared) {
        document.getElementById('subs').innerHTML = "<h1>No Subjects Added!</h1>";
      }
    }, 500);
  } else {
    alert("Error deleting the subject: " + data.error);
  }
})
.catch(error => {
  console.log("AJAX error: ", error);
});
}

//-------TO TOGGLE BETWEEN NORMAL AND LEETCODE JOURNAL---------
function toggleJournalType() {
const type = document.getElementById("journaltype").value;
document.getElementById("normal").style.display = type === "normal" ? "block" : "none";
document.getElementById("leetcode").style.display = type === "leetcode" ? "block" : "none";
}

// Set journal type toggle on page load
document.addEventListener("DOMContentLoaded", () => {
toggleJournalType();
});

//-------ADD JOURNAL CONTENTS TO journal_data.json------------
function submitJournal(event, type) {
event.preventDefault();

const dateObj = new Date();
const formattedDate = dateObj.toLocaleDateString('en-GB', {
  weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
});

let entryData = {
  type: type,
  date: formattedDate
};

// For normal journal type, capture mood and description
if (type === "normal") {
  const desc = document.getElementById("ndesc");
  const mood = document.getElementById("moods");

  if (!desc || !mood) {
    console.error("Form elements not found.");
    return false;
  }

  entryData.Mood = mood.value;
  entryData.Description = desc.value;

} else if (type === "leetcode") {
  // For leetcode journal type, capture coding task details
  const form = document.getElementById("leetcodeForm");
  if (!form) {
    console.error("LeetCode form not found.");
    return false;
  }

  entryData.Title = form.querySelector('input[name="title"]').value;
  entryData.Link = form.querySelector('input[name="url"]').value;
  entryData.Topic = form.querySelector('input[name="topic"]').value;
  entryData.Difficulty = form.querySelector('select[name="difficulty"]').value;
  entryData.Status = form.querySelector('select[name="status"]').value;
  entryData.Description = form.querySelector('textarea[name="jdesc"]').value;
}

// 🔥 Use AJAX to save data to a PHP file or JSON storage
fetch("save_journal.php", {
  method: "POST",
  headers: {
    "Content-Type": "application/json"
  },
  body: JSON.stringify(entryData)
})
.then(res => res.json())
.then(response => {
  Swal.fire({
    icon: 'success',
    title: 'Journal Logged!',
    text: 'Your entry was saved successfully.',
  });
  // Optional: clear the form
  if (type === 'normal') {
    document.getElementById("normalForm").reset();
  } else {
    document.getElementById("leetcodeForm").reset();
  }
})
.catch(error => {
  console.error("Error:", error);
  Swal.fire({
    icon: 'error',
    title: 'Oops!',
    text: 'Something went wrong while saving your entry.',
  });
});
event.target.reset();
return false; // prevent default form submission
}

//-------VIEW JOURNAL ENTRY BY DATE---------
function viewJournal(event){
event.preventDefault();
const date = document.getElementById("date").value;
fetch("view_entry.php", {
  method: "POST",
  headers: {"Content-Type": "application/x-www-form-urlencoded"},
  body: "dates=" + encodeURIComponent(date)
})
.then(res => res.json())
.then(response => {
  const entryDiv = document.getElementById("entry");
  if (!response.success) {
    entryDiv.innerHTML = response.message;
  } else {
    let html = "";
    response.message.forEach(entry => {
      for (const key in entry) {
        html += "<strong>"+key+" : </strong>"+ entry[key]+"<br>";
      }
      
    });
    entryDiv.innerHTML = html;
  }
})
.catch(error => {
  console.error("AJAX error:", error);
});
}
