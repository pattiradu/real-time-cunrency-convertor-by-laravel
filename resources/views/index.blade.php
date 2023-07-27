<!DOCTYPE html>
<html>
<head>
    <title>Currency Converter</title>
    <!-- Link Bootstrap CSS -->
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    
    <!-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"> -->

    <script src="{{ asset('js/script.js') }}"></script>

</head>

<body class="p-3 mb-2 bg-info text-dark">
    
    <div class="container-fluid custom-background d-flex flex-column align-items-center">
       
        <!-- Title div -->
        <div class="title-container text-center mt-4">
            <h3 class="mb-4">Currency Converter</h3>
        </div>
        
        <div class="mt-3">

        @csrf

        <form action="{{ url('/currency-converter') }}" id="currencyConverterForm" method="get">

                <div class="form-group">
                    <label for="amountInput">Enter Amount</label>
                    <input type="number" id="amountInput" class="form-control" placeholder="Enter amount">
                </div><br>

                <div class="form-group">
                    <label for="fromCurrency">From</label>
                    <select id="fromCurrency" class="form-control from">
                        <!-- Currencies will be added dynamically using JavaScript -->
                    </select>
                </div><br>

                <div class="form-group">
                    <label for="toCurrency">To</label>
                    <select id="toCurrency" class="form-control to">
                        <!-- Currencies will be added dynamically using JavaScript -->
                    </select>
                </div><br>

                @csrf
    <button type="submit" class="btn btn-info text-light" style="margin-left: 30px;">Get Exchange Rate</button>
</form>
        </div>

        <div class="result mt-3"></div>

    </div>

    <div class="result mt-3">
    @isset($convertedAmount)
        <p>{{ $amount }} {{ $fromCurrency }} = {{ $convertedAmount }} {{ $toCurrency }}</p>
    @endisset
</div>

    <!-- Include Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    
 
<script src="{{ asset('js/script.js') }}"></script>
    <style>
        /* Custom background style */
        .custom-background {
            background-color: #f2f2f2; /* Set your desired background color here */
            width: 30%; /* Set the desired width (percentage or pixel value) */
            max-width: 800px; /* Set the maximum width if needed */
            margin: 0 auto; /* Center the container horizontally */
            padding: 30px; /* Add padding for better appearance */
            border-radius: 10px; /* Add border-radius for rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add box-shadow for a subtle shadow effect */
        }
    </style>



    
<!-- Include the CSRF token in the meta tag -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    // Fetch currency data from the ExchangeRatesAPI
    async function fetchCurrencies() {
        try {
            const response = await fetch("https://api.exchangeratesapi.io/latest");
            const data = await response.json();
            const currencies = data.rates;
            return currencies;
        } catch (error) {
            console.error("Error fetching currencies:", error);
            return null;
        }
    }

    // Function to populate select element with options
    async function populateSelect(selectElement) {
        const currencies = await fetchCurrencies();
        if (currencies === null) return; // Abort if data couldn't be fetched

        for (const currencyCode in currencies) {
            const option = document.createElement("option");
            option.value = currencyCode;
            option.textContent = `${currencyCode} - ${currencies[currencyCode]}`;
            selectElement.appendChild(option);
        }
    }

    // Populating "From" and "To" select elements on page load
    window.addEventListener("load", function () {
        const fromCurrencySelect = document.getElementById("fromCurrency");
        const toCurrencySelect = document.getElementById("toCurrency");
        populateSelect(fromCurrencySelect);
        populateSelect(toCurrencySelect);
    });

    // JavaScript code to handle form submission and validate input
    document.getElementById("currencyConverterForm").addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent default form submission

        const amountInput = document.getElementById("amountInput");
        const fromCurrencySelect = document.getElementById("fromCurrency");
        const toCurrencySelect = document.getElementById("toCurrency");

        if (amountInput.value === "" || amountInput.value === "0") {
            alert("Please enter a valid amount.");
            return; // Stop form submission if amount is invalid
        }

        // Get the selected currencies and submit the form using AJAX
        const fromCurrency = fromCurrencySelect.value;
        const toCurrency = toCurrencySelect.value;
        const amount = amountInput.value;

        // Perform AJAX POST request to the form action URL with the form data
        const formData = new FormData();
        formData.append("_token", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
        formData.append("fromCurrency", fromCurrency);
        formData.append("toCurrency", toCurrency);
        formData.append("amount", amount);

        fetch("/currency-converter", {

            method: "POST",
            body: formData,
        })
            .then((response) => response.json())
            .then((data) => {
                // Display the result in the "result" div
                const resultDiv = document.querySelector(".result");
                resultDiv.innerHTML = `<p>${data.amount} ${data.fromCurrency} = ${data.convertedAmount} ${data.toCurrency}</p>`;
            })
            .catch((error) => {
                console.error("Error submitting form:", error);
            });
    });
</script>

  
</body>
</html>
