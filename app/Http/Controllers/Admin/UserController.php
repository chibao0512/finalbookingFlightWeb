<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Role;

class UserController extends Controller
{
    public function __construct(Role $role)
    {
        view()->share([
            'user_active' => 'active',
            'roles' => $role->all(),
            'status' => User::STATUS
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::with([
            'userRole' => function($userRole)
            {
                $userRole->select('*');
            }
        ])->orderBy('id', 'DESC')->paginate(10);
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //
        \DB::beginTransaction();
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = bcrypt($request->password);
            $user->status = $request->status;
            if (isset($request->images) && !empty($request->images)) {
                $image = upload_image('images');
                if ($image['code'] == 1)
                    $user->avatar = $image['name'];
            }
            if ($user->save()) {
                \DB::table('role_user')->insert(['role_id'=> $request->role, 'user_id'=> $user->id]);
            }

            \DB::commit();
            return redirect()->back()->with('success','Thêm mới thành công');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
        }
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
        $user = User::with([
            'userRole' => function($userRole)
            {
                $userRole->select('*');
            }
        ])->find($id);
        $listRoleUser = \DB::table('role_user')->where('user_id', $id)->first();
        if(!$user) {
            return redirect()->route('get.list.user')->with('danger', 'Quyền không tồn tại');
        }

        $viewData = [
            'user' => $user,
            'listRoleUser' => $listRoleUser
        ];
        return view('admin.user.create', $viewData);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        //
        \DB::beginTransaction();
        try {
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->status = $request->status;

            if (isset($request->images) && !empty($request->images)) {
                $image = upload_image('images');
                if ($image['code'] == 1)
                    $user->avatar = $image['name'];
            }
            if ($user->save()) {
                \DB::table('role_user')->where('user_id', $id)->delete();
                \DB::table('role_user')->insert(['role_id'=> $request->role, 'user_id'=> $user->id]);
            }

            \DB::commit();
            return redirect()->back()->with('success','Chỉnh sửa thành công');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'Dữ liệu không tồn tại');
        }
        \DB::beginTransaction();
        try {
            $user->delete();
            \DB::commit();
            return redirect()->back()->with('success','Đã xóa thành công');
        } catch (\Exception $exception) {
            \DB::rollBack();
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi lưu dữ liệu');
        }
    }
}
