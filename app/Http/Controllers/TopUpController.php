<?php

namespace App\Http\Controllers;

use App\TopupPackage;
use App\TopupRechargeHistory;
use App\User;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopUpController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.topup.index');
    }

    public function addOperator(Request $request, $operator_name)
    {
        $request->session()->put('operator_name', $operator_name);

        return redirect()->route('topup.enterNumber');
    }

    public function enterMobileNumber()
    {
        // $roles = Topup::all();
        return view('frontend.topup.step1');
    }

    public function postMobileNumber(Request $request)
    {
        $request->validate([
            'mobile_number' => 'required|max:11|min:11',
        ],
        [
            'mobile_number.required' => 'Enter a mobile number',
            'mobile_number.max' => 'Mobile number must be 11 digit',
            'mobile_number.min' => 'Mobile number must be 11 digit',
        ]);

        if(session()->get('operator_name') == 'Grameenphone'){
            if(substr($request->get('mobile_number'), 0, 3) == '017'){
                $request->session()->put('mobile_number', $request->get('mobile_number'));
                
                // $role = new Topup();
                // $role->name = $request->get('mobile_number');
                // $role->save();

                return redirect()->route('topup.step2');
            }
            else{
                flash(translate('Enter a valid grameenphone number'))->error();
                return redirect()->back();
            }
        }
        else if(session()->get('operator_name') == 'Robi'){
            if(substr($request->get('mobile_number'), 0, 3) == '018'){
                $request->session()->put('mobile_number', $request->get('mobile_number'));
                return redirect()->route('topup.step2');
            }
            else{
                flash(translate('Enter a valid robi number'))->error();
                return redirect()->back();
            }
        }
        else if(session()->get('operator_name') == 'Airtel'){
            if(substr($request->get('mobile_number'), 0, 3) == '016'){
                $request->session()->put('mobile_number', $request->get('mobile_number'));
                return redirect()->route('topup.step2');
            }
            else{
                flash(translate('Enter a valid airtel number'))->error();
                return redirect()->back();
            }
        }
        else if(session()->get('operator_name') == 'Banglalink'){
            if(substr($request->get('mobile_number'), 0, 3) == '019'){
                $request->session()->put('mobile_number', $request->get('mobile_number'));
                return redirect()->route('topup.step2');
            }
            else{
                flash(translate('Enter a valid banglalink number'))->error();
                return redirect()->back();
            }
        }
        else if(session()->get('operator_name') == 'Teletalk'){
            if(substr($request->get('mobile_number'), 0, 3) == '015'){
                $request->session()->put('mobile_number', $request->get('mobile_number'));
                return redirect()->route('topup.step2');
            }
            else{
                flash(translate('Enter a valid teletalk number'))->error();
                return redirect()->back();
            }
        }
        else{
            return redirect()->route('topup.index');
        }
    }

    public function enterStep2()
    {
        $minutes = TopupPackage::where('package_type', 'Minute')->orderBy('created_at','DESC')->get();

        return view('frontend.topup.step2', compact('minutes'));
    }

    public function postStep2(Request $request)
    {
        $request->validate([
            'recharge_amount' => 'required|numeric|min:10',
        ]);

        

        if($request->get('recharge_amount') < Auth::user()->balance){
            $newwalletamount = Auth::user()->balance - $request->get('recharge_amount');

            $request->session()->put('recharge_amount', $request->get('recharge_amount'));
            $request->session()->put('new_balance', $newwalletamount);

            return redirect()->route('topup.step3');
        }
        else{
            flash(translate('Not enougn balance'))->error();
            return redirect()->back();
        }
    }

    public function enterStep3()
    {
        return view('frontend.topup.step3');
    }

    public function postStep3(Request $request)
    {
        $request->validate([
            'sim_type'=>'required',
            'tpin'=>'required',
        ],
        [
            'sim_type.required'=>'Please select type',
        ]);

        if($request->get('tpin') == Auth::user()->tpin){
            $request->session()->put('total_amount', $request->get('total_amount'));
            $request->session()->put('recharge_commission', $request->get('commission'));
            $request->session()->put('total_charge', $request->get('charge'));
            $request->session()->put('sim_type', $request->get('sim_type'));

            return redirect()->route('topup.step4');
        }
        else{
            flash(translate('Incorrect T-Pin'))->error();
            return redirect()->back();
        }
    }

    public function enterStep4()
    {
        return view('frontend.topup.step4');
    }

    public function postStep4(Request $request)
    {
        if(session()->get('operator_name') != '' && session()->get('recharge_amount') != '' && session()->get('mobile_number') != '' && session()->get('total_amount') != '' && session()->get('recharge_commission') != '' && session()->get('total_charge') != '' && session()->get('sim_type') != '' && session()->get('new_balance') != ''){
            
            //add history to topup database
            $recharge = new TopupRechargeHistory();

            $recharge->user_id = Auth::user()->id;
            $recharge->name = Auth::user()->name;
            $recharge->email = Auth::user()->email;
            $recharge->user_type = Auth::user()->user_type;

            $recharge->operator = session()->get('operator_name');
            $recharge->operator_type = session()->get('sim_type');
            $recharge->phone = session()->get('mobile_number');
            $recharge->amount = session()->get('recharge_amount');
            $recharge->charge = session()->get('total_charge');
            $recharge->w_balance = session()->get('new_balance');
            $recharge->commission = session()->get('recharge_commission');

            $recharge->save();

            $user = User::where('id', Auth::user()->id)->first();
            $user->balance = $user->balance - session()->get('total_amount');
            $user->save();

            $wallet = new Wallet();
            $wallet->user_id = Auth::user()->id;
            $wallet->amount = '-'.session()->get('total_amount');
            $wallet->payment_method = 'Recharge';
            $wallet->save();

            //Remove session values
            $request->session()->forget(['operator_name', 'recharge_amount', 'mobile_number', 'total_amount', 'recharge_commission', 'total_charge', 'sim_type', 'new_balance']);

            flash(translate('Success'))->success();
            session()->flash('recharge_success');
            return redirect()->route('topup.index');
        }
        else{
            flash(translate('Something went wrong'))->error();
            return redirect()->route('topup.index');
        }
        
        //return redirect()->route('topup.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
