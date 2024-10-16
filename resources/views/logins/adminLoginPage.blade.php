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
            background-color: #f0f4f8;
            /* Solid background color */
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
            width: 800px;
            max-width: 100%;
        }

        .left-section {
            /* background-color: #047857; Solid color for the left section */
            /* color: white; */
            padding: 20px;
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
            <h3 class="text-3xl font-bold text-center mb-8">Welcome to EduNexus</h3>
            <div class="flex justify-between items-center mb-8 ">
                <img src="{{ asset('/images/images.png') }}" alt="Logo" class="w-150 h-400">
            </div>
            <div class="mt-4">
                <p class="text-xs text-gray-100">- Made by TeamDev</p>
            </div>
        </div>
        <div class="right-section">
            <div class="logo mb-8">
            </div>
            <h2 class="text-2xl font-semibold mb-4 text-center">Admin Login</h2>
            <form action="{{ route('loginAdmin') }}" method="POST">
                @csrf
                @if(\Illuminate\Support\Facades\Session::has('error'))
                <div class="text-sm mb-5 text-red-500">
                    {{ \Illuminate\Support\Facades\Session::get('error') }}
                </div>
                @endif

                @if(\Illuminate\Support\Facades\Session::has('success'))
                <div class="text-sm mb-5 text-green-500">
                    {{ \Illuminate\Support\Facades\Session::get('success') }}
                </div>
                @endif

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email*</label>
                    <input type="text" name="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password*</label>
                    <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 sm:text-sm" required>
                </div>
                <div>
                    <button type="submit" class="mt-4 w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Sign in
                    </button>
                </div>
            </form>
            <div class="mt-10 text-center">
                <p class="text-xs text-gray-400">Web App Version: 1.0.0</p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
</body>

</html>