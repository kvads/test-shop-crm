@extends('layouts.app')
@section('content')
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
    <strong class="font-bold">Ошибка</strong>
    <span class="block sm:inline">{{ $exception->getMessage() }}</span>
</div>
@endsection
