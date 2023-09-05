<?php

namespace Omarabdulwahhab\Laramessenger\Helpers;

use Illuminate\Support\Facades\Storage;

class FileUpload
{

    public static function Upload($File)
    {
        try {
            if (!empty($File)) {
                $FileName = time() . $File->getClientOriginalName();
                $Done = Storage::disk("public")->putFileAs(
                    'chat/', $File, $FileName, "public"
                );
                if ($Done) {
                    return $FileName;
                }
                return false;
            } else {
                return false;
            }
        }catch (\Exception $exception){
            return response()->json([
                "status" => $exception->getCode(),
                "message"   => $exception->getMessage(),
            ]);
        }
    }
}
