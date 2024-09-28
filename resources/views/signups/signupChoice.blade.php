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
            background: url('/images/ready-back-school.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5); /* Adjust the opacity as needed */
            z-index: 1;
        }

        .container {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
            display: flex;
            width: 900px;
            max-width: 100%;
            z-index: 2; /* Make sure the container is above the overlay */
        }

        .left-section {
            background-color: #057A55;
            color: white;
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

        .right-section form {
            max-width: 300px;
            width: 100%;
        }

        .logo img {
            width: 50px;
            height: 50px;
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
                <img src="/images/notebook.png" alt="Logo">
            </div>
            <h2 class="text-2xl font-semibold mb-4 text-center">Sign in</h2>
            <a href="{{ route('gotoStudentSignupPage') }}">Student Signup</a>
            <a href="{{ route('gotoTeacherSignupPage') }}">Teacher Signup</a>
            <a href="{{ route('gotoAdminSignupPage') }}">Admin Signup</a>
            
            <div class="mt-10 text-center">
                <p class="text-xs text-gray-400">Web App Version: 1.0.0</p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
</body>
</html>
