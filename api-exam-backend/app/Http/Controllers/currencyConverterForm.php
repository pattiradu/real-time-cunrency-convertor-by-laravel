<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class currencyConverterForm extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function currencyConverterForm(Request $request)
     {
         $fromCurrency = $request->input('fromCurrency');
         $toCurrency = $request->input('toCurrency');
         $amount = $request->input('amount');
     
         // Fetch the exchange rate from the external API
         $apiKey = "YOUR_API_KEY"; // Replace this with your actual API key
         $apiUrl = "https://v6.exchangerate-api.com/v6/{$apiKey}/latest/{$fromCurrency}/{$toCurrency}";
     
         try {
             $response = file_get_contents($apiUrl);
             $data = json_decode($response, true);
     
             // Check if the API response contains the conversion rate
             if (isset($data['conversion_rate'])) {
                 $exchangeRate = $data['conversion_rate'];
                 $convertedAmount = $amount * $exchangeRate;
                 $convertedAmount = number_format($convertedAmount, 2); // Format the amount with two decimal places
             } else {
                 throw new \Exception("Failed to get exchange rate from API");
             }
         } catch (\Exception $e) {
             // Handle API errors or connection issues
             $convertedAmount = null; // Set the converted amount to null to indicate an error
         }
     
         return view('index', compact('convertedAmount', 'fromCurrency', 'toCurrency', 'amount'));
     }
     


     public function convertCurrency(Request $request)
     {
         $fromCurrency = $request->input('fromCurrency');
         $toCurrency = $request->input('toCurrency');
         $amount = $request->input('amount');
 
         // Fetch the exchange rate from the external API
         $apiKey = "YOUR_API_KEY"; // Replace this with your actual API key
         $apiUrl = "https://v6.exchangerate-api.com/v6/{$apiKey}/latest/{$fromCurrency}/{$toCurrency}";
 
         try {
             $response = file_get_contents($apiUrl);
             $data = json_decode($response, true);
 
             // Calculate the converted amount based on the exchange rate
             if (isset($data['conversion_rate'])) {
                 $exchangeRate = $data['conversion_rate'];
                 $convertedAmount = $amount * $exchangeRate;
                 $convertedAmount = number_format($convertedAmount, 2); // Format the amount with two decimal places
             } else {
                 throw new \Exception("Failed to get exchange rate from API");
             }
         } catch (\Exception $e) {
             // Handle API errors or connection issues
             $convertedAmount = "Error: Unable to convert currency";
         }
 
         // Prepare the response data as an array
         $responseData = [
             'fromCurrency' => $fromCurrency,
             'toCurrency' => $toCurrency,
             'amount' => $amount,
             'convertedAmount' => $convertedAmount,
         ];
 
         return response()->json($responseData); // Return the data as a JSON response
     }
 

    public function index()
    {
        //

        return view('currency-converter');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
