<?php

namespace App\Http\Controllers\Page;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Payment;
use Carbon\Carbon;
use App\Models\Transport;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TransportRequest;
use App\Http\Requests\BookTicketRequest;
use App\Http\Requests\PaymentRequest;
use Illuminate\Support\Facades\Log;

class FlightController extends Controller
{
    // tìm kiếm danh sách chuyến bay phù hợp
    public function search(Request $request)
    {

        $flights = Flight::with(['start_location', 'end_location', 'plane' => function($query) {
            $query->with('airline_company');
        }]);

        if ($request->start_location) {
            $flights->where('start_location_id', $request->start_location);
        }

        if ($request->end_location) {
            $flights->where('end_location_id', $request->end_location);
        }

        if ($request->start_date) {
            $start_date = Carbon::parse($request->start_date)->startOfDay();
            $flights->where('start_day', '>=', $start_date);

        } else {
            $timeNow = Carbon::now()->addHour(2);
            $flights->where('start_day', '>=', $timeNow);
        }

        if ($request->end_date) {
            $end_date = Carbon::parse($request->end_date)->endOfDay();
            $flights->where('end_day', '<=', $end_date);
        }
        if ($request->airlines) {
            $airlines = $request->airlines;

            $flights->whereIn('plane_id', function ($query) use($airlines) {
                $query->select('id')->from('planes')->whereIn('airline_company_id', $airlines);
            });
        }

        $flights = $flights->orderBy('start_day')->paginate(12);
        $search = $request->all();
        session(['request_search' => $search]);


        $viewData = [
            'flights' => $flights,
            'query' => $request->query(),
            'search' => $search
        ];

        return view('page.flight.index', $viewData);
    }

    // Hiển thị màn hình đặt vé máy bay
    public function bookTicket(Request $request, $id)
    {

        $flight = Flight::with(['start_location', 'end_location', 'plane' => function($query) {
            $query->with('airline_company');
        }])->find($id);

        if (!$flight) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        if (session()->has('request_search')) {
            $dataSearch = session()->get('request_search');
            unset($dataSearch['transports']);
        } else {
            $dataSearch = [
                'start_location' => $flight->start_location_id,
                'end_location' => $flight->end_location_id,
                'type' => 1,
                'start_date' => $flight->start_day,
                'end_date' => $flight->end_day,
                'adult' => 1,
                'children' => 0,
                'baby' => 0,
            ];
        }
        $dataSearch['flight_id'] = $flight->id;
        $dataSearch['flight'] = $flight->toArray();

        session(['request_search' => $dataSearch]);

        $transports = null;
        if (isset($flight->plane) && isset($flight->plane->airline_company)) {
            $transports = Transport::where('airline_company_id', $flight->plane->airline_company->id)->get();
        }
        $user = null;
        if (Auth::guard('user')->check()) {
            $user = Auth::guard('user')->user();
        }

        $viewData= [
            'flight' => $flight,
            'dataSearch' => $dataSearch,
            'transports' => $transports,
            'user' => $user,
        ];
        return view('page.flight.book', $viewData);
    }
    // thêm thông tin người lớn
    public function plusCustomer(Request $request)
    {
        if ($request->ajax()) {
            $type = $request->type ?? 'adult';
            $i = $request->numAdult ?? 2;
            $i = $i + 1;
            if (session()->has('request_search')){
                $dataSearch = session()->get('request_search');
                if ($type == 'adult') {
                    $dataSearch['adult'] = $dataSearch['adult'] + 1;
                } else {
                    $dataSearch['children'] = $dataSearch['children'] + 1;
                }
            } else {
                $dataSearch = [
                    'adult' => 2,
                    'children' => 2,
                    'baby' => 0,
                ];
            }

            $id = $request->flight_id;

            $flight = Flight::with(['start_location', 'end_location', 'plane' => function($query) {
                $query->with('airline_company');
            }])->find($id);

            $transports = null;
            if (isset($flight->plane) && isset($flight->plane->airline_company)) {
                $transports = Transport::where('airline_company_id', $flight->plane->airline_company->id)->get();
            }
            session(['request_search' => $dataSearch]);

            if ($type == 'adult') {
                $html = view('page.flight.item_adult', compact('transports', 'i', 'flight'))->render();
            } else {
                $type = 'children';
                $html = view('page.flight.item_baby', compact('i', 'flight', 'type'))->render();
            }
            $html_price =  view('page.flight.table_price', compact('dataSearch', 'flight'))->render();

            return response([
                'code' => 200,
                'html' => $html,
                'html_price' => $html_price,
                'type' => $type
            ]);
        }
    }
    // cộng trừ thông tin người lớn và trẻ em
    public function minusCustomer(Request $request)
    {
        if ($request->ajax()) {

            $type = $request->type ?? 'adult';
            $baby_gender = $request->baby_gender ?? 'adult';

            if (session()->has('request_search')){
                $dataSearch = session()->get('request_search');

                if ($type == 'adult') {
                    if ($dataSearch['adult'] > 1) {
                        $dataSearch['adult'] = $dataSearch['adult'] - 1;
                    }
                } else {
                    if ($dataSearch['children'] >= 1 && in_array($baby_gender, [1])) {
                        $dataSearch['children'] = $dataSearch['children'] - 1;
                    } else if ($dataSearch['baby'] >= 1) {
                        $dataSearch['baby'] = $dataSearch['baby'] - 1;
                    }
                }
                session(['request_search' => $dataSearch]);

                $id = $request->flight_id;
                $flight = Flight::with(['start_location', 'end_location', 'plane' => function($query) {
                    $query->with('airline_company');
                }])->find($id);

                $html_price =  view('page.flight.table_price', compact('dataSearch', 'flight'))->render();

                return response([
                    'code' => 200,
                    'html_price' => $html_price
                ]);
            }
        }
    }
    // thay đổi thông tin em bé và trẻ em
    public function changeBabyGender(Request $request)
    {
        if (session()->has('request_search')){
            $dataSearch = session()->get('request_search');
            $baby_gender = $request->baby_gender;
            $key_gender = $request->key_gender;

            if ($baby_gender == 1 && $key_gender == 'children') {
                $dataSearch['children'] = $dataSearch['children'] + 1;
                if ($dataSearch['baby'] >= 1) {
                    $dataSearch['baby'] = $dataSearch['baby'] - 1;
                }
            } else if ($baby_gender == 2 && $key_gender == 'baby') {

                $dataSearch['baby'] = $dataSearch['baby'] + 1;

                if ($dataSearch['children'] >= 1) {
                    $dataSearch['children'] = $dataSearch['children'] - 1;
                }
            }

            session(['request_search' => $dataSearch]);

            $id = $request->flight_id;

            $flight = Flight::with(['start_location', 'end_location', 'plane' => function($query) {
                $query->with('airline_company');
            }])->find($id);

            $html_price =  view('page.flight.table_price', compact('dataSearch', 'flight'))->render();

            return response([
                'code' => 200,
                'html_price' => $html_price
            ]);
        }
    }

    public function transport(TransportRequest $request)
    {
        if ($request->ajax()) {
            if (session()->has('request_search')){

                $id = $request->flight_id;
                $transport_id = $request->transport_id;
                $transport_key = $request->transport_key;

                $dataSearch = session()->get('request_search');


                $flight = Flight::with(['start_location', 'end_location', 'plane' => function($query) {
                    $query->with('airline_company');
                }])->find($id);
                if ($transport_id != 0) {
                    $transport = Transport::find($transport_id);
                    if ($transport) {
                        $dataSearch['transports'][$transport_key] = $transport->toArray();
                    }
                } else {
                    unset($dataSearch['transports'][$transport_key]);
                }

                session(['request_search' => $dataSearch]);

                $html_price =  view('page.flight.table_price', compact('dataSearch', 'flight'))->render();

                return response([
                    'code' => 200,
                    'html_price' => $html_price
                ]);
            }
        }
    }

    public function postBookTicket(BookTicketRequest $request, $id)
    {
        $flight = Flight::with(['start_location', 'end_location', 'plane' => function($query) {
            $query->with('airline_company');
        }])->find($id);

        if (!$flight) {
            return redirect()->route('user.home.index')->with('error', 'Dữ liệu không tồn tại');
        }

        if (!session()->has('request_search')){
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }

        $adult_genders = $request->adult_genders;
        $adult_names = $request->adult_names;
        $adult_cards = $request->adult_cards;
        $adult_birthday = $request->adult_birthday;
        $adult_transports = $request->adult_transports;
        $baby_genders = $request->baby_genders;
        $baby_names = $request->baby_names;
        $baby_birthday = $request->baby_birthday;
        $dataSearch = session()->get('request_search');

        $data = [
            'flight_id' => $flight->id,
            'code_no' => generateRandomString(),
            'name' => $request->name_contact,
            'phone' => $request->phone_contact,
            'email' => $request->email_contact,
            'adult' => $dataSearch['adult'] ?? 1,
            'children' => $dataSearch['children'] ?? 1,
            'baby' => $dataSearch['baby'] ?? 1,
            'start_location_id' => $flight->start_location_id,
            'end_location_id' => $flight->end_location_id ,
            'start_day' => $flight->start_day,
            'end_day' => $flight->end_day,
            'expense' => $flight->expense,
            'baby_ticket' => $flight->baby_ticket,
            'tax_percentage' => $flight->tax_percentage,
            'type' => $dataSearch['type'] ?? 1,
        ];
        if (\Auth::guard('user')->check()) {
            $data['user_id'] = \Auth::guard('user')->id();
        }
        $price = isset($dataSearch['ticket_class']) && $dataSearch['ticket_class'] == 2 ? $flight->price_vip : $flight->price;
        $data['price'] = $price;
        $data['ticket_class'] = $dataSearch['ticket_class'] ?? 1 ;

        $adult = $dataSearch['adult'] ?? 1;
        $adult_money = $adult * $price;
        $children = $dataSearch['children'] ?? 0;
        $children_money = $children * $price;
        $baby = $dataSearch['baby'] ?? 0;
        $baby_money = $baby * $flight->baby_ticket;

        $transport_total = 0;

        foreach ($adult_transports as $transport_id) {
            $transport = Transport::find($transport_id);
            if ($transport) {
                $transport_total = $transport_total + $transport->price;
            }
        }

        $total = $adult_money + $children_money + $baby_money + $flight->expense + $transport_total;
        $total_percentage = $flight->tax_percentage > 0 ? $total * ($flight->tax_percentage / 100) : 0;
        $data['taxes_fees'] = $total_percentage;
        $total_money = $total + $total_percentage;
        $data['total_money'] = $total_money;
        $data['status'] = 1;
        $data['created_at'] = $data['updated_at'] = Carbon::now();

        try {
            \DB::beginTransaction();

            $transactionId =  Transaction::insertGetId($data);

            foreach ($adult_genders as $key => $gender) {

                if (isset($adult_transports[$key])) {
                    $transport = Transport::find($adult_transports[$key]);
                }

                $ticket_adult = [
                    'transaction_id' => $transactionId,
                    'transport_id' => $transport ? $transport->id : null,
                    'flight_id' => $flight->id,
                    'code_no' => generateRandomString(0),
                    'gender' => $gender,
                    'type' => 'adult',
                    'name' => $adult_names[$key] ?? null,
                    'card' => $adult_cards[$key] ?? null,
                    'birthday' => $adult_birthday[$key] ?? null,
                    'transport_price' => $transport ? $transport->price : null,
                    'transport_weight' => $transport ? $transport->weigh : null,
                    'status' => 0,
                ];

                Ticket::create($ticket_adult);
            }
            if ($baby_genders) {
                foreach ($baby_genders as $key => $baby_gender) {

                    $ticket_baby = [
                        'transaction_id' => $transactionId,
                        'flight_id' => $flight->id,
                        'code_no' => generateRandomString(0),
                        'gender' => $baby_gender,
                        'type' => $baby_gender == 1 ? 'children' : 'baby',
                        'name' => $baby_names[$key] ?? null,
                        'birthday' => $baby_birthday[$key] ?? null,
                        'status' => 0,
                    ];

                    Ticket::create($ticket_baby);
                }
            }
            session()->forget('request_search');
            \DB::commit();
            return redirect()->route('flight.payment', $transactionId);
        } catch (\Exception $exception) {
            \DB::rollBack();
            Log::info('book ticket exception'. json_encode(['exception' => $exception->getMessage()]));
            return redirect()->back()->with('error', 'Đã xảy ra lỗi không thể book vé máy bay');
        }
    }

    public function payment($id)
    {
        $transaction = Transaction::with(['flight', 'tickets' => function ($query) {
            $query->with('transport');
        }])->where('status', 1)->find($id);

        if (!$transaction) {
            return redirect()->route('user.home.index')->with('error', 'Dữ liệu không tồn tại');
        }

        $seats = Ticket::where('flight_id', $transaction->flight_id)->whereNotNull('seats')->pluck('seats')->toArray();
        return view('page.flight.payment', compact('transaction', 'seats'));
    }

    public function postPayment(PaymentRequest $request, $id)
    {
        $transaction = Transaction::with(['flight', 'tickets' => function ($query) {
            $query->with('transport');
        }])->where('status', 1)->find($id);

        if (!$transaction) {
            return redirect()->route('user.home.index')->with('error', 'Dữ liệu không tồn tại');
        }
        $numberTicket = $transaction->tickets->count();
        if (!$request->seats) {
            return redirect()->back()->with('error', 'Vui lòng chọn số ghế trước khi thanh toán');
        }
        $seats = $request->seats;
        $numberSeat = count($seats);

        if ($numberTicket != $numberSeat) {
            return redirect()->back()->with('error', 'Vui lòng cọn đúng số lượng ghế : '. $numberTicket);
        }

        try {
            if ($request->payment_method == 'payment') {

                $transaction->payment_method = $request->payment_method;
                $transaction->status = 2;

                if ($transaction->save()) {
                    foreach ($transaction->tickets as $key => $ticket) {
                        Ticket::where('id', $ticket->id)->update(['seats' => $seats[$key]]);
                    }
                }

                return redirect()->route('user.home.index')->with('success', 'Đặt vé thành công chờ chúng tôi xác nhận');
            } else {
                session(['seats' => $seats]);
                return $this->paymentOnline($transaction);
            }
        } catch (\Exception $exception) {
            return redirect()->route('user.home.index')->with('error', 'Đã xảy ra lỗi không thể thực hiện đặt vé máy bay');
        }
    }

    public function paymentOnline($transaction)
    {
        $totalMoney = $transaction->total_money;
        $vnp_TxnRef = $transaction->code_no; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = 'THANH TOAN VE MAY BAY';
        $vnp_OrderType = 'other';
        $vnp_Amount = $totalMoney * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $startTime = date("YmdHis");


        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => Transaction::VNP_TMN_CODE,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => $startTime,
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => route('flight.vnpay.return'),
            "vnp_TxnRef" => $vnp_TxnRef,
        );


        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = Transaction::VNP_URL . "?" . $query;

        if (Transaction::VNP_HASH_SECRET) {

            $vnpSecureHash =  hash_hmac('sha512', $hashdata, Transaction::VNP_HASH_SECRET); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return redirect($vnp_Url);
    }

    public function vnpayReturn(Request $request)
    {
        if (session()->has('seats') && $request->vnp_ResponseCode == '00') {
            //
            \DB::beginTransaction();
            try {
                $vnpayData = $request->all();
                $seats = session()->get('seats');

                $transaction = Transaction::with(['flight', 'tickets' => function ($query) {
                    $query->with('transport');
                }])->where(['status' => 1, 'code_no' => $vnpayData['vnp_TxnRef']])->first();

                if ($transaction) {

                    $transaction->payment_method = 'payment-online';
                    $transaction->status = 3;
                    if ($transaction->save()) {

                        foreach ($transaction->tickets as $key => $ticket) {
                            Ticket::where('id', $ticket->id)->update(['seats' => $seats[$key]]);
                        }

                        $dataPayment = [
                            'transaction_id' => $transaction->id,
                            'money' => $transaction->total_money,
                            'notes' => $vnpayData['vnp_OrderInfo'],
                            'vnp_response_code' => $vnpayData['vnp_ResponseCode'],
                            'code_vnpay' => $vnpayData['vnp_TransactionNo'],
                            'code_bank' => $vnpayData['vnp_BankCode'],
                            'time' => date('Y-m-d H:i', strtotime($vnpayData['vnp_PayDate'])),

                        ];
                        $dataPayment['created_at'] = $dataPayment['updated_at'] = Carbon::now();

                        Payment::insert($dataPayment);
                    }
                }
                session()->forget('seats');
                \DB::commit();
                return view('page/vnpay/vnpay_return', compact('vnpayData'));
            } catch (\Exception $exception) {

                \DB::rollBack();
                return redirect()->route('user.home.index')->with('error', 'Đặt vé máy bay không thành công.');
            }
        } else {
            return redirect()->route('user.home.index')->with('error', 'Đặt vé máy bay không thành công.');
        }
    }
}
