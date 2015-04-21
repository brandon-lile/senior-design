<div class="ui active tab" data-tab="stats">

    <div class="row">
        <div class="ui sixteen wide column">
            <div class="ui center aligned divided grid">
                <div class="equal height row">

                    <div class="six wide column">
                        <div class="ui center aligned grid">
                            <div class="ui divided equal height row">
                                <!-- Stats -->
                                <div class="five wide column">
                                    <h2 class="ui header">Stats</h2>
                                    @include('includes.sheets.stats')
                                </div>

                                <!-- Throws -->
                                <div class="eleven wide column">
                                    <div class="ui left labeled input">
                                        <div class="ui red label">
                                            Inspiration
                                        </div>
                                        {{ Form::number('inspiration', 0) }}
                                    </div>
                                    <br /><br />
                                    <div class="ui left labeled input">
                                        <div class="ui red label">
                                            Proficiency Bonus
                                        </div>
                                        {{ Form::number('prof_bonus', 0) }}
                                    </div>
                                    @include('includes.sheets.throws')
                                </div>
                            </div>

                            <div class="ui sixteen wide column">
                                @include('includes.sheets.equipment')
                            </div>
                        </div>
                    </div>

                    <!-- Skills -->
                    <div class="seven wide column">
                        @include('includes.sheets.hp')
                        @include('includes.sheets.skills')
                    </div>

                    <!-- Features and Traits -->
                    <div class="three wide column">
                        <div class="ui form">
                            <div class="field">
                                {{ Form::label('traits', 'Features and Traits') }}
                                {{ Form::textarea('traits') }}
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>