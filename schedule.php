<?php
include ("auth_session.php");
include ("connection.php"); 

   $price = 0;
   $address = "";
   $time = "";
   $tp = "";
   $phone=$user=$username = "";
   $tname = "";
   $stmt = null;
   $stmt1 = null;
   $rs1 = null;
$email=null;
$image=$map="";

   if (isset($_SESSION["userLoggedIn"])) {
       $username = $_SESSION["userLoggedIn"];
       $tname = $_GET["para1"];
    $allowedTypes = ['tur/png', 'image/jpeg', 'image/jpg'];


       try {

           $stmt1 = $conn->prepare("SELECT * FROM turfs WHERE tname = ?");
           $stmt1->bindParam(1, $tname);
           $stmt1->execute();

           while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {
               $price = $row["price"];
               $address = $row["address"];
               $email=$row["email"];
                $image=$row["image_data"];
                $map=$row["mapp"];
           }
           

            $stmt1 = null; 
           $stmt1 = $conn->prepare("SELECT * FROM o_register WHERE email = ?");
           $stmt1->bindParam(1, $email);
           $stmt1->execute();
           while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {
            $user = $row["username"];
            $phone=$row["phone"];
            $email=$row["email"];
        }
       } catch (PDOException $e) {
           echo "An error occurred: " . $e->getMessage();
       } finally {
           if ($stmt1) {
               $stmt1 = null;
           }
           if ($conn) {
               $conn = null;
           }
       }
   }

?>
        
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule</title>
    <link rel="stylesheet" href="css/head.css">
    <link rel="icon" href="images/tbs.png">

    <link rel="stylesheet" href="css/new_home.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100&display=swap" rel="stylesheet">
    <script src="calender//script.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Kadwa&display=swap');
*{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
    </style>
</head>
<body>
<header>
                <div class="lhead"><a href="index.html"><img src="images/logo1.png" alt=""></a></div>
                <div class="rhead">
                    <div class="menu">
                        <li><a href="register.php">Register</a></li>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="about.html">About</a></li>
                    </div>
                </div>
 </header>
    <div class="containerr">
        <div class="cen_contain">
            <div class="img_container">
                <h2><?php echo $tname; ?> turf</h2>
                <img  src="data:imagdata/jpg;charset=utf8;base64,<?php echo base64_encode($image);?>" alt="turf image">
            </div>
        </div>

        <div class="main_contain">
            <div class="first_div">
                <div class="pri">
                    <h2>Get the play area for :</h2>
                    <button disabled><?php echo $price; ?> Per Hour</button>
                </div> 
                <div class="tim">
                    <h2>Select Time</h2>
                    <div class="tim_contain" id="timeButtons">
                        <button class="button">9 am</button>
                        <button class="button">10 am</button>
                        <button class="button">11 am</button>
                        <button class="button">12 pm</button>
                        <button class="button">1 pm</button>                       
                        <button class="button">2 pm</button>
                        <button class="button">3 pm</button>
                        <button class="button">4 pm</button>
                        <button class="button">5 pm</button>                        
                        <button class="button">6 pm</button>
                        <button class="button">7 pm</button>
                        <button class="button">8 pm</button>
                        <button class="button">9 pm</button>
                        <button class="button">10 pm</button>
                        
                    </div>
                </div> 
                 <div class="hr">
                    <h2>Select Hour</h2>
                <div class="hr_contain" id="hourButtons">
                    <div class="f">
                        <label for="">Hour</label>
                        <button class="button">1</button>
                        <button class="button">2</button>
                        <button class="button">3</button>
                        <button class="button">4</button>
                    </div>
                    <div class="s">
                        <label for="">Minutes</label>
                        <button class="button">30</button>
                    </div>
                </div>
                 </div>    
            </div>
            <div class="sec_div">
            <h2>Select Date </h2>
            <div class="calendar">
        <div class="calendar-header">
            <button id="prevBtn">&lt;</button>
            <h2 id="monthYear"></h2>
            <button id="nextBtn">&gt;</button>
        </div>
        <div class="calendar-weekdays">
            <div>Sun</div>
            <div>Mon</div>
            <div>Tue</div>
            <div>Wed</div>
            <div>Thu</div>
            <div>Fri</div>
            <div>Sat</div>
        </div>
        <div class="calendar-days" id="calendarDays">
            <!-- Days will be inserted here dynamically -->
        </div>

    </div>
    <!-- <div></div> -->
                <div class="ow_details">
                    <h3>Selected Date : <span id="selectedDate"></span></h3>
                    <h3>Owner Contact :<span> <?php echo $phone; ?></span></h3>
                    <h3>Name : <span><?php echo $user; ?></span></h3>
                    <h3>Email : <span><?php echo $email; ?></span></h3>
                    <h3>Turf Name :  <span><?php echo $tname; ?></span></h3>
                </div>
                <div class="map">
                       <?php echo($map); ?>
                </div>
            </div>
            <div class="third">
          
                      <div class="resultDiv" ></div>

                    <input type="button" value="Book" class="cal" id="cal" onclick="redirectToNextPage()"><br>
         
            </div>
        </div>
    </div>






    <script>

    const timeButtons = document.querySelectorAll('.tim_contain .button');
        const hourButtons = document.querySelectorAll('.hr_contain .f .button');
        const minutesButton = document.querySelector('.hr_contain .s .button');
        const resultDiv = document.querySelector('.resultDiv');
        function deselectAll(buttons) {
            buttons.forEach(button => {
                button.classList.remove('selected');
                button.removeAttribute('data-value');
            });
        }

        timeButtons.forEach(button => {
            button.addEventListener('click', () => {
                deselectAll(timeButtons);


                button.classList.toggle('selected');
                calculateResult();
            });
        });

        hourButtons.forEach(button => {
            button.addEventListener('click', () => {
                deselectAll(hourButtons);

                button.classList.toggle('selected');
                calculateResult();
            });
        });

        minutesButton.addEventListener('click', () => {
            minutesButton.classList.toggle('selected');
            calculateResult();
        });
        let s=s1=t=add=em=tname=da="";
        function calculateResult() {
            const selectedHour = parseInt(document.querySelector('.hr_contain .f .button.selected')?.textContent) || 0;
            const selectedMinutes = document.querySelector('.hr_contain .s .button.selected') ? 0.5 : 0;
            const totalPrice = (selectedHour + selectedMinutes) * <?php echo $price; ?>;
            resultDiv.innerHTML = `Total Price: ${totalPrice} rs`;
            const selectedTime = document.querySelector('.tim_contain .button.selected')?.textContent;
           t=totalPrice;
           s=selectedTime;
           s1=`${selectedHour}:${selectedMinutes}`;
           
        //     var xhr = new XMLHttpRequest();
        // xhr.open('POST', 'book_jsp.php', true);
        // xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        // xhr.onreadystatechange = function () {
        //     if (xhr.readyState === 4 && xhr.status === 200) {
        //         console.log(xhr.responseText); // Log the PHP response
        //     }
        // };

        // // Send the JavaScript variable to PHP
        // xhr.send('totalPrice=' +totalPrice);
        }
        document.addEventListener("DOMContentLoaded", function() {
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");
    const monthYear = document.getElementById("monthYear");
    const calendarDays = document.getElementById("calendarDays");
    const selectedDateDisplay = document.getElementById("selectedDate");
    const monthNames = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];
    let currentDate = new Date();
    let currentMonth = currentDate.getMonth();
    let currentYear = currentDate.getFullYear();
    let selectedDate = currentDate.getDate();

    function showCalendar(month, year) {
        monthYear.textContent = `${monthNames[month]} ${year}`;
        calendarDays.innerHTML = "";

        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);

        for (let i = 0; i < firstDay.getDay(); i++) {
            const emptyDay = document.createElement("div");
            emptyDay.classList.add("empty");
            calendarDays.appendChild(emptyDay);
        }

        for (let i = 1; i <= lastDay.getDate(); i++) {
            const day = document.createElement("div");
            day.textContent = i;

            // Check if the day is in the past
            const currentDateObj = new Date(currentDate.getFullYear(), currentDate.getMonth(), currentDate.getDate());
            const currentDayObj = new Date(year, month, i);

            if (currentDayObj < currentDateObj) {
                // If the day is in the past, disable it
                day.classList.add("disabled");
            }

            // Check if it's the selected date
            if (i === selectedDate && currentMonth === month && currentYear === year) {
                day.classList.add("selected");
            }

            calendarDays.appendChild(day);
        }

        const days = document.querySelectorAll("#calendarDays > div:not(.empty)");
        days.forEach(day => {
            day.addEventListener("click", function() {
                if (!day.classList.contains("disabled")) {
                    // Update the selected date only if it's not disabled
                    days.forEach(d => d.classList.remove("selected"));
                    day.classList.add("selected");
                    selectedDate = parseInt(day.textContent);
                    showSelectedDate();
                }
            });
        });
    }

    var curr_date;
    function showSelectedDate() {
        curr_date2= ` ${currentYear}-${currentMonth+1}-${selectedDate}`;
        curr_date= ` ${monthNames[currentMonth]} ${selectedDate}, ${currentYear}`;
        selectedDateDisplay.textContent =curr_date+" "+s;
    }

    showCalendar(currentMonth, currentYear);
    showSelectedDate();

    prevBtn.addEventListener("click", function() {
        currentYear = currentMonth === 0 ? currentYear - 1 : currentYear;
        currentMonth = currentMonth === 0 ? 11 : currentMonth - 1;
        showCalendar(currentMonth, currentYear);
    });

    nextBtn.addEventListener("click", function() {
        currentYear = currentMonth === 11 ? currentYear + 1 : currentYear;
        currentMonth = currentMonth === 11 ? 0 : currentMonth + 1;
        showCalendar(currentMonth, currentYear);
    });
});




        function redirectToNextPage() {
            let url="";
            add="<?php echo(addslashes($address))?>";
            em="<?php echo(addslashes($email))?>";
            tname="<?php echo(addslashes($tname))?>";
            da=curr_date2;
            if (add === "" || em === "" || tname === "" || da === ""|| s === "" || s1 === ""|| t === "" || typeof s === 'undefined' || s === 0 ||s1==='0:0') {
        alert("Please select  all the required fields.");
    } else {
            let encodedT = encodeURIComponent(t);
    let encodedS = encodeURIComponent(s);
    let encodedS1 = encodeURIComponent(s1);
    let encodedAdd = encodeURIComponent(add);
    let encodedEm = encodeURIComponent(em);
    let encodedTname = encodeURIComponent(tname);
    let encodedDa = encodeURIComponent(da);

    // Construct the URL with encoded parameters


        url = `book_jsp.php?param1=${encodedT}&param2=${encodedS}&param3=${encodedS1}&param4=${encodedAdd}&param5=${encodedEm}&param6=${encodedTname}&param7=${encodedDa}`;

    // Redirect to the constructed URL
    window.location.href = url;
    }
        }
    </script>
      <footer>
        <div class="f">
            <div class="socio">
                <img src="images/Vector.png" alt="">
                <img src="images/linkedin.png" alt="">
                <img src="images/instagram.png" alt="">
                <img src="images/facebook.png" alt="">
            </div>
        </div>
        <div class="s"><p>All Copyrights are reserved by turf.com</p></div>
        <div class="t"><menu>
            <li><a href="login.php">SignIn</a></li>
            <li><a href="register.php">Signup</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="privacypolicy.html">Privacy Policy</a></li>
        </menu></div>
    </footer>
</body>
</html>
