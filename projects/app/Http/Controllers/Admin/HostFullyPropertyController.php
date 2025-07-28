<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HostFully\HostFullyProperty;
use Helper;
use App\Helper\Upload;
use Validator;
use LiveCart;
use Carbon\Carbon;

class HostFullyPropertyController extends Controller{
    
    public function __construct(HostFullyProperty $model){
        $this->model=$model;
        $this->admin_base_url="host_fully_properties.index";
        $this->admin_view="admin.host_fully_properties";
    }

    public function index(){
        $data=$this->model::where("isActive","1")->orderBy("id","desc")->get();
        return view($this->admin_view.".index",compact("data"));
    }

    public function create(){
        return redirect()->route($this->admin_base_url);
    }

    public function store(Request $request){
        return redirect()->route($this->admin_base_url);
    }

    public function show($id){
        return redirect()->route($this->admin_base_url);
    }
   
    public function edit($id){
        $data=$this->model::find($id);
        if($data){
            return view($this->admin_view.".edit",compact("data"));
        }
        return redirect()->route($this->admin_base_url)->with("danger","Invalid Calling");
    }
  
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), ['seo_url' => 'required|unique:host_fully_properties,seo_url,'.$id]);  
        if($validator->fails()){
            return redirect()->back()->withInput()->with("danger",$validator->errors()->first())->withErrors($validator->errors());
        }
        $exist=$this->model::find($id);
        if($exist){
            $data=$request->all();
             if ($request->hasFile("rental_aggrement_attachment")) {
                Helper::deleteFile($exist->rental_aggrement_attachment);
                $data['rental_aggrement_attachment'] = Upload::uploadWithLogoImageData($request->file("rental_aggrement_attachment"),"properties");
            }
            if($request->remove_rental_aggrement_attachment){
                $data['rental_aggrement_attachment'] ='';
                Helper::deleteFile($exist->rental_aggrement_attachment);
            }
            $this->model::find($id)->update($data);
            return redirect()->route($this->admin_base_url)->with("success","Successfully Updated");
        }
        return redirect()->back()->with("danger","Invalid Calling");
    }

    public function destroy($id){
        return redirect()->route($this->admin_base_url)->with("danger","Invalid Calling");
    }
}