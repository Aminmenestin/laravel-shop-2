@extends('admin.layouts.master')



@section('content')
<form action="{{route('payment')}}" method="POST">
    @csrf
    <input type="text" name="amount">
</form>
@endsection
