<table style="width: 100%">
    <tr>
        <td>Vé người lớn : </td>
        <td style="width: 20%; text-align: center">x {{ isset($dataSearch['adult']) ? $dataSearch['adult'] : 1 }}</td>
        <td style="text-align: right">
            @php
                $price = isset($dataSearch['ticket_class']) && $dataSearch['ticket_class'] == 2 ? $flight->price_vip : $flight->price;
                $adult = $dataSearch['adult'] ?? 1;
            @endphp
            @php $adult_money = $adult * $price @endphp
            {{ number_format($adult_money,0,',','.') }} vnđ
        </td>
    </tr>

    <tr>
        <td>Vé trẻ em : </td>
        <td style="width: 20%; text-align: center">x {{ isset($dataSearch['children']) ? $dataSearch['children'] : 0 }}</td>
        <td style="text-align: right">
            @php $children = $dataSearch['children'] ?? 0  @endphp
            @php $children_money = $children * $price @endphp
            {{ isset($dataSearch) ? number_format($children_money,0,',','.') : 0 }} vnđ
        </td>
    </tr>

    <tr>
        <td>Vé em bé : </td>
        <td style="width: 20%; text-align: center">x {{ isset($dataSearch['baby']) ? $dataSearch['baby'] : 0 }}</td>
        @php $baby = $dataSearch['baby'] ?? 0 @endphp
        @php $baby_money = $baby * $flight->baby_ticket @endphp

        <td style="text-align: right">{{ isset($dataSearch) ? number_format($baby_money,0,',','.') : 0 }} vnđ</td>
    </tr>
    <tr>
        <td>Hành lý : </td>
        <td style="width: 20%; text-align: center"></td>
        <td style="text-align: right">
            @php $transport_total = 0; @endphp
            @if (isset($dataSearch['transports']))
                @foreach($dataSearch['transports'] as $transport)
                    @php $transport_total = $transport_total + $transport['price']; @endphp
                @endforeach
            @endif
            {{ number_format($transport_total,0,',','.') }} vnđ
        </td>
    </tr>
    <tr>
        <td>Phụ phí : </td>
        <td style="width: 20%; text-align: center"></td>
        <td style="text-align: right">
            <b>{{ number_format($flight->expense,0,',','.') }} vnđ</b>
        </td>
    </tr>
    <tr>
        <td>Thuế + phụ phí : </td>
        <td style="width: 20%; text-align: center"></td>
        <td style="text-align: right">
            @php
                $total = $adult_money + $children_money + $baby_money + $flight->expense;
                $total_percentage = $flight->tax_percentage > 0 ? $total * ($flight->tax_percentage / 100) : 0;
            @endphp
            <b>{{ number_format($total_percentage,0,',','.') }} vnđ</b>
        </td>
    </tr>
    <tr>
        <td>Tổng giá vé : </td>
        <td style="width: 20%; text-align: center"></td>
        <td style="text-align: right">
            <b>{{ number_format($total + $total_percentage + $transport_total,0,',','.') }} vnđ</b>
        </td>
    </tr>
</table>