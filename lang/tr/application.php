<?php

return [
    'titles' => [
        'index' => 'Başvurular',
        'create' => 'Başvuru Oluştur',
        'edit' => 'Başvuru Düzenle'
    ],

    'success' => [
        'created' => 'Başvurunuz alınmıştır.',
        'updated' => 'Başvurunuz güncellenmiştir.',
        'status-updated' => 'Başvuru durumunu güncellendi.'
    ],

    'buttons' => [
        'create' => 'Başvuru Oluştur',
        'edit' => 'Başvuruyu Düzenle',
        'send' => 'Başvuruyu Gönder',
        'save' => 'Başvuruyu Kaydet',
        'preview' => 'Görüntüle',
        'apply' => 'Uygula',
        'reset' => 'Sıfırla',

        'approve-application' => 'Başvuruyu Onayla',
        'reject-application' => 'Başvuruyu Reddet',
        'recognition-certificate' => 'YÖK Tanınırlık İste',
        'missing-document' => 'Hatalı veya Eksik Belge',
        'approve-payment' => 'Ödemeyi Onayla'
    ],

    'steps' => [
        'one' => 'Birinci Adım',
        'two' => 'İkinci Adım',
        'three' => 'Üçüncü Adım',
        'finish' => 'Tamamlandı'
    ],

    'statuses' => [
        'pending' => 'Değerlendirmeyi Bekliyor',
        'approved' => 'Başvuru Kabul Edildi',
        'missing-document' => 'Eksik veya Hatalı Belge',
        'rejected' => 'Reddedildi',
        'pending-recognition-certificate' => 'YÖK Tanınırlık Belgesi Bekleniyor',
        'pending-payment' => 'Ödeme Bekleniyor',
        'approval-payment' => 'Ödeme Onaylandı',
        'official-letter-sent' => 'Resmi Davetiye Gönderildi'
    ],

    'tabs' => [
        'department-details' => 'Bölüm Bilgileri',
        'personal-details' => 'Kişisel Bilgiler',
        'contact-details' => 'İletişim Bilgileri',
        'school-details' => 'Okul Bilgileri',
        'test-and-score-details' => 'Test ve Dereceler',
        'program-details' => 'Program Detay',
        'application-terms' => 'Başvuru Şartları',
        'payment-details' => 'Ödeme Dekont'
    ],

    'texts' => [
        'self-application' => 'Kendisi',
        'warning-upload-image' => 'Yükleyebileceğiniz fotoğraf boyutu en fazla 2MB olmalıdır. Desteklenen Formatlar: jpg, png, jpeg.',
//        'warning-upload-image' => 'The file size you upload must be a maximum of 2MB. Supported formats are jpg, png, jpeg.'
        'warning-upload-transcript' => 'Yükleyebileceğiniz dosya boyutu en fazla 2MB olmalıdır. Desteklenen Formatlar: pdf, xlsx, docx, doc.',
        'warning-upload-payment' => 'Yükleyebileceğiniz dosya boyutu en fazla 2MB olmalıdır. Desteklenen Format: pdf.',
//        'warning-upload-transcript' => 'The file size you upload must be a maximum of 2MB. Supported formats are pdf, xlsx, docx, doc.',
        'warning-upload-exam' => 'Yükleyebileceğiniz dosya boyutu en fazla 2MB olmalıdır. Desteklenen Formatlar: pdf, xlsx, docx, doc.',
//        'warning-upload-exam' => 'The file size you upload must be a maximum of 2MB. Supported formats are pdf, xlsx, docx, doc.',
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
        'department_id' => 'Bölümler',
        'name' => 'Adınız Soyadınız',
        'nationality' => 'Uyruk',
        'passport_number' => 'Pasaport No',
        'place_of_birth' => 'Doğum Yeri',
        'date_of_birth' => 'Doğum Tarihi',
        'passport_photo' => 'Pasaport Fotoğrafı',
        'country' => 'Ülke',
        'address' => 'Adres',
        'phone_number' => 'Telefon Numarası',
        'email' => 'E-Posta',
        'school_name' => 'Okul Adı',
        'school_country' => 'Okulun Bulunduğu Ülke',
        'school_city' => 'Okulun Bulunduğu Şehir',
        'year_graduation' => 'Mezuniyet Yılı',
        'graduation_degree' => 'Mezuniyet Derecesi',
        'official_transcript' => 'Resmi Transkript (Son 3 YIL)',
        'official_exam' => 'TOEFL veya IELTS Sonucunuz (varsa)',
        'reference' => 'Referans',
        'payment_file' => 'Ödeme Dekontu',
        'status' => 'Statü',
        'nationality_id' => 'Uyruk',
        'agency_id' => 'Acente'
    ],

    'tables' => [
        'id' => 'ID',
        'who_applied' => 'Başvuran Kişi',
        'name' => 'Öğrenci Adı',
        'nationality' => 'Uyruk',
        'status' => 'Durum',
        'actions' => 'İşlemler'
    ]
];
