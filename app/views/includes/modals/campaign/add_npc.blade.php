<div class="ui tiny modal" id="npc_modal">
    <i class="close icon"></i>
    <div class="ui green header">Add NPC</div>
    <div class="content">
        {{ Form::open(array('url' => action('User\CampaignController@postNpc'), 'class' => 'ui form', 'files' => true)) }}
            {{ Form::hidden('camp', $campaign->id) }}
            <div class="field">
                {{ Form::text('name', '', array('placeholder' => 'NPC Name')) }}
            </div>
            <div class="field">
                {{ Form::textarea('desc', '', array('placeholder' => 'NPC Description')) }}
            </div>
            <div class="field">
                <div class="ui action input">
                    <input type="text" id="_avatar" placeholder="NPC photo">
                    <label for="avatar" class="ui icon button btn-file">
                        <i class="attachment basic icon"></i>
                        <input type="file" id="avatar" name="avatar" style="display: none">
                    </label>
                </div>
            </div>
            <div class="field">
                {{ Form::submit('Create NPC', array('class' => 'ui green submit button')) }}
            </div>
        {{ Form::close() }}
    </div>
</div>

@section('inline-js')
    <script type="text/javascript">
        var fileExtentionRange = '.png .jpg .jpeg';
        var MAX_SIZE = 30; // MB

        $(document).on('change', '#npc_modal .btn-file :file', function() {
            var input = $(this);

            if (navigator.appVersion.indexOf("MSIE") != -1) { // IE
                var label = input.val();

                input.trigger('fileselect', [ 1, label, 0 ]);
            } else {
                var label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                var numFiles = input.get(0).files ? input.get(0).files.length : 1;
                var size = input.get(0).files[0].size;

                input.trigger('fileselect', [ numFiles, label, size ]);
            }
        });

        $('#npc_modal .btn-file :file').on('fileselect', function(event, numFiles, label, size) {
            $('#avatar').attr('name', 'avatar'); // allow upload.

            var postfix = label.substr(label.lastIndexOf('.'));
            if (fileExtentionRange.indexOf(postfix.toLowerCase()) > -1) {
                if (size > 1024 * 1024 * MAX_SIZE ) {
                    alert('max size：<strong>' + MAX_SIZE + '</strong> MB.');

                    $('#avatar').removeAttr('name'); // cancel upload file.
                } else {
                    $('#_avatar').val(label);
                }
            } else {
                alert('file type：<br/> <strong>' + fileExtentionRange + '</strong>');

                $('#avatar').removeAttr('name'); // cancel upload file.
            }
        });
    </script>
@append