<html>

<body onload="return paymentYuk()">
    <!-- <button id="pay-button">Pay!</button>
    <pre><div id="result-json">JSON result will appear here after payment:<br></div></pre> -->

    <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-_-BUF2ld7yxAhFMo"></script>
    <script type="text/javascript">
        function paymentYuk() {
            // SnapToken acquired from previous step
            snap.pay('<?= $snapToken ?>', {
                // Optional
                onSuccess: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(JSON.stringify(result, null, 2));

                    // Mengirim data JSON ke server dengan AJAX
                    $.ajax({
                        url: '/payment/transaction', // URL untuk mengirim data (sesuaikan dengan route di CodeIgniter 4)
                        type: 'POST',
                        contentType: 'application/json',
                        data: JSON.stringify(result, null, 2), // Konversi objek JS ke JSON
                        success: function(response) {
                            console.log('Data berhasil disimpan:', response);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                },
                // Optional
                onPending: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(JSON.stringify(result, null, 2));

                    // Mengirim data JSON ke server dengan AJAX
                    $.ajax({
                        url: '/payment/transaction', // URL untuk mengirim data (sesuaikan dengan route di CodeIgniter 4)
                        type: 'POST',
                        contentType: 'application/json',
                        data: JSON.stringify(result, null, 2), // Konversi objek JS ke JSON
                        success: function(response) {
                            console.log('Data berhasil disimpan:', response);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(JSON.stringify(result, null, 2));

                    // Mengirim data JSON ke server dengan AJAX
                    $.ajax({
                        url: '/payment/transaction', // URL untuk mengirim data (sesuaikan dengan route di CodeIgniter 4)
                        type: 'POST',
                        contentType: 'application/json',
                        data: JSON.stringify(result, null, 2), // Konversi objek JS ke JSON
                        success: function(response) {
                            console.log('Data berhasil disimpan:', response);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                }
            });
        };
    </script>
</body>

</html>