<?php

namespace App\Repositories;

use App\Enums\CampaignStatus;
use App\Enums\CollectionType;
use App\Jobs\UpdateCampaignStatusJob;
use App\Models\Campaign;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CompanyRepository
{
    public static function update(Company $company, array $data): Company
    {
        return DB::transaction(function () use ($company, $data) {
            if($data['logo'] && $data['logo'] instanceof TemporaryUploadedFile){
                /** @var \Illuminate\Filesystem\FilesystemAdapter $s3 */
                $s3 = Storage::disk('s3');
                $path = $s3->putFileAs(
                    env('AWS_COMPANY_LOGO_PATH'),
                    $data['logo'],
                    uniqid() . '.' . $data['logo']->getClientOriginalExtension()
                );
            }

            $company->update([
                'logo' => $data['logo'] && $data['logo'] instanceof TemporaryUploadedFile ? $path : $company->logo,
                'name' => $data['registerName'],
                'email' => $data['email'],
                'cnpj' => $data['cnpj'],
            ]);

            return $company;
        });
    }
}
