<div class="ui tab" data-tab="information">

    <div class="row">
        <div class="ui sixteen wide column">
            <div class="ui center aligned divided grid">
                <div class="equal height row">
                    <div class="twelve wide column">
                        <!-- Features and Traits -->
                        <div class="ui green raised segment">
                            <div class="ui form">
                                <div class="field">
                                    {{ Form::label('traits', 'Features and Traits') }}
                                    {{ Form::textarea('traits') }}
                                </div>
                            </div>
                        </div>
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
</div>