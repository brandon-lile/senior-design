<div class="ui active tab" data-tab="stats">

    <div class="row">
        <div class="ui three column divided equal height grid">
            <div class="column">
                <h2 class="ui header">Stats</h2>
                @include('includes.sheets.stats')
                @include('includes.sheets.equipment')
            </div>

            <div class="column">
                <div class="ui left labeled input">
                        <div class="ui red label">
                            {{ Form::label('inspiration') }}
                        </div>
                        <div class="ui mini toggle checkbox insp-checkbox">
                            {{ Form::checkbox('inspiration', ($sheet->insp) ? 1 : 0 , ($sheet->insp) ? true : false) }}
                        </div>

                </div>
                <br /><br />
                <div class="ui left labeled input">
                    <div class="ui red label">
                        Proficiency <br> Bonus
                    </div>
                    {{ Form::number('prof_bonus', $sheet->charactergeneral->proficiency_bonus, array('id' => 'proficiency_bonus')) }}
                </div>
                @include('includes.sheets.throws')
                @include('includes.sheets.treasure')
            </div>

            <div class="column">
                @include('includes.sheets.hp')
                @include('includes.sheets.skills')
            </div>
        </div>
    </div>
</div>

@section('inline-js')
    <script type="text/javascript">
        $("input[name=inspiration]").on("change", function()
        {
            $.ajax({
                type: "PATCH",
                url: "{{ url('character/patchInspiration') }}/{{ $sheet->id }}/" + ((parseInt($("#inspiration").val())) ? 0 : 1),
                success: function(data){
                    $(this).val(data);
                }
            });
        });
    </script>
@append