
function changeTheme() {
    document.body.classList.toggle("darktheme");
    if (document.body.classList.contains("darktheme")) {
      localStorage.setItem('theme', 'dark');
    } else {
      localStorage.removeItem('theme');
    }
  }
  // Apply theme on page load
    window.onload = () => {
      if (localStorage.getItem('theme') === 'dark') {
        document.body.classList.add("darktheme");
      }
    };

    function datetime() {
      const date = new Date();
      const item = document.getElementById("dates");
    
      // If the element doesn't exist on the page, exit early
      if (!item) return;
    
      const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
      const months = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
      ];
    
      const dayName = days[date.getDay()];
      const day = date.getDate();
      const monthName = months[date.getMonth()];
      const year = date.getFullYear();
    
      const formattedDate = `${dayName}, ${day} ${monthName} ${year}`;
      item.innerHTML = formattedDate;
    
      const greeting = document.querySelector(".welcome h2");
      const hour = date.getHours();
    
      let msg = "Hey " + user + " <3 Ready to conquer the day?";
      let gifSrc = "pictures/girlcats.gif"; // default
    
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
    
      greeting.innerHTML = msg;
    
      // 🌠 Switch the gif based on time
      const girlcat = document.getElementById("girlcat");
      if (girlcat) {
        girlcat.src = gifSrc;
      }
    }
    
    
    
function callphp(id){
    if (id==="addsub"){
      window.location.href = 'addsub.php';
    }
}

function cancel(){
    window.location.href='dashboard.php';
}

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








