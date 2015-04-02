@section('content')
    <h1 class="ui red header">Pyro's Character Sheet - Jocelyn</h1>

    <div class="ui divider"></div>

    <div class="ui divided equal height row">
        <div class="three wide column">
            <div class="ui segment">
                <img src="{{ asset('images/dnd_character.jpg') }}" class="ui centered rounded image">
                <div class="ui mini buttons pic-ops">
                    <div class="ui blue button">Edit</div>
                    <div class="or"></div>
                    <div class="ui red button">Delete</div>
                </div>
            </div>
        </div>
        <div class="nine wide column">
            @include('includes.sheets.class_dropdowns')
        </div>
        <div class="four wide column">
            <div class="ui form">
                <div class="field">
                    {{ Form::label('backstory', 'Backstory') }}
                    {{ Form::textarea('backstory') }}
                </div>
            </div>
        </div>
    </div>

    <div class="ui divider"></div>

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
                    <div class="six wide column">
                        @include('includes.sheets.skills')
                    </div>

                    <!-- Misc -->
                    <div class="four wide column">
                        @include('includes.sheets.misc')
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop