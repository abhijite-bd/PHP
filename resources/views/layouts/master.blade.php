<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduNexus</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css">
    @notifyCss
</head>

<body class="bg-gray-100">



    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('images/HSTU_Logo (1).png') }}" class="h-8 me-3" alt="HSTU Logo" />
                <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">EduNexus</span>
            </a>
            <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <button type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                </button>
                <!-- Dropdown menu -->
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
                    <div class="px-4 py-3">
                        <span class="block text-sm text-gray-900 dark:text-white">{{session('curr_user')->name}}</span>
                        <span class="block text-sm  text-gray-500 truncate dark:text-gray-400">{{session('curr_user')->email}}</span>
                    </div>
                    <ul class="py-2" aria-labelledby="user-menu-button">
                        @if(session('user_role') == 'Admin')
                        <li>
                            <a href="{{ route('gotoAdminDashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard</a>
                        </li>
                        @elseif(session('user_role') == 'Teacher')
                        <li>
                            <a href="{{ route('gotoTeacherDashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard</a>
                        </li>
                        @else
                        <li>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Dashboard</a>
                        </li>
                        @endif
                        <li>
                            <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Sign out</a>
                        </li>
                    </ul>
                </div>
                <button data-collapse-toggle="navbar-user" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-user" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
                <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                    @if(session('user_role') == 'Admin')
                    <li>
                        <a href="{{ route('gotoAdminDashboard') }}" class="block py-2 px-3 {{ request()->routeIs('gotoAdminDashboard') ? 'text-blue-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent' }} rounded md:bg-transparent md:p-0 dark:bg-blue-600 md:dark:bg-transparent" aria-current="page">Dashboard</a>
                    </li>
                    <li>
                        <a href="{{ route('routine.upload.page') }}" class="block py-2 px-3 {{ request()->routeIs('routine.upload.page') ? 'text-blue-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent' }} rounded md:bg-transparent md:p-0 dark:bg-blue-600 md:dark:bg-transparent" aria-current="page"> Routine</a>
                    </li>
                    <li>
                        <button id="UsersNavbarLink" data-dropdown-toggle="UsersNavbar" class="{{ request()->routeIs('gotoAdminSignupPage') || request()->routeIs('gotoTeacherSignupPage') || request()->routeIs('gotoStudentSignupPage') ? 'text-blue-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent' }} flex items-center justify-between w-full py-2 px-3 rounded md:bg-transparent md:p-0 dark:bg-blue-600 md:dark:bg-transparent">
                            Users
                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="UsersNavbar" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                                <li>
                                    <a href="{{ route('gotoAdminSignupPage') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Add Admin</a>
                                </li>
                                <li>
                                    <a href="{{ route('gotoTeacherSignupPage') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Add Teacher</a>
                                </li>
                                <li>
                                    <a href="{{ route('gotoStudentSignupPage') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Add Student</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <button id="CoursesNavbarLink" data-dropdown-toggle="CoursesNavbar" class="{{ request()->routeIs('gotoAddCoursePage') || request()->routeIs('gotoDistributeCoursePage') ? 'text-blue-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent' }} flex items-center justify-between w-full py-2 px-3 rounded md:bg-transparent md:p-0 dark:bg-blue-600 md:dark:bg-transparent">
                            Courses
                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="CoursesNavbar" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-400" aria-labelledby="dropdownLargeButton">
                                <li>
                                    <a href="{{ route('gotoAddCoursePage') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Add Courses</a>
                                </li>
                                <li>
                                    <a href="{{ route('gotoDistributeCoursePage') }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Distribute Courses</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="{{ route('validationReq') }}" class="block py-2 px-3 {{ request()->routeIs('routine.upload.page') ? 'text-blue-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent' }} rounded md:bg-transparent md:p-0 dark:bg-blue-600 md:dark:bg-transparent" aria-current="page">Results</a>
                    </li>
                    @elseif(session('user_role') == 'Teacher')
                    <li>
                        <a href="{{ route('gotoTeacherDashboard') }}" class="block py-2 px-3 {{ request()->routeIs('gotoTeacherDashboard') ? 'text-blue-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent' }} rounded md:bg-transparent md:p-0 dark:bg-blue-600 md:dark:bg-transparent" aria-current="page">Dashboard</a>
                    </li>
                    <li>
                        <a href="{{ route('gotoTeacherClassSchedule') }}" class="block py-2 px-3 {{ request()->routeIs('gotoTeacherClassSchedule') ? 'text-blue-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent' }} rounded md:bg-transparent md:p-0 dark:bg-blue-600 md:dark:bg-transparent" aria-current="page">Class Schedule</a>
                    </li>
                    <li>
                        <a href="{{ route('gotoTeachersCoursesPage') }}" class="block py-2 px-3 {{ request()->routeIs('gotoTeachersCoursesPage') || request()->routeIs('gotoTeachersCourseViewPage') ? 'text-blue-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent' }} rounded md:bg-transparent md:p-0 dark:bg-blue-600 md:dark:bg-transparent" aria-current="page">Your Courses</a>
                    </li>

                    @if((request()->routeIs('gotoTeachersCourseViewPage') || request()->routeIs('gotoUploadMaterialByTeacherPage') || request()->routeIs('gotoUploadAssignmentByTeacherPage')))
                    @yield('content2')

                    @endif
                    @elseif(session('user_role') == 'Student')
                    <li>
                        <a href="{{ route('gotoStudentDashboard') }}" class="block py-2 px-3 {{ request()->routeIs('gotoTeacherDashboard') ? 'text-blue-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent' }} rounded md:bg-transparent md:p-0 dark:bg-blue-600 md:dark:bg-transparent" aria-current="page">Dashboard</a>
                    </li>
                    <li>
                        <a href="{{ route('gotoStudentCoursesPage') }}" class="block py-2 px-3 {{ request()->routeIs('gotoStudentCoursesPage') || request()->routeIs('gotoStudentsCourseViewPage') ? 'text-blue-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent' }} rounded md:bg-transparent md:p-0 dark:bg-blue-600 md:dark:bg-transparent" aria-current="page">Your Courses</a>
                    </li>
                    <li>
                        <a href="{{ route('gotoUploadMaterialByStudentPage') }}" class="block py-2 px-3 {{ request()->routeIs('gotoUploadMaterialByStudentPage') ? 'text-blue-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent' }} rounded md:bg-transparent md:p-0 dark:bg-blue-600 md:dark:bg-transparent" aria-current="page">Your Resources</a>
                    </li>
                    <li>
                        <a href="{{ route('gotoResult') }}" class="block py-2 px-3 {{ request()->routeIs('gotoUploadMaterialByStudentPage') ? 'text-blue-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent' }} rounded md:bg-transparent md:p-0 dark:bg-blue-600 md:dark:bg-transparent" aria-current="page">Your Result</a>
                    </li>
                    <li>
                        <a href="{{ route('gotoStudentClassSchedule') }}" class="block py-2 px-3 {{ request()->routeIs('gotoUploadMaterialByStudentPage') ? 'text-blue-700' : 'text-gray-900 hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent' }} rounded md:bg-transparent md:p-0 dark:bg-blue-600 md:dark:bg-transparent" aria-current="page">Class Schedule</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-5">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
    <script src="https://kit.fontawesome.com/dbf830dbab.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <x-notify::notify />
    @notifyJs
</body>

</html>