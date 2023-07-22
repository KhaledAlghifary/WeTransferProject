<!DOCTYPE html>
<html>
<head>
    <title>Download Files</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .download-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
        .download-link:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Download Files</h1>
        <p>Sender: {{ $senderEmail }}</p>

        <p>Click the button below to download the files:</p>
        <a target="_blank" href="{{ $route }}" class="download-link">Download Files</a>
    </div>
</body>
</html>
