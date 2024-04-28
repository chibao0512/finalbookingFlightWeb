@foreach($tickets as $key => $ticket)
    <tr>
        <td scope="col">{{ $key + 1 }}</td>
        <td scope="col">{{ $ticket->code_no }}</td>
        <td scope="col">{{ $ticket->type == 'adult' ? GENDER_ADULT[$ticket->gender] : GENDER_BABY[$ticket->gender] }} : {{ $ticket->name }}</td>
        <td scope="col">{{ $ticket->seats }}</td>
        <td scope="col">{{ $ticket->birthday }}</td>
        <td scope="col">{{ $ticket->card }}</td>
        <td scope="col">{{ isset($ticket->transport) ? $ticket->transport->weight . 'Kg' : '' }}</td>
    </tr>
@endforeach