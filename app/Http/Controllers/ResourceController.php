<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function resource($pathFile)
    {
        $path = dirname(getcwd());
        $filePath=$path.'/resources/'.$pathFile;
        return response()->file($filePath);
        // return response()->json(['path'=>$filePath]);
    }
    public function publics($pathFile)
    {
        $path = getcwd();
        $filePath=$path.'/build/'.$pathFile;
        return response()->file($filePath);
    }
    public function getPath()
    {
        $path = dirname(getcwd());
        $asset = asset('/');
        $abspath = realpath($path.'/resources/css/app.css');
        $exist = file_exists($path.'/resources/css/app.css');
        return response()->json(['path' => $path, "dir" => __DIR__, "asset" => $asset, "pathinfo" => pathinfo($path),
          'exsist' => $exist, 'abspath' => $abspath]);
    }


}
