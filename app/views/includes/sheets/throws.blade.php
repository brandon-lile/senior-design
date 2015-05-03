<div class="ui raised red segment" id="saving_throws">
    <h2 class="ui red header">Saving Throws</h2>
        <div class="ui segment">
            @foreach ($sheet->savingthrows->abilities as $ability)
                <div class="ui toggle checkbox">
                    {{ Form::checkbox(strtolower($ability['name'] . "_throw"), $ability['value'], $ability['value']) }}
                    {{ Form::label(strtolower($ability['name'] . "_throw"), $ability['name']) }}
                </div>
                <div class="ui divider"></div>
            @endforeach
        </div>
</div>

@section('inline-js')
    <script type="text/javascript">
        $('.ui.checkbox').checkbox();

        $("#saving_throws input[type=checkbox]").on("change", function()
        {
            var name = $(this).attr('name');
            var params = {
                'sheet' : "{{ $sheet->id }}",
                'field' : name.substr(0, name.indexOf('_')),
                'value' : (parseInt($(this).val())) ? 0 : 1
            }

            $.ajax({
                type: "PATCH",
                data: params,
                url: "{{ action('User\CharacterController@patchSavingThrow') }}",
                success: function(data){
                    if(data === true) {
                        // Change the val on checkbox
                        $("#saving_throws input[name=" + params['field'] + "_throw]").val(parseInt(params['value']));
                    }
                }
            });
        });
    </script>
@append