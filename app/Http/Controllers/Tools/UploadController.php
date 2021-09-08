<?php

namespace App\Http\Controllers\Tools;
use App\Http\Controllers\Controller;
use App\Http\Requests\FileUploadRequest;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Str;
use Intervention\Image\ImageManagerStatic as Image;
use Auth;

class UploadController extends Controller
{
    public function postUpload(FileUploadRequest $request)
    {
            $file = $request->file('file');
            $uploadedImages = [];
//            var_dump($files);die;
//            if(!is_array($files)){
//                $files = [$files];
//            }
//            foreach($files as $file){
                $destionationSubfolder = null;
                $destinationPath = '/images/'; // upload path
                if($request->has('destination_path')){
                    $destionationSubfolder = $request->destination_path;
                    $destinationPath .= $destionationSubfolder . '/';
                }
                $thumbPath = $destinationPath.'thumbs/';
                $placeholderPath = $destinationPath.'placeholders/';

                $ext_num = 0 - (strlen($file->getClientOriginalExtension()) + 1);
                $clean_filename = mb_substr($file->getClientOriginalName(), 0, $ext_num);
                $slug_filename = Str::slug($clean_filename, '_');
                $filename = $slug_filename
                    . '_'
                    . Str::random(3);

                $thumbName = $filename . '.jpg';
                $filename  .= '.jpg';

                $filePath = public_path().$destinationPath. $filename;

                $uploaded_image = $file->move(public_path().$destinationPath, $filename);
                $contentType = mime_content_type($filePath);


                if($destionationSubfolder == 'avatars'){
                    $user = Auth::user();
                    $user->avatar = $destinationPath . $filename;
                    $user->save();
                    Image::make($filePath)->fit(400)->save($filePath, 79);
                } else {
                    $img = Image::make($filePath);
                    $img->orientate();
                    $img->resize(900, null, function ($constraint) {
                        $constraint->aspectRatio();
                       /*  $constraint->upsize(); */
                    })->encode('jpg')->save($filePath, 95);
                  
                    $img = $img->fit(650)->encode('jpg')->save(public_path().$thumbPath.$thumbName);
                    $img->save(public_path().$placeholderPath.$thumbName, 1);

                }
                if ($uploaded_image) {
                    $data = [
                        'path' => $destinationPath. $filename,
                        'placeholder' => $placeholderPath.$thumbName,
                        'thumb_path' => $thumbPath.$thumbName,
                        'originalName' => $slug_filename . '.' . $file->getClientOriginalExtension(),
                        'mime' => $contentType,

                    ];
                    $uploadedImages[] = $data;
                }
//            }

            return response()->json(count($uploadedImages) ? ['images' => $uploadedImages]: 'error', count($uploadedImages) ? 200 : 400);
    }

    public function deleteUpload(Request $request)
    {
        $data['path'] = $request->input('path');
        Storage::delete($data['path']);

        return response()->json($data);
    }

    public function getUpload($folder, $filename)
    {
        $storagePath = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
        $pathToFile = $storagePath . $folder . '/' . $filename;

        if (Storage::disk('local')->exists($folder . "/" . $filename))
            return response()->file($pathToFile);

        return response()->file(public_path()."/img/product.jpg");
    }

    public function encodeImages(){
        $posts = Post::where('is_public', true)->take(5)->orderBy('created_at', 'desc')->get();
        foreach($posts as $obj){
            $images = [];
            $hasPng = false;
            foreach($obj->image as $image){

                $filePath = $image['path'];
                $thumbPath = $image['thumb_path'];



                $pathInfo =  pathinfo( public_path(). $filePath);
                if($pathInfo['extension'] == 'PNG' || $pathInfo['extension'] == 'png'){
                    $hasPng = true;
                    $fileName = str_replace($pathInfo['extension'], 'jpg', $filePath);
                    $thumbName = str_replace($pathInfo['extension'], 'jpg', $thumbPath);
                    Image::make( public_path(). $filePath)->encode('jpg')->save( public_path().$fileName);
                    Image::make( public_path(). $thumbPath)->encode('jpg')->save( public_path().$thumbName);
                    $image['path'] = $fileName;
                    $image['thumb_path'] = $thumbName;
//                    var_dump($pathInfo['extension']);
//
//
//                    dd($filePath);
                }
                $images[] = $image;



            }

//            dd($images);
            if($hasPng){
                $obj->image = $images;
                $obj->save();
            }


        }
    }
}