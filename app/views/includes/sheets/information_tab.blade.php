<div class="ui tab" data-tab="information">

    <div class="row">
        <div class="ui sixteen wide column">
            <div class="ui center aligned divided stackable grid">
                    <div class="twelve wide column">
                        <!-- Character Information -->
                        @include('includes.sheets.backstory')
                    </div>
                    <!-- Misc -->
                    <div class="four wide column">
                        @include('includes.sheets.misc')
                    </div>
            </div>
        </div>
    </div>
</div>

@section('inline-js')
    <script type="text/javascript">
        var save_features = debounce(function()
        {
            var params = {
                'features' : $("#traits").val(),
                'sheet' : "{{ $sheet->id }}"
            };

            $.ajax({
                type : "PATCH",
                data : params,
                url : "{{ action('User\CharacterController@patchFeatures') }}",
                success : function(data) {

                }
            });
        }, 250);

        $("#traits").on("change", save_features);

        var save_info = debounce(function()
        {
            var params = {
                'field' : $(this).attr('name'),
                'value' : $(this).val(),
                'sheet' : "{{ $sheet->id }}"
            };

            console.log(params);
            $.ajax({
                type : "PATCH",
                data : params,
                url : "{{ action('User\CharacterController@patchInfo') }}",
                success : function(data) {

                }
            });
        }, 250);

        $("#char_info input").on("change", save_info);
        $("#backstory").on("change", save_info);
        $("#misc textarea").on("change", save_info);
    </script>
@append