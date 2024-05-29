<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;

use Image;
use File;

class TestController extends Controller
{
    public function test()
    {
        try {
            //code...
            $ftp = ftp_connect('203.151.27.229', '21');
            $login_result = ftp_login($ftp, 'spm', 'a0815209598');

            // ftp_close($ftp);
            dd($login_result);
        } catch (\Throwable $th) {
            //throw $th;
            dd($th->getMessage());
        }
    }

    public function connect()
    {
        $ftp = ftp_connect('203.151.27.229', '21');
        $login_result = ftp_login($ftp, 'spm', 'a0815209598');

        return $ftp;
    }

    public function del()
    {
        // Storage::disk('ftp')->delete('/Asset/PicAsset/ped.png');

    }

    public function upfiletest(Request $request)
    {

        // $file = $request->file('filenames');

        // $filename = "asset-" . uniqid() . "." . $file->extension();
        // $filenames = $file->storeAs('/Asset/PicAsset/', $filename, 'ftp'); // Asset/PicAsset

        // $image = $request->file('filenames');
        // $fileName = $image->getClientOriginalName();
        // $image_resize = Image::make($image->getRealPath());
        // $image_resize->resize(300, 300);
        // $image_resize->save(public_path('image/Thumbnails/' . $fileName));

        // $image_resize->destroy();

        // Storage::disk('ftp')->put('/Asset/PicAsset/', $request->file);

        // Storage::disk('custom-ftp')->put('path/to/distant-file.ext', $localFile);
    }

    public function resizeAndSaveToFTP(Request $request)
    {
        // Check if an image file was uploaded
        if ($request->hasFile('filenames')) {

            $uploadedImage = $request->file('filenames');

            // Resize the uploaded image
            $resizedImage = Image::make($uploadedImage)
                ->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                });

            // Get the resized image content
            $imageContent = $resizedImage->encode();

            // FTP server credentials
            $ftpCredentials = [
                'username' => 'spm',
                'password' => 'a0815209598',
                'server' => '203.151.27.229',
                'directory' => 'Asset/PicAsset',
                'filename' => 'resized_image.jpg',
            ];

            // Construct the FTP path
            // $ftpPath = "ftp://{$ftpCredentials['username']}:{$ftpCredentials['password']}@{$ftpCredentials['server']}{$ftpCredentials['directory']}{$ftpCredentials['filename']}";

            // Ensure the directory exists on the FTP server
            // Storage::disk('ftp')->makeDirectory($ftpCredentials['directory']);

            // Save the resized image to the FTP server
            Storage::disk('ftp')->put($ftpCredentials['filename'], $imageContent);

            return 'Image resized and saved to FTP successfully.';
        }
        return 'No image file uploaded.';
    }

    public function dumpAutoload()
    {
        Artisan::call('dump-autoload');
        return response()->json(['message' => 'Autoload files have been regenerated successfully.']);
    }
}
