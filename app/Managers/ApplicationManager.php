<?php

namespace App\Managers;

use App\Enums\ApplicationStatusEnum;
use App\Models\Application;
use App\Models\EmailTemplateApplicationStatus;
use App\Models\User;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\UploadedFile;

class ApplicationManager extends BaseManager
{
    public function create(array $data)
    {
        /** @var User $user */
        $user = auth()->user();

        if (! isset($data['agency_id'])) {
            $data['agency_id'] = $user->agency_id;
        }

        if (! isset($data['user_id'])) {
            $data['user_id'] = $user->id;
        }

        if ($user->isStudent()) {
            if (is_null($data['email'])) {
                $data['email'] = $user->email;
            }
        }

        $data['code'] = IdGenerator::generate(['table' => 'applications', 'field' => 'code', 'length' => 10, 'prefix' => 'ABU-']);

        return Application::query()->create($data);
    }

    public function update(Application $application, array $data): void
    {
        $application->update($data);
    }

    public function uploadPassportPhoto(Application $application, UploadedFile $file): void
    {
        $passportPhoto = $application->getRawOriginal('passport_photo');

        if (!is_null($passportPhoto) && $this->disk()->exists($passportPhoto)) {
            $this->disk()->delete($passportPhoto);
        }

        $path = $file->store('applications/passports', 'public');

        $application->update([
            'passport_photo' => $path,
        ]);
    }

    public function uploadTranscript(Application $application, UploadedFile $file): void
    {
        $officialTranscript = $application->getRawOriginal('official_transcript');

        if (! is_null($officialTranscript) && $this->disk()->exists($officialTranscript)) {
            $this->disk()->delete($officialTranscript);
        }

        $path = $file->store('applications/transcripts', 'public');

        $application->update([
            'official_transcript' => $path,
        ]);
    }

    public function uploadOfficialExam(Application $application, UploadedFile $uploadedFile): void
    {
        $file = $application->getRawOriginal('official_exam');

        if (! is_null($file) && $this->disk()->exists($uploadedFile)) {
            $this->disk()->delete($uploadedFile);
        }

        $path = $uploadedFile->store('applications/exams', 'public');

        $application->update([
            'official_exam' => $path,
        ]);
    }

    public function uploadSchoolDiploma(Application $application, UploadedFile $uploadedFile): void
    {
        $file = $application->getRawOriginal('school_diploma');

        if (! is_null($file) && $this->disk()->exists($file)) {
            $this->disk()->delete($file);
        }

        $path = $uploadedFile->store('applications/diplomas', 'public');

        $application->update([
            'school_diploma' => $path,
        ]);
    }

    public function uploadAdditionalDocument(Application $application, UploadedFile $uploadedFile): void
    {
        $file = $application->getRawOriginal('additional_document');

        if (! is_null($file) && $this->disk()->exists($file)) {
            $this->disk()->delete($file);
        }

        $path = $uploadedFile->store('applications/additional-documents', 'public');

        $application->update([
            'additional_document' => $path,
        ]);
    }

    public function uploadPaymentFile(Application $application, UploadedFile $file): void
    {
        $paymentFile = $application->getRawOriginal('payment_file');

        if (! is_null($paymentFile) && $this->disk()->exists($paymentFile)) {
            $this->disk()->delete($paymentFile);
        }

        $path = $file->store('applications/payments', 'public');

        $application->update([
            'payment_file' => $path,
        ]);
    }

    public function updateStatus(Application $application, string $status): void
    {
        $application->update([
            'step' => ApplicationStatusEnum::getValue($status),
            'status' => $status
        ]);
    }

    public function sendEmail(Application $application, string $status)
    {
        $templates = EmailTemplateApplicationStatus::query()->where('application_status_type', '=', $status)->get();
    }
}
