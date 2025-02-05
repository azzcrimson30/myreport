<?php

namespace App\Http\Controllers;
use App\Models\Company;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::latest()->paginate(5);
        return view('companies.index',compact('companies'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('companies.create');
    }

    public function uniqueChecker($request){
        $err = [];
        $checkName =  Company::where('name',$request->name)->first();
        $checkEmail =  Company::where('email',$request->email)->first();
        if($request->logo){
            $checkLogo =  Company::where('logo',$request->logo->getClientOriginalName())->first();
        }else{
            $checkLogo = false;
        }
        $checkLink =  Company::where('website_link',$request->website_link)->first();

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

    public function updateUniqueChecker($request, $company){
        $err = [];
        $checkName =  Company::where('name',$request->name)->where('id','!=',$company->id)->first();
        $checkEmail =  Company::where('email',$request->email)->where('id','!=',$company->id)->first();
        if($request->logo){
            $checkLogo =  Company::where('logo',$request->logo->getClientOriginalName())->where('id','!=',$company->id)->first();
        }else{
            $checkLogo = false;
        }
        $checkLink =  Company::where('website_link',$request->website_link)->where('id','!=',$company->id)->first();

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
            'email' => 'required',
            'logo' => 'required|dimensions:min_width=100,min_height=100|mimes:jpg,bmp,png,jpeg',
            'website_link' => 'required',
        ], [
            'logo.dimensions' => 'The logo must be at least 100 pixels in width and height.',
            'logo.mimes' => 'The logo must be at format as jpg,bmp,png or jpeg only.',
        ]);

        $err = $this->uniqueChecker($request);

        if(count($err) == 0){
            try{
                $company = new Company();
                $company->name = $request->name;
                $company->email = $request->email;
                $company->website_link = $request->website_link;
                $filename = $request->logo->getClientOriginalName();

                $uploadedFile = $request->logo;
                $company->logo = $filename;
                $company->save();

                if($request->logo){
                    $uploadedFile->storeAs('', $filename, 'public');
                }

                $alert = 'success';
                $message = 'Company created successfully.';

            }catch(Exception $e){
                $alert = 'danger';
                $message = $e->getMessage();
            }

            return redirect()->route('companies.index')->with($alert, $message);

        }else{
            $alert = 'warning';
            $str = $err[0];
            for($i = 1;$i < count($err);$i++){
                $str .= ', '.$err[$i];
            }
            $message = 'Company '.$str.' already existed!';

            return redirect()->route('companies.create')->with($alert, $message);
        }
    }

    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    public function edit(Company $company)
    {
        return view('companies.edit',compact('company'));
    }

    public function update(Request $request, Company $company)
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

        $err = $this->updateUniqueChecker($request, $company);

        if(count($err) == 0){
            try{
                $company->name = $request->name;
                $company->email = $request->email;
                $company->website_link = $request->website_link;

                if($request->logo){
                    if ($company->logo) {
                        Storage::disk('public')->delete($company->logo);
                    }
                    $filename = $request->logo->getClientOriginalName();
                    $uploadedFile = $request->logo;
                    $company->logo = $filename;
                    $uploadedFile->storeAs('', $filename, 'public');
                }

                $company->save();
                $alert = 'success';
                $message = 'Company created successfully.';

            }catch(Exception $e){
                $alert = 'danger';
                $message = $e->getMessage();
            }

            return redirect()->route('companies.index')->with('success','Company updated successfully');

        }else{
            $alert = 'warning';
            $str = $err[0];
            for($i = 1;$i < count($err);$i++){
                $str .= ', '.$err[$i];
            }
            $message = 'Info of '.$str.' has already used by other company!';

            return redirect()->back()->with($alert, $message);
        }

        $company->update($request->all());
    }

    public function destroy(Company $company)
    {
        if ($company->logo) {
            Storage::disk('public')->delete($company->logo);
        }
        $company->delete();
        return redirect()->route('companies.index')->with('success','Company deleted successfully');
    }

}
