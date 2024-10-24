<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Civil Registry Appointment</title>
    <style>
        /* General styling */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .form-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
            border-radius: 8px;
        }

        h2 {
            text-align: center;
        }

        .section-header {
            margin-top: 50px;
            font-size: 18px;
            font-weight: bold;
            color: #333;
            border-bottom: 1px solid #ccc;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 15px;
            
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .form-row .form-group {
            flex: 1 1 200px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="date"],
        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .radio-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        button[type="submit"] {
            background-color: #007BFF;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
            display: block;
            width: 100%;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        
        }

        
/*CONTACT NUMBER */
     .form-group input,
    .form-group select {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }

    .contact-container {
        display: flex;
        align-items: center;
    }

    .country-code {
        background-color: #f0f0f0;
        border: 1px solid #000;
        padding: 6.5px;
        border-right: none;
    }

    input[type="tel"] {
        border: 1px solid #000;
        padding: 8px;
        flex: 1;
    }

    
    /*adjust Delayed Yes or No*/
    .radio-group {
    display: inline-flex;
    align-items: center;
    gap: 5px; 
}

.radio-group input[type="radio"] {
    margin-right: 5px; 
}

.radio-group label {
    margin-right: 15px;
}




        @media (max-width: 600px) {
            .form-row {
                flex-direction: column;
            }
            
    
        }
    </style>
</head>

<body>

<div class="form-container">
    <h2>City Civil Registry Appointment</h2>
    <form action="{{ url('/appointment') }}" method="POST">
        @csrf

        <!-- Basic Information -->
        <div class="section-header">Applicant's Information</div>
        <div class="form-row">
            <div class="form-group">
            <label for="first_name">First Name:</label>
                <input type="text" name="first_name" required>
               
            </div>
            <div class="form-group">
                <label for="middle_name">Middle Name:</label>
                <input type="text" name="middle_name">
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" required>

            </div>
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" name="address" required>
        </div>

        <div class="form-row">
            <div class="form-group">
            <label for="contact_no">Contact Number:</label>
                <div class="contact-container">
                    <span class="country-code">+63</span>
                    <input type="tel" name="contact_no" id="contact_no" maxlength="10" placeholder="9123456789" required oninput="checkContactNumber()">
                </div>
                        <script>
                    function checkContactNumber() {
                        var contactInput = document.getElementById("contact_no");
                        var value = contactInput.value;

                        // Remove any non-digit characters
                        contactInput.value = value.replace(/[^0-9]/g, '');

                        // Ensure the number starts with "9" (after +63, it should be 09xxxxxxx)
                        if (!contactInput.value.startsWith("9")) {
                            contactInput.value = "9";
                        }

                        // Limit input to 10 digits (since +63 is already displayed)
                        if (contactInput.value.length > 10) {
                            contactInput.value = contactInput.value.slice(0, 10);
                        }
                    }
                </script>
            </div>
            <div class="form-group">
                <label for="sex">Sex:</label>
                <select name="sex" required>
                    <option value="">Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="lgbtq">LGBTQ</option>
                </select>
            </div>
            <div class="form-group">
            <label for="age">Age:</label>
            <input type="number" name="age" id="age" min="1" max="120" required oninput="checkAgeLimit()">
            <script>
                    function checkAgeLimit() {
                        var ageInput = document.getElementById("age");
                        
                        // Check if the input exceeds 120 and reset it to 120 if necessary
                        if (ageInput.value > 120) {
                            ageInput.value = 120;
                        }

                        // Check if the input is below 1 and reset it to 1 if necessary
                        if (ageInput.value < 1) {
                            ageInput.value = 1;
                        }
                    }

                    // Optionally prevent manual typing of out-of-range values using input event
                    document.getElementById("age").addEventListener("input", function() {
                        var value = this.value;
                        if (value > 120) {
                            this.value = 120;
                        } else if (value < 1) {
                            this.value = 1;
                        }
                    });
                </script>
            </div>
        </div>

        <!-- Document Service Needed -->
        <div class="form-group">
            <label for="appointment_type">Document Service Needed:</label>
            <select id="appointment_type" name="appointment_type" onchange="showForm()" required>
                <option value="">Select Service</option>
                <option value="Birth Certificate">Birth Certificate</option>
                <option value="Marriage Certificate">Marriage Certificate</option>
                <option value="Marriage License">Marriage License</option>
                <option value="Death Certificate">Death Certificate</option>
                <option value="Other">Other (Specify)</option>
            </select>
        </div>

        <!-- Field for "Other" document type -->
        <div id="other_document_field" class="form-group" style="display:none;">
            <label for="other_document">Specify Document:</label>
            <input type="text" id="other_document" name="other_document">
        </div>

        <!-- Dynamic Form Content -->
        <div id="dynamic_form"></div>

        <!-- Appointment Date -->
        <div class="form-group">

            <label for="requesting_party">Requesting Party:</label>
            <input type="text" id="requesting_party" name="requesting_party" required><br>
        </div>

        <div class="form-group">
            <label for="relationship_to_owner">Relationship to Owner:</label>
            <input type="text" id="relationship_to_owner" name="relationship_to_owner" required><br>
        </div>

        <div class="form-group">
            <label for="purpose">Purpose:</label>
             <input type="text" id="purpose" name="purpose" required><br>
        </div>
        <div class="form-group">
    <label>Delayed Registration:</label>
        <div class="radio-group">
            <input type="radio" id="delayed_yes" name="delayed" value="Yes" onclick="toggleDelayedDate()" required>
            <label for="delayed_yes">Yes</label>
            <input type="radio" id="delayed_no" name="delayed" value="No" onclick="toggleDelayedDate()" required>
            <label for="delayed_no">No</label>
        </div>
    </div>
                <!-- Hidden by default -->
                <div class="form-group" id="delayed_date_container" style="display:none;">
                    <label for="delayed_date">Delayed Date:</label>
                    <input type="date" id="delayed_date" name="delayed_date">
                </div>
                <script>
                    // Function to toggle the delayed date field visibility
                    function toggleDelayedDate() {
                        var delayedYes = document.getElementById("delayed_yes").checked;
                        var delayedDateContainer = document.getElementById("delayed_date_container");
                        
                        if (delayedYes) {
                            delayedDateContainer.style.display = "block";
                        } else {
                            delayedDateContainer.style.display = "none";
                        }
                    }
                </script>
        <div class="form-group">
            <label for="appointment_date">Appointment Date:</label>
            <input type="date" name="appointment_date" id="appointment_date" required>
        </div>

        <button type="submit">Submit Appointment</button>
    </form>
</div>

<script>
    // Prevent past dates for the appointment
    var today = new Date().toISOString().split('T')[0];
    document.getElementById("appointment_date").setAttribute('min', today);

    function showForm() {
        var selectedService = document.getElementById("appointment_type").value;
        var dynamicForm = document.getElementById("dynamic_form");
        var otherDocumentField = document.getElementById("other_document_field");

        dynamicForm.innerHTML = ""; // Clear existing form

        if (selectedService === "Other") {
            otherDocumentField.style.display = "block";
        } else {
            otherDocumentField.style.display = "none";
        }

        if (selectedService === "Birth Certificate") {
            dynamicForm.innerHTML = `
                <div class="section-header">Child Information</div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="child_first_name">First Name:</label>
                        <input type="text" id="child_first_name" name="child_first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="child_middle_name">Middle Name:</label>
                        <input type="text" id="child_middle_name" name="child_middle_name">
                    </div>
                    <div class="form-group">
                        <label for="child_last_name">Last Name:</label>
                        <input type="text" id="child_last_name" name="child_last_name" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="date_of_birth">Date of Birth:</label>
                    <input type="date" id="date_of_birth" name="date_of_birth" required>
                </div>
                <div class="form-group">
                    <label for="place_of_birth">Place of Birth:</label>
                    <input type="text" id="place_of_birth" name="place_of_birth" required>
                </div>

                <div class="section-header">Family Background</div>

                <!-- Mother's Information -->
                <div class="form-group"><strong>Mother's Maiden Name</strong></div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="mother_first_name">First Name:</label>
                        <input type="text" id="mother_first_name" name="mother_first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="mother_middle_name">Middle Name:</label>
                        <input type="text" id="mother_middle_name" name="mother_middle_name">
                    </div>
                    <div class="form-group">
                        <label for="mother_last_name">Last Name:</label>
                        <input type="text" id="mother_last_name" name="mother_last_name" required>
                    </div>
                </div>

                <!-- Father's Information -->
                <div class="form-group"><strong>Father's Name</strong></div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="father_first_name">First Name:</label>
                        <input type="text" id="father_first_name" name="father_first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="father_middle_name">Middle Name:</label>
                        <input type="text" id="father_middle_name" name="father_middle_name">
                    </div>
                    <div class="form-group">
                        <label for="father_last_name">Last Name:</label>
                        <input type="text" id="father_last_name" name="father_last_name" required>
                    </div>
                </div>
            `;
    
        } else if (selectedService === "Marriage Certificate") {
            dynamicForm.innerHTML = `
                <div class="section-header">Marriage Information</div>
                <!-- Husband's Information -->
                <div class="form-group"><strong>Husband's Name</strong></div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="husband_first_name">First Name:</label>
                        <input type="text" id="husband_first_name" name="husband_first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="husband_middle_name">Middle Name:</label>
                        <input type="text" id="husband_middle_name" name="husband_middle_name">
                    </div>
                    <div class="form-group">
                        <label for="husband_last_name">Last Name:</label>
                        <input type="text" id="husband_last_name" name="husband_last_name" required>
                    </div>
                </div>

                <!-- Wife's Information -->
                <div class="form-group"><strong>Wife's Name</strong></div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="wife_first_name">First Name:</label>
                        <input type="text" id="wife_first_name" name="wife_first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="wife_middle_name">Middle Name:</label>
                        <input type="text" id="wife_middle_name" name="wife_middle_name">
                    </div>
                    <div class="form-group">
                        <label for="wife_last_name">Last Name:</label>
                        <input type="text" id="wife_last_name" name="wife_last_name" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="date_of_marriage">Date of Marriage:</label>
                    <input type="date" id="date_of_marriage" name="date_of_marriage" required>
                </div>
            `;

        } else if (selectedService === "Marriage License") {
              dynamicForm.innerHTML = `
        <div class="form-group">
            <div class="section-header">Marriage License Information</div>

            
            <!-- Applicant's Information -->
            <div class="form-row">
                <div class="form-group">
                    <label for="applicant_first_name">First Name:</label>
                    <input type="text" name="applicant_first_name" required>
                </div>

                <div class="form-group">
                    <label for="applicant_middle_name">Middle Name:</label>
                    <input type="text" name="applicant_middle_name">
                </div>

                <div class="form-group">
                    <label for="applicant_last_name">Last Name:</label>
                    <input type="text" name="applicant_last_name" required>
                </div>
            </div>

            <!-- Spouse's Information -->
            <div class="form-group"><strong>Spouse's Information</strong></div>
            <div class="form-row">
                <div class="form-group">
                    <label for="spouse_first_name">First Name:</label>
                    <input type="text" name="spouse_first_name" required>
                </div>

                <div class="form-group">
                    <label for="spouse_middle_name">Middle Name:</label>
                    <input type="text" name="spouse_middle_name">
                </div>

                <div class="form-group">
                    <label for="spouse_last_name">Last Name:</label>
                    <input type="text" name="spouse_last_name" required>
                </div>
            </div>

            <!-- Planned Date and Place of Marriage -->
            <div class="form-group"><strong>Marriage Details</strong></div>
             <div class="form-group">
                    <label for="planned_date_of_marriage">Planned Date of Marriage:</label>
                    <input type="date" id="planned_date_of_marriage" name="planned_date_of_marriage" required>
                </div>

                <div class="form-group">
                    <label for="place_of_marriage">Place of Marriage:</label>
                    <input type="text" name="place_of_marriage" required>
                </div>
            </div>
    `;
        
            // Ensure Planned Date of Marriage doesn't allow past dates
            document.getElementById("planned_date_of_marriage").setAttribute('min', today);

        } else if (selectedService === "Death Certificate") {
            dynamicForm.innerHTML = `
                <div class="section-header">Deceased Information</div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="deceased_first_name">First Name:</label>
                        <input type="text" id="deceased_first_name" name="deceased_first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="deceased_middle_name">Middle Name:</label>
                        <input type="text" id="deceased_middle_name" name="deceased_middle_name">
                    </div>
                    <div class="form-group">
                        <label for="deceased_last_name">Last Name:</label>
                        <input type="text" id="deceased_last_name" name="deceased_last_name" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="place_of_death">Place of Death:</label>
                    <input type="text" id="place_of_death" name="place_of_death" required>
                </div>
                <div class="form-group">
                    <label for="date_of_death">Date of Death:</label>
                    <input type="date" id="date_of_death" name="date_of_death" required>
                </div>
            `;
        }
        // You can add similar code for "Marriage License" based on your requirements.
    }
</script>

</body>
</html>