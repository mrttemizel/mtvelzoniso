<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Pre Offer</title>
</head>
<body>
    <img src="{{ asset('pdfs/header.jpg') }}" alt="header" style="width: 100%;" />

    <h1 style="text-align: center; margin-top: 20px;">Pre-Acceptance Letter</h1>

    <div style="font-weight: 600; float: right;">
        <div style="text-align: right">
            <span>Date of Issue:</span> {{ $application->created_at->format('d.m.Y') }}
        </div>
        <div style="text-align: right">
            <span>Application Number:</span> {{ $application->application_code }}
        </div>
    </div>

    <div style="clear: both;"></div>

    <div>
        <div>Dear <b>{{ $application->name }}</b>,</div>

        <p>
            Congratulations! We’re pleased to inform you that you have been accepted to Antalya Bilim University for the upcoming academic year. We are excited to welcome you to our community
        </p>
        <p>Please refer to the table below for pertinent admission details:</p>

        <table border="1" style="border-collapse: collapse; width: 85%; margin: 0 auto">
            <tr>
                <td style="width: 50%;">
                    <div style="font-weight: 600; margin-left: 5px;">Admitted Program Name</div>
                </td>
                <td>{{ $application->department->name }}</td>
            </tr>
            <tr>
                <td>
                    <div style="font-weight: 600; margin-left: 5px;">Faculty/School</div>
                </td>
                <td>{{ $application->department->faculty }}</td>
            </tr>
            <tr>
                <td>
                    <div style="font-weight: 600; margin-left: 5px;">Admission Term</div>
                </td>
                <td></td>
            </tr>
            <tr>
                <td>
                    <div style="font-weight: 600; margin-left: 5px;">Annual Fee</div>
                </td>
                <td>{{ $application->department->annual_fee }}</td>
            </tr>
            <tr>
                <td>
                    <div style="font-weight: 600; margin-left: 5px;">Annual Discounted Tuition Fee</div>
                </td>
                <td>{{ $application->department->discounted_fee }}</td>
            </tr>
            <tr>
                <td>
                    <div style="font-weight: 600; margin-left: 5px;">Deposit Payment</div>
                </td>
                <td>${{ number_format(1000, 2) }}</td>
            </tr>
            <tr>
                <td>
                    <div style="font-weight: 600; margin-left: 5px;">Installment</div>
                </td>
                <td>2</td>
            </tr>
            <tr>
                <td>
                    <div style="font-weight: 600; margin-left: 5px;">Expiry Date of the Letter</div>
                </td>
                <td>{{ $application->created_at->addDays(7)->format('d.m.Y') }}</td>
            </tr>
        </table>

        <p style="font-weight: 400; font-style: italic; color: red;">Please note that this letter cannot be used for visa applications.</p>

        <p>Upon payment of the deposit, you'll receive the Official Acceptance Letter, which can be used for visa purposes.</p>

        <p>
            To comply with university regulations, please make the deposit payment in US dollars to the provided bank account. Include the student's name- last name and application number on the payment receipt and email it to
            <a href="mailto:iso@antalya.edu.tr">iso@antalya.edu.tr</a>
        </p>

        <p>The deposit will be deducted from the program's annual fee.</p>

        <b style="display:block; margin-bottom: 10px;">Bank Account Details:</b>

        <table border="1" style="border-collapse: collapse; width: 85%; margin: 0 auto;">
            <tr>
                <td>
                    <div style="font-weight: 600; margin-left: 10px;">Bank Name</div>
                </td>
                <td>VAKIFBANK</td>
            </tr>
            <tr>
                <td>
                    <div style="font-weight: 600; margin-left: 10px;">Brunch Name</div>
                </td>
                <td>Antalya Brunch</td>
            </tr>
            <tr>
                <td>
                    <div style="font-weight: 600; margin-left: 10px;">Bank Account Number</div>
                </td>
                <td>00158048018711633</td>
            </tr>
            <tr>
                <td>
                    <div style="font-weight: 600; margin-left: 10px;">IBAN</div>
                </td>
                <td>TR870001500158048018711633</td>
            </tr>
            <tr>
                <td>
                    <div style="font-weight: 600; margin-left: 10px;">Swift Code</div>
                </td>
                <td>TVBATR2AXXX</td>
            </tr>
            <tr>
                <td>
                    <div style="font-weight: 600; margin-left: 10px;">Account Name</div>
                </td>
                <td>ANTALYA BILIM UNIVERSITESI</td>
            </tr>
        </table>

        <div style="page-break-before: always;"></div>

        <p>Kindly note that the deposit fee is refundable only in case of visa rejection. Upon confirmation of rejection by the Turkish Consulate/Embassy, the deposit will be refunded to the student's bank account.</p>

        <p>Ensure that you take responsibility for providing the necessary documents to the University prior to official registration. Failure to do so may result in the cancellation of your admission at the University. For a list of required documents for final registration, please refer to the following link:</p>

        <p>For Bachelor Programs:
            <a href="https://antalya.edu.tr/en/departments/international-student-office/content/required-documents-1/undergraduate-1">https://antalya.edu.tr/en/departments/international-student-office/content/required-documents-1/undergraduate-1</a>
        </p>

        <p>
            For Master and PhD Programs:
            <a href="https://antalya.edu.tr/en/departments/international-student-office/content/required-documents-1/graduate-1">https://antalya.edu.tr/en/departments/international-student-office/content/required-documents-1/graduate-1</a>
        </p>

        <p>If you have any questions or concerns, please feel free to reach out.</p>
        <p>Best regards,</p>

        <img src="{{ asset('pdfs/signature.png') }}" alt="signature" style="width: 250px; float: right" />
    </div>
</body>
</html>
