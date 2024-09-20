<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CGPA Entry Table</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <p>User id: {{ $s_id }}</p>
        <h2 class="text-center">CGPA Entry Table</h2>
        <form id="cgpaForm">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Level and Semester</th>
                        <th>CGPA</th>
                        <th>Total Credit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (range(1, 4) as $level)
                    @foreach (['1' => 'Semester 1', '2' => 'Semester 2'] as $semesterKey => $semester)
                    <tr data-level="{{ $level }}" data-semester="{{ $semesterKey }}">
                        <td>Level {{ $level }} - {{ $semester }}</td>
                        <td>
                            @php
                                // Define the field name based on level and semester
                                $fieldName = "l{$level}s{$semesterKey}";
                            @endphp
                            <input type="number" step="0.01" name="cgpa[]" class="form-control" 
                                   value="{{ $cgpa->$fieldName ?? '' }}" placeholder="Enter CGPA" min="0.0" max="4.0">
                        </td>
                        <td><input type="number" step="1" name="credit[]" class="form-control" min="0" required></td>
                        <td><button type="button" class="btn btn-info" onclick="viewCourses({{ $level }}, '{{ $semesterKey }}')">View Courses</button></td>
                    </tr>
                    @endforeach
                    @endforeach
                </tbody>
            </table>
            <script>
                // Array of values to be used for inputs
                const valuesArray = [19, 19.25, 21.50, 20, 18.5, 18.5, 18.75, 19.25];

                // Function to update the values of input fields
                function updateInputValues() {
                    const inputFields = document.querySelectorAll('input[name="credit[]"]');

                    inputFields.forEach((input, index) => {
                        if (index < valuesArray.length) {
                            input.value = valuesArray[index];
                        }
                    });
                }

                // Call the function to update the input values when the page loads
                window.onload = updateInputValues;
            </script>

            <div class="text-center mt-4">
                <button type="button" class="btn btn-primary" onclick="showTotalResult()">Show Total Result</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>

        <!-- Modal for viewing courses -->
        <div class="modal fade" id="coursesModal" tabindex="-1" role="dialog" aria-labelledby="coursesModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="coursesModalLabel">Courses</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="coursesList">
                        <!-- Courses will be dynamically inserted here -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="totalResult" class="mt-4 text-center" style="display: none;">
            <h4>Total CGPA: <span id="totalCgpa"></span></h4>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Function to view courses based on level and semester
        function viewCourses(level, semester) {
            // Convert semester number to roman numeral
            let semesterText = semester === '1' ? 'i' : 'ii';

            // Filter courses by level and semester
            const courses = @json($courses);
            const filteredCourses = courses.filter(course => course.level == level && course.semester == semesterText);

            let coursesHtml = '<ul>';
            filteredCourses.forEach(course => {
                coursesHtml += `<li>${course.name}</li>`;
            });
            coursesHtml += '</ul>';

            // Update the modal content
            document.getElementById('coursesList').innerHTML = coursesHtml;
            $('#coursesModal').modal('show');
        }

        // Function to calculate and display total CGPA
        function showTotalResult() {
            let form = document.getElementById('cgpaForm');
            let cgpaInputs = form.querySelectorAll('input[name="cgpa[]"]');
            let creditInputs = form.querySelectorAll('input[name="credit[]"]');

            let totalWeightedCgpa = 0;
            let totalCredits = 0;
            let error = false;

            cgpaInputs.forEach(function(input, index) {
                let cgpaValue = parseFloat(input.value);
                let creditValue = parseFloat(creditInputs[index].value);

                // Validate if CGPA is within 0.0 to 4.0 range
                if (!isNaN(cgpaValue) && cgpaValue >= 0 && cgpaValue <= 4) {
                    totalWeightedCgpa += cgpaValue * creditValue;
                    totalCredits += creditValue;
                    input.classList.remove("is-invalid");
                } else if (!isNaN(cgpaValue) && (cgpaValue < 0 || cgpaValue > 4)) {
                    input.classList.add("is-invalid");
                    error = true;
                }
            });

            if (error) {
                alert("Please enter valid CGPA values between 0.0 and 4.0.");
            } else if (totalCredits > 0) {
                let totalCgpa = totalWeightedCgpa / totalCredits;
                document.getElementById('totalCgpa').innerText = totalCgpa.toFixed(2);
                document.getElementById('totalResult').style.display = 'block';
            } else {
                alert('Please enter CGPA values.');
            }
        }

        // Form submission handler (for saving the data)
        document.getElementById('cgpaForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission for now

            let cgpaInputs = document.querySelectorAll('input[name="cgpa[]"]');
            let valid = true;

            cgpaInputs.forEach(function(input) {
                let value = parseFloat(input.value);
                if (value < 0 || value > 4 || isNaN(value)) {
                    valid = false;
                    input.classList.add("is-invalid");
                }
            });

            if (valid) {
                alert('Data saved successfully!');
            } else {
                alert("Please correct the invalid CGPA values.");
            }
        });
    </script>
</body>

</html>
