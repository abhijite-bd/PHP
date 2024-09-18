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
                    <tr>
                        <td>Level 1 - Semester 1</td>
                        <td><input type="number" step="0.01" name="cgpa[]" class="form-control" placeholder="Enter CGPA" min="0.0" max="4.0"></td>
                        <td><input type="number" step="1" name="credit[]" class="form-control" value="18" min="0" required></td>
                    </tr>
                    <tr>
                        <td>Level 1 - Semester 2</td>
                        <td><input type="number" step="0.01" name="cgpa[]" class="form-control" placeholder="Enter CGPA" min="0.0" max="4.0"></td>
                        <td><input type="number" step="1" name="credit[]" class="form-control" value="18" min="0" required></td>
                    </tr>
                    <tr>
                        <td>Level 2 - Semester 1</td>
                        <td><input type="number" step="0.01" name="cgpa[]" class="form-control" placeholder="Enter CGPA" min="0.0" max="4.0"></td>
                        <td><input type="number" step="1" name="credit[]" class="form-control" value="18" min="0" required></td>
                    </tr>
                    <tr>
                        <td>Level 2 - Semester 2</td>
                        <td><input type="number" step="0.01" name="cgpa[]" class="form-control" placeholder="Enter CGPA" min="0.0" max="4.0"></td>
                        <td><input type="number" step="1" name="credit[]" class="form-control" value="18" min="0" required></td>
                    </tr>
                    <tr>
                        <td>Level 3 - Semester 1</td>
                        <td><input type="number" step="0.01" name="cgpa[]" class="form-control" placeholder="Enter CGPA" min="0.0" max="4.0"></td>
                        <td><input type="number" step="1" name="credit[]" class="form-control" value="18" min="0" required></td>
                    </tr>
                    <tr>
                        <td>Level 3 - Semester 2</td>
                        <td><input type="number" step="0.01" name="cgpa[]" class="form-control" placeholder="Enter CGPA" min="0.0" max="4.0"></td>
                        <td><input type="number" step="1" name="credit[]" class="form-control" value="18" min="0" required></td>
                    </tr>
                    <tr>
                        <td>Level 4 - Semester 1</td>
                        <td><input type="number" step="0.01" name="cgpa[]" class="form-control" placeholder="Enter CGPA" min="0.0" max="4.0"></td>
                        <td><input type="number" step="1" name="credit[]" class="form-control" value="18" min="0" required></td>
                    </tr>
                    <tr>
                        <td>Level 4 - Semester 2</td>
                        <td><input type="number" step="0.01" name="cgpa[]" class="form-control" placeholder="Enter CGPA" min="0.0" max="4.0"></td>
                        <td><input type="number" step="1" name="credit[]" class="form-control" value="18" min="0" required></td>
                    </tr>
                </tbody>
            </table>

            <div class="text-center mt-4">
                <button type="button" class="btn btn-primary" onclick="showTotalResult()">Show Total Result</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
        </form>

        <div id="totalResult" class="mt-4 text-center" style="display: none;">
            <h4>Total CGPA: <span id="totalCgpa"></span></h4>
        </div>
    </div>

    <script>
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
