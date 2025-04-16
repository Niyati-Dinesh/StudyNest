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
  const hour = new Date().getHours();

  let msg = "Hey "+user+" <3 Ready to conquer the day?";
  if (hour < 12 && hour >= 6) {
    msg = "Good morning, "+user+" 💖 Let's win the day!";
  } else if (hour < 18 && hour >= 12) {
    msg = "Good afternoon, "+user+" 🌞 Keep going!";
  } else if (hour < 23 && hour >= 18) {
    msg = "Good evening, "+user+" 🌙 You’ve done great today!";
  } else if (hour < 6 && hour >= 0) {
    msg = "Good Night, "+user+" ✨ Sweet dreams <3";
  }
  greeting.innerHTML = msg;
}
datetime();

function callphp(id){
    if (id==="addsub"){
      window.location.href = 'addsub.php';
    }
}

function cancel(){
    window.location.href='dashboard.php';
}