<?php

namespace App\Http\Controllers;
require_once __DIR__ . '\autoload.php';

use Phpml\Classification\KNearestNeighbors;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;

class UserController extends Controller
{

    public function userprofile()
    {   
     $images = \File::allFiles(public_path('img/perfil'));
     return view('profile', ['images' => $images]);
    }

    public function setimgprofile(Request $request)
    {
        Auth::user()->profile_image = 'img/perfil/'.$request['the_path'];
        Auth::user()->save();

        echo \json_encode($request['the_path']);
    }

    public function showcharts()
    {
        return view('chart');
    }
    public function getdataforchart()
    {
        $array = array();

        $subArray = array();

        $linked_users = \App\User::where('vinculed', 1)->get();
        $subArray['Vinculados'] = $linked_users->count();

        $unlinked_users = \App\User::where('vinculed', 0)->get();
        $subArray['NoVinculados'] = $unlinked_users->count();

        $array['Usuarios'] = $subArray;

        $subArray = array();
        $modules_with_class = \App\Module::has('subjects')->get();

        $subArray['ConClase'] = $modules_with_class->count();
        $modules_with_no_class = \App\Module::doesnthave('subjects')->get();
        $subArray['SinClase'] = $modules_with_no_class->count();

        $array['modules'] = $subArray;

        echo json_encode($array);

    }

    public function kmeans()
    {
        
        $samples = [[1, 3], [1, 4], [2, 4], [3, 1], [4, 1], [4, 2]];
        $labels = ['a', 'a', 'a', 'b', 'b', 'b'];

        $classifier = new KNearestNeighbors();
        $classifier->train($samples, $labels);

        echo $classifier->predict([3, 2]);
        // return 'b'

        $directories = Storage::disk('local')->directories('mainfolder');
        var_dump();
    }
}
