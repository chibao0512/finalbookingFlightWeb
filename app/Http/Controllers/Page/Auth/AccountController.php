<?php

namespace App\Http\Controllers\Page\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Flight;
use App\Models\Ticket;
use App\Http\Requests\UpdateInfoAccountRequest;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    //
    public function infoAccount()
    {
        $user = Auth::guard('user')->user();
        return view('page.auth.account', compact('user'));
    }

    public function updateInfoAccount(UpdateInfoAccountRequest $request)
    {
        DB::beginTransaction();
        try {
            $user =  User::find(Auth::guard('user')->user()->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->gender = $request->gender;
            $user->birthday = $request->birthday;
            $user->address = $request->address;
            $user->save();
            DB::commit();
            return redirect()->back()->with('success', 'Update successfull.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred and the account could not be updated');
        }
    }

    public function changePassword()
    {
        return view('page.auth.change_password');
    }

    public function postChangePassword(ChangePasswordRequest $request)
    {
        DB::beginTransaction();
        try {
            $user =  User::find(Auth::guard('users')->user()->id);
            $user->password = bcrypt($request->password);
            $user->save();
            DB::commit();
            Auth::guard('users')->logout();
            return redirect()->route('page.user.account')->with('success', 'Password changed successfully.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'An error occurred and the password cannot be changed');
        }
    }

    public function transactionUser(Request $request)
    {
        $user = Auth::guard('user')->user();
        $types = Flight::TYPES;
        $ticket_class = Flight::TICKET_CLASS;
        $status = Transaction::STATUS;

        $transactions = Transaction::with(['flight' => function ($query) {
            $query->with('plane');
        }, 'start_location', 'end_location', 'tickets']);

        if ($request->code_no) {
            $transactions->where('code_no', $request->code_no);
        }

        $transactions = $transactions->where('user_id', $user->id)->orderByDesc('id')->paginate(NUMBER_PAGINATION);
        return view('page.auth.transaction', compact('transactions', 'types', 'ticket_class', 'status'));
    }

    public function cancelOrder($id)
    {
        DB::beginTransaction();
        try {


            DB::commit();
            return redirect()->back();
        } catch (\Exception $exception) {
            return redirect()->back();
        }
    }

    public function showTicket($id)
    {
        $tickets = Ticket::with('transport')->where('transaction_id', $id)->get();
        $html = view("page.auth.ticket", compact('tickets'))->render();

        return response([
            'code' => 200,
            'html' => $html,
        ]);

    }
}
