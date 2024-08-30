<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accommodation</title>
    <link rel="stylesheet" href="StyleSheet.css">
    <style>
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
        }

        .container h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .accommodation-content {
            margin-top: 20px;
        }
    </style>
    <script>
        function showAccommodation() {
            var place = document.getElementById("place").value;
            var content = document.getElementById("accommodation-content");

            switch (place) {
                case "Overland Park":
                    content.innerHTML = `<p> There are few top Appartments where UCM students stay.</p></br></br>
                        <iframe src="https://www.thelakesatlionsgate.com/floorplans.aspx" width="100%" height="600px"></iframe></br></br>
                        <iframe src="https://www.whisperinghillsks.com/floorplans/" width="100%" height="600px"></iframe></br></br>
                        <a href="https://www.villageatlionsgate.com/floorplans/" target="_blank">Village at LionsGate</a></br></br>
                        <a href="https://www.corbingreens.com/floorplans" target="_blank">Corbin Greens</a></br></br>
                        <a href="https://www.willowcreekaptskc.com/floorplans" target="_blank">Willow Creek</a></br></br>
                        <a href="https://www.skylerridge.com/floorplans" target="_blank">Skyler Ridge</a></br></br>
                        <a href="https://www.highlandridgekc.com/floorplans" target="_blank">Highlandridge</a></br></br>
                        <a href="https://www.lexingtonfarmsapts.com/floorplans" target="_blank">Lexington farms</a></br></br>
                        <a href="https://www.pointeroyalapts.com/floorplans" target="_blank">Pointe Royal</a></br></br>
                        <p>Please click on the above links for new lease or join the whats App group - <a href="https://chat.whatsapp.com/BRtcbW8mUed8cJ4OYTfkcJ" target="_blank">Whatsapp</a> for shared accommodation.</p>`;
                    break;
                case "Lees Summit":
                    content.innerHTML = `<p>Please join the whats App group - <a href="https://chat.whatsapp.com/BRtcbW8mUed8cJ4OYTfkcJ" target="_blank">Whatsapp</a> for shared accommodation.</p></br></br>
                    <p>Click on the below link for new lease in the latest appartments which are just under 5 mins walk from MIC campus.</p></br>
                    <a href="https://www.thedonovankc.com/lees-summit-mo-apartments/the-donovan/conventional/" target="_blank">The Donovan</a></br></br>`;
                    break;
                case "Warrensburg":
                    content.innerHTML = `<p>Please join the whats App group - <a href="https://chat.whatsapp.com/BRtcbW8mUed8cJ4OYTfkcJ" target="_blank">Whatsapp</a> for shared accommodation.</p></br>
                    <p>For university accomodation click on the below link.</p></br>
                    <a href="https://www.ucmo.edu/future-students/university-housing-and-dining-services/" target="_blank">UCM Accomodation</a></br></br>`;
                    break;
                case "Kansas City":
                    content.innerHTML = `<p>Please join the whats App group - <a href="https://chat.whatsapp.com/BRtcbW8mUed8cJ4OYTfkcJ" target="_blank">Whatsapp</a> for shared accommodation.</p>`;
                    break;
                default:
                    content.innerHTML = "";
                    break;
            }
        }
    </script>
</head>

<body>
    <nav>
        <a href="Home.php">Home</a>
    <a href="academic.php" class="academic"><span>Academic</span></a>
    <a href="requestrides.php" class="requestrides"><span>Request Rides</span></a>
    <a href="providerides.php" class="providerides"><span>Provide Rides</span></a>
    <a href="calendar.php" class="calendar"><span>Rides Calendar</span></a>
    <a href="courier.php" class="courier"><span>Courier Service</span></a>
    <a href="Expenses.php" class="expenses"><span>Expense Calculator</span></a>
    <a href="CarExpenses.php" class="carmaintenance"><span>Car Maintenance Calculator</span></a>
        <a href="logout.php">Logout</a>
    </nav><main>
    <div class="container">
        <h1>Accommodation</h1>
        <label for="place">Select a place:</label>
        <select id="place" name="place" onchange="showAccommodation()">
            <option value="">--Select--</option>
            <option value="Overland Park">Overland Park</option>
            <option value="Lees Summit">Lees Summit</option>
            <option value="Warrensburg">Warrensburg</option>
            <option value="Kansas City">Kansas City</option>
        </select>

        <div id="accommodation-content" class="accommodation-content"></div>
    </div></main>
    <footer>
        <p>&copy; 2024 UCM Student Hub. All rights reserved.</p>
    </footer>
</body>

</html>