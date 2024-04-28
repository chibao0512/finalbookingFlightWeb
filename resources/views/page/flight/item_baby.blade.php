<div class="row item-baby" style="margin-top: 30px">
    <div class="col-sm-12 col-md-2">
        <div class=" form-group">
            <select name="baby_genders[]" class="form-control baby_gender" url="{{ route('flight.change.baby.gender') }}" flight_id="{{ $flight->id }}" required>
                @foreach(GENDER_BABY as $key => $gender_adult)
                    @if($type == 'children' && $key == 1)
                        <option value="{{ $key }}" selected key_gender="{{ $key == 1 ? 'children' : 'baby' }}">{{ $gender_adult }}</option>
                    @elseif($type == 'baby' && $key == 2)
                        <option value="{{ $key }}" selected key_gender="{{ $key == 1 ? 'children' : 'baby' }}">{{ $gender_adult }}</option>
                    @else
                        <option value="{{ $key }}" key_gender="{{ $key == 1 ? 'children' : 'baby' }}">{{ $gender_adult }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-12 col-md-4">
        <div class=" form-group">
            <input type="text" name="baby_names[]" class="form-control" placeholder="Họ và tên" required>
        </div>
    </div>
    <div class="col-sm-12 col-md-4">
        <input type="date" name="baby_birthday[]" class="form-control" required>
    </div>
    <div class="col-sm-12 col-md-2">
        <span class="item-baby-delete btn-minus-customer" url="{{ route('flight.minus.customer') }}" flight_id="{{ $flight->id }}" type="baby"><img src="{{ asset('page/images/icon/trash-can-solid.svg') }}" alt="" width="15" style="margin-top: 20px"></span>
    </div>
    <div class="col-md-12">
        <hr>
    </div>
</div>