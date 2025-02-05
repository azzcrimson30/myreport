<?php

namespace App\Http\Controllers;
use App\Models\Report;
use App\Models\ReportFormat;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

Class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::latest()->paginate(5);
        return view('reports.index',compact('reports'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $users = User::all();
        $formats = ReportFormat::all();
        return view('reports.create',compact('users','formats'));
    }

    public function uniqueChecker($request){
        $err = [];
        $checkName =  Report::where('name',$request->name)->first();

        if($checkName){
            $err[] = 'name';
        }

        return $err;
    }

    public function updateUniqueChecker($request, $report){
        $err = [];
        $checkName =  Report::where('name',$request->name)->where('id','!=',$report->id)->first();
        $checkEmail =  Report::where('email',$request->email)->where('id','!=',$report->id)->first();
        if($request->logo){
            $checkLogo =  Report::where('logo',$request->logo->getClientOriginalName())->where('id','!=',$report->id)->first();
        }else{
            $checkLogo = false;
        }
        $checkLink =  Report::where('website_link',$request->website_link)->where('id','!=',$report->id)->first();

        if($checkName){
            $err[] = 'name';
        }
        if($checkEmail){
            $err[] = 'email';
        }
        if($checkLogo){
            $err[] = 'logo';
        }
        if($checkLink){
            $err[] = 'link';
        }

        return $err;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'format' => 'required',
            'owner' => 'required',
        ]);

        $err = $this->uniqueChecker($request);

        if(count($err) == 0){
            try{
                $report = new Report();
                $report->name = $request->name;
                $report->user_id = $request->owner;
                $report->format = $request->format;
                $report->location = 'reports/'.$request->owner.'/'.$request->name;
                $report->save();

                $alert = 'success';
                $message = 'Report created successfully.';

            }catch(Exception $e){
                $alert = 'danger';
                $message = $e->getMessage();
            }

            return redirect()->route('reports.index')->with($alert, $message);

        }else{
            $alert = 'warning';
            $str = $err[0];
            for($i = 1;$i < count($err);$i++){
                $str .= ', '.$err[$i];
            }
            $message = 'Report '.$str.' already existed!';

            return redirect()->route('reports.create')->with($alert, $message);
        }
    }

    public function show(Report $report)
    {
        return view('reports.show', compact('report'));
    }

    public function edit(Report $report)
    {
        return view('reports.edit',compact('report'));
    }

    public function update(Request $request, Report $report)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'website_link' => 'required',
        ]);

        if($request->logo){
            $request->validate([
                'logo' => 'dimensions:min_width=100,min_height=100|mimes:jpg,bmp,png,jpeg',
            ],[
                'logo.dimensions' => 'The logo must be at least 100 pixels in width and height.',
                'logo.mimes' => 'The logo must be at format as jpg,bmp,png or jpeg only.',
            ]);
        }

        $err = $this->updateUniqueChecker($request, $report);

        if(count($err) == 0){
            try{
                $report->name = $request->name;
                $report->email = $request->email;
                $report->website_link = $request->website_link;

                if($request->logo){
                    if ($report->logo) {
                        Storage::disk('public')->delete($report->logo);
                    }
                    $filename = $request->logo->getClientOriginalName();
                    $uploadedFile = $request->logo;
                    $report->logo = $filename;
                    $uploadedFile->storeAs('', $filename, 'public');
                }

                $report->save();
                $alert = 'success';
                $message = 'Report created successfully.';

            }catch(Exception $e){
                $alert = 'danger';
                $message = $e->getMessage();
            }

            return redirect()->route('reports.index')->with('success','Report updated successfully');

        }else{
            $alert = 'warning';
            $str = $err[0];
            for($i = 1;$i < count($err);$i++){
                $str .= ', '.$err[$i];
            }
            $message = 'Info of '.$str.' has already used by other report!';

            return redirect()->back()->with($alert, $message);
        }

        $report->update($request->all());
    }

    public function destroy(Report $report)
    {
        if ($report->logo) {
            Storage::disk('public')->delete($report->logo);
        }
        $report->delete();
        return redirect()->route('reports.index')->with('success','Report deleted successfully');
    }

}
