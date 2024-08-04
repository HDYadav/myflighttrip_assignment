<!DOCTYPE html>
<html>

<head>
    <title>Search Flights</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }

        h1 {
            margin-top: 0;
            color: #333;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input,
        select,
        button {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .loader {
            display: none;
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            z-index: 1000;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">
</head>

<body>
    <div class="loader" id="loader"></div>
    <div class="container">
        <h1>Search Flights</h1>
        <form id="search-form" action="/flights" method="POST">
            @csrf
            <label for="origin">Origin:</label>
            <select id="origin" name="origin" required>
                <option value="DEL">New Delhi (DEL) - Indira Gandhi International</option>
                <option value="BOM">Mumbai (BOM) - Chhatrapati Shivaji International</option>
                <option value="BLR">Bangalore (BLR) - Kempegowda International</option>
                <option value="MAA">Chennai (MAA) - Chennai International</option>
                <option value="HYD">Hyderabad (HYD) - Shamshabad Rajiv Gandhi</option>
                <option value="GOI">Goa (GOI) - Dabolim</option>
                <option value="CCU">Kolkata (CCU) - Netaji Subhas Chandra Bose</option>
                <option value="PNQ">Pune (PNQ) - Lohegaon</option>
                <option value="JAI">Jaipur (JAI) - Sanganeer</option>
                <option value="LKO">Lucknow (LKO) - Amausi</option>
            </select>

            <label for="destination">Destination:</label>
            <select id="destination" name="destination" required> 
                <option value="BOM">Mumbai (BOM) - Chhatrapati Shivaji International</option>
                <option value="BLR">Bangalore (BLR) - Kempegowda International</option>
                <option value="MAA">Chennai (MAA) - Chennai International</option>
                <option value="HYD">Hyderabad (HYD) - Shamshabad Rajiv Gandhi</option>
                <option value="GOI">Goa (GOI) - Dabolim</option>
                <option value="CCU">Kolkata (CCU) - Netaji Subhas Chandra Bose</option>
                <option value="PNQ">Pune (PNQ) - Lohegaon</option>
                <option value="JAI">Jaipur (JAI) - Sanganeer</option>
                <option value="LKO">Lucknow (LKO) - Amausi</option>
            </select>

            <label for="departure_date">Departure Date:</label>
            <input type="text" id="departure_date" name="departure_date" required>

            <label for="adult">Number of Adult Passengers:</label>
            <select name="adult">
                <option value="1"> 1 </option>
                <option value="2">2 </option>
                <option value="3"> 3 </option>
                <option value="4"> 4 </option>
                <option value="5"> 5 </option>
            </select>

            <label for="child">Number of Child Passengers:</label>
            <select name="child">
                <option value="0"> 0 </option>
                <option value="1"> 1 </option>
                <option value="2">2 </option>
                <option value="3"> 3 </option>
                <option value="4"> 4 </option>
                <option value="5"> 5 </option>
            </select>

            <label for="class">Airline Class:</label>
            <select id="class" name="class" required>
                <option value="ECONOMY">Economy</option>
                <option value="BUSINESS">Business</option>
                <option value="FIRST">First</option>
            </select>

            <button type="submit">Search Flights</button>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
    <script>
        flatpickr("#departure_date", {
            dateFormat: "Y-m-d",
            minDate: "today"
        });

        document.getElementById('search-form').addEventListener('submit', function(e) {
            document.getElementById('loader').style.display = 'block';
        });
    </script>
</body>

</html>