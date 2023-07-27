<!DOCTYPE html>
<html>
<head>
    <title>Currency Converter</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body class="p-3 mb-2 bg-info text-dark">
    <div class="container-fluid custom-background d-flex flex-column align-items-center">
        <div class="title-container text-center mt-4">
            <h3 class="mb-4">Currency Converter</h3>
        </div>
        <div class="mt-3">
            <form method="POST" action="{{ route('currency.convert') }}">
                @csrf
                <div class="form-group">
                    <label for="amountInput">Enter Amount</label>
                    <input type="number" name="amount" id="amountInput" class="form-control" placeholder="Enter amount">
                </div><br>
                <div class="form-group">
                    <label for="fromCurrency">From</label>
                    <select name="fromCurrency" id="fromCurrency" class="form-control from">
                        <option value="USD">USD</option>
                        <!-- Add more currency options as needed -->
                    </select>
                </div><br>
                <div class="form-group">
                    <label for="toCurrency">To</label>
                    <select name="toCurrency" id="toCurrency" class="form-control to">
                        <option value="EUR">EUR</option>
                        <!-- Add more currency options as needed -->
                    </select>
                </div><br>
                <button type="submit" class="btn btn-info text-light" style="margin-left: 30px;">Get Exchange Rate</button>
            </form>
        </div>
    </div>
</body>
</html>
