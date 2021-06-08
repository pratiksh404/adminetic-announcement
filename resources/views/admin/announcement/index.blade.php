@extends('adminetic::admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>All Announcements</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i data-feather="home"></i></a>
                        </li>
                        <li class="breadcrumb-item active">Annoucements</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <x-adminetic-card title="announcement" route="announcement">
        <x-slot name="buttons">
            <a href="{{ adminCreateRoute('announcement') }}" class="btn btn-primary btn-air-primary mx-1">Create
                Announcement</a>
            <a href="{{ adminRedirectRoute('timeline') }}" class="btn btn-info btn-air-info mx-1">Timeline</a>
        </x-slot>
        <x-slot name="content">
            {{-- ================================Card================================ --}}
            <table class="table table-striped table-bordered datatable">
                <thead>
                    <tr>
                        <th>Announcement By</th>
                        <th>Announcement On</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($announcements as $announcement)
                        @if (in_array(auth()->user()->id, $announcement->audience))
                            <tr>
                                <td>{{ $announcement->user->name ?? 'N/A' }}</td>
                                <td>{{ $announcement->created_at->toDayDateTimeString() }}</td>
                                <td>
                                    <x-adminetic-action :model="$announcement" route="announcement" />
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
            {{-- =================================================================== --}}
        </x-slot>
    </x-adminetic-card>
@endsection

@section('custom_js')
    @include('announcement::admin.layouts.modules.announcement.scripts')
@endsection
