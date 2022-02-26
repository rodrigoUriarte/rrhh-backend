<?php
namespace App\Services;

use App\Models\Empleado;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class EmpleadoFilesService
{
    public function upload(UploadedFile $file): string
    {
        $remote_path = sprintf('%s', Empleado::BASE_PATH);
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
