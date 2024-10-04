<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Result</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-8">
        <h1 class="text-center mb-4">My Result</h1>
        @if (isset($result))
        <div class="alert alert-info text-center">
            <strong>CGPA:</strong> {{ number_format($result, 3) }}
        </div>
        @endif
        <form class="bg-light p-4 shadow rounded">


            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Semester</th>
                        <th>CGPA</th>
                        <th>Total Credit</th>
                        <th>Courses</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 1; $i <= 8; $i++)
                        <tr>
                        <td>Level {{ ceil($i / 2) }} Semester {{ $i % 2 == 1 ? 1 : 2 }}</td>
                        <td>{{ $cgpa->{'sem'.$i} ?? 'Not Published' }}</td>
                        <td>{{ $credits[$i-1] }}</td>
                        <td>
                            <button type="button" class="btn btn-info view-courses"
                                data-semester="{{ $i  }}"
                                data-bs-toggle="modal" data-bs-target="#courseModal">
                                View Courses
                            </button>
                        </td>
                        </tr>
                        @endfor
                </tbody>
            </table>
        </form>
    </div>

    <!-- Course Modal -->
    <div class="modal fade" id="courseModal" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="courseModalLabel">Course List</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul id="course-list" class="list-group">
                        <!-- Course list will be populated here via hardcoded data -->
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS & jQuery (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        // Hardcoded course data
        var coursesData = {
            '1': [
                'Fundamentals of Computer and Computing',
                'Fundamentals of Computer and Computing Sessional',
                'Discrete Mathematics',
                'Mathematics 1 (Calculus and Co-ordinate Geometry)',
                'Physics (Electricity, Magnetism, Optics, Waves and Oscillations)',
                'Physics (Electricity, Magnetism, Optics, Waves, and Oscillations) Sessional',
                'Basic Mechanical Engineering',
                'Communicative English',
                'Communicative English Sessional'
            ],
            '2': [
                'Structured Programming Language',
                'Structured Programming Language Sessional',
                'Digital Logic Design',
                'Digital Logic Design Sessional',
                'Introduction to Electrical Engineering',
                'Introduction to Electrical Engineering Sessional',
                'Engineering Drawing and Auto CAD Sessional',
                'Mathematics II (Matrix, Ordinary and Partial Differential Equations, and Series Solutions)',
                'Society and Technology'
            ],
            '3': [
                'Object Oriented Programming',
                'Object Oriented Programming (C++) Sessional',
                'Data Structures',
                'Data Structures Sessional',
                'Numerical Methods',
                'Numerical Methods Sessional',
                'Electronic Devices and Circuits',
                'Electronic Devices and Circuits Sessional',
                'Mathematics III (Vector, Complex Variable, Fourier Analysis and Laplace Transformation)',
                'Statistics (Introduction to Statistics and Probability)'
            ],

            '4': [
                'Object Oriented Programming (Java) Sessional',
                'Algorithms Analysis and Design',
                'Algorithms Analysis and Design Sessional',
                'Theory of Computation and Concrete Mathematics',
                'Theory of Computation and Concrete Mathematics Sessional',
                'Computer Architecture and Organization',
                'Digital Electronics and Pulse Techniques',
                'Digital Electronics and Pulse Techniques Sessional',
                'Financial and Managerial Accounting',
                'Application Development Sessional'
            ],

            '5': [
                'Database',
                'Database Sessional',
                'Software Engineering',
                'Microprocessor and Interfacing',
                'Microprocessor and Interfacing Sessional',
                'Data Communication',
                'Economics',
                'Software Development Sessional'
            ],
            '6': [
                'Operating System',
                'Operating System Sessional',
                'Web Engineering',
                'Web Engineering Sessional',
                'Computer Networks',
                'Computer Networks Sessional',
                'Compiler Design',
                'Compiler Design Sessional',
                'Mathematical Analysis for Computer Science',
                'Web and Mobile Application Development Sessional'
            ],
            '7': [
                'Artificial Intelligence',
                'Artificial Intelligence Sessional',
                'Computer Graphics and Image Processing',
                'Computer Graphics and Image Processing Sessional',
                'Option I Mobile and Wireless Communication',
                'Option I Sessional',
                'Option II Graph Theory',
                'Option II Sessional',
                'Technical Writing and Presentation Skill Development Sessional',
                'Project and Thesis Sessional'
            ],
            '8': [
                'Multimedia System and Animation Techniques',
                'Multimedia System and Animation Techniques Sessional',
                'Computer Ethics and Cyber Law',
                'Industrial Management',
                'Option III',
                'Option III Sessional',
                'Option IV',
                'Option IV Sessional',
                'Project and Thesis Sessional'
            ],


        };

        $(document).ready(function() {
            // When the "View Course" button is clicked
            $('.view-courses').on('click', function() {
                var semester = $(this).data('semester');

                var courseList = $('#course-list');
                courseList.empty(); // Clear the previous list

                // Check if there are courses for the selected semester
                if (coursesData[semester]) {
                    $.each(coursesData[semester], function(index, course) {
                        courseList.append('<li class="list-group-item">' + course + '</li>');
                    });
                } else {
                    courseList.append('<li class="list-group-item">No courses found for this semester.</li>');
                }
            });
        });
    </script>
</body>

</html>