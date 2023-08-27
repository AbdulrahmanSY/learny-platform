<?php

namespace App\Services;

use App\Models\Appointment;
use App\Traits\ApiResponderTrait;

class FileService
{
    use ApiResponderTrait;
    public function fileStore(Appointment $appointment, $files = null)
    {
        try {
            if ($files) {
                foreach ($files as $file) {
                    if ($file !== null) {
                        $file_url = handleFile($file, 'session_file/');
                        $appointment->files()->create([
                            'file' => $file_url,
                        ]);
                    }
                }
            }
        }catch(\Exception $exception){
            return $this->error(errors: $exception->getMessage());
        }
    }

}
