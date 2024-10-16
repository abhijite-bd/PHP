<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        .header {
            background-color: green;
            color: #ffffff;
            padding: 15px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        .content {
            padding: 20px;
            font-size: 16px;
            color: #333333;
        }

        .content h2 {
            color: green;
        }

        .footer {
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #aaaaaa;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Class Has Been Scheduled</h1>
        </div>
        <div class="content">
            <h2>Class Scheduled: {{ $courseName }} ({{$courseCode}})</h2>
            <p>Your class <strong>{{ $courseName}}({{$courseCode}}) </strong> will be held on <strong>{{ $date }} ({{ $day }})</strong> at <strong>{{ $time }}</strong> .</p>
            <p>Join the class in time.</p>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} EduNexus. All rights reserved.</p>
        </div>
    </div>
</body>

</html>