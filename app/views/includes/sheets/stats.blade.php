<div class="ui form" id="stats">
    @foreach($sheet->abilities as $data)
        <div class="field">
            <div class="ui blue label">
                {{ Form::label(strtolower($data['name']), $data['name']) }}
                <div class="ui right labeled left icon input">
                    {{ Form::number(strtolower($data['name']), $data['value'], array('id' => strtolower($data['name']))) }}
                    <div class="ui tag label">
                        {{ $data['bonus'] }}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@section('inline-js')
    <script type="text/javascript">
        $("#stats").on('change', 'input', function()
        {
            var input = $(this);
            var params = {
                'ability' : $(this).attr('name'),
                'value' : $(this).val(),
                'sheet' : "{{ $sheet->id }}"
            }

            $.ajax({
                type : 'PATCH',
                data : params,
                datatype : 'json',
                url : "{{ action('User\CharacterController@patchAbility') }}",
                success : function(data) {
                    $("div", input.parent()).html(data.bonus);
                }
            });
        });
    </script>
@append