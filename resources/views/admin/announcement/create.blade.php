@extends('adminetic::admin.layouts.app')

@section('content')
    <x-adminetic-create-page name="announcement" route="announcement">
        <x-slot name="content">
            {{-- ================================Form================================ --}}
            @include('announcement::admin.layouts.modules.announcement.edit_add')
            {{-- =================================================================== --}}
        </x-slot>
    </x-adminetic-create-page>
@endsection

@section('custom_js')
    @include('announcement::admin.layouts.modules.announcement.scripts')
@endsection
