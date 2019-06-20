<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use App\CSV;
use Illuminate\Http\Request;
use Twilio;
use Twilio\Rest\Client;
use App\History;
use DB;

class CSVsController extends Controller
{


    function send_group_sms(Request $request)
    {
      $all_group = rtrim($request->input('groupString'),',');
      $group_string = rtrim($request->input('groupString'),',');
      $group_string = explode(",",$group_string);
      $message = $request->input('smsBody');
      $sendgroupby=$request->input('sendgroup_by');
      $users = CSV::whereIn('group', $group_string)->get();
      $to = array();

      foreach ($users as $user) {
          $to[] = '{"binding_type":"sms", "address":"'.$user->phone.'"}';
      }
      $history = new History();
      $history->send_by       = $sendgroupby;
      $history->sms_content   = $message;
      $history->send_to       = "Send to groups: ".$all_group;
      $history->save();

      $this->send_sms($to, $message);
      return response()->json(array('msg'=> 'Success'), 200);
    }


    public function send_all_sms(Request $request)
    {
        
        $message = $request->input('allsms');
        $sentAll=$request->input('sentAll');
        $sentBy=$request->input('sendBy');
        $users = CSV::all();
        $to = array();
        $history = new History();
        foreach ($users as $user) {
            $to[] = '{"binding_type":"sms", "address":"'.$user->phone.'"}';
        }
        $history->send_by       = $sentBy;
        $history->sms_content   = $message;
        $history->send_to       = 'Sent to all users.';
        $history->save();

        $this->send_sms($to, $message);
        return response()->json(array('msg'=> 'Success'), 200);
    }

    function send_individual_sms(Request $request)
    {
      $send_by = $request->input('send_by');
      $ids = rtrim($request->input('ids'),',');
      $ids = explode(",",$ids);
      $message = $request->input('smsBody');
      $users = CSV::whereIn('id', $ids)->get();
      $to = array();
      $user_names="";
      foreach ($users as $user) {
          $to[] = '{"binding_type":"sms", "address":"'.$user->phone.'"}';
          $user_names .= $user->fname.' '.$user->lname.',';
      }
      $user_names = rtrim($user_names, ',');
      $history = new History();
      $history->send_by       = $send_by;
      $history->sms_content   = $message;
      $history->send_to       = "Send to: ".$user_names;
      $history->save();
      $this->send_sms($to, $message);
      return response()->json(array('msg'=> 'Success'), 200);
    }

    private function send_sms($to, $message)
    {

        $sid    = env('TWILIO_ACCOUNT_SID');
        $token  = env('TWILIO_AUTH_TOKEN');
        $services_id = env('TWILIO_SERVICE_ID');
        $twilio = new Client($sid, $token);


        $notification = $twilio
            ->notify->services($services_id)
            ->notifications->create([
                "toBinding" => $to,
                "body" => $message
            ]);
        return true;
    }

    /**
     * Display CSV Upload Page
     *
     * @return \Illuminate\View\View
     */

    public function store(Request $data)
    {
        if ($data->hasFile('csv')) {
            $upload_by = $data->input('upload_by');
            $csv = $data->file('csv');
            $csv_data = [];
            $handle = fopen($csv->getPathName(), "r");
            while($data = fgetcsv($handle))//handling csv file
            {

                array_push($csv_data, array('group'=>$data[0], 'fname'=>$data[1], 'lname'=>$data[2], 'phone' => '+1'.preg_replace('/[^0-9]/', '', $data[3]), 'email' =>$data[4], 'created_at'=>date("Y-m-d H:i:s"), 'updated_at'=>date("Y-m-d H:i:s"), 'upload_by'=> $upload_by));
            }
            fclose($handle);
            CSV::insert($csv_data);
            Session::flash('success', 'CSV Uploaded Successfully.');
            return redirect()->back();
        }
    }

    public function csv_group_list()
    {
        $csvs = CSV::select('group')->get();
        $csv_array = [];
        foreach( $csvs as $csv){
                array_push($csv_array, $csv->group);
        }
        $csv_array = array_unique($csv_array);
//        dd($csv_array);
        return view('csv.group_list', compact('csv_array'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $csvs = CSV::where('group', 'LIKE', "%$keyword%")
                ->orWhere('fname', 'LIKE', "%$keyword%")
                ->orWhere('lname', 'LIKE', "%$keyword%")
                ->orWhere('phone', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $csvs = CSV::latest()->paginate($perPage);
        }

        return view('csv.index', compact('csvs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('csv.create');
    }



    public function manualUploadView()
    {
        return view('csv.manual');
    }

    public function manualUpload(Request $request)
    {
        $phone=preg_replace('/[^0-9]/', '', $request->phone);
        $phone = '+1'.$phone;
        CSV::create([
            'group' => $request->group,
            'fname' => $request->fname,
            'lname' => $request->lname,
            'phone' => $phone,
            'email' => $request->email,
            'upload_by' => $request->upload_by,
        ]);
        Session::flash('success', 'Successfully added.');
        return redirect('/manual');
    }

    public function GroupDataView($group)
    {
        $usData=CSV::where('group',$group)->get();
        return view('csv.groupViewData',compact('usData'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $csv = CSV::findOrFail($id);

        return view('csv.show', compact('csv'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $csv = CSV::findOrFail($id);

        return view('csv.edit', compact('csv'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

        $requestData = $request->all();

        $csv = CSV::findOrFail($id);
        $csv->update($requestData);

        return redirect(url('csv'))->with('flash_message', 'CSV updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */

    public function truncateCsvsTable()
    {
        DB::table('c_s_vs')->truncate();
        Session::flash('success', 'Data successfully cleared.');
        return redirect('group_list');
    }





    public function deleteGroup($group)
    {
        
        $csv=CSV::where('group',$group)->delete();
        Session::flash('success', 'Successfully Delete Group.');
        return redirect('group_list');
        
    }


    public function destroy($id)
    {
        CSV::destroy($id);

        Session::flash('success', 'Successfully Deleted.');

        return redirect(url('csv'))->with('flash_message', 'CSV deleted!');
    }
}
