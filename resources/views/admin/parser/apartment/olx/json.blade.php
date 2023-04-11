[
@foreach($data as $item)
   {"title": "{{ $item->title}}", "date":"{{ $item->date}}", "description":"{{ $item->description}},"etajnost":"{{ $item->etajnost}}",
   "floor":"{{ $item->floor}}", "price":"{{ $item->price}}", "rooms":"{{ $item->rooms}}", "type":"{{ $item->type}}", "area":"{{$item->area}}",
"metro":"{{$item->shops}}", "service":"{{$item->service}}", "repair":"{{$item->repair}}", "favorites":"{{$item->favorites}}",}
@endforeach
]
