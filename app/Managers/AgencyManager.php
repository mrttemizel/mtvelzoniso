<?php

namespace App\Managers;

use App\Models\Agency;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class AgencyManager
{
    protected string $diskName = 'public';

    public function findById($id)
    {
        return Agency::query()->find($id);
    }

    /**
     * @throws \Exception
     */
    public function create(array $data)
    {
        $data['code'] = IdGenerator::generate(['table' => 'agencies', 'field' => 'code', 'length' => 10, 'prefix' => 'ACT-']);

        return Agency::query()->create($data);
    }

    public function update(Agency $agency, array $data)
    {
        $agency->update($data);

        return $agency;
    }

    public function delete(Agency $agency): void
    {
        $agency->delete();
    }

    public function uploadCertificate(Agency $agency, UploadedFile $file): void
    {
        if ($agency->hasTaxCertificate() && $this->disk()->exists($agency->getRawOriginal('tax_certificate'))) {
            $this->disk()->delete($agency->getRawOriginal('tax_certificate'));
        }

        $path = $file->store('agencies/certificates', 'public');

        $agency->update([
            'tax_certificate' => $path,
        ]);
    }

    public function uploadContract(Agency $agency, UploadedFile $file): void
    {
        if ($agency->hasContract() && $this->disk()->exists($agency->getRawOriginal('contract'))) {
            $this->disk()->delete($agency->getRawOriginal('contract'));
        }

        $path = $file->store('agencies/contracts', 'public');

        $agency->update([
            'contract' => $path,
        ]);
    }

    private function disk(): Filesystem
    {
        return Storage::disk($this->diskName);
    }
}
