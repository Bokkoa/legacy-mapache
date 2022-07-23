<?php

namespace App\Http\Controllers;

use Auth;
use Goutte\Client;
use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function subjects()
    {
        $subjects = Auth::user()->subjects;

        // foreach($subjects as $s)
        // {   
        //     // var_dump($s);
        //     // dd($s);
        //     echo $s->Name;
        //     echo "<hr>";
        // }
        // // $subjects = \App\Subject::all();
        return view('subjects', ['subjects' => $subjects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function scrapsiiau(Request $request)
    {

        $content = $request['siiaucode'].','.$request['siiaupass'].','.$request['siiautype'].','.Auth::user()->username;
        $path = "C:\Users\Sabal\Desktop\Mapache\Crawler\credenciales";
        $p_result = "C:\Users\Sabal\Desktop\Mapache\Crawler\\result";
        $file = fopen( $path , "w" );
        fwrite($file , $content);
        fclose($file);
        // shell_exec or exec
        $command = shell_exec("cd C:\Users\Sabal\Desktop\mapache\Crawler\\virtualcrawl\Scripts && Activate && cd .. && cd .. && scrapy crawl login");
        $result = fopen($p_result, 'r');
        $line = fgets($result);   
        echo $line;
            if ($line == "FAIL") {
                \Auth::user()->vinculed = 0;
                alert()->error('Hubo un error al vincular.','Oops!')->autoclose(3000);
                return redirect('subjects');            
            }
            else{
                \Auth::user()->vinculed = 1;
                alert()->success('Siiau Vinculado.','Yeah')->autoclose(3000);
                return redirect('subjects');            
            }
        
        fwrite($file, ' ');
        /// IMPLEMENTACION PARA DOM CRAWLER EN PHP
        // $client = new Client();
        // $crawler = $client->request('POST', 'http://siiauescolar.siiau.udg.mx/wus/gupprincipal.forma_inicio');
        
        // $form = $crawler->selectButton('Ingresar')->form();
        // $crawler = $client->submit($form, array('p_codigo_c' => '212558139', 'p_clave_c' => 'obzen420'));
      
        // $crawler = $client->request('POST', 'http://siiauescolar.siiau.udg.mx/wus/gupprincipal.FrameMenu');
        // // $crawler = $crawler->filter('frame > html')->first();
        // $html = $crawler->html();
        // dd($html);

        //$crawler = $client->click($crawler->selectLink('ALUMNOS')->link());

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        //
    }
}
