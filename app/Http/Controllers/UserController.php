<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fileName = '_datafile.txt';
        $destinationPath=public_path()."/upload/";
        $fileUrl = $destinationPath. $fileName;
        $content = json_decode(File::get($fileUrl));
        return json_decode(json_encode($content), true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->except(['_token']);
        $fileName = '_datafile.txt';
        $destinationPath=public_path()."/upload/";
        $fileUrl = $destinationPath. $fileName;
        $content = json_decode(File::get($fileUrl));
        if ($content) {
            $array = json_decode(json_encode($content), true);
            $inputs['user_id'] = count($array) + 1;
            array_push($array,$inputs);
        }
        else {
            $inputs['user_id'] = 1;
            $array[] = $inputs;
        }

        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($fileUrl, json_encode($array));
        return ['user_id' => count($array)];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $inputs = $request->all();
        $fileName = '_datafile.txt';
        $destinationPath=public_path()."/upload/";
        $fileUrl = $destinationPath. $fileName;
        $content = json_decode(File::get($fileUrl));
        if ($content) {
            $array = json_decode(json_encode($content), true);
            $array[$id - 1][array_key_first($inputs)] = $inputs[array_key_first($inputs)];
        }

        if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  }
        File::put($fileUrl, json_encode($array));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
