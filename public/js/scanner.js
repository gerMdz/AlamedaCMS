function docReady(fn) {
    // see if DOM is already available
    if (document.readyState === "complete" || document.readyState === "interactive") {
        // call on next available tick
        setTimeout(fn, 1);
    } else {
        document.addEventListener("DOMContentLoaded", fn);
    }
}

docReady(function() {
    var resultContainer = document.getElementById('qr-reader-results');
    var lastResult, countResults = 0;

    var html5QrcodeScanner = new Html5QrcodeScanner(
        "qr-reader", { fps: 10, qrbox: 250 });

    function onScanSuccess(qrCodeMessage) {
        if (qrCodeMessage !== lastResult) {
            ++countResults;
            lastResult = qrCodeMessage;
            window.location.replace(qrCodeMessage);
            // resultContainer.innerHTML += `<div>${qrCodeMessage}</div>`;

            // Optional: To close the QR code scannign after the result is found
            //html5QrcodeScanner.clear();
        }
    }

    // Optional callback for error, can be ignored.
    function onScanError(qrCodeError) {
        // This callback would be called in case of qr code scan error or setup error.
        // You can avoid this callback completely, as it can be very verbose in nature.
    }

    html5QrcodeScanner.render(onScanSuccess, onScanError);
});