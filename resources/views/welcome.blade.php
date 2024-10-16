<!-- resources/views/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Include Flowbite CDN -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <style>
        body {
            position: relative;
            background-color: #f0f4f8; /* Solid background color */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            background-color: #6b72;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            border-radius: 12px;
            overflow: hidden;
            display: flex;
            width: 700px;
            max-width: 100%;
        }

        .left-section {
            padding: 40px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .right-section {
            padding: 40px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .right-section a {
            margin: 10px 0;
            padding: 12px 24px;
            display: block;
            width: 100%;
            text-align: center;
            background-color: #4e63ea;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .right-section a:hover {
            background-color: #3b4bb5;
        }

        .right-section .logo img {
            width: 60px;
            height: 60px;
        }

        .right-section h2 {
            margin-bottom: 20px;
            font-size: 1.8rem;
            font-weight: bold;
        }

        .version-text {
            margin-top: 20px;
            font-size: 0.8rem;
            color: #6b7280;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="left-section">
            <h3 class="text-3xl font-bold">Welcome to EduNexus</h3>
            <p class="mt-4 text-sm text-white-300"><strong>EduNexus</strong> ensures efficient communication among all users while providing role-based access for privacy and security. Teachers can manage and update course content, while students can track their progress in real-time, leading to a more transparent and organized learning environment. Additionally, the platform's flexibility allows for easy customization to suit the specific needs of the institution.</p>


            <div class="mt-4">
                <p class="text-xs text-gray-100">- Made by TeamDev</p>
            </div>
        </div>
        <div class="right-section">
            <div class="logo mb-8">
            </div>
            <h2 class="text-2xl font-semibold mb-4 text-center">Sign in</h2>
            <a href="{{ route('gotoStudentLoginPage') }}">Student Login</a>
            <a href="{{ route('gotoTeacherLoginPage') }}">Teacher Login</a>
            <a href="{{ route('gotoAdminLoginPage') }}">Admin Login</a>
            <div class="mt-10 text-center">
                <p class="text-xs text-gray-400">Web App Version: 1.0.0</p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
</body>

</html>