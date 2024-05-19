<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Flight;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;


class TransactionController extends Controller
{
    //
    //
    protected $transaction;
    /**
     * constructor.
     */
    public function __construct(Transaction $transaction)
    {
        view()->share([
            'transaction_active' => 'active',
            'status' => Transaction::STATUS,
            'classStatus' => Transaction::CLASS_STATUS,
        ]);
        $this->transaction = $transaction;
    }

    public function index(Request $request)
    {
        $types = Flight::TYPES;
        $ticket_class = Flight::TICKET_CLASS;

        $transactions = Transaction::with(['flight' => function ($query) {
            $query->with('plane');
        }, 'start_location', 'end_location', 'tickets', 'payment']);

        if ($request->code_no) {
            $transactions->where('code_no', $request->code_no);
        }

        if ($request->start_day) {
            $start_day = Carbon::parse($request->start_day)->startOfDay();
            $transactions->where('created_at', '>=', $start_day);
        }

        if ($request->end_day) {
            $end_day = Carbon::parse($request->end_day)->endOfDay();
            $transactions->where('created_at', '<=', $end_day);
        }

        if ($request->status) {
            $status = $request->status;
            $transactions->where('status', $status);
        }
        $transactions = $transactions->orderByDesc('id')->paginate(NUMBER_PAGINATION);

        $viewData = [
            'transactions' => $transactions,
            'types' => $types,
            'ticket_class' => $ticket_class,
        ];

        return view('admin.transaction.index', $viewData);
    }

    public function updateStatus(Request $request, $status, $id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        DB::beginTransaction();
        try {
            $transaction->status = $status;
            $transaction->save();
            DB::commit();
            return redirect()->back()->with('success', 'Save Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
        }
    }

    public function delete(Request $request, $id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        DB::beginTransaction();
        try {
            $transaction->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Save Successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
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
