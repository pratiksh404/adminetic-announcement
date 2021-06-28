<div class="row">
    <div class="col-lg-8">
        <div class="mb-3" style="position: static;">
            <label for="body">Announcement Body</label>
            <textarea name="body" id="heavytexteditor" cols="30" rows="10">
                @if (isset($announcement->body))
                    {!! $announcement->body !!}
@else
                    {{ old('body') }}
                @endif
            </textarea>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="mb-3" style="position: static;">
            <label>Medium</label>
            <div class="col">
                <div class="checkbox">
                    <input name="medium[]" id="checkbox-def" type="checkbox" value="1"
                        {{ isset($announcement->medium) ? (in_array(1, $announcement->medium) ? 'checked' : '') : 'checked' }}>
                    <label for="checkbox-def">System Notification</label>
                </div>
                <div class="checkbox">
                    <input name="medium[]" id="checkbox-dis" type="checkbox" value="2"
                        {{ isset($announcement->medium) ? (in_array(2, $announcement->medium) ? 'checked' : '') : '' }}>
                    <label for="checkbox-dis">Email</label>
                </div>
                <div class="media mb-2">
                    <label class="col-form-label m-r-10">Slack Notification</label>
                    <div class="media-body text-end icon-state">
                        <label class="switch">
                            <input type="hidden" name="slack_notify" value="0">
                            <input type="checkbox" name="slack_notify" value="1"
                                {{isset($announcement->slack_notify) ? ($announcement->slack_notify ? 'checked' : '') : 'checked'}}><span
                                class="switch-state"></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3" style="position: static;max-height:30vh;overflow:auto">
            <label>Audience</label>
            <div class="col">
                @foreach ($users as $user)
                <div class="checkbox">
                    <input name="audience[]" id="user{{ $user->id }}" type="checkbox" value="{{ $user->id }}"
                        {{ isset($announcement->audience) ? in_array($user->id, $announcement->audience) ? 'checked' : '' : 'checked' }}>
                    <label for="user{{ $user->id }}">{{ $user->name }}</label>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<hr>
<input type="submit"
    class="btn btn-{{ isset($announcement) ? 'warning' : 'primary' }} btn-air-{{ isset($announcement) ? 'warning' : 'primary' }}"
    value="{{ isset($announcement) ? 'Edit Announcement' : 'Add Announcement' }}">