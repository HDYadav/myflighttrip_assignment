<!DOCTYPE html>
<html>

<head>
    <title>Flights</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
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

        .flight {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .flight h2 {
            margin-top: 0;
            color: #333;
        }

        .flight p {
            margin: 5px 0;
            color: #666;
        }

        .flight .segment {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .flight .segment p {
            margin: 5px 0;
            color: #555;
        }

        .flight .segment .duration {
            font-weight: bold;
            color: #007bff;
        }

        .flight .segment .city {
            font-style: italic;
            color: #333;
        }

        .flight ul {
            list-style: none;
            padding: 0;
        }

        .flight li {
            background-color: #fafafa;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.05);
        }

        hr {
            border: 0;
            height: 1px;
            background-color: #ddd;
            margin: 40px 0;
        }

        select {
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
            background-color: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }

        .toggle-content {
            display: none;
            margin-top: 20px;
        }

        .tabs {
            display: flex;
            border-bottom: 1px solid #ddd;
        }

        .tabs button {
            flex: 1;
            padding: 10px;
            border: none;
            background: #f4f4f4;
            cursor: pointer;
            outline: none;
        }

        .tabs button.active {
            background: #fff;
            border-top: 2px solid #007bff;
        }

        .tab-content {
            display: none;
            padding: 20px;
            border: 1px solid #ddd;
            border-top: none;
        }

        .tab-content.active {
            display: block;
        }

        .toggle-button {
            cursor: pointer;
            color: #ff4d4d;
        }

        .toggle-button:hover {
            color: #e60000;
        }
    </style>
</head>

<body>
    <div class="loader" id="loader"></div>
    <h1>Available Flights</h1>

    <div id="flights-container">

        <?php
        $i = 0;
        ?>
        @foreach($flights as $flight)
        <div class="flight">

            <?php
            // dump($flight['totalPriceList']);

            $totalFareCount = count($flight['totalPriceList']);
            ?>
            <p>+ ({{ $totalFareCount }}) Fare

                <select name="">
                    <?php foreach ($flight['totalPriceList'] as $priceExtract) { ?>
                        <option value="">
                            <?php echo '₹ ' . ($priceExtract['fd']['ADULT']['fC']['NF'] + $priceExtract['fd']['CHILD']['fC']['NF']); ?>
                            <?php echo ' ' . $priceExtract['fd']['ADULT']['fB']; ?>
                            <?php echo ' ' . $priceExtract['fd']['ADULT']['cc']; ?>
                        </option>
                    <?php } ?>
                </select>
            </p>

            @foreach($flight['sI'] as $flightSi)
            <div class="segment">
                <p class="duration">
                    {{ \Carbon\Carbon::parse($flight['sI'][0]['dt'])->format('H:i') }}
                    <span class="city">{{ $flight['sI'][0]['da']['city'] }}, {{ \Carbon\Carbon::parse($flight['sI'][0]['dt'])->format('j F Y') }}</span>,
                    {{ intdiv($flightSi['duration'], 60) }}H:{{ $flightSi['duration'] % 60 }}M,
                    {{ \Carbon\Carbon::parse($flight['sI'][0]['at'])->format('H:i') }},
                    <span class="city">{{ $flight['sI'][0]['aa']['city'] }}, {{ \Carbon\Carbon::parse($flight['sI'][0]['at'])->format('j F Y') }}</span>
                </p>

                <p class="duration">
                    <span class="city">Stop:</span> {{ $flightSi['stops'] ?? 'N/A' }}
                </p>

                <ul>
                    @foreach($flightSi['fD'] as $flightFDS)
                    @if(!empty($flightFDS['name']) || !empty($flightFDS['code']))
                    <li>Flight Name: {{ $flightFDS['name'] ?? 'N/A' }}</li>
                    <li>Flight Code: {{ $flightFDS['code'] ?? 'N/A' }} - {{ $flightSi['fD']['fN'] ?? 'N/A' }}</li>
                    @endif
                    @endforeach
                </ul>

                <!-- Total Available Seats -->
                <p>Total Available Seats: {{ $flight['totalSeats'] ?? 'N/A' }}</p>
            </div>
            @endforeach
        </div>
        <p class="toggle-button">Flight Details</p>
        <div class="toggle-content">
            <div class="tabs">
                <button class="tab-button active" data-tab="tab<?php echo $i; ?>1">Flight Details</button>
                <button class="tab-button" data-tab="tab<?php echo $i; ?>2">Fare Details</button>
                <button class="tab-button" data-tab="tab<?php echo $i; ?>3">Fare Rules</button>
                <button class="tab-button" data-tab="tab<?php echo $i; ?>4">Baggage Information</button>
            </div>
            <div class="tab-content active" id="tab<?php echo $i; ?>1">Content for Tab 1</div>
            <div class="tab-content" id="tab<?php echo $i; ?>2">Content for Tab 2</div>
            <div class="tab-content" id="tab<?php echo $i; ?>3">Content for Tab 3</div>
            <div class="tab-content" id="tab<?php echo $i; ?>4">Content for Tab 4</div>
        </div>
        <hr>
        <?php
        $i++;
        ?>
        @endforeach
    </div>

    <script>
        document.getElementById('loader').style.display = 'block';

        window.addEventListener('load', function() {
            document.getElementById('loader').style.display = 'none';
            document.getElementById('flights-container').style.display = 'block';
        });

        // Toggle fare details
        document.querySelectorAll('.toggle-button').forEach(button => {
            button.addEventListener('click', function() {
                const content = this.nextElementSibling;
                content.style.display = content.style.display === 'block' ? 'none' : 'block';
            });
        });

        // Tab functionality
        document.querySelectorAll('.tab-button').forEach(button => {
            button.addEventListener('click', function() {
                const tabId = this.getAttribute('data-tab');

                // Remove active class from all tabs and tab buttons
                document.querySelectorAll('.tab-button').forEach(btn => btn.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));

                // Add active class to clicked tab button and corresponding tab
                this.classList.add('active');
                document.getElementById(tabId).classList.add('active');
            });
        });
    </script>
</body>

</html>