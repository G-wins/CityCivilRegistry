<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .error {
            border: 2.5px solid red;
        }

        #confirmation_modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            max-width: 500px;
            max-height: 80vh;
            overflow-y: auto;
            margin: 0 auto;
            position: relative;
            padding-right: 10px;
        }
        #close_modal {
            position: absolute;
            top: 10px;
            right: 10px;
            cursor: pointer;
        }
          /*OTHER DOCUMENT*/
          .form-group {
            width: 100%;
        }

        #document_details {
            width: 100%;
            max-width: none;
        }


       


    </style>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Civil Registry</title>
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

</head>
<body>
    <div class="form-container">
        <h2>CITY CIVIL REGISTRY</h2>
        <form id="appointment_form" action="{{ url('/appointment') }}" method="POST">
            @csrf
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <!-- Basic Information -->
        <div class="section-header">Requester's Details</div>
            <div class="form-row">
                <div class="form-group">
                <label for="requester_last_name">Last Name:</label>
                    <input type="text" name="requester_last_name" required>
               
                </div>
                <div class="form-group">
                    <label for="requester_first_name">First Name:</label>
                    <input type="text" name="requester_first_name"  required>
                </div>
                <div class="form-group">
                    <label for="requester_middle_name">Middle Name:</label>
                    <input type="text" name="requester_middle_name">

                </div>
            </div>

            <div class="form-group">
            <label for="requester_mailing_address">Mailing Address:</label>
            <input type="text" id="requester_mailing_address" name="requester_mailing_address" placeholder="House No., Street Name / Barangay" required>
            <small class="hint">House No., Street Name / Barangay</small>
        </div>
        <div class="form-row">
                    <!-- City/Municipality Field -->
                    <div class="form-group">
                        <label for="requester_city_municipality">City/Municipality:</label>
                        <input type="text" id="requester_city_municipality" name="requester_city_municipality" required>
                    </div>

                    <!-- Province Field -->
                    <div class="form-group">
                        <label for="requester_province">Province:</label>
                        <input type="text" id="requester_province" name="requester_province" required>
                    </div>
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

                           
                            contactInput.value = value.replace(/[^0-9]/g, '');

                            if (!contactInput.value.startsWith("9")) {
                                contactInput.value = "9";
                            }
                            if (contactInput.value.length > 10) {
                                contactInput.value = contactInput.value.slice(0, 10);
                            }
                        }
                    </script>
                </div>
                <div class="form-group">
                    <label for="requester_sex">Sex:</label>
                    <select name="requester_sex" required>
                        <option value="" selected disabled>Select</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="form-group">
                <label for="requester_age">Age:</label>
                <input type="number" name="requester_age" id="requester_age" min="1" max="120" required oninput="checkAgeLimit()">
                <script>
                        function checkAgeLimit() {
                            var ageInput = document.getElementById("requester_age");
                            if (ageInput.value > 120) {
                                ageInput.value = 120;
                            }
                            if (ageInput.value < 1) {
                                ageInput.value = 1;
                            }
                        }
                        document.getElementById("requester_age").addEventListener("input", function() {
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
                    <option value="" selected disabled>Select Service</option>
                    <option value="Birth Certificate">Birth Certificate</option>
                    <option value="Marriage Certificate">Marriage Certificate</option>
                    <option value="Marriage License">Marriage License</option>
                    <option value="Death Certificate">Death Certificate</option>
                    <option value="Cenomar">Cenomar</option>
                    <option value="Other Document">Other (Specify)</option>
                </select>
            </div>

       
            <div id="dynamic_form"></div>
            <div class="form-group">
                <label for="requesting_party">Requesting Party:</label>
                <input type="text" id="requesting_party" name="requesting_party" required><br>
            </div>

            <div class="form-group">
                <label for="relationship_to_owner">Relationship to Owner:</label>
                <input type="text" id="relationship_to_owner" name="relationship_to_owner" required><br>
            </div>

            <div class="section-header">Purpose of Request</div>
                        <div class="form-group">
                            <label for="purpose">Purpose:</label>
                            <select name="purpose" id="purpose" onchange="toggleOtherPurpose()" required>
                                <option value="" selected disabled>Select Purpose</option>
                                <option value="Claim Benefits/Loan">Claim Benefits/Loan</option>
                                <option value="Employment (Local)">Employment (Local)</option>
                                <option value="School Requirements">School Requirements</option>
                                <option value="Passport/Travel">Passport/Travel</option>
                                <option value="Employment (Abroad)">Employment (Abroad)</option>
                                <option value="Other">Other (Specify)</option>
                            </select>
                            <input  type="text" name="other_purposes" id="purpose_other" placeholder="Specify if other" style="display: none; margin-top: 10px;">  </div>
           
                            <label>Delayed Registration:</label>
                            <div class="radio-group">
                                <input type="radio" id="delayed_yes" name="delayed" value="Yes" onclick="toggleDelayedDate()" required>
                                <label for="delayed_yes">Yes</label>
                                <input type="radio" id="delayed_no" name="delayed" value="No" onclick="toggleDelayedDate()" required>
                                <label for="delayed_no">No</label>
                            </div>
                    <div class="form-group" id="delayed_date_container" style="display:none;">
                        <label for="delayed_date">Delayed Date:</label>
                        <input type="date" id="delayed_date" name="delayed_date">
                    </div>
                    <script>
                       
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
            <div class="input-with-icon">
                <label for="appointment_date">Appointment Date:</label>
                <input type="text" name="appointment_date" id="appointment_date" autocomplete="off" required>
            </div>
            <div id="slot-container"></div>

            <button type="button" id="submit_btn" class="btn btn-primary w-100 py-2 mt-2" onclick="showConfirmation()">Next</button>

        </form>


        <div id="confirmation_modal" style="display:none;">
        <div class="modal-content">
            <span id="close_modal" onclick="closeModal()">X</span>
            <h2>Confirm Your Information</h2>
            <div id="modal_data"></div>
            <button class="btn btn-primary w-100 py-2 mt-2" onclick="proceedToPrivacyNotice()">Confirm and Submit</button>
        </div>
    </div>






 
<script>
    var isSubmitting = false;

    const privacyNotices = {
        "Birth Certificate": `
        <h2>TIMELY REGISTRATION OF LIVE BIRTH FROM MARRIED AND SOLO PARENT</h2>
        <p>
            <Strong>Registration of live birth</Strong> shall be made in the Local Civil Registry Office of the city/municipality where the birth occurred.
            It shall be registered within thirty (30) days from the time of occurrence.
        </p>
        <h4>Requirements:</h4>
        <ul>
            <li>Four (4) copies of Form 102 duly accomplished and signed by the proper parties.</li>
        </ul>

        <h2>TIMELY REGISTRATION OF LIVE BIRTH OF ILLEGITIMATE CHILDREN</h2>
        <p>
            <Strong>Registration of live birth</Strong> shall be made in the Local Civil Registry Office of the city/municipality where the birth occurred.
            It shall be registered within thirty (30) days from the time of occurrence.
        </p>
        <h4>Requirements:</h4>
        <ul>
            <li>Four (4) copies of Form 102 duly accomplished and signed by the proper parties.</li>
            <li>Duly accomplished, signed, and notarized affidavit of acknowledgment/admission of paternity.</li>
            <li>Duly accomplished and notarized affidavit to use the surname of the father (AUSF) executed by the mother (3 original copies).</li>
            <li>Community tax certificate/Valid ID of parents (2 photocopies).</li>
        </ul>
        <h4>Fees:</h4>
        <ul>
            <li>₱200.00 – Acknowledgement of Paternity</li>
            <li>₱300.00 – Affidavit to Use the Surname of Father</li>
        </ul>



        <h2>DELAYED REGISTRATION OF BIRTH</h2>
        <p>
            A report of vital event made beyond the reglementary period is considered delayed. A notice to the public on the pending application for DELAYED REGISTRATION shall be posted in the bulletin board of the city/municipality for a period of not less than ten (10) days. If after ten (10) days, no one opposes the registration, the civil registrar shall evaluate the veracity of the statements made in the required documents submitted. When the civil registrar is convinced that the event really occurred within the jurisdiction of the civil registry office and finding out that the said event was not registered, he shall register the delayed report thereof.
        </p>
        <h4>Requirements:</h4>
        <ul>
            <li>No record of Birth from PSA and CCR of City of San Jose del Monte.</li>
            <li><Strong>Submit original copy of any two (2) of the following both showing date and place of birth of the registrant:</Strong>
                <ul>
                    <li>Medical Certificate and Birth Certificate if born in hospital, lying-in, or clinic.</li>
                    <li>Baptismal Certificate.</li>
                    <li>White Card.</li>
                    <li>Form 137 (either Elementary or High School) or school certification or Transcript of Records.</li>
                    <li>Voter’s Registration</li>
                    <li>Brgy. Certification</li>
                    <li>Affidavit, Employment Records (GSIS/SSS E-1 OR E-Form), Other documents the OFFICE MAY CONSIDER relevant and necessary for the approval of the application (Philhealth-MD, Service, Record, Personal Data Sheet, Medical Record, OSCA Certification, etc. </li>
                </ul>
            </li>
            <li>Photocopy of ID/cedula of parents & registrant.</li>
            <li>Marriage Contract of registrant, if married, Certified copy of Marriage Contract of Parents or Birth Certificate of brother/sister with date and place of marriage of parents or Birth Certificate of older brother/sister with proof of legitimacy.</li>
            <li>Joint Affidavit of two disinterested persons.</li>
            <li>Affidavit of Midwife/Hilot stating the reason of delay.</li>
            <li>Pre-Natal Record of mother regardless of birth order (For Minor Children) or if the mother is more than 40 years old at the time of the birth of the child.</li>
        </ul>

        <h2>ILLEGITIMATE CHILDREN:</h2>
        <p>
            <Strong>Born before August 3, 1988,</Strong> the FATHER must sign the Affidavit of Acknowledgment at the back of COLB.
            <Strong>IF FATHER IS DECEASED,</Strong> submit documents that will <Strong>prove the filiation</Strong> of the child or documents showing that the father has acknowledged the child, i.e., ITR, public document, and private handwritten instrument.
        </p>
        <h4>A.O. 1 s. 2016 <Strong>Revised IRR of RA 9255 based on Supreme Court Ruling on GRANDA vs. ANTONIO</Strong></h4>
        <p>
            <Strong>Born from AUGUST 3, 1988 – MARCH 18, 2004,</Strong> with or without Admission of Paternity at the back of the COLB, the child shall use the SURNAME OF THE MOTHER.
        </p>
        <p>
            <Strong>Born from MARCH 19, 2004 – PRESENT:</Strong>
                <li> With Admission of Paternity but no AUSF, the child shall use the SURNAME OF THE MOTHER</li>
                <li>With Admission of Paternity and with AUSF, the child shall use the SURNAME OF THE FATHER</li>

            <ul>
                <li><Strong>0 - 6 yrs. old</Strong> – AUSF to be executed by the mother or the guardian, in the absence of the mother.</li>
                <li><Strong>7 - 17 yrs. old</Strong> – AUSF to be executed by the child & sworn attestation executed by the mother or the guardian.</li>
                <li><Strong>18 yrs. and above</Strong> – AUSF to be executed by the child without need of attestation.</li>
            </ul>
        </p>

        <h4>Fees:</h4>
        <ul>
            <li>₱35.00 – Certificate of No record</li>
            <li>₱35.00 – Verification</li>
            <li>₱200.00 – Acknowledgement of Paternity</li>
            <li>₱300.00 – Authority to Use Surname of Father</li>
        </ul>










            <h2>LATE REGISTRATION OF BIRTH</h2>
        <ul>
            <p><Strong>1.</Strong> No record of Birth from PSA and CCR of City of San Jose del Monte.</p>
            <p><Strong>2. Submit original copy of any two (2) of the following both showing date and place of birth of the registrant:</Strong>
                <ul>
                    <li>Baptismal Certificate.</li>
                    <li>White Card.</li>
                    <li>Form 137 (either Elementary or High School) or school certification or Transcript of Records.</li>
                    <li>Voter’s Registration</li>
                    <li>Employment Records (GSIS/SSS E-1 or E-Form</li>
                    <li>Other Documents the OFFICE MAY CONSIDER relevant and necessary for the approval of the application (Philhealth-MDR, Service Record, Personal Data Sheet, Medical Record, OSCA Certification)</li>
                </ul>
                    <p><Strong>3.</Strong> Medical Certificate and Birth Certificate if born in hospital, lying-in, or clinic.</p>
                    <p><Strong>4.</Strong> Government-issued ID of registrant</p>
                    <p><Strong>5.</Strong> Marriage Contract of registrant, if married</p>
                    <p><Strong>6.</Strong> Barangay Certification as proof of residency</p>
                    <p><Strong>7.</Strong> National ID</p>
                    <p><Strong>8.</Strong> Any (2) documentary evidence showing the identity of the parents such as but not limited to his/her certificate of live birth, government issued ID, certificate of marriage or certificate of death if deceased </p>
                    <p><Strong>9.</Strong> 2pcs. Unedited front-facing photo of the registrant (2x2 size. white backgrund, taken within 3 mos. from the date of registration</p>
                    <p><Strong>10.</Strong>Joint Affidavit of two disinterested persons.</p>
                    <p><Strong>11.</Strong>Affidavit of Midwife/Hilot stating the reason of delay</p>
                    <p><Strong>12.</Strong>Pre-Natal Record of mother regardless of birth order (For Minor Children) or if the mother is more than 40 years old at the time of the birth of the child.</p>
                </ul>

            <p><Strong>CHILDREN FROM NON-MARITAL PARENTS</Strong>the<Strong>FATHER</Strong> must sign the affidavit of acknowledgement at the back of COLB</p>

        <p>
            <Strong>IF FATHER IS DECEASED,</Strong> submit documents that will prove the filiation of the child or documents showing that the father has acknowledged the child, i.e., ITR, public document and private handwritten instrument.
        </p>      
        <p>    
                <li> With Admission of Paternity but no AUSF, the child shall use the SURNAME OF THE MOTHER</li>
                <li>With Admission of Paternity and with AUSF, the child shall use the SURNAME OF THE FATHER</li>

            <ul>
                <li><Strong>0 - 6 yrs. old</Strong> – AUSF to be executed by the mother or the guardian, in the absence of the mother.</li>
                <li><Strong>7 - 17 yrs. old</Strong> – AUSF to be executed by the child & sworn attestation executed by the mother or the guardian.</li>
                <li><Strong>18 yrs. and above</Strong> – AUSF to be executed by the child without need of attestation.</li>
            </ul>
        </p>
   


        <h2>REQUIREMENTS FOR OUT OF TOWN DELAYED REGISTRATION OF BIRTH CERTIFICATE</h2>
        <ul>
            <P><Strong>1.</Strong> No record of Birth from PSA</P>
            <p><Strong>2.</Strong> Submit original copy of any two (2) of the following both showing date and place of birth of the registrant:</p>
                <ul>
                    <li>Baptismal Certificate</li>
                    <li>White Card</li>
                    <li>Form 137 (either Elementary or High School) or school certification or Transcript of Records</li>
                    <li>Voter’s Registration Record</li>
                    <li>Employment Records (GSIS/SSS E-1 or E-Form)</li>
                    <li>
                        Other documents the OFFICE MAY CONSIDER relevant and necessary for the approval of the application (Philhealth-MDR, Service Record, Personal Data Sheet, Medical Record, OSCA Certification, etc.)
                    </li>
                </ul>
       
            <p><Strong>3.</Strong> Medical Certificate/Birth Certificate if born in hospital, lying-in, or clinic</p>
            <p><Strong>4.</Strong> Photocopy of ID of registrant</p>
            <p><Strong>5.</Strong> Marriage Contract of registrant, if married</p>
            <p><Strong>6.</Strong> Barangay Certification</p>
            <p><Strong>7.</Strong> National ID</p>
            <p><Strong>8.</Strong> Any (2) documentary evidence showing the identity of the parents such as but not limited to his/her certificate of live birth, government-issued ID, certificate of marriage, or certificate of death if deceased </p>
            <p><Strong>9.</Strong> 2 pcs. unedited front-facing photo of the registrant (2x2 size, white background, taken within 3 mos. from the date of registration)</p>
            <p><Strong>10.</Strong> Affidavit for Out-of-Town Delayed Registration</p>
            <p><Strong>11.</Strong> Joint Affidavit of 2 Disinterested Persons</p>
        </ul>




        <h2>CORRECTION OF CLERICAL ERROR</h2>
        <p>
            <strong>Republic Act No. 9048</strong> is an act further authorizing the City or Municipal Civil Registrar or the Consul General to correct clerical or typographical error in an entry and/or change of name or nickname in the civil register except corrections involving the change in sex, age, nationality and status of a person without a need of a judicial order. A petition shall be filed with the Local Civil Registry Office (LCRO) where the record containing the clerical error to be corrected is kept. However, in case the present residence is different from where his civil registry record is registered, he may file the petition in the nearest LCRO in his area. His petition will be treated as a migrant petition.
        </p>
        <h4>Who May Avail the Service:</h4>
        <ul>
            <li>Owner of the record that contains the error to be changed or corrected</li>
            <li>Owner’s spouse, children, parents, brothers, sisters, grandparents, guardian or any other person duly authorized by law or by the owner of the document sought to be corrected</li>
        </ul>
        <h4>Requirements:</h4>
        <ul>
            <li>PSA Copy of Birth Certificate containing the alleged erroneous entry or entries</li>
            <li>Not less than 2 public or private documents upon which the correction shall be based:
                <ul>
                    <li>Baptismal Certificate</li>
                    <li>Voter’s Affidavit</li>
                    <li>Employment Record</li>
                    <li>GSIS/SSS Record</li>
                    <li>Medical Record</li>
                    <li>School Record</li>
                    <li>Business Record</li>
                    <li>Driver’s License</li>
                    <li>Insurance</li>
                    <li>Land Titles</li>
                    <li>Certificate of Land Transfer</li>
                    <li>Bank Passbook</li>
                    <li>NBI/Police Clearance</li>
                    <li>Civil Registry Records of Ascendants and Others</li>
                </ul>
            </li>
        </ul>
        <h4>Fees:</h4>
        <ul>
            <li>₱1,000.00 – Filing Fee</li>
            <li>₱150.00 – Posting Fee</li>
            <li>₱200.00 – Certificate of Finality</li>
            <li>₱500.00 – Migrant Fee</li>
            <li>Other expenses: Courier & Notary</li>
        </ul>



        <p>
        <li>Don't submit<Strong> FAKE DOCUMENTS</Strong> to avoid penalty. All supporting documents are subject for<Strong> VERIFICATION and FURTHER EVALUATION</Strong></li>
        <li>Complete the needed requirements before submission</li>
        <li>Ten (10) days mandatory posting period will commence on the day requirements are submitted</li>
        </p>







                    <h2>CORRECTION OF CLERICAL ERROR IN DATE OF BIRTH, SEX, MONTH IN THE DATE OF BIRTH (INTERNAL & EXTERNAL SERVICE)</h2>

                        <p>
                            <strong>Republic Act No. 10172</strong> is an act further authorizing the City or Municipal Civil Registrar or the Consul General to correct clerical or typographical errors in the day and month in the date of birth or sex of a person appearing in the civil register without a need of a judicial order while Republic Act No. 9048 is an act further authorizing the City or Municipal Civil Registrar or the Consul General to change a name or nickname in the civil register without a need of a judicial order. A petition shall be filed with the Local Civil Registry Office where the record containing the clerical error to be corrected is kept. However, in case the present residence is different from where his civil registry record is registered, he may file the petition in the nearest LCRO in his area. His petition will be treated as a migrant petition.
                        </p>

                        <h4>Who May File the Petition?</h4>
                        <ul>
                            <li>Owner of the record that contains the error to be changed or corrected.</li>
                            <li>
                                Owner's spouse, children, parents, brothers, sisters, grandparents, guardian or any other person duly authorized by law or by the owner of the document sought to be corrected; provided, however, that when a person is a minor or physically or mentally incapacitated, the petition may be filed by his/her spouse, or any of his/her children, parents, brothers, sisters, grandparents, guardians or persons duly authorized by law.
                            </li>
                            <li>For correction of clerical error in sex: the petitioner affected by such error shall personally file the petition.</li>
                        </ul>

                        <h4>Requirements:</h4>
                        <ul>
                            <li>PSA Copy of Birth Certificate containing the alleged erroneous entry or entries.</li>
                            <li>Baptismal Certificate.</li>
                            <li>Earliest School Record (Form-137).</li>
                            <li>Previous Medical Record.</li>
                            <li>Other documents showing date of birth.</li>
                            <li>
                                Certification of no civil, criminal, and administrative records from:
                                <ul>
                                    <li>Employer; Affidavit of Non-Employment (if unemployed).</li>
                                    <li>Police Clearance.</li>
                                    <li>NBI Clearance.</li>
                                </ul>
                            </li>
                            <li>Sex Change Certification from Public Health Office that the document owner did not undergo sex change.</li>
                            <li>Affidavit of Publication.</li>
                            <li>Community Tax Certificate.</li>
                            <li>DSWD Certification of Minor (if minor).</li>
                        </ul>

                        <h4>Fees:</h4>
                        <ul>
                            <li>₱3,000.00 – Filing Fee</li>
                            <li>₱150.00 – Posting Fee</li>
                            <li>₱200.00 – Certificate of Finality</li>
                            <li>₱1,000.00 – Migrant Fee</li>
                            <li>Other expenses: Courier & Notary</li>
                        </ul>

                        <h4>Note:</h4>
                        <ul>
                            <p><Strong>ALL DOCUMENTS ARE SUBJECT FOR EVALUATION</strong></p>
                        </ul>

             











        <h2>ISSUANCE OF CERTIFIED PHOTOCOPY / CERTIFICATION OF BIRTH, DEATH AND MARRIAGE CERTIFICATE</h2>
        <p><Strong>A CERTIFIED TRUE COPY</Strong> is a photocopy of the registered civil registry document in this City signed by the City Civil Registrar or his designed officer to certify that the copy is a true copy of the registered document kept this Office.</p>
            <h4>Who May Avail the Service:</h4>
            <ul>
                <li>The owner himself or through a duly authorized representative;</li>
                <li>His/her spouse, parent, direct descendants, guardian, or institution legally in charge of him/her, if minor;</li>
                <li>The court or proper public official whenever absolutely necessary in administrative, judicial, or other official proceedings to determine the identity of a person;</li>
                <li>In case of the person’s death, the nearest of kin</li>
            </ul>

            <h4>Requirements:</h4>
            <ul>
                <li>Any Government-issued Identification Card (ID)</li>
                <li>If the child is a minor, his parents, guardian, or the institution legally in charge of him, as the case may be, shall issue the authorization required.;</li>
                <li>Photocopy of the one giving the authorization with 3 fresh signatures and the grantee is also required.</li>
                <li>Affidavit of kinship, as needed</li>
            </ul>

            <h4>Fees:</h4>
            <ul>
                <li>₱35.00 each Certified True Copy of document.</li>
                <li>₱50.00 per Certification of document.</li>
            </ul>

            <p><Strong>ALL DOCUMENTS ARE SUBJECT FOR EVALUATION</strong> </p>





             <h2>ISSUANCE OF SECURITY PAPER (BREQS)</h2>

                    <p>
                        Copy of Birth, Marriage, or Death Certificates from Philippine Statistics Authority is printed on a SECURITY PAPER.
                    </p>

                    <h4>Who May Avail the Service:</h4>
                    <ul>
                        <li>The owner himself or through a duly authorized representative;</li>
                        <li>His/her spouse, parent, direct descendants, guardian, or institution legally in charge of him/her, if minor;</li>
                        <li>The court or proper public official whenever absolutely necessary in administrative, judicial, or other official proceedings to determine the identity of a person.</li>
                        <li>In case of the person’s death, the nearest of kin.</li>
                    </ul>

                    <h4>Requirements:</h4>
                    <ul>
                        <li>Any Government issued Identification Card (ID).</li>
                        <li>If the child is a minor, his parents, guardian, or the institution legally in charge of him, as the case may be, shall issue the authorization required.</li>
                        <li>Photocopy of the one giving the authorization with 3 fresh signatures, and the grantee is also required.</li>
                        <li>Affidavit of kinship, as needed.</li>
                    </ul>

                    <h4>Fees:</h4>
                    <ul>
                        <li>₱255.00 per copy of Certificate of Live Birth, Certificate of Death, & Certificate of Marriage.</li>
                        <li>₱310.00 per copy of Certificate of No Marriage (CENOMAR).</li>
                    </ul>

                    <h4>Note:</h4>
                    <ul>
                        <p><Strong>All documents are subject for evaluation.</Strong></p>
                    </ul>









              <h2>AUTHORITY TO USE THE SURNAME OF THE FATHER (RA 9255)</h2>

                    <p>
                        <strong>AFFIDAVIT TO USE THE SURNAME OF FATHER</strong> shall be registered in the Register of Legal Instruments of the Civil Registry Office where the birth of the child was recorded. This process allows children born out of wedlock to use the surname of their father. This only applies to children born on March 19, 2004 onwards.
                    </p>

                    <h4>Who May Avail This Service:</h4>
                    <ul>
                        <li>Children born on March 19, 2004 onwards.</li>
                    </ul>

                    <h4>Requirements:</h4>
                    <ul>
                        <li>Latest Certified Copy of Birth Certificate of the Child. Include dorsal page if signed by father.</li>
                        <li>If not, Affidavit of Acknowledgment/Admission of Paternity is needed.</li>
                        <li>Affidavit to Use the Surname of Father:
                            <ul>
                                <li><strong>0 - 6 yrs. old</strong> – AUSF to be executed by the mother or the guardian, in the absence of the mother.</li>
                                <li><strong>7 - 17 yrs. old</strong> – AUSF to be executed by the child & sworn attestation executed by the mother or the guardian.</li>
                                <li><strong>18 yrs. and above</strong> – AUSF to be executed by the child without need of attestation.</li>
                            </ul>
                        </li>
                        <li>Valid ID of Father and Mother (Original and Photocopy).</li>
                        <li>Original and Photocopy of Baptismal Certificate.</li>
                        <li>Original School Records showing the names of parents (Must be Certified True Copy).</li>
                        <li>If mother is deceased, submit Certified Copy of Death Certificate (Latest Copy).</li>
                        <li>If Filiation has not been expressly recognized by the father, submit any two (2) of the following documents showing clearly the paternity between the father and the child:
                            <ul>
                                <li>Employment Records</li>
                                <li>SSS/GSIS Records</li>
                                <li>Insurance</li>
                                <li>Certification of Membership in any Organization</li>
                                <li>Statement of Assets and Liabilities</li>
                                <li>Income Tax Return (ITR)</li>
                            </ul>
                        </li>
                    </ul>

                    <h4>Fees:</h4>
                    <ul>
                        <li>₱200.00 – Affidavit to Use the Surname of Father</li>
                        <li>₱300.00 – Acknowledgement of Paternity</li>
                        <li>₱200.00 – Endorsement</li>
                        <li>₱35.00 – Certified True Copy of every supporting document</li>
                    </ul>

                    <h4>Note:</h4>
                    <ul>
                        <li>All public documents executed abroad shall be registered with the Civil Registry Office of Manila.</li>
                        <li>All Affidavit shall be registered within 20 days from the date of execution.</li>
                        <li>All documents are subject for evaluation.</li>
                    </ul>







                     <h2>LEGITIMATION (RA9858)</h2>

                    <p>
                        <strong>Legitimation by Subsequent Marriage of Parents</strong> shall be registered in the Register of Legal Instruments of the Civil Registry Office where the birth of the child was recorded. Only children conceived and born outside of wedlock of parents, who, at the time of the conception of the former, were not disqualified by any impediment to marry each other, may be legitimated.
                    </p>

                    <h4>Requirements:</h4>
                    <ul>
                        <li>Latest Local Certified True Copy of Birth Certificate of the Child.</li>
                        <li>Latest Copy of Marriage Contract of Parents.
                            <ul>
                                <li>If issued in San Jose del Monte, Certified True Copy Only.</li>
                                <li>If issued outside San Jose del Monte, PSA/NSO Copy Only.</li>
                            </ul>
                        </li>
                        <li>Latest Copy of Certificate of No Marriage of both parents from PSA (CENOMAR).</li>
                        <li>Original Baptismal Certificate of the Child.</li>
                        <li><Strong>If the surname of the father does not appear at the birth certificate of the child, submit at least two (2) supporting documents from the following: </Strong>
                            <ul>
                                <li>SSS Form E-1 or E-4 of the father where the child is declared as beneficiary.</li>
                                <li>GSIS of the father where the child is declared as beneficiary.</li>
                                <li>Income Tax Return (ITR) of the father where the child is declared as beneficiary.</li>
                                <li>Philhealth of the father where the child is declared as beneficiary.</li>
                                <li>Insurance of parents where the child is declared as beneficiary.</li>
                                <li>Original Copy of Report Card (F-138) & Certified True Copy of School Record (F-137) of the child wherein the name of the father is declared and signature of the father is affix at the card.</li>
                                <li>Statement of Assets and Liabilities.</li>
                            </ul>
                        </li>
                        <li><Strong>If mother is deceased,</Strong> submit the Latest Certified True Copy of Death Certificate.</li>
                        <li><Strong>If the father is deceased,</Strong> AUTHENTIC WRITING WILL BE NEEDED. SUBMIT THE FOLLOWING DOCUMENTS LISTED AT NO.5 or any other records that will prove the filiation of the child or documents showing the father has acknowledged the child.</li>
                        <li>Submit photocopy of the Valid ID and Cedula of Parents.</li>
                        <li>Affidavit of Acknowledgment/Admission of Paternity.</li>
                        <li>Joint Affidavit of Legitimation (if one of the parents is in a foreign country, secure Affidavit of Legitimation from the Philippine Consulate in the country where he/she is located. The said affidavit should be signed by the Consul General and red ribbon).</li>
                        <li>Joint Supplemental Affidavit (if either of the parent is a minor at time of conception).</li>
                    </ul>

                    <h4>Fees:</h4>
                    <ul>
                        <li>₱300.00 – Acknowledgement of Paternity</li>
                        <li>₱300.00 – Legitimation</li>
                        <li>₱200.00 – Endorsement</li>
                        <li>₱35.00 – Certified True Copy of every supporting document</li>
                    </ul>

                    <h4>Note:</h4>
                    <ul>
                        <li><Strong>ALL PUBLIC DOCUMENTS EXECUTED ABROAD SHALL BE REGISTERED WITH THE CIVIL REGISTRY OFFICE OF MANILA.</Strong></li>
                        <li><Strong>ALL AFFIDAVIT BE REGISTERED WITHIN 20 DAYS FROM THE DATE OF EXECUTION.</Strong></li>
                        <li><Strong>ALL DOCUMENTS ARE SUBJECT FOR EVALUATION</Strong></li>
                    </ul>






                      <h2>SUPPLEMENTAL REPORT</h2>
                        <p>
                           <strong>A Supplemental Report</strong> may be filed to supply information inadvertently omitted when the document is registered. It shall not be used in any manner to change or to correct any entry which was previously entered in the civil register. The Civil Registrar shall accept only one supplemental report for not more than two omitted information in any registered event.
                        </p>

                        <h4>Who May File the Petition?</h4>
                        <ul>
                            <li>
                                The supplemental report may be filed by the parent/guardian or the party concerned, if of age, who shall execute an affidavit indicating the entry/entries missed in the registration and the reasons why there was a failure in supplying the required entry.
                            </li>
                        </ul>

                        <h4>Requirements:</h4>
                        <ul>
                            <li>PSA Copy of the certificate containing the omitted entry or entries.</li>
                            <li>Not less than two (2) public or private documents upon which the omitted entry/entries shall be based:
                                <ul>
                                    <li>Baptismal Certificate</li>
                                    <li>Voter’s Affidavit</li>
                                    <li>Employment Record</li>
                                    <li>GSIS/SSS Record</li>
                                    <li>Medical Record</li>
                                    <li>School Record</li>
                                    <li>Business Record</li>
                                    <li>Driver’s License</li>
                                    <li>Insurance</li>
                                    <li>Land Titles</li>
                                    <li>Certificate of Land Transfer</li>
                                    <li>Bank Passbook</li>
                                    <li>NBI/Police Clearance</li>
                                    <li>Civil Registry Records of Ascendants and Others</li>
                                </ul>
                            </li>
                            <li>If Gender is omitted, request for certification from hospital is needed.</li>
                            <li>Affidavit for Supplemental Report</li>
                        </ul>

                        <h4>Fees:</h4>
                        <ul>
                            <li>₱300.00 – Supplemental Report</li>
                            <li>₱200.00 – Endorsement</li>
                            <li>₱35.00 – Certified True Copy of every supporting document</li>
                        </ul>

                        <h4>Note:</h4>
                        <ul>
                            <p>ALL DOCUMENTS ARE SUBJECT FOR EVALUATION.</p>
                        </ul>





                        <h2>LEGITIMATION (RA9858)</h2>

                    <p>
                        <strong>Legitimation by Subsequent Marriage of Parents</strong> shall be registered in the Register of Legal Instruments of the Civil Registry Office where the birth of the child was recorded. Only children conceived and born outside of wedlock of parents, who, at the time of the conception of the former, were not disqualified by any impediment to marry each other, may be legitimated.
                    </p>

                    <h4>Requirements:</h4>
                    <ul>
                        <li>Latest Local Certified True Copy of Birth Certificate of the Child.</li>
                        <li>Latest Copy of Marriage Contract of Parents.
                            <ul>
                                <li>If issued in San Jose del Monte, Certified True Copy Only.</li>
                                <li>If issued outside San Jose del Monte, PSA/NSO Copy Only.</li>
                            </ul>
                        </li>
                        <li>Latest Copy of Certificate of No Marriage of both parents from PSA (CENOMAR).</li>
                        <li>Original Baptismal Certificate of the Child.</li>
                        <li><Strong>If the surname of the father does not appear at the birth certificate of the child, submit at least two (2) supporting documents from the following: </Strong>
                            <ul>
                                <li>SSS Form E-1 or E-4 of the father where the child is declared as beneficiary.</li>
                                <li>GSIS of the father where the child is declared as beneficiary.</li>
                                <li>Income Tax Return (ITR) of the father where the child is declared as beneficiary.</li>
                                <li>Philhealth of the father where the child is declared as beneficiary.</li>
                                <li>Insurance of parents where the child is declared as beneficiary.</li>
                                <li>Original Copy of Report Card (F-138) & Certified True Copy of School Record (F-137) of the child wherein the name of the father is declared and signature of the father is affix at the card.</li>
                                <li>Statement of Assets and Liabilities.</li>
                            </ul>
                        </li>
                        <li><Strong>If mother is deceased,</Strong> submit the Latest Certified True Copy of Death Certificate.</li>
                        <li><Strong>If the father is deceased,</Strong> AUTHENTIC WRITING WILL BE NEEDED. SUBMIT THE FOLLOWING DOCUMENTS LISTED AT NO.5 or any other records that will prove the filiation of the child or documents showing the father has acknowledged the child.</li>
                        <li>Submit photocopy of the Valid ID and Cedula of Parents.</li>
                        <li>Affidavit of Acknowledgment/Admission of Paternity.</li>
                        <li>Joint Affidavit of Legitimation (if one of the parents is in a foreign country, secure Affidavit of Legitimation from the Philippine Consulate in the country where he/she is located. The said affidavit should be signed by the Consul General and red ribbon).</li>
                        <li>Joint Supplemental Affidavit (if either of the parent is a minor at time of conception).</li>
                    </ul>

                    <h4>Fees:</h4>
                    <ul>
                        <li>₱300.00 – Acknowledgement of Paternity</li>
                        <li>₱300.00 – Legitimation</li>
                        <li>₱200.00 – Endorsement</li>
                        <li>₱35.00 – Certified True Copy of every supporting document</li>
                    </ul>

                    <h4>Note:</h4>
                    <ul>
                        <li><Strong>ALL PUBLIC DOCUMENTS EXECUTED ABROAD SHALL BE REGISTERED WITH THE CIVIL REGISTRY OFFICE OF MANILA.</Strong></li>
                        <li><Strong>ALL AFFIDAVIT BE REGISTERED WITHIN 20 DAYS FROM THE DATE OF EXECUTION.</Strong></li>
                        <li><Strong>ALL DOCUMENTS ARE SUBJECT FOR EVALUATION</Strong></li>
                    </ul>


        `,









       "Marriage Certificate": `
        <h2>TIMELY REGISTRATION OF MARRIAGE</h2>
        <p>
            The time for submission of the <strong>CERTIFICATE OF MARRIAGE</strong> is within fifteen (15) days following the solemnization of marriage while in marriage exempt from license requirement, the prescribed period is thirty (30) days at the place where the marriage was solemnized.
        </p>
        <h4>Requirements:</h4>
        <ul>
            <li>Four (4) copies of Form 97 duly accomplished and signed by the proper parties.</li>
        </ul>




            <h2>REQUIREMENTS FOR LATE REGISTRATION OF MARRIAGE CERTIFICATE</h2>
        <ul>
            <p><Strong>1.</Strong> Latest copy of Certificate of No Record from PSA and City of San Jose Del Monte, Bulacan</p>
            <p><Strong>2.</Strong> Latest copy of Certificate of No Marriage (CENOMAR) from PSA (for both parties)</p>
            <p><Strong>3.</Strong> Original or Duplicate Copy of Old Marriage Certificate with Signatures</p>
            <p><Strong>4.</Strong> If not available, certification from the church or Solemnizing Officer indicating date of said marriage based on their record or logbook </p>
            <p><Strong>5.</Strong> Affidavit of delayed registration which shall be executed by the solemnizing officer stating therein the exact place and date of marriage, the facts and circumstances surrounding the marriage, and the reason or cause of delay</p>
            <p><Strong>6.</Strong> If the solemnizing officer is deceased and no longer available, certification from PSA re: Authority to solemnize Marriage (CRASM) </p>
            <p><Strong>7.</Strong> Affidavit of Contracting Parties indicating the reason or cause of delay with VALID ID</p>
            <p><Strong>8.</Strong> Affidavit of delayed registration executed by 2 witnesses stating therein the exact place and date of marriage, the facts and circumstances surrounding the marriage, and the reason or cause of delay WITH VALID ID</p>
            <p><Strong>9.</Strong> Certified copy of Application for Marriage License bearing the date when the marriage license was issued, if applicable </p>
            <p><Strong>10.</Strong> Certified Copy of Birth Certificate of children with date and place of marriage of parents</p>
            <p><Strong>11.</Strong> If marriage outside of Church, letter of request to solemnize Marriage outside of Church (notarized)</p>
            <p><Strong>12.</Strong> Follow the information indicated in the old copy of marriage certificate in accomplishing the new form</p>
        </ul>

        <h4>Reminders:</h4>
        <ul>
            <li>Don’t submit <strong>“FAKE DOCUMENTS”</strong> to avoid penalty. All supporting documents are subject for <strong>VERIFICATION</strong>.</li>
            <li>All Birth Certificates for submission must be certified photocopy.</li>
            <li>All supporting documents submitted must be original copy.</li>
            <li>
                Accomplished correctly and completely the four (4) copies of the Certificate of Marriage. Avoid erasures and alterations.
            </li>
            <li>Please complete all needed requirements before submission.</li>
            <li>Ten (10) days mandatory posting period will commence on the day requirements are submitted.</li>
            <li><strong>Registration Fee: PHP 150.00</strong></li>
        </ul>





        <h2>CORRECTION OF CLERICAL ERROR</h2>
        <p>
            <strong>Republic Act No. 9048</strong> is an act further authorizing the City or Municipal Civil Registrar or the Consul General to correct clerical or typographical error in an entry and/or change of name or nickname in the civil register except corrections involving the change in sex, age, nationality and status of a person without a need of a judicial order. A petition shall be filed with the Local Civil Registry Office (LCRO) where the record containing the clerical error to be corrected is kept. However, in case the present residence is different from where his civil registry record is registered, he may file the petition in the nearest LCRO in his area. His petition will be treated as a migrant petition.
        </p>
        <h4>Who May Avail the Service:</h4>
        <ul>
            <li>Owner of the record that contains the error to be changed or corrected</li>
            <li>Owner’s spouse, children, parents, brothers, sisters, grandparents, guardian or any other person duly authorized by law or by the owner of the document sought to be corrected</li>
        </ul>
        <h4>Requirements:</h4>
        <ul>
            <li>PSA Copy of Birth Certificate containing the alleged erroneous entry or entries</li>
            <li>Not less than 2 public or private documents upon which the correction shall be based:
                <ul>
                    <li>Baptismal Certificate</li>
                    <li>Voter’s Affidavit</li>
                    <li>Employment Record</li>
                    <li>GSIS/SSS Record</li>
                    <li>Medical Record</li>
                    <li>School Record</li>
                    <li>Business Record</li>
                    <li>Driver’s License</li>
                    <li>Insurance</li>
                    <li>Land Titles</li>
                    <li>Certificate of Land Transfer</li>
                    <li>Bank Passbook</li>
                    <li>NBI/Police Clearance</li>
                    <li>Civil Registry Records of Ascendants and Others</li>
                </ul>
            </li>
        </ul>
        <h4>Fees:</h4>
        <ul>
            <li>₱1,000.00 – Filing Fee</li>
            <li>₱150.00 – Posting Fee</li>
            <li>₱200.00 – Certificate of Finality</li>
            <li>₱500.00 – Migrant Fee</li>
            <li>Other expenses: Courier & Notary</li>
        </ul>



        <p>
        <li>Don't submit<Strong> FAKE DOCUMENTS</Strong> to avoid penalty. All supporting documents are subject for<Strong> VERIFICATION and FURTHER EVALUATION</Strong></li>
        <li>Complete the needed requirements before submission</li>
        <li>Ten (10) days mandatory posting period will commence on the day requirements are submitted</li>
        </p>







            <h2>ISSUANCE OF CERTIFIED PHOTOCOPY / CERTIFICATION OF BIRTH, DEATH AND MARRIAGE CERTIFICATE</h2>
              <p><Strong>A CERTIFIED TRUE COPY</Strong> is a photocopy of the registered civil registry document in this City signed by the City Civil Registrar or his designed officer to certify that the copy is a true copy of the registered document kept this Office.</p>
            <h4>Who May Avail the Service:</h4>
            <ul>
                <li>The owner himself or through a duly authorized representative;</li>
                <li>His/her spouse, parent, direct descendants, guardian, or institution legally in charge of him/her, if minor;</li>
                <li>The court or proper public official whenever absolutely necessary in administrative, judicial, or other official proceedings to determine the identity of a person;</li>
                <li>In case of the person’s death, the nearest of kin</li>
            </ul>

            <h4>Requirements:</h4>
            <ul>
                <li>Any Government-issued Identification Card (ID)</li>
                <li>If the child is a minor, his parents, guardian, or the institution legally in charge of him, as the case may be, shall issue the authorization required.;</li>
                <li>Photocopy of the one giving the authorization with 3 fresh signatures and the grantee is also required.</li>
                <li>Affidavit of kinship, as needed</li>
            </ul>

            <h4>Fees:</h4>
            <ul>
                <li>₱35.00 each Certified True Copy of document.</li>
                <li>₱50.00 per Certification of document.</li>
            </ul>

            <p><Strong>ALL DOCUMENTS ARE SUBJECT FOR EVALUATION</strong> </p>






             <h2>ISSUANCE OF SECURITY PAPER (BREQS)</h2>

                    <p>
                        Copy of Birth, Marriage, or Death Certificates from Philippine Statistics Authority is printed on a SECURITY PAPER.
                    </p>

                    <h4>Who May Avail the Service:</h4>
                    <ul>
                        <li>The owner himself or through a duly authorized representative;</li>
                        <li>His/her spouse, parent, direct descendants, guardian, or institution legally in charge of him/her, if minor;</li>
                        <li>The court or proper public official whenever absolutely necessary in administrative, judicial, or other official proceedings to determine the identity of a person.</li>
                        <li>In case of the person’s death, the nearest of kin.</li>
                    </ul>

                    <h4>Requirements:</h4>
                    <ul>
                        <li>Any Government issued Identification Card (ID).</li>
                        <li>If the child is a minor, his parents, guardian, or the institution legally in charge of him, as the case may be, shall issue the authorization required.</li>
                        <li>Photocopy of the one giving the authorization with 3 fresh signatures, and the grantee is also required.</li>
                        <li>Affidavit of kinship, as needed.</li>
                    </ul>

                    <h4>Fees:</h4>
                    <ul>
                        <li>₱255.00 per copy of Certificate of Live Birth, Certificate of Death, & Certificate of Marriage.</li>
                        <li>₱310.00 per copy of Certificate of No Marriage (CENOMAR).</li>
                    </ul>

                    <h4>Note:</h4>
                    <ul>
                        <p><Strong>All documents are subject for evaluation.</Strong></p>
                    </ul>






              <h2>SUPPLEMENTAL REPORT</h2>
                        <p>
                           <strong>A Supplemental Report</strong> may be filed to supply information inadvertently omitted when the document is registered. It shall not be used in any manner to change or to correct any entry which was previously entered in the civil register. The Civil Registrar shall accept only one supplemental report for not more than two omitted information in any registered event.
                        </p>

                        <h4>Who May File the Petition?</h4>
                        <ul>
                            <li>
                                The supplemental report may be filed by the parent/guardian or the party concerned, if of age, who shall execute an affidavit indicating the entry/entries missed in the registration and the reasons why there was a failure in supplying the required entry.
                            </li>
                        </ul>

                        <h4>Requirements:</h4>
                        <ul>
                            <li>PSA Copy of the certificate containing the omitted entry or entries.</li>
                            <li>Not less than two (2) public or private documents upon which the omitted entry/entries shall be based:
                                <ul>
                                    <li>Baptismal Certificate</li>
                                    <li>Voter’s Affidavit</li>
                                    <li>Employment Record</li>
                                    <li>GSIS/SSS Record</li>
                                    <li>Medical Record</li>
                                    <li>School Record</li>
                                    <li>Business Record</li>
                                    <li>Driver’s License</li>
                                    <li>Insurance</li>
                                    <li>Land Titles</li>
                                    <li>Certificate of Land Transfer</li>
                                    <li>Bank Passbook</li>
                                    <li>NBI/Police Clearance</li>
                                    <li>Civil Registry Records of Ascendants and Others</li>
                                </ul>
                            </li>
                            <li>If Gender is omitted, request for certification from hospital is needed.</li>
                            <li>Affidavit for Supplemental Report</li>
                        </ul>

                        <h4>Fees:</h4>
                        <ul>
                            <li>₱300.00 – Supplemental Report</li>
                            <li>₱200.00 – Endorsement</li>
                            <li>₱35.00 – Certified True Copy of every supporting document</li>
                        </ul>

                        <h4>Note:</h4>
                        <ul>
                            <p>ALL DOCUMENTS ARE SUBJECT FOR EVALUATION.</p>
                        </ul>



        `,
       






            "Marriage License": `
            <h2>REQUIREMENTS FOR APPLICATION OF MARRIAGE LICENSE</h2>
        <p><strong>(Personal Appearance of the contracting parties / should be 18 years old and above)</strong></p>
        <h4>Requirements:</h4>
        <ul>
            <li>PSA original Copy of Certificate of Live Birth
                <ul>
                    <li>*If No Record of Birth - Latest Original Copy of Baptismal/MDR (Philhealth)/MDF(Pag-ibig)/E1 Form (SSS)</li>
                </ul>
            </li>
            <li>PSA Original Copy of Certificate of No Marriage (6 months validity/CENOMAR)</li>
            <li>Valid ID’s with Address in City of San Jose del Monte, Bulacan  – (<Strong>at least one of the applicant</Strong>- present the original & 2 photocopies with 3 affixed signature) </li>
            <li>Certificate of Pre-Marriage Orientation (PMO) & Marriage Counselling <Strong>(City Population Office - located at 2nd floor, New Government Center)</Strong></li>
            <li>Latest ID Picture (Passport size- white backgound)</li>
        </ul>
        <h4>Applicants between 18 and below 21 years old:</h4>
        <ul>
            <li>
                <strong>Parental Consent</strong> – Parents (Father and Mother or Guardian in the order mentioned) need to come personally with valid ID. If mother or father is already dead, please provide a copy of Death Certificate. (PSA Copy and 2 pcs Photocopy)
            </li>
            <li>*Parental consent provided for under Art. 14 of the Family Code of the Philippines</li>
        </ul>

        <h4>Applicants between 21 and below 25 years old:</h4>
        <ul>
            <li>
                <strong>Parental Advice</strong> – Parents (Father and Mother or Guardian in the order mentioned) need to come personally with valid ID. If mother and father is already dead, please provide a copy of Death Certificate (PSA Copy and 2 photocopies).
            </li>
            <li>
                *Parental Advice – If not obtained or unfavorable, Marriage License shall not be issued until after 3 months following the completion of the publication of the application. A sworn statement of the contracting parties must likewise be submitted indicating therein that the parents refuse to give advice.
            </li>
        </ul>

        <h4>Foreigner or Former Filipino Citizen but now is Naturalized Citizen of other country:</h4>
        <ul>
            <li>Certificate of Legal Capacity to Marry <Strong>issued by their respective Embassy here in the Philippines</Strong> (translate if in non-English content)</li>
            <li>Passport ID – Original & 2 photocopies with 3 affixed signature (showing data and date of arrival)</li>
            <li>PSA Copy of Certificate of No Marriage (CENOMAR)</li>
            <li>Certificate of Pre-Marriage Orientation -PMO (City Population Office)</li>
            <li>If applicant is naturalized citizen, Naturalized papers / Election of Citizenship (present the original copy and 2 photocopies)</li>
        </ul>

        <h4>Additional Document Needed:</h4>
        <p><strong>FOR WIDOW/WIDOWER:</strong></p>
        <ul>
            <li>PSA Copy of Death Certificate of deceased spouse</li>
            <li>PSA Copy of Marriage Certificate</li>
            <li>PSA Copy of CENOMAR / Having Advisory of Marriage</li>
        </ul>

        <p><strong>FOR ANNULLED:</strong></p>
        <ul>
            <li>Decree of Annulment / Decree of Nullity of Marriage certified by the court</li>
            <li>Court Decision and Annotated COM PSA Copy</li>
        </ul>

        <p><strong>FOR JUDICIAL DECLARATION PRESSUMPTIVE DEATH:</strong></p>
        <ul>
            <li>Court Decision</li>
            <li>Annotated COM -PSA Copy</li>
        </ul>

        <p><strong>FOR DIVORCED/DIVORCEE (Foreigner / Non-Filipino Citizen):</strong></p>
        <ul>
            <li>Divorce decree (translate if in non-English content)</li>
            <li>Court Decision (translate in non-English content)</li>
            <li>Annotated COM PSA Copy</li>
        </ul>

        <p><strong>FOR DIVORCE granted by Foreign Courts to Filipino abroad ( marriage took place here in the Phil.)</strong></p>
        <ul>
            <li>Divorce decree issued by a foreign court </li>
            <li>Judicial Recognition of Divorce obtained from the Philippine Court</li>
            <li>Annotated COM-PSA Copy</li>
        </ul>

        <p><strong>FOR DIVORCE Granted to MUSLIM Filipino:</strong></p>
        <ul>
            <li>Sharia’h Court (PD 1083)</li>
            <li>Divorce decree 3 copies</li>
            <li>Court Decision certified by the Sharia’h Court and Annotated COM PSA Copy</li>
        </ul>

        <h4>Notes:</h4>
        <ul>
            <li>At least one of the applicant must be a resident of the place where they will apply for marriage license.</li>
            <li>All requirements must be submitted upon application. Present all original copy, after assessment/evaluation <Strong>submit 2 photocopies of each requirement.</Strong></li>
            <li>The marriage license will be issue on the <Strong>11th day</Strong> after the <Strong>10-day posting period</Strong> upon submission of the application for marriage license. <Strong>License expires 120 days</Strong> from the date licensed was issued.</li>
        </ul>

        <h4>For added guidance & information please follow the following steps:</h4>
        <ul>
            <li>Comply all applicable requirements as stated above and proper fill out Application for Marriage License Form.</li>
            <li>Attend Pre-Marriage Orientation at City Population Office.</li>
            <li>Submit personally the complete requirement to the City Civil Registry Office and pay the corresponding fee (₱250.00 at the City Treasurer’s Office).</li>
            <li>Wait for 10-days posting period (Notice of Application).</li>
            <li>Claim the Marriage License presenting the issued Claim Stub after the completion of 10-day posting period and payment of License Fee (₱2.00).</li>
            <li>Please check/review all entries to avoid errors and bring the Marriage License to your Solemnizing Officer for the scheduled wedding ceremony.</li>
        </ul>




       



            `,




            "Death Certificate": `
            <h2>TIMELY REGISTRATION OF DEATH</h2>
        <p>
            <strong>REGISTRATION OF DEATH CERTIFICATE</strong> shall be made in the Office of the Civil Registrar of the city/municipality where it occurred within thirty (30) days from the time of death.
        </p>
        <h4>Requirements:</h4>
        <ul>
            <li>Four (4) copies of Form 103 duly accomplished and signed by the proper parties.</li>
        </ul>




        <h2>Delayed Registration of Death</h2>
        <h4>Requirements:</h4>
        <ul>
            <li>Original Death Certificate prepared by Hospital or Funeral Parlor</li>
            <li>Latest Copy of Certificate of No Record from PSA (NSO) and CCR of City of San Jose del Monte</li>
            <li>
                Affidavit of the nearest relative of the deceased or any person having legal charge of the deceased when he/she was still alive stating therein the exact date and place of death, the facts and circumstances surrounding the death and the reason or cause of delay
            </li>
            <li>Original Copy of the Certificate of Burial, Cremation or other means of corpse disposal</li>
            <li>Certificate from the Funeral Parlor and Cemetery</li>
            <li>Joint Affidavit of two Disinterested Persons</li>
            <li>For Muslim Registrants, fill-up Municipal Form No. 103</li>
        </ul>
        <h4>Fees:</h4>
        <ul>
            <li>₱150.00 – Delayed Registration of Death</li>
        </ul>

        <p>
        <li>Don't submit<Strong> FAKE DOCUMENTS</Strong> to avoid penalty. All supporting documents are subject for<Strong> VERIFICATION</Strong></li>
        <li>All supporting documents submitted must be original copy</li>
        <li>Please avoid erasures and alterations in the preparation of the Death Certificate</li>
        <li>Please Complete all the needed requirements before submission</li>
        <li>Ten (10) days posting period. Will commence on the day when requirements was submitted</li>
        </p>







        <h2>CORRECTION OF CLERICAL ERROR</h2>
        <p>
            <strong>Republic Act No. 9048</strong> is an act further authorizing the City or Municipal Civil Registrar or the Consul General to correct clerical or typographical error in an entry and/or change of name or nickname in the civil register except corrections involving the change in sex, age, nationality and status of a person without a need of a judicial order. A petition shall be filed with the Local Civil Registry Office (LCRO) where the record containing the clerical error to be corrected is kept. However, in case the present residence is different from where his civil registry record is registered, he may file the petition in the nearest LCRO in his area. His petition will be treated as a migrant petition.
        </p>
        <h4>Who May Avail the Service:</h4>
        <ul>
            <li>Owner of the record that contains the error to be changed or corrected</li>
            <li>Owner’s spouse, children, parents, brothers, sisters, grandparents, guardian or any other person duly authorized by law or by the owner of the document sought to be corrected</li>
        </ul>
        <h4>Requirements:</h4>
        <ul>
            <li>PSA Copy of Birth Certificate containing the alleged erroneous entry or entries</li>
            <li>Not less than 2 public or private documents upon which the correction shall be based:
                <ul>
                    <li>Baptismal Certificate</li>
                    <li>Voter’s Affidavit</li>
                    <li>Employment Record</li>
                    <li>GSIS/SSS Record</li>
                    <li>Medical Record</li>
                    <li>School Record</li>
                    <li>Business Record</li>
                    <li>Driver’s License</li>
                    <li>Insurance</li>
                    <li>Land Titles</li>
                    <li>Certificate of Land Transfer</li>
                    <li>Bank Passbook</li>
                    <li>NBI/Police Clearance</li>
                    <li>Civil Registry Records of Ascendants and Others</li>
                </ul>
            </li>
        </ul>
        <h4>Fees:</h4>
        <ul>
            <li>₱1,000.00 – Filing Fee</li>
            <li>₱150.00 – Posting Fee</li>
            <li>₱200.00 – Certificate of Finality</li>
            <li>₱500.00 – Migrant Fee</li>
            <li>Other expenses: Courier & Notary</li>
        </ul>






        <h2>ISSUANCE OF CERTIFIED PHOTOCOPY / CERTIFICATION OF BIRTH, DEATH AND MARRIAGE CERTIFICATE</h2>
        <p><Strong>A CERTIFIED TRUE COPY</Strong> is a photocopy of the registered civil registry document in this City signed by the City Civil Registrar or his designed officer to certify that the copy is a true copy of the registered document kept this Office.</p>
            <h4>Who May Avail the Service:</h4>
            <ul>
                <li>The owner himself or through a duly authorized representative;</li>
                <li>His/her spouse, parent, direct descendants, guardian, or institution legally in charge of him/her, if minor;</li>
                <li>The court or proper public official whenever absolutely necessary in administrative, judicial, or other official proceedings to determine the identity of a person;</li>
                <li>In case of the person’s death, the nearest of kin</li>
            </ul>

            <h4>Requirements:</h4>
            <ul>
                <li>Any Government-issued Identification Card (ID)</li>
                <li>If the child is a minor, his parents, guardian, or the institution legally in charge of him, as the case may be, shall issue the authorization required.;</li>
                <li>Photocopy of the one giving the authorization with 3 fresh signatures and the grantee is also required.</li>
                <li>Affidavit of kinship, as needed</li>
            </ul>

            <h4>Fees:</h4>
            <ul>
                <li>₱35.00 each Certified True Copy of document.</li>
                <li>₱50.00 per Certification of document.</li>
            </ul>

            <p><Strong>ALL DOCUMENTS ARE SUBJECT FOR EVALUATION</strong> </p>





              <h2>SUPPLEMENTAL REPORT</h2>
                        <p>
                           <strong>A Supplemental Report</strong> may be filed to supply information inadvertently omitted when the document is registered. It shall not be used in any manner to change or to correct any entry which was previously entered in the civil register. The Civil Registrar shall accept only one supplemental report for not more than two omitted information in any registered event.
                        </p>

                        <h4>Who May File the Petition?</h4>
                        <ul>
                            <li>
                                The supplemental report may be filed by the parent/guardian or the party concerned, if of age, who shall execute an affidavit indicating the entry/entries missed in the registration and the reasons why there was a failure in supplying the required entry.
                            </li>
                        </ul>

                        <h4>Requirements:</h4>
                        <ul>
                            <li>PSA Copy of the certificate containing the omitted entry or entries.</li>
                            <li>Not less than two (2) public or private documents upon which the omitted entry/entries shall be based:
                                <ul>
                                    <li>Baptismal Certificate</li>
                                    <li>Voter’s Affidavit</li>
                                    <li>Employment Record</li>
                                    <li>GSIS/SSS Record</li>
                                    <li>Medical Record</li>
                                    <li>School Record</li>
                                    <li>Business Record</li>
                                    <li>Driver’s License</li>
                                    <li>Insurance</li>
                                    <li>Land Titles</li>
                                    <li>Certificate of Land Transfer</li>
                                    <li>Bank Passbook</li>
                                    <li>NBI/Police Clearance</li>
                                    <li>Civil Registry Records of Ascendants and Others</li>
                                </ul>
                            </li>
                            <li>If Gender is omitted, request for certification from hospital is needed.</li>
                            <li>Affidavit for Supplemental Report</li>
                        </ul>

                        <h4>Fees:</h4>
                        <ul>
                            <li>₱300.00 – Supplemental Report</li>
                            <li>₱200.00 – Endorsement</li>
                            <li>₱35.00 – Certified True Copy of every supporting document</li>
                        </ul>

                        <h4>Note:</h4>
                        <ul>
                            <p>ALL DOCUMENTS ARE SUBJECT FOR EVALUATION.</p>
                        </ul>






                         <h2>ISSUANCE OF SECURITY PAPER (BREQS)</h2>

                            <p>
                                Copy of Birth, Marriage, or Death Certificates from Philippine Statistics Authority is printed on a SECURITY PAPER.
                            </p>

                            <h4>Who May Avail the Service:</h4>
                            <ul>
                                <li>The owner himself or through a duly authorized representative;</li>
                                <li>His/her spouse, parent, direct descendants, guardian, or institution legally in charge of him/her, if minor;</li>
                                <li>The court or proper public official whenever absolutely necessary in administrative, judicial, or other official proceedings to determine the identity of a person.</li>
                                <li>In case of the person’s death, the nearest of kin.</li>
                            </ul>

                            <h4>Requirements:</h4>
                            <ul>
                                <li>Any Government issued Identification Card (ID).</li>
                                <li>If the child is a minor, his parents, guardian, or the institution legally in charge of him, as the case may be, shall issue the authorization required.</li>
                                <li>Photocopy of the one giving the authorization with 3 fresh signatures, and the grantee is also required.</li>
                                <li>Affidavit of kinship, as needed.</li>
                            </ul>

                            <h4>Fees:</h4>
                            <ul>
                                <li>₱255.00 per copy of Certificate of Live Birth, Certificate of Death, & Certificate of Marriage.</li>
                                <li>₱310.00 per copy of Certificate of No Marriage (CENOMAR).</li>
                            </ul>

                            <h4>Note:</h4>
                            <ul>
                                <p><Strong>All documents are subject for evaluation.</Strong></p>
                            </ul>



        `,





        "Cenomar": `
            <h2>Privacy Notice for Certificate of No Marriage (CENOMAR)</h2>
            <p>The PSA supports the policy of the State to protect the fundamental right of privacy. In view of the passage of Republic Act No. 10173 also known as "Data Privacy Act of 2012," this office cannot issue documents from which the identity of an individual is apparent or can be reasonably and directly ascertained without the consent of the individual whose personal information is processed.</p>
            <p><strong>Such consent must be evidenced by written, electronic, or recorded means.</strong></p>
            <p>Hence, original and certified true copy of the Certificate of Live Birth, Certificate of Marriage, Certificate of Death, and Certificate of No Marriage (CENOMAR), and Advisory on Marriages, can only be issued to:</p>
            <ol>
                <li>The owner himself or through a duly authorized representative;</li>
                <li>His/her spouse, parent, direct descendants, guardian, or institution legally in-charge of him/her, if minor;</li>
                <li>The court or proper public official whenever absolutely necessary in administrative, judicial, or other official proceedings to determine the identity of a person;</li>
                <li>In case of the person's death, the nearest of kin.</li>
            </ol>
            <p>I understand that as per Data Privacy Act of 2012, PSA documents, if available in this office, cannot be released to me without valid IDs/government-issued IDs and proper authorization from the owner of the document, his/her parent (if minor), his/her spouse, his/her direct descendant, or his/her authorized guardian/institution-in-charge.</p>
        `,


       

        "Other Document": `
           <h2>REGISTRATION OF COURT ORDERS / DECREE AND REQUEST OF ANNOTATED RECORDS</h2>
                <h4>A. For Locally Originated Court Decree/Order</h4>
                <h4>Checklist of Requirements:</h4>
                <ul>
                    <li>Certified Copy of the Decision/Order (3 copies)</li>
                    <li>Original Copy of the Certificate of Finality</li>
                    <li>Affidavit for Late Registration (if not registered within the prescribed period)</li>
                    <li>Original PSA copy of the document needing annotation/correction</li>
                    <li>Valid ID of Petitioner</li>
                    <li>SPA and Valid ID, if registrant is not the Petitioner</li>
                </ul>

                <h4>Where to Secure:</h4>
                <ul>
                    <li>Regional Trial Court where the decision/order was rendered/issued</li>
                    <li>Notary Public</li>
                    <li>Philippine Statistics Authority (PSA)</li>
                    <li>Petitioner</li>
                </ul>

                <h4>Fees:</h4>
                <ul>
                    <li>Adoption: ₱3,000</li>
                    <li>Annulment of Marriage: ₱3,000</li>
                    <li>Divorce or Legal Separation: ₱3,000</li>
                    <li>Other similar registrable instruments: ₱500</li>
                    <li>Certified True Copy of the Decree/Order: ₱35 each</li>
                    <li>Endorsement: ₱200</li>
                </ul>

                <h4>B. For Court Decree/Order Originated from Outside the City (2 copies each)</h4>
                <h4>Checklist of Requirements:</h4>
                <ul>
                    <li>Certificate of Registration</li>
                    <li>Certificate of Authenticity</li>
                    <li>Certified Copy of Court Decree</li>
                    <li>Certified Copy of the Finality</li>
                    <li>Original PSA Copy of the document needing annotation/correction</li>
                    <li>Valid ID of Petitioner</li>
                    <li>SPA and Valid ID, if registrant is not the Petitioner</li>
                </ul>

                <h4>Where to Secure:</h4>
                <ul>
                    <li>City/Municipality Civil Registry Office where the Court Decree was Registered</li>
                    <li>Philippine Statistics Authority (PSA)</li>
                    <li>Petitioner</li>
                </ul>

                <h4>Fees:</h4>
                <ul>
                    <li>Clerical Error: ₱300</li>
                    <li>Adoption: ₱500</li>
                    <li>Annulment: ₱1,000</li>
                    <li>Others: ₱300</li>
                    <li>Certified True Copy of the Decree/Order: ₱35 each</li>
                    <li>Endorsement: ₱200</li>
                </ul>

                <h4>C. For Recognition of Foreign Judgment</h4>
                <h4>Checklist of Requirements:</h4>
                <ul>
                    <li>Judgment/orders rendered by foreign courts must be judicially confirmed/enforced by a civil action at the Regional Trial Courts in the Philippines (RTC-Phil.)</li>
                    <li>The RTC-Phil decision must be registered in the Local Civil Registry Office of the city/municipality where the court is functioning</li>
                    <li>Original or Certified True Copy of the foreign judgment or order duly registered at the City Civil Registry Office of Manila (where all foreign court orders are to be registered)</li>
                    <li>Certificate of Registration</li>
                </ul>

                <h4>Where to Secure:</h4>
                <ul>
                    <li>Regional Trial Court where the decision/order was rendered</li>
                    <li>City/Municipal Civil Registry Office</li>
                </ul>

                <h4>Fees:</h4>
                <ul>
                    <li>₱1,000</li>
                    <li>Certified True Copy of the Decree/Order: ₱35 each</li>
                    <li>Endorsement: ₱200</li>
                </ul>


               



                <h2>ACKNOWLEDGEMENT / ADMISSION OF PATERNITY</h2>

                    <p>
                        The <strong>ACKNOWLEDGEMENT</strong> of an illegitimate child by both parents or by the mother alone if the father refuses shall be done in a public instrument (considered authentic writing under Article 278 of the Civil Code).
                    </p>

                    <h4>Who May Avail This Service?</h4>
                    <ul>
                        <li>Children born prior to the effective of Family Code on August 03, 1988.</li>
                    </ul>

                    <h4>Requirements:</h4>
                    <ul>
                        <li>Local Copy of Birth Certificate of the Child.</li>
                        <li>Affidavit of Acknowledgement (for births before August 03, 1988).</li>
                        <li>Affidavit of Admission of Paternity (for births on or before August 03, 1988).</li>
                        <li>Valid ID of Father and Mother (Original and Photocopy).</li>
                        <li>Submit at least two (2) of the following documents or any other records that will prove the filiation of the child or documents showing the father has acknowledged the child:
                            <ul>
                                <li>Employment Records</li>
                                <li>SSS/GSIS Records</li>
                                <li>Insurance</li>
                                <li>Certification of Membership in any Organization</li>
                                <li>Statement of Assets and Liabilities</li>
                                <li>Income Tax Return (ITR)</li>
                            </ul>
                        </li>
                        <li><Strong>IF THE FATHER IS DECEASED,</Strong> submit Death Certificate and AUTHENTIC WRITING WILL BE NEEDED.</li>
                    </ul>

                    <h4>Fees:</h4>
                    <ul>
                        <li>₱300.00 – Acknowledgement of Paternity</li>
                        <li>₱200.00 – Endorsement</li>
                        <li>₱35.00 – Certified True Copy of every supporting document</li>
                    </ul>

                    <h4>Note:</h4>
                   
                        <p><Strong>ALL DOCUMENTS ARE SUBJECT FOR EVALUATION.</Strong></p>
                   




                        <h2>ANNOTATION IN THE CIVIL REGISTER BASED ON COURT/DECREE</h2>

                            <p>
                                The Civil Registry Office where the event of the decree/order was registered shall process the ANNOTATION OF CIVIL REGISTRY DOCUMENT BASED ON THE COURT DECREE. This procedure is done upon compliance of complete requirements of the petitioner.
                            </p>

                            <h4>Who May Avail the Service:</h4>
                            <ul>
                                <li>Owner of the record to be annotated</li>
                                <li>
                                    Owner’s spouse, children, parents, brothers, sisters, grandparents, guardian, or any other person duly authorized by law or by the owner of the document sought to be annotated
                                </li>
                            </ul>

                            <h4>Requirements:</h4>
                            <ul>
                                <li>Three sets of certified true copy of court decision, finality, certificate of authenticity, and certification</li>
                            </ul>

                            <h4>Fees:</h4>
                            <ul>
                                <li>₱1,000.00 – Annulment</li>
                                <li>₱500.00 – Adoption</li>
                                <li>₱300.00 – Clerical Error</li>
                                <li>₱300.00 – Others</li>
                            </ul>

                            <h4>Note:</h4>
                            <ul>
                                <li>All documents are subject for evaluation.</li>
                            </ul>


               







                   

                            `,

         
           





    };

    function showConfirmation() {
        const requiredFields = document.querySelectorAll("#appointment_form [required]");
        const modalData = document.getElementById("modal_data");
        let allFieldsFilled = true;

        // Reset border colors for all fields
        requiredFields.forEach(field => {
            field.style.border = ""; // Clear any previous styling
        });

        // Validate required fields
        requiredFields.forEach(field => {
            if (field.value.trim() === "") {
                allFieldsFilled = false;
                field.style.border = "2px solid red"; // Highlight the empty field
            }
        });

        if (!allFieldsFilled) {
            alert("Please fill out all required fields.");
            return; // Stop further execution
        }

        modalData.innerHTML = '';
        const formElements = document.querySelectorAll("#appointment_form [name]");
        formElements.forEach(element => {
            if (element.type !== "hidden" && element.value.trim() !== "") {
                modalData.innerHTML += `<p><strong>${formatFieldName(element.name)}:</strong> ${element.value}</p>`;
            }
        });

        document.getElementById("confirmation_modal").style.display = "flex";
    }

    function formatFieldName(name) {
        return name.charAt(0).toUpperCase() + name.slice(1).replace(/_/g, ' ');
    }



    function proceedToPrivacyNotice() {
        const selectedService = document.getElementById("appointment_type").value;

        if (!selectedService) {
            alert("Please select a document service.");
            return;
        }

        const privacyMessage = privacyNotices[selectedService] || `
            <h2>Privacy Notice</h2>
            <p>No specific privacy notice available for this service.</p>`;

        const privacyWindow = window.open('', '_blank');
        privacyWindow.document.write(`
            <html>
            <head>
                <title>Privacy Notice</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        margin: 20px;
                        line-height: 1.6;
                    }
                    h2 {
                            text-align: center;
                            color: #E91E63;
                            font-size: 25px;
                            border-bottom: 2px solid #E91E63;
                            padding-bottom: 10px;
                            margin-bottom: 20px;
                        }
                    h3 {
                        color:rgb(10, 9, 9);
                        font-size: 20px;
                        margin-bottom: 15px;
                        text-transform: capitalize;
                    }
                    p {
                        margin-bottom: 20px;
                        text-align: justify;
                        font-size: 16px;
                        color: #333;
                    }
                    ul, ol {
                        padding-left: 40px;
                    }
                    ul li, ol li {
                        margin-bottom: 10px;
                    }
                    button {
                        display: block;
                        margin: 20px auto;
                        padding: 10px 20px;
                        font-size: 16px;
                        cursor: pointer;
                        background-color: #4CAF50;
                        color: white;
                        border: none;
                        border-radius: 5px;
                        transition: background-color 0.3s;
                    }
                    button:hover {
                        background-color: #45a049;
                    }
                    .container {
                        max-width: 800px;
                        margin: 0 auto;
                        background-color: #f9f9f9;
                        padding: 20px;
                        border-radius: 10px;
                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    }
                </style>
            </head>
        <body>
                <div class="container">
                    ${privacyMessage}
                    <button onclick="window.opener.finalSubmit(); window.close();">I Agree and Submit</button>
                </div>
            </body>
            </html>
        `);
    }

    function finalSubmit() {
        alert("Form submitted successfully!");
        document.getElementById("appointment_form").submit();
    }

    function closeModal() {
        document.getElementById("confirmation_modal").style.display = "none";
    }

    function formatFieldName(fieldName) {
        return fieldName.replace(/_/g, ' ').replace(/\b\w/g, char => char.toUpperCase());
    }

    //APPOINTMENT CALENDAR
    $(document).ready(function () {
        // Inject Custom CSS for Datepicker
        const style = document.createElement('style');
        style.innerHTML = `
            .ui-datepicker {
                z-index: 1000 !important;
                margin-top: 8px !important;
                font-size: 1.2em !important;
                background-color: #ffffff !important;
                border: 1px solid #ddd !important;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                width: 780px !important; 
                height: auto !important; 
                padding: 15px; 
            }

            .ui-datepicker table {
                width: 100% !important; 
                height: 100% !important;  
            }

            .unavailable-date a {
                background-color: #f44336 !important; 
                color: white !important;
                pointer-events: none; 
            }
        `;
        document.head.appendChild(style);

        // Initialize Datepicker
        var today = new Date();

        // Fetch unavailable dates
        $.ajax({
            url: '/appointments/unavailable-dates',
            method: 'GET',
            success: function (bookedDates) {
                $("#appointment_date").datepicker({
                    dateFormat: 'yy-mm-dd',
                    minDate: today,
                    beforeShowDay: function (date) {
                        var formattedDate = $.datepicker.formatDate('yy-mm-dd', date);
                        var day = date.getDay(); // 0 = Sunday, 6 = Saturday

                        // Disable weekends and unavailable dates
                        if (day === 0 || day === 6 || bookedDates.includes(formattedDate)) {
                            return [false, 'unavailable-date', 'Unavailable'];
                        }
                        return [true, '', 'Available'];
                    }
                });
            },
            error: function () {
                console.error("Error fetching unavailable dates.");
            }
        });

        // Disable button if the calendar is visible
        $("#appointment_date").on("focus", function () {
            $("#submit_btn").prop("disabled", true); // Disable button when calendar is showing
        }).on("blur", function () {
            $("#submit_btn").prop("disabled", false); // Enable button when calendar is hidden
        });
    });









    //PLACE OF BIRTH (COUNTRY IF BORN ABROAD)
    function toggleCountryField() {
        var bornAbroadCheckbox = document.getElementById("born_abroad");
        var countryContainer = document.getElementById("country_container");

        if (bornAbroadCheckbox.checked) {
            countryContainer.style.display = "block";
        } else {
            countryContainer.style.display = "none";
        }
    }

    //PURPOSE DYNAMIC FORM
    function toggleOtherPurpose() {
        const purpose = document.getElementById('purpose').value;
        const purposeOther = document.getElementById('purpose_other');

        if (purpose === 'Other') {
            purposeOther.style.display = 'block';
            purposeOther.setAttribute('required', 'required');
        } else {
            purposeOther.style.display = 'none';
            purposeOther.removeAttribute('required');
        }
    }

    //DEATH CERTIFICATE (DIED ABROAD)
    function toggleCountryFieldForDeath() {
        var diedAbroadCheckbox = document.getElementById("died_abroad");
        var countryContainer = document.getElementById("country_container");

        if (diedAbroadCheckbox.checked) {
            countryContainer.style.display = "block";
        } else {
            countryContainer.style.display = "none";
        }
    }
   
        var today = new Date().toISOString().split('T')[0];
        document.getElementById("appointment_date").setAttribute('min', today);

        function showForm() {
            var selectedService = document.getElementById("appointment_type").value;
            var dynamicForm = document.getElementById("dynamic_form");
       
       
       

       

            if (selectedService === "Birth Certificate") {
                dynamicForm.innerHTML = `  
                    <div class="section-header">Request Information</div>
                    <div class="form-group">
                        <label for="request_type">Request Type:</label>
                        <select name="request_type" required>
                            <option value="" selected disabled>Select Request Type</option>
                            <option value="Copy Issuance">Copy Issuance</option>
                            <option value="Authentication">Authentication</option>
                            <option value="Viewable Online">Viewable Online</option>
                            <option value="Endorsement">Endorsement</option>
                            <option value="DocPrint">DocPrint</option>
                            <option value="Premium Annotation">Premium Annotation</option>
                            <option value="CD/LI">CD/LI</option>
                        </select>
                    </div>
                    <div class="form-group">
                    <label>For Muslim: Certificate of Conversion to Islam</label>
                    <div class="radio-group">
                        <input type="radio" id="muslim_yes" name="certificate_of_conversion" value="Yes" required>
                        <label for="muslim_yes">Yes</label>
                        <input type="radio" id="muslim_no" name="certificate_of_conversion" value="No" checked required>
                        <label for="muslim_no">No</label>
                    </div>
                </div>

                    <div class="form-group">
                        <label for="brn">Birth Reference Number (BRN):</label>
                        <input type="text" name="brn" maxlength="14" placeholder="000000-0000000-0">
                    </div>
                <div class="section-header">BIRTH CERTIFICATE DETAILS</div>
                    <h4>Person's/Child's Information</h4>
                        <div class="form-group">
                            <label for="child_last_name">Last Name: (if female, last name before marriage)</label>
                            <input type="text" name="child_last_name" required>
                        </div>
                        <div class="form-group">
                            <label for="child_first_name">First Name: (include JR., SR., II, III, IV, etc., if applicable)</label>
                            <input type="text" name="child_first_name" required>
                        </div>
                        <div class="form-group">
                            <label for="child_middle_name">Middle Name: (if female, middle name before marriage)</label>
                            <input type="text" name="child_middle_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Sex:</label>
                        <select name="child_sex" required>
                            <option value="" selected disabled>Select</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date_of_birth">Date of Birth:</label>
                        <input type="date" id="date_of_birth" name="date_of_birth" required>
                    </div>
                   
                    <!-- Born Abroad Checkbox -->
                    <label>Place of Birth</label>
                    <div class="form-group born-abroad" style="position: relative;">
                        <div style="position: absolute; left: 0; top: 0;">
                            <input type="checkbox" id="born_abroad" onclick="toggleCountryField()">
                        </div>
                        <label for="born_abroad" style="padding-left: 25px; font-size: 14px;">Born Abroad</label>
                    </div>

                    <!-- Country Field (Visible if Born Abroad is checked) -->
                    <div class="form-group" id="country_container" style="display: none;">
                        <label for="country">Country:</label>
                        <input type="text" id="country" name="country" placeholder="Please specify country if born abroad">
                        <small class="hint">Please specify country if born abroad only.</small>
                    </div>
                </div>

                <div class="form-row">
                    <!-- City/Municipality Field -->
                    <div class="form-group">
                        <label for="place_of_birth_city_municipality">City/Municipality:</label>
                        <input type="text" id="place_of_birth_city_municipality" name="place_of_birth_city_municipality" required>
                    </div>

                    <!-- Province Field -->
                    <div class="form-group">
                        <label for="place_of_birth_province">Province:</label>
                        <input type="text" id="place_of_birth_province" name="place_of_birth_province" required>
                    </div>
                </div>
                    <div class="section-header">Family Background</div>

                    <!-- Father's Information -->
                    <div class="form-group"><strong>Father's Name</strong></div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="father_last_name">Last Name:</label>
                            <input type="text" id="father_last_name" name="father_last_name" required>
                        </div>
                        <div class="form-group">
                            <label for="father_first_name">First Name:</label>
                            <input type="text" id="father_first_name" name="father_first_name" required>
                        </div>
                        <div class="form-group">
                            <label for="father_middle_name">Middle Name:</label>
                            <input type="text" id="father_middle_name" name="father_middle_name">
                        </div>
                    </div>
                    <!-- Mother's Information -->
                    <div class="form-group"><strong>Mother's Maiden Name</strong></div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="mother_last_name">Last Name:</label>
                            <input type="text" id="mother_last_name" name="mother_last_name" required>
                        </div>
                        <div class="form-group">
                            <label for="mother_first_name">First Name:</label>
                            <input type="text" id="mother_first_name" name="mother_first_name" required>
                        </div>
                        <div class="form-group">
                            <label for="mother_middle_name">Middle Name:</label>
                            <input type="text" id="mother_middle_name" name="mother_middle_name">
                        </div>
                    </div>
                `;
       
            } else if (selectedService === "Marriage Certificate") {
                dynamicForm.innerHTML = `
                        <div class="section-header">Request Information</div>
                    <div class="form-group">
                        <label for="request_type">Request Type:</label>
                        <select name="request_type" required>
                            <option value="" selected disabled>Select Request Type</option>
                            <option value="Marriage Certificate">Marriage Certificate</option>
                            <option value="Authentication">Authentication</option>
                            <option value="CD/LI">CD/LI</option>
                        </select>
                    <div class="section-header">Marriage Information</div>
                    <div class="form-group"><strong>NAME OF HUSBAND</strong></div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="husband_last_name">Last Name:</label>
                            <input type="text" id="husband_last_name" name="husband_last_name" required>
                        </div>
                        <div class="form-group">
                            <label for="husband_first_name">First Name:</label>
                            <input type="text" id="husband_first_name" name="husband_first_name" required>
                        </div>
                        <div class="form-group">
                            <label for="husband_middle_name">Middle Name:</label>
                            <input type="text" id="husband_middle_name" name="husband_middle_name">
                        </div>
                    </div>

                    <!-- Wife's Information -->
                    <div class="form-group"><strong>MAIDEN NAME OF WIFE</strong></div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="wife_last_name">Last Name:</label>
                            <input type="text" id="wife_last_name" name="wife_last_name" required>
                        </div>
                        <div class="form-group">
                            <label for="wife_first_name">First Name:</label>
                            <input type="text" id="wife_first_name" name="wife_first_name" required>
                        </div>
                        <div class="form-group">
                            <label for="wife_middle_name">Middle Name:</label>
                            <input type="text" id="wife_middle_name" name="wife_middle_name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="date_of_marriage">Date of Marriage:</label>
                        <input type="date" id="date_of_marriage" name="date_of_marriage" required>
                    </div>
                    <div class="form-group">
                    <label>Place of Marriage:</label>
                        <div class="form-group born-abroad" style="position: relative;">
                        <div style="position: absolute; left: 0; top: 0;">
                            <input type="checkbox" id="born_abroad" onclick="toggleCountryField()">
                        </div>
                        <label for="born_abroad" style="padding-left: 25px; font-size: 14px;">Married Abroad</label>
                    </div>
                    <div class="form-group" id="country_container" style="display: none;">
                        <label for="country">Country:</label>
                        <input type="text" id="country" name="country" placeholder="Please specify country if married abroad">
                        <small class="hint">Please specify country if married abroad only</small>
                    </div>
                </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="marriage_city_municipality">City/Municipality:</label>
                            <input type="text" id="marriage_city_municipality" name="marriage_city_municipality" required>
                        </div>
                        <div class ="form-group">
                            <label for="marriage_province">Province:</label>
                            <input type="text" id="marriage_province" name="marriage_province" required>
                        </div>
                    </div>
                       
                `;

            } else if (selectedService === "Marriage License") {
                dynamicForm.innerHTML =`
                    <div class="section-header">Request Information</div>
                    <div class="form-group">
                    <label for="request_type">Request Type:</label>
                    <select name="request_type" required>
                        <option value="" selected disabled>Select Request Type</option>
                        <option value="Marriage Certificate">Marriage Certificate</option>
                        <option value="Authentication">Authentication</option>
                        <option value="CD/LI">CD/LI</option>
                    </select>
                    </div>
                   
                    <div class="form-group">
                        <label for="brn">Birth Reference Number (BRN):</label>
                        <input type="text" name="brn" maxlength="11" placeholder="0-000-0000000">
                    </div>
                    <div class="form-group">
                    <div class="section-header">Marriage License Information</div>    
                    <!-- Applicant's Information -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="applicant_last_name">Last Name:</label>
                                    <input type="text" name="applicant_last_name" required>
                            </div>

                            <div class="form-group">
                                <label for="applicant_first_name">First Name:</label>
                                <input type="text" name="applicant_first_name" required>
                            </div>

                                <div class="form-group">
                                    <label for="applicant_middle_name">Middle Name:</label>
                                    <input type="text" name="applicant_middle_name">
                                </div>
                            </div>

                            <!-- Spouse's Information -->
                <div class="form-group"><strong>Spouse's Information</strong></div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="spouse_last_name">Last Name:</label>
                        <input type="text" name="spouse_last_name" required>
                    </div>

                    <div class="form-group">
                        <label for="spouse_first_name">First Name:</label>
                        <input type="text" name="spouse_first_name" required>
                    </div>

                    <div class="form-group">
                        <label for="spouse_middle_name">Middle Name:</label>
                        <input type="text" name="spouse_middle_name">
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
                   
                   
                        document.getElementById("planned_date_of_marriage").setAttribute('min', today);

            } else if (selectedService === "Death Certificate") {
                dynamicForm.innerHTML = `
                <div class="section-header">Request Information</div>
                    <div class="form-group">
                        <label for="request_type">Request Type:</label>
                        <select name="request_type" required>
                            <option value="" selected disabled>Select Request Type</option>
                            <option value="Death Certificate">Death Certificate</option>
                            <option value="Authentication">Authentication</option>
                            <option value="CD/LI">CD/LI</option>
                        </select>
                    </div>
                </div>

                    <div class="form-group">
                        <label for="brn">Birth Reference Number (BRN):</label>
                        <input type="text" name="brn" maxlength="14" placeholder="000000-0000000-0">
                    </div>
                    <div class="section-header">Deceased Information</div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="deceased_last_name">Last Name:</label>
                            <input type="text" id="deceased_last_name" name="deceased_last_name" required>
                        </div>
                        <div class="form-group">
                            <label for="deceased_first_name">First Name:</label>
                            <input type="text" id="deceased_first_name" name="deceased_first_name" required>
                        </div>
                        <div class="form-group">
                            <label for="deceased_middle_name">Middle Name:</label>
                            <input type="text" id="deceased_middle_name" name="deceased_middle_name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="date_of_death">Date of Death:</label>
                        <input type="date" id="date_of_death" name="date_of_death" required>
                    </div>
                    <div class="form-group">
                        <label>Place of Death:</label>
                        <div class="form-group died-abroad" style="position: relative;">
                            <div style="position: absolute; left: 0; top: 0;">
                                <input type="checkbox" id="died_abroad" onclick="toggleCountryFieldForDeath()">
                            </div>
                            <label for="died_abroad" style="padding-left: 25px; font-size: 14px;">Died Abroad</label>
                        </div>
                        <div class="form-group" id="country_container" style="display: none;">
                            <label for="country">Country:</label>
                            <input type="text" id="country" name="country" placeholder="Please specify country if died abroad">
                            <small class="hint">Please specify country if death occurred abroad only.</small>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="death_city_municipality">City/Municipality:</label>
                                <input type="text" id="death_city_municipality" name="death_city_municipality" required>
                            </div>
                            <div class="form-group">
                                <label for="death_province">Province:</label>
                                <input type="text" id="death_province" name="death_province" required>
                            </div>
                        </div>
                    </div>

               
                `;

            } else if (selectedService === "Cenomar") {
                dynamicForm.innerHTML = `
                    <div class="section-header">CENOMAR Request Information</div>

                    <!-- Request Information for CENOMAR -->
                    <div class="form-group">
                        <label for="request_type">Request Type:</label>
                        <select name="request_type" required>
                            <option value="" selected disabled>Select Request Type</option>
                            <option value="Certificate of No Marriage (CENOMAR)">Certificate of No Marriage (CENOMAR)</option>
                            <option value="Viewable Online">Viewable Online</option>
                            <option value="DocPrint">DocPrint</option>
                        </select>
                    </div>
                    <div class="form-group">
                                <label for="brn">Birth Reference Number (BRN):</label>
                                <input type="text" name="brn" maxlength="14" placeholder="000000-0000000-0">
                        </div>
                        <div class="section-header">BIRTH DETAILS</div>
                            <h4>Person's Information</h4>
                                <div class="form-group">
                                    <label for="person_last_name">Last Name: (if female, last name before marriage)</label>
                                    <input type="text" name="person_last_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="person_first_name">First Name: (include JR., SR., II, III, IV, etc., if applicable)</label>
                                    <input type="text" name="person_first_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="person_middle_name">Middle Name: (if female, middle name before marriage)</label>
                                    <input type="text" name="person_middle_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Sex:</label>
                                <select name="person_sex" required>
                                    <option value="" selected disabled>Select</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="date_of_birth">Date of Birth:</label>
                                <input type="date" id="date_of_birth" name="date_of_birth" required>
                            </div>
                           
                            <!-- Born Abroad Checkbox -->
                            <label>Place of Birth</label>
                            <div class="form-group born-abroad" style="position: relative;">
                                <div style="position: absolute; left: 0; top: 0;">
                                    <input type="checkbox" id="born_abroad" onclick="toggleCountryField()">
                                </div>
                                <label for="born_abroad" style="padding-left: 25px; font-size: 14px;">Born Abroad</label>
                            </div>

                            <!-- Country Field (Visible if Born Abroad is checked) -->
                            <div class="form-group" id="country_container" style="display: none;">
                                <label for="country">Country:</label>
                                <input type="text" id="country" name="country" placeholder="Please specify country if born abroad">
                                <small class="hint">Please specify country if born abroad only.</small>
                            </div>
                        </div>

                        <div class="form-row">
                            <!-- City/Municipality Field -->
                            <div class="form-group">
                                <label for="person_city_municipality">City/Municipality:</label>
                                <input type="text" id="person_city_municipality" name="person_city_municipality" required>
                            </div>

                            <!-- Province Field -->
                            <div class="form-group">
                                <label for="person_province">Province:</label>
                                <input type="text" id="person_province" name="person_province" required>
                            </div>
                        </div>
                                <div class="section-header">Family Background</div>

                            <!-- Father's Information -->
                            <div class="form-group"><strong>Father's Name</strong></div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="father_last_name">Last Name:</label>
                                    <input type="text" id="father_last_name" name="father_last_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="father_first_name">First Name:</label>
                                    <input type="text" id="father_first_name" name="father_first_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="father_middle_name">Middle Name:</label>
                                    <input type="text" id="father_middle_name" name="father_middle_name">
                                </div>
                            </div>

                            <!-- Mother's Information -->
                            <div class="form-group"><strong>Mother's Maiden Name</strong></div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="mother_last_name">Last Name:</label>
                                    <input type="text" id="mother_last_name" name="mother_last_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="mother_first_name">First Name:</label>
                                    <input type="text" id="mother_first_name" name="mother_first_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="mother_middle_name">Middle Name:</label>
                                    <input type="text" id="mother_middle_name" name="mother_middle_name">
                                </div>
                            </div>
                `;

                } else if (selectedService === "Other Document") {
                    dynamicForm.innerHTML = `
                   
                    <div class="form-group">
                        <label for="other_document">Specify Document:</label>
                        <input type="text" id="other_document" name="other_document" placeholder="e.g., Barangay Clearance" required>
                    </div>

                    <div class="form-group">
                        <label for="document_details">Document Details:</label>
                        <textarea id="document_details" name="document_details" rows="4" placeholder="Provide additional details about the document" required></textarea>
                    </div>

                `;

    }
        }

       
</script>
<script>
    // If user press enter, it prevent submitting esp if field with required
    document.getElementById("appointment_form").addEventListener("keydown", function (event) {
        if (event.key === "Enter") {
            event.preventDefault();
            validateForm();
        }
    });

    function validateForm() {
        const form = document.getElementById("appointment_form");
        const inputs = form.querySelectorAll("[required]");
        let isValid = true;

        inputs.forEach(input => {
            if (!input.value.trim()) {
                input.classList.add("error");
                isValid = false;
            } else {
                input.classList.remove("error");
            }
        });

        if (!isValid) {
            alert("Please fill out all required fields.");
        }
    }
    document.getElementById('appointment_form').addEventListener('submit', function (event) {
        console.log(new FormData(this)); // Log form data to check missing fields
    });




</script>

</body>
</html>