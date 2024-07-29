<?php
return [
    'titles' => [
        'index' => 'Applications',
        'create' => 'Create Application',
        'edit' => 'Edit Application'
    ],

    'success' => [
        'created' => 'Your application has been received.',
        'updated' => 'Your application has been updated.',
        'status-updated' => 'Application status updated.',
        'uploaded-payment' => 'Payment receipt uploaded successfully.'
    ],

    'errors' => [
        'unable-create-zip' => 'File compression failed.'
    ],

    'buttons' => [
        'create' => 'Create',
        'edit' => 'Edit',
        'send' => 'Send',
        'save' => 'Save',
        'preview' => 'Preview',
        'apply' => 'Apply',
        'reset' => 'Reset',

        'upload' => 'Upload',
        'zip-download' => 'Download Documents',

        'send-mail' => 'Send Mail',
        'cancel' => 'Cancel',

        'upload-payment-document' => 'Upload Payment Receipt',

        'approve-application' => 'Approve Application',
        'edit-application' => 'Edit Application',
        'reject-application' => 'Reject Application',
        'recognition-certificate' => 'Request YÖK Recognition',
        'missing-document' => 'Missing Document',
        'approve-official-letter' => 'Send Official Acceptance Letter'
    ],

    'statuses' => [
        'pending' => 'Pending Review',
        'missing-document' => 'Missing Document',
        'rejected' => 'Rejected',

        'sent-pre-approval-letter' => 'Pre-approval Letter Sent',
        'pending-financial-approval' => 'Pending Financial Approval',

        'official-letter-sent' => 'Official Invitation Sent'
    ],

    'attachments' => [
        'pre-letter' => 'Pre-approval Letter'
    ],

    'tabs' => [
        'department-details' => 'Department Details',
        'personal-details' => 'Personal Details',
        'contact-details' => 'Contact Details',
        'school-details' => 'School Details',
        'test-and-score-details' => 'Test and Scores',
        'program-details' => 'Program Details',
        'application-terms' => 'Application Terms',
        'payment-details' => 'Payment Receipt'
    ],

    'texts' => [
        'upload-letter' => 'Official Acceptance Letter',
        'missing-document-header' => 'Missing Document',

        'pending-application' => 'Pending Application',
        'sent-pre-letter' => 'Received Pre-approval Letter',
        'pending-payment-application' => 'Pending Payment Approval',
        'sent-official-letter' => 'Received Official Acceptance Letter',
        'missing-document' => 'Notified of Missing Document',
        'self-application' => 'Self',
        'warning-upload-image' => 'The photo you upload must be a maximum of 2MB. Supported formats: jpg, png, jpeg.',
//        'warning-upload-image' => 'The file size you upload must be a maximum of 2MB. Supported formats are jpg, png, jpeg.'
        'warning-upload' => 'The file you upload must be a maximum of 2MB. Supported formats: pdf, xlsx, docx, doc.',
        'application-terms' => "I Confirm that, <br>
                                        1. I will bring all required documents for the final registration.<br>
                                        2. If I don't get equivalency from the Ministry of Education in Turkey the
                                        University won't take any responsibility and can cancel the registration.<br>
                                        3. I will require my deposit fees only in case of visa rejection confirmed from
                                        the embassy.<br>
                                        4. Tuition fees are non-refundable.<br>",
        'gdpr' => 'I approve and consent to the processing of my personal data in the ways specified in the text.'
    ],

    'inputs' => [
        'department_id' => 'Departments',
        'name' => 'Full Name',
        'nationality' => 'Nationality',
        'passport_number' => 'Passport Number',
        'place_of_birth' => 'Place of Birth',
        'date_of_birth' => 'Date of Birth',
        'passport_photo' => 'Passport Photo',
        'country' => 'Country',
        'address' => 'Address',
        'phone_number' => 'Phone Number',
        'email' => 'Email',
        'school_name' => 'School Name',
        'school_country' => 'School Country',
        'school_city' => 'School City',
        'year_graduation' => 'Graduation Year',
        'graduation_degree' => 'Graduation Degree',
        'high_school_diploma' => 'High School Diploma',
        'official_transcript' => 'Official Transcript (Last 3 Years)',
        'additional_document' => 'Additional Document',
        'official_exam' => 'TOEFL or IELTS Result (if any)',
        'reference' => 'How Did You Hear About Us?',
        'payment_file' => 'Payment Receipt',
        'status' => 'Status',
        'nationality_id' => 'Nationality',
        'agency_id' => 'Agency',

        'payment-document' => 'Payment Receipt',
        'description' => 'Description',

        'title' => 'Title',
        'content' => 'Content',
        'attachments' => 'Attachment(s)'
    ],

    'tables' => [
        'id' => 'ID',
        'agency_code' => 'Agency Code',
        'agency_name' => 'Agency Name',
        'name' => 'Student Name',
        'nationality' => 'Nationality',
        'status' => 'Status',
        'actions' => 'Actions'
    ]
];
