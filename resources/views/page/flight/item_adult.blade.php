<div class="row item-adult">
    <div class="col-sm-12 col-md-2">
        <div class="form-group">
            <select name="adult_genders[]" class="form-control" required>
                @foreach(GENDER_ADULT as $key => $gender_adult)
                    <option value="{{ $key }}">{{ $gender_adult }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-12 col-md-5">
        <div class="form-group">
            <input type="text" name="adult_names[]" class="form-control" placeholder="Fullname" required>
        </div>
    </div>
    <div class="col-sm-12 col-md-5">
        <div class="form-group">
            <input type="text" name="adult_cards[]" class="form-control adult_card" placeholder="CCCD or Passport" required>
        </div>
    </div>
    <div class="col-sm-12 col-md-5">
        <div class="form-group">
            <input type="date" name="adult_birthday[]" class="form-control" required>
        </div>
    </div>
    <div class="col-sm-12 col-md-4">
        <div class="form-group">
            <select name="adult_transports[]" flight_id="{{ $flight->id }}" class="form-control transports" url="{{ route('flight.transport') }}" transport_key="{{ $i }}">
                <option value="0">Buy more consignments</option>
                @foreach($transports as $transport)
                    <option value="{{ $transport->id }}" price="{{ $transport->price }}">{{ $transport->title }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @if ($i > 1)
        <div class="col-sm-12 col-md-2">
            <span class="item-adult-delete btn-minus-customer" url="{{ route('flight.minus.customer') }}" flight_id="{{ $flight->id }}" type="adult">
                <img src="{{ asset('page/images/icon/trash-can-solid.svg') }}" alt="Delete" width="15" style="margin-top: 20px">
            </span>
        </div>
    @endif
    <div class="col-md-12">
        <hr>
    </div>
</div>
