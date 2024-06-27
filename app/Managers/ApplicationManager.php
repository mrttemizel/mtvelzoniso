<?php

namespace App\Managers;

use App\Enums\ApplicationStatusEnum;
use App\Models\Application;
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

        $data['application_code'] = IdGenerator::generate(['table' => 'applications', 'field' => 'application_code', 'length' => 10, 'prefix' => 'ABU-']);

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

    public function uploadDocumentFile(Application $application, UploadedFile $file): void
    {
        $documentFile = $application->getRawOriginal('document_file');

        if (! is_null($documentFile) && $this->disk()->exists($documentFile)) {
            $this->disk()->delete($documentFile);
        }

        $path = $file->store('applications/documents', 'public');

        $application->update([
            'document_file' => $path,
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
}
