@foreach($data as $item)
    <li>{{$item->getStudent()->getName()}}</li>
@endforeach