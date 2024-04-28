<option value="">Chọn sân bay {{ $type == 'start' ? 'đi' : 'đến' }}</option>
@foreach($airports as $airport)
    <option value="{{$airport->id}}">{{$airport->name}}</option>
@endforeach