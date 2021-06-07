@extends('adminetic::admin.layouts.app')

@section('content')
    <x-adminetic-show-page name="announcement" route="announcement" :model="$announcement">
        <x-slot name="content">
            <div class="row">
                <div class="col-lg-8">
                    <h4 class="text-center"><b>Announcement</b></h4>
                    <hr>
                    @isset($announcement->body)
                        {!! $announcement->body !!}
                    @endisset
                </div>
                <div class="col-lg-4">
                    <ul class="list-group">
                        <li class="list-group-item"><b>Announcement By : </b>{{ $announcement->user->name ?? 'N/A' }}</li>
                        <li class="list-group-item"><b>Announcement At :
                            </b>{{ $announcement->created_at->toDayDateTimeString() }}</li>
                        @if ($announcement->mediums() != null)
                            @if (count($announcement->mediums()) > 0)
                                <li class="list-group-item"><b>Mediums : </b> <br>
                                    @foreach ($announcement->mediums() as $medium)
                                        <span class="badge badge-info">{{ $medium ?? 'N/A' }}</span>
                                    @endforeach
                                </li>
                            @endif
                        @endif
                        <li class="list-group-item"><b>Audience : </b> <br>
                            @isset($announcement->audience_names)
                                @foreach ($announcement->audience_names as $audience)
                                    <span class="badge badge-primary">{{ $audience ?? 'N/A' }}</span>
                                @endforeach
                            @endisset
                        </li>
                    </ul>
                </div>
            </div>
        </x-slot>
    </x-adminetic-show-page>

@endsection

@section('custom_js')
    @include('announcement::admin.layouts.modules.announcement.scripts')
@endsection
