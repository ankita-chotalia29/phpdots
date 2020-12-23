<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Session;
use \App\ClassList;
use \App\College;
use \App\Level;
use PDF;

class ClassController extends Controller {


	public function index(Request $request) {

		$class = ClassList::select('class.*','colleges.college_name')->join('colleges','colleges.id','class.college_id')->get();
		return view('classList' ,compact('class'));
	}

	public function create(Request $request, $id = '') {

		$colleges =College::all(); 
		$latest_id = College::max('id');
		if(!empty($id))
		{	
			$class = ClassList::where('id',$id)->first();
			return view('addClass',compact('colleges','class','latest_id'));

		}else{


			return view('addClass', compact('colleges','latest_id'));
		}


	}

	public function store(Request $request) {
		try
		{
			//echo "<pre>";print_r($_FILES);exit;
			$validator = app('validator')->make($request->all(), [
				'college_id' => 'required|max:100',
				'title' => 'required',
				'email' => 'required|unique:class,email|regex:/(.+)@(.+)\.(.+)/i',
				'contact_no' => 'required',
				'price' => 'required',
				'description' => 'required',
				'syllabus' => 'required|mimes:pdf,docx|max:8192',
			], []);

			if ($validator->fails()) {
				$flashArr = array(
					'msg' => $validator->errors()->first(),
				);
				return redirect()->route('home')->withInput()->with('error', $validator->errors()->first());
			}
			$inserted_data = array(
				'college_id' => $request->input('college_id'),
				'title' => $request->input('title'),
				'email' => $request->input('email'),
				'contact_no' => $request->input('contact_no'),
				'price' => $request->input('price'),
				'description' => $request->input('description'),
				'created_at' => date("Y-m-d H:i:s"),
			);


			$image = $request->file('syllabus');
            if(!empty($image))
            {   
                $dirpath = public_path('img/class/');
                $syllabus = preg_replace('/ /','-',$image->getClientOriginalName());
            
                if(!is_dir($dirpath)){
                    mkdir($dirpath, 0777, true);
                }
                $request->file('syllabus')->move($dirpath, $syllabus);

                $inserted_data['syllabus'] = $syllabus;
            }

            $data = ClassList::create($inserted_data);

            $levels = $request->input('levels');
			if (!empty($levels)) {
				foreach ($levels as $key => $value) {

					if ($value != "") {
						$LevelArray = array(
							'class_id' => $data->id,
							'level' => $value,
						);
						Level::create($LevelArray);
					}

				}
			}

		
			
			if ($data) {

				$request->session()->flash('sucess','Class added successfully.');
			}

			return redirect()->route('home');

		} catch (\Exception $e) {

			$request->session()->flash('error', $e->getMessage());
			return redirect()->route('home');
		}
	}

	public function update(Request $request,$id) {
		try
		{
			//echo "<pre>";print_r($_FILES);exit;
			$validator = app('validator')->make($request->all(), [
				'college_id' => 'required|max:100',
				'title' => 'required',
				'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:class,email,'.$id,
				'contact_no' => 'required',
				'price' => 'required',
				'description' => 'required',
				'syllabus' => 'mimes:pdf,docx|max:8192',
			], []);

			if ($validator->fails()) {
				$flashArr = array(
					'msg' => $validator->errors()->first(),
				);
				return redirect()->route('home')->withInput()->with('error', $validator->errors()->first());
			}
			$inserted_data = array(
				'college_id' => $request->input('college_id'),
				'title' => $request->input('title'),
				'email' => $request->input('email'),
				'contact_no' => $request->input('contact_no'),
				'price' => $request->input('price'),
				'description' => $request->input('description'),
				'created_at' => date("Y-m-d H:i:s"),
			);


			$image = $request->file('syllabus');
            if(!empty($image))
            {   
                $dirpath = public_path('img/class/');
                $syllabus = preg_replace('/ /','-',$image->getClientOriginalName());
            
                if(!is_dir($dirpath)){
                    mkdir($dirpath, 0777, true);
                }
                $request->file('syllabus')->move($dirpath, $syllabus);

                $inserted_data['syllabus'] = $syllabus;
            }

            $data = ClassList::where('id',$id)->update($inserted_data);

            Level::where('class_id', $id)->delete();
            $levels = $request->input('levels');
			foreach ($levels as $key => $value) {

				if ($value != "") {
					$LevelArray = array(
						'class_id' => $request->id,
						'level' => $value,
					);
					Level::create($LevelArray);
				}

			}
		
			
			if ($data) {

				$request->session()->flash('success','Class updated successfully.');
			}

			return redirect()->route('home');

		} catch (\Exception $e) {

			$request->session()->flash('error', $e->getMessage());
			return redirect()->route('home');
		}
	}
	
	public function destroy(ClassList $class,$id)
    {
        $class::where('id',$id)->delete();
  
        return redirect()->route('home')
                        ->with('success','Class deleted successfully');
    }

    public function download(Request $request,$id)
    {
    	try
		{
			$class['data'] = ClassList::select('class.*','colleges.college_name')->join('colleges','colleges.id','class.college_id')->where('class.id', $id)->get();
			$pdf = PDF::loadView('Viewpdf', $class);

			return $pdf->download('class_details_'.$id.'.pdf');

		} catch (\Exception $e) {

			$request->session()->flash('error', $e->getMessage());
			return redirect()->route('home');
		}
    }

}
