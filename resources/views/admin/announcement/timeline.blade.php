@extends('adminetic::admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h3>Announcement Timeline</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> <i data-feather="home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ adminRedirectRoute('announcement') }}">Annoucements</a>
                        </li>
                        <li class="breadcrumb-item active">Timeline</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <x-adminetic-card title="Announcement Timeline">
        <x-slot name="content">
            @if (isset($announcements))
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- cd-timeline Start-->
                                <section class="cd-container" id="cd-timeline">
                                    @foreach ($announcements as $announcement)
                                        @if (in_array(auth()->user()->id, $announcement->audience))
                                            <div class="cd-timeline-block">
                                                <a href="{{ adminShowRoute('announcement', $announcement->id) }}">
                                                    <div
                                                        class="cd-timeline-img cd-picture bg-{{ $announcement->color ?? 'primary' }}">
                                                        <i class="icofont icofont-bullhorn"></i>
                                                    </div>
                                                </a>
                                                <div class="cd-timeline-content">
                                                    @isset($announcement->body)
                                                        {!! $announcement->body !!}
                                                    @endisset
                                                    <a href="{{ adminShowRoute('announcement', $announcement->id) }}">
                                                        <span
                                                            class="cd-date">{{ $announcement->created_at->toDayDateTimeString() }}
                                                            -
                                                            {{ $announcement->user->name ?? 'N/A' }}</span></span>
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </section>
                                <br>
                                <div class="d-flex justify-content-center">
                                    {{ $announcements->links() }}
                                </div>
                                <!-- cd-timeline Ends-->
                                <!-- Container-fluid ends                    -->
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <h2 class="text-bold text-center">No announcements yet !</h2>
            @endif
        </x-slot>
    </x-adminetic-card>
@endsection
