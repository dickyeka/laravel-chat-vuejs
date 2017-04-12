@extends('layouts.app')

@section('content')

    @if (isset($conversation))
        <conversations-dashboard id="{{ $conversation->id }}"></conversations-dashboard>
    @else
        <conversations-dashboard></conversations-dashboard>
    @endif
@endsection
