<?php

namespace App\Http\Controllers;

use ZipArchive;
use App\Models\file;
use App\Mail\FileMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\fileRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\File as SystemFile;
use App\Models\upload;


class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(fileRequest $request)
    {


       return DB::transaction(function () use($request) {
           

        $check=($request->filled('senderEmail') && $request->filled('receiverEmail'));
        if ($request->hasFile('files')) {
            $data=['unique_name'=> Str::random(20)];

            if($check ){
                $data = array_merge(  $data, [
                    'mail_from'=>$request->get('senderEmail'),
                    'mail_to'=>$request->get('receiverEmail')
                ]);
    
            }

            $fileModel = File::create($data);
            $files = $request->file('files');

            if($check){

                Mail::to($request->get('receiverEmail'))
                ->send(new FileMail(route('download',$fileModel->unique_name),$request->get('senderEmail')));
            }

            foreach ($files as $file) {
                $path =  $file->store(
                    'files', 'public'
                );
                $fileModel->uploads()->create(['path' => $path,'name'=> $file->getClientOriginalName()]);
            }

            return redirect()->back()->with('success', 'File has been Uploaded!, Share this link '.route('download',$fileModel->unique_name));


        }
       
       
        });

     
    }

    public function downloadZip($fileId=null)
    {   
        if($fileId){
            $file = File::where('unique_name',$fileId)->first();

        }
        else if(request()->filled('link')){

            $link=request()->link;
            $file_id= substr($link,strrpos($link,"/")+1);
            $file = File::where('unique_name',$file_id)->first();



        }
        else
        $file=null;

        

        if($file){
        $uploads = $file->uploads;

        $zip = new ZipArchive();
        $zipFileName = 'files_' . time() . '.zip';
        $zipFilePath = storage_path($zipFileName);
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            foreach ($uploads as $upload) {
                $uploadFilePath = public_path('storage/'. $upload->path);

                if (file_exists($uploadFilePath)) {

                    $zip->addFile($uploadFilePath, $upload->name);

                }
            }

            $zip->close();
        }
        return response()->download($zipFilePath)->deleteFileAfterSend();
        }
        return redirect()->back()->with('error', "File doesn't exist");
    }
   

    public function preview($fileId =null){
        if($fileId){
            $file = File::where('unique_name',$fileId)->first();

        }
        else if(request()->filled('link')){

            $link=request()->link;
            $file_id= substr($link,strrpos($link,"/")+1);
            $file = File::where('unique_name',$file_id)->first();



        }
        else
        $file=null;


        if($file){

            $uploads=$file->uploads;
            return view('index',['uploads'=>$uploads]);
        }
        return redirect()->back()->with('error', "File doesn't exist");

    }

    public function download(Upload $file){
        if($file){ 
             $path = public_path('storage/'. $file->path);

            return response()->download($path);
        
        }
        return redirect()->back()->with('error', "File doesn't exist");

      



    }
   

}
