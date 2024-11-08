<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download PDFs</title>
</head>
<body>
    <h1>Download All PDFs for Batch P123123</h1>
    
    <!-- Button to trigger the download -->
    <button id="downloadButton">Download PDFs</button>

    <script>
        // JavaScript to trigger the PHP script when the button is clicked
        document.getElementById('downloadButton').addEventListener('click', function() {
            window.location.href = 'download_pdfs.php'; // URL to the PHP script that handles the download
        });
    </script>
</body>
</html>
