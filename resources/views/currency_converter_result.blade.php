<!DOCTYPE html>
<html>
<head>
    <title>Currency Converter Result</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body class="p-3 mb-2 bg-info text-dark">
    <div class="container-fluid custom-background d-flex flex-column align-items-center">
        <div class="title-container text-center mt-4">
            <h3 class="mb-4">Currency Converter Result</h3>
        </div>
        <div class="mt-3">
            <p>Amount: {{ $amount }} {{ $fromCurrency }}</p>
            <p>Converted to: {{ $convertedAmount }} {{ $toCurrency }}</p>
        </div>
    </div>
</body>
</html>
