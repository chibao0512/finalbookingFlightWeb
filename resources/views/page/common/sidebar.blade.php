<div class="col-lg-4 sidebar">
    <form action="{{ route('user.flight.search') }}" class="search-form mb-3">
    <div class="sidebar-box bg-white p-4 ftco-animate fadeInUp ftco-animated">
        <h3 class="heading-sidebar">Tìm kiếm</h3>
            <div class="form-group">
                <div class="form-field">
                    <lable for="start_location" style="float: left;">Điểm đi</lable>
                    <div class="select-wrap">
                        <select name="start_location" id="start_location" class="form-control" tabindex="1">
                            <option value="">Điểm đi</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}" {{ isset($search['start_location']) && $search['start_location'] == $location->id ? 'selected' : '' }}>{{ $location->name.'('.$location->code_no.')' }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-field">
                    <lable for="end_location" style="float: left;">Điểm đến</lable>
                    <div class="select-wrap">
                        <select name="end_location" id="end_location" class="form-control" tabindex="2">
                            <option value="">Điểm đến</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}" {{ isset($search['end_location']) && $search['end_location'] == $location->id ? 'selected' : '' }}>{{ $location->name.'('.$location->code_no.')' }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-field">
                    <lable for="type" style="float: left;">Loại vé</lable>
                    <div class="select-wrap">
                        <select name="type" id="type" class="form-control" tabindex="3">
                            <option value="">Loại vé </option>
                            @foreach($types as $key => $type)
                                <option value="{{ $key }}" {{ isset($search['type']) && $search['type'] == $key ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <lable for="start_date" style="float: left;">Ngày đi</lable>
                <div class="form-field">
                    <input type="date" name="start_date" id="start_date" class="form-control" placeholder="Ngày đi" tabindex="4">
                </div>
            </div>
            <div class="form-group">
                <lable for="end_date" style="float: left;">Ngày về</lable>
                <div class="form-field">
                    <input type="date" name="end_date" id="end_date" class="form-control" placeholder="Ngày đến" tabindex="5">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <lable for="adult" style="float: left;">Người lớn</lable>
                    <div class="form-field">
                        <input type="number" name="adult" id="adult" class="form-control" placeholder="(≥ 12 tuổi)" value="1" tabindex="5">
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <lable style="float: left;">Trẻ em</lable>
                    <div class="form-field">
                        <input type="number" name="children" class="form-control" placeholder="(2-12 tuổi)" value="0">
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <lable style="float: left;">Em bé</lable>
                    <div class="form-field">
                        <input type="number"  name="baby" class="form-control" placeholder="(< 2 tuổi)" value="0">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-field" style="margin-top: 30px;">
                    <button type="submit" class="form-control btn btn-primary">Tìm kiếm</button>
                </div>
            </div>
    </div>
    <div class="sidebar-box bg-white p-4 ftco-animate fadeInUp ftco-animated">
        <h3 class="heading-sidebar">Hãng hàng không</h3>

        @foreach($airlines as $airline)
            <label for="{{ safeTitle($airline->name) }}">
                <input type="checkbox" id="{{ safeTitle($airline->name) }}" name="airlines[]" value="{{ $airline->id }}"
                        {{ isset($search['airlines']) && in_array($airline->id, $search['airlines']) ? 'checked' : '' }}> {{ $airline->name }}
            </label><br>
        @endforeach
    </div>
    </form>
    @if (isset($book))
        <div class="p-4 mb-3 bg-white">
            <h3 class="h5 text-black mb-3">Điều kiện vé</h3>
            <p class="mb-0 font-weight-bold">- Hoàn vé:</p>
            <p class="mb-0 m-lg-3">+ Trước giờ khởi hành 06 tiếng: 500,000đ/khách</p>
            <p class="mb-0 m-lg-3">+ Trong vòng 06 tiếng và sau khởi hành: 650,000đ/khách</p>

            <p class="mb-0 font-weight-bold">- Đổi vé:</p>
            <p class="mb-0 m-lg-3">+ Trước giờ khởi hành 06 tiếng: 450,000đ/chiều/khách + chênh lệch giá</p>
            <p class="mb-0 m-lg-3">+ Trong vòng 06 tiếng và sau khởi hành: 600,000đ/chiều/khách + chênh lệch giá</p>
            <p class="mb-0 m-lg-3">- Đổi tên: Không áp dụng</p>
        </div>
    @endif
</div>