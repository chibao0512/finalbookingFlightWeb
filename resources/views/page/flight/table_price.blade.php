<table style="width: 100%">
    <tr>
        <td>Adult ticket : </td>
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
        <td>Child tickets: </td>
        <td style="width: 20%; text-align: center">x {{ isset($dataSearch['children']) ? $dataSearch['children'] : 0 }}</td>
        <td style="text-align: right">
            @php $children = $dataSearch['children'] ?? 0  @endphp
            @php $children_money = $children * $price @endphp
            {{ isset($dataSearch) ? number_format($children_money,0,',','.') : 0 }} vnđ
        </td>
    </tr>

    <tr>
        <td>Baby ticket : </td>
        <td style="width: 20%; text-align: center">x {{ isset($dataSearch['baby']) ? $dataSearch['baby'] : 0 }}</td>
        @php $baby = $dataSearch['baby'] ?? 0 @endphp
        @php $baby_money = $baby * $flight->baby_ticket @endphp

        <td style="text-align: right">{{ isset($dataSearch) ? number_format($baby_money,0,',','.') : 0 }} vnđ</td>
    </tr>
    <tr>
        <td>Luggage : </td>
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
        <td>Surcharge : </td>
        <td style="width: 20%; text-align: center"></td>
        <td style="text-align: right">
            <b>{{ number_format($flight->expense,0,',','.') }} vnđ</b>
        </td>
    </tr>
    <tr>
        <td>Tax + surcharge : </td>
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
        <td>Total ticket price : </td>
        <td style="width: 20%; text-align: center"></td>
        <td style="text-align: right">
            <b>{{ number_format($total + $total_percentage + $transport_total,0,',','.') }} vnđ</b>
        </td>
    </tr>
</table>