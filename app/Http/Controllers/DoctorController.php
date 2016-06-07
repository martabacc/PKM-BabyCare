<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use App\Http\Requests;

class DoctorController extends Controller
{
    protected function answerValidator(array $data)
    {
        return Validator::make($data, [
            'answer' => 'required|min:10'
        ]);
    }

    private $modelView = 'pages.doctor.';

    public function index(Request $request){
        if($request->isMethod('get')){
            $data['items'] = Question::all();
            $data['content_title'] = 'Daftar Pertanyaan';
            $data['items'] = Question::simplePaginate(15);
            return view($this->modelView.'question', $data);
        }

    }

    public function landing(){

    }

    public function answer($id, Request $request){
        if($request->isMethod('get')){
            $data['item'] = Question::find($id);
            return view($this->modelView.'answer', $data);
        }
        elseif($request->isMethod('post')){
            $data = $request->all();
            $data['user_id'] = Auth::user()->id;

            if(Answer::create($data)){
                return redirect('/');
            }
            else redirect()->back();


        }
    }
}
