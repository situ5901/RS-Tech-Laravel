<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home-page</title>
    <style>
        .main {
            text-align: center;
            margin-top: 180px;
        }
        .imgg {
            height: 40px;
            width: 40px;
        }
    </style>
</head>
<body>

    <div class="img">
        <img class="imgg" src="{{ asset('admin-assest/img/repo.png') }}" alt="">
    </div>
    
    <div class="main">
        <h1 id="welcomeText">Welcome to Costmor page</h1>
        <p>We are using Laravel version 10 and PHP version 8.1</p>
        <p>Thanks for visiting our store</p>
        <!-- New element to display date and time -->
        <p id="dateTime"></p>
    </div>

    <script>
        // Function to fetch real-time data
        function fetchData() {
            fetch('/api/realtime-data') // Replace this URL with your Laravel route that provides real-time data
                .then(response => response.json())
                .then(data => {
                    // Update the DOM with the fetched data
                    document.getElementById('welcomeText').textContent = data.welcomeMessage;
                })
                .catch(error => console.error('Error fetching data:', error));
        }

        // Function to update date and time
        function updateDateTime() {
            const currentDate = new Date();
            const dateTimeString = currentDate.toLocaleString(); // Adjust date and time format as needed
            document.getElementById('dateTime').textContent = 'Current date and time: ' + dateTimeString;
        }

        // Call fetchData initially
        fetchData();

        // Call fetchData every 5 seconds to get real-time updates
        setInterval(fetchData, 5000); // Adjust the interval as needed

        // Call updateDateTime initially
        updateDateTime();

        // Call updateDateTime every second to update date and time
        setInterval(updateDateTime, 1000);
    </script>
</body>
</html>
