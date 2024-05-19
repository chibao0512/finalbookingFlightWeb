<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\ChangePasswordRequest;

class ProfileController extends Controller
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        view()->share([]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $agency = Auth::user();
        $user = User::with([
            'userRole' => function($userRole)
            {
                $userRole->select('*');
            }
        ])->find($agency->id);
        return view('admin.user.profile', compact('user'));
    }

    public function update(ProfileRequest $request, $id)
    {
        //
        DB::beginTransaction();
        try {
            $data = $request->except('_token', 'images');
            if (isset($request->images) && !empty($request->images)) {
                $image = upload_image('images');
                if ($image['code'] == 1)
                    $data['avatar'] = $image['name'];
            }

            User::find($id)->update($data);
            DB::commit();
            return redirect()->route('profile.index')->with('success','Update successfully');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->route('profile.index')->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
        }
    }

    public function changePassword()
    {
        view()->share([
            'change_password' => 'active',
        ]);
        return view('admin.user.change_password');
    }

    public function postChangePassword(ChangePasswordRequest $request)
    {
        $data['password'] = bcrypt($request->password);

        try {

            User::find(Auth::user()->id)->update($data);
            Auth::logout();
            return redirect()->route('admin.login');
        } catch (\Exception $exception) {
            return redirect()->back()->with('danger', '[Error ]' . $exception->getMessage());
        }
    }


}
