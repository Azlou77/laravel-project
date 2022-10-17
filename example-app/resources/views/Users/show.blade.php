@extends ('layouts.app')

@('section scrpits')
<!--JS et CSS-->
@endsection('content')

<div>{{$user->email}}</div>
@endsection

@section('content')
<x-alert/>
<div>{{ $user->email }}</div>
@endsection