<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Status</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h3>Check Payment Status</h3>
        <div class="form-group">
            <label for="order_id">Order ID</label>
            <input type="text" id="order_id" class="form-control" placeholder="Enter your order ID">
        </div>
        <button id="check_status" class="btn btn-primary">Check Status</button>

        <div class="mt-4" id="status_result">
            <!-- Status result will appear here -->
        </div>
    </div>

    <script>
        document.getElementById('check_status').addEventListener('click', function() {
            const orderId = document.getElementById('order_id').value;
            const statusResult = document.getElementById('status_result');

            if (!orderId) {
                alert('Please enter an order ID');
                return;
            }

            // Fetch payment status
            fetch(`/payment-status/check/${orderId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status_code) {
                        let resultHTML = `<h5>Status: ${data.transaction_status}</h5>`;
                        resultHTML += `<p>Order ID: ${data.order_id}</p>`;
                        resultHTML += `<p>Payment Type: ${data.payment_type}</p>`;
                        resultHTML += `<p>Gross Amount: ${data.gross_amount}</p>`;
                        resultHTML += `<p>Status Code: ${data.status_code}</p>`;
                        resultHTML += `<p>Status Message: ${data.status_message}</p>`;

                        statusResult.innerHTML = resultHTML;
                    } else {
                        statusResult.innerHTML = `<p class="text-danger">Failed to get status. Please try again.</p>`;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    statusResult.innerHTML = `<p class="text-danger">An error occurred. Please try again.</p>`;
                });
        });
    </script>
</body>

</html>