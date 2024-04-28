<div class="col-md-8 default">
    <table class="table table-borderless">
        <tbody>
            <tr>
                <td>Full name</td>
                <td>{{ $user->full_name }}</td>
                <td>Phone</td>
                <td>{{ $user->phone }}</td>
            </tr>
            <tr>
                <td>Day of birth</td>
                <td>{{ $user->birthday }}</td>
                <td>Giới tính</td>
                <td>{{ $gender[$user->gender] }}</td>
            </tr>
            <tr>
                <td>Địa chỉ</td>
                <td colspan="3"> {{ $user->address }}</td>
            </tr>
        </tbody>
    </table>
</div>

<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th style="width: 2%;" class="text-center">STT</th>
            <th>Ngày hiến máu</th>
            <th>Ngày nhập kho</th>
            <th>Ngày xuất kho</th>
            <th>Nhóm máu</th>
            <th>Số đơn vị máu</th>
            <th>Cân nặng</th>
            <th>Trạng thái</th>
            <th>File sét nghiệm</th>
        </tr>
        @php $events = $user->events @endphp
        @if ($events->count() > 0)
            @foreach($events as $key => $event)
                <tr>
                    <th style="width: 2%;" class="text-center">{{ $key + 1 }}</th>
                    <th>{{ $event->execution_date }}</th>
                    <th>{{ $event->archive_date }}</th>
                    <th>{{ $event->date_inventory }}</th>
                    <th>{{ $event->blood_group }}</th>
                    <th>{{ $unit[$event->unit] }}</th>
                    <th>{{ $event->weight }}</th>
                    <th>{{ $status_event[$event->status] }}</th>
                    <th><a href="{{ Storage::url('public/file_result/'.$event->name_file) }}" download>Tải file</a></th>
                </tr>
            @endforeach
        @endif
    </thead>
    <tbody>

    </tbody>
</table>
