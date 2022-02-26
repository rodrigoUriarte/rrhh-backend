<?php
namespace App\Services;

use App\Models\Empresa;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class EmpresaFilesService
{
    public function upload(UploadedFile $file): string
    {
        $remote_path = sprintf('%s', Empresa::BASE_PATH);
        $path = $file->storePublicly($remote_path);

        return $path;
    }

    public function delete(string $path): bool
    {
        return Storage::delete($path);
    }

    public function getSize(UploadedFile $file): float
    {
        return filesize($file->path()) / 1000;
    }
}
