<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FamilyHeadModel;
use App\Models\FamilyMember;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FamilyDataController extends Controller
{
    
    public function index(){

        $family_head = FamilyHeadModel::latest()->paginate(10);
        return view('/head/family_head',compact('family_head'));

    }

    public function get_state(Request $request){
       
        $stateArr = DB::table('states')->where('country_id',$request->countryId)->orderby('state')->get();
        $options = '';
        $options.="<option selected>Select State</option>";
        foreach ($stateArr as $key => $value) {
            $options.='<option value="'.$value->id_state.'" >'.$value->state.'</option>';
        }
        return $options;
    }

    public function get_cities(Request $request){
        
        $cityArr = DB::table('cities')->where('state_id',$request->stateId)->orderby('city')->get();
        $options = '';
        $options.="<option selected>Select City</option>";
        foreach ($cityArr as $key => $value) {
            $options.='<option value="'.$value->id_city.'" >'.$value->city.'</option>';
        }
        return $options;
    }

    public function add_head(){
       $data['cities']    = DB::table('cities')->orderby('city')->get();
       $data['state']     = DB::table('states')->orderby('state')->get();
       $data['countries'] = DB::table('countries')->orderby('country_name')->get();
       return view('/head/add_family_head',compact('data'));
    }

    public function store_head( Request $request){

        $validate = $request->validate(
            [
                'name'=>'required|max:255',
                'surname'=>'required|max:255',
                'mobile_no'=>'required|max:10|min:10',
                'address'=>'required|max:300',
                'pincode'=>'required|max:8',
                'birthdate' => 'required|date|before:'.now()->subYears(21)->toDateString(),
                'photo'=> 'required'
            ], [
                'birthdate.before' => trans('Age should be greater that 21 year'),
            ]
        );

        $head               = new FamilyHeadModel;
        $head->name         = $request->input('name');
        $head->surname      = $request->input('surname');
        $head->mobile_no    = $request->input('mobile_no');
        $head->address      = $request->input('address');
        $head->pincode      = $request->input('pincode');
        $head->birthdate    = $request->input('birthdate');
        $head->marital_status = $request->input('marital_status');
        $head->wedding_date   = $request->input('wedding_date');
        $head->hobbies      = $request->input('hobbies');
        $head->stateId      = $request->input('stateId');
        $head->cityId       = $request->input('cityId');
        $head->created_at   = Carbon::now();

        if($request->hasfile('photo'))
        {
            $file = $request->file('photo');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            if($file->move(base_path().'/uploads/heads/', $filename)){
                $head->photo = $filename;
            }else{
                $head->photo = "not save file";
            }

        }
        // echo base_path().'/uploads/heads/'.$filename;
        // dd($head);

        $head->save();

        return redirect()->back()->with('success','Family Head added');

        // "name" => "sc nmdcs"
        // "surname" => "scsc"
        // "birthdate" => "2024-04-09"
        // "mobile_no" => "32844487482"
        // "address" => "fnfjejfe"
        // "pincode" => "777777"
        // "stateId" => "1"
        // "cityId" => "1"
        // "wedding_date" => "2024-04-10"
        // "hobbies" => "1"


        // "photo" => Symfony\Component\HttpFoundation\File\UploadedFile {#34 ▼
        //     -test: false
        //     -originalName: "passport.jpg"
        //     -mimeType: "image/jpeg"
        //     -error: 0
        //     path: "C:\wamp64\tmp"
        //     filename: "phpB6A1.tmp"
        //     basename: "phpB6A1.tmp"
        //     pathname: "C:\wamp64\tmp\phpB6A1.tmp"
        //     extension: "tmp"
        //     realPath: "C:\wamp64\tmp\phpB6A1.tmp"


        //name,surname,
        // birthdate > 21 acceptable
        //mobile no
        //address
        //state - dropdown
        //city - dropdown
        //pincode
        //marital status radio - if married - wedding date
        //hobbies - add hobby button
        //photo

    }
    public function delete_head(Request $request){
            echo $request->input('head_id');
            exit;
            DB::table('FamilyHeadModel')->delete($id);
        // FamilyHeadModel::where('id', $id)->delete();
        // return redirect()->back()->with('success','Family Member deleted');
    }

    public function family_member(){
        $family_member =  FamilyMember::latest()->paginate(10);
        return view('/member/family_member',compact('family_member'));
    }

    public function add_member(){
        // $familyHead = FamilyHeadModel::all();
        $familyHead = DB::table('family_head_models')->orderby('id')->get();
        // echo "<pre>"; echo $familyHead;
        return view('/member/add_family_member',compact('familyHead'));
    }

    public function store_member( Request $request){
            // print_r($request);exit;
        $validate = $request->validate(
            [
                'name'=>'required|max:255',
                'surname'=>'required|max:255',
                'birthdate' => 'required|date',
                'photo'=> 'required',
                'education'=> 'required',
            ]
        );

        $member                 = new Familymember;
        $member->name           = $request->input('name');
        $member->family_head_id = $request->input('family_head_id');
        $member->surname        = $request->input('surname');
        $member->birthdate      = $request->input('birthdate');
        $member->marital_status = $request->input('marital_status');
        $member->wedding_date   = $request->input('wedding_date');
        $member->education      = $request->input('education');
        $member->created_at     = Carbon::now();

        if($request->hasfile('photo'))
        {
            $file = $request->file('photo');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            if($file->move(base_path().'/uploads/member/', $filename)){
                $member->photo = $filename;
            }else{
                $member->photo = "not save file";
            }

        }
        // echo base_path().'/uploads/member/'.$filename;
        // dd($member);
        $member->save();
        return redirect()->back()->with('success','Family Member added');

    }
   
}
