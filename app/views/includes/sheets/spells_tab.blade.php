<div class="ui tab" data-tab="spells">

    <div class="row">
        <div class="ui sixteen wide column">
            <div class="ui center aligned divided grid">
                <div class="equal height row">
                    <div class="sixteen wide column">
                        <div class="ui blue raised segment">
                            <h2 class="ui header">Spell Information</h2>
                            <div class="ui form">
                                <div class="fields">
                                    <div class="four wide field">
                                        {{ Form::label('spell_class', 'Spell Casting Class') }}
                                        {{ Form::text('spell_class') }}
                                    </div>
                                    <div class="four wide field">
                                        {{ Form::label('spell_ability', 'Spell Casting Ability') }}
                                        {{ Form::text('spell_ability') }}
                                    </div>
                                    <div class="four wide field">
                                        {{ Form::label('spell_save', 'Spell Save DC') }}
                                        {{ Form::text('spell_save',8) }}
                                    </div>
                                    <div class="four wide field">
                                        {{ Form::label('spell_bonus', 'Spell Attack Bonus') }}
                                        {{ Form::number('spell_bonus',8) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="ui sixteen wide column">
            <div class="ui center aligned divided grid">
                <div class="equal height row">
                    <div class="five wide column">
                        <div class="ui raised red segment">
                            <h3 class="ui red header">Cantrips</h3>
                            <div class="ui segment equipment-list">
                                <div class="ui divided list">
                                    <div class="item">
                                        <div class="right floated compact mini red ui button">Desc</div>
                                        <div class="content">
                                            <div class="header">Light </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="right floated compact mini red ui button">Desc</div>
                                        <div class="content">
                                            <div class="header">Viscious Mockery</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <br><br>

                        <div class="ui raised red segment">
                            <h3 class="ui red header">Level: 1</h3>
                            Slots Expended
                            <div class="ui right labeled left icon input">
                                {{ Form::number('used', 0) }}
                                <div class="ui tag label">
                                    Total: 4
                                </div>
                            </div>
                            <div class="ui segment equipment-list">
                                <div class="ui divided list">
                                    <div class="item">
                                        <div class="right floated compact mini red ui button">Desc</div>
                                        <div class="content">
                                            <div class="header">
                                                <div class="ui checkbox">
                                                    <input type="checkbox">
                                                    <label>Detect Magic</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="right floated compact mini red ui button">Desc</div>
                                        <div class="content">
                                            <div class="header">
                                                <div class="ui checkbox">
                                                    <input type="checkbox">
                                                    <label>Cure Wounds</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br><br>

                        <div class="ui raised red segment">
                            <h3 class="ui red header">Level: 2</h3>
                            Slots Expended
                            <div class="ui right labeled left icon input">
                                {{ Form::number('used', 0) }}
                                <div class="ui tag label">
                                    Total: 3
                                </div>
                            </div>
                            <div class="ui segment equipment-list">
                                <div class="ui divided list">
                                    <div class="item">
                                        <div class="right floated compact mini red ui button">Desc</div>
                                        <div class="content">
                                            <div class="header">
                                                <div class="ui checkbox">
                                                    <input type="checkbox">
                                                    <label>Invisibility</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="right floated compact mini red ui button">Desc</div>
                                        <div class="content">
                                            <div class="header">
                                                <div class="ui checkbox">
                                                    <input type="checkbox">
                                                    <label>Dispel Magic</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="five wide column">
                        <div class="ui raised red segment">
                            <h3 class="ui red header">Level: 3</h3>
                            Slots Expended
                            <div class="ui right labeled left icon input">
                                {{ Form::number('used', 0) }}
                                <div class="ui tag label">
                                    Total: 3
                                </div>
                            </div>
                            <div class="ui segment equipment-list">
                                <div class="ui divided list">
                                    <div class="item">
                                        <div class="right floated compact mini red ui button">Desc</div>
                                        <div class="content">
                                            <div class="header">
                                                <div class="ui checkbox">
                                                    <input type="checkbox">
                                                    <label>Bestow Curse</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="right floated compact mini red ui button">Desc</div>
                                        <div class="content">
                                            <div class="header">
                                                <div class="ui checkbox">
                                                    <input type="checkbox">
                                                    <label>Fireball</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br><br>

                        <div class="ui raised red segment">
                            <h3 class="ui red header">Level: 4</h3>
                            Slots Expended
                            <div class="ui right labeled left icon input">
                                {{ Form::number('used', 0) }}
                                <div class="ui tag label">
                                    Total: 3
                                </div>
                            </div>
                            <div class="ui segment equipment-list">
                                <div class="ui divided list">
                                    <div class="item">
                                        <div class="right floated compact mini red ui button">Desc</div>
                                        <div class="content">
                                            <div class="header">
                                                <div class="ui checkbox">
                                                    <input type="checkbox">
                                                    <label>Conjure Woodland Being</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="right floated compact mini red ui button">Desc</div>
                                        <div class="content">
                                            <div class="header">
                                                <div class="ui checkbox">
                                                    <input type="checkbox">
                                                    <label>Protection from Energy</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br><br>

                        <div class="ui raised red segment">
                            <h3 class="ui red header">Level: 5</h3>
                            Slots Expended
                            <div class="ui right labeled left icon input">
                                {{ Form::number('used', 0) }}
                                <div class="ui tag label">
                                    Total: 3
                                </div>
                            </div>
                            <div class="ui segment equipment-list">
                                <div class="ui divided list">
                                    <div class="item">
                                        <div class="right floated compact mini red ui button">Desc</div>
                                        <div class="content">
                                            <div class="header">
                                                <div class="ui checkbox">
                                                    <input type="checkbox">
                                                    <label>Banishing Smite</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="right floated compact mini red ui button">Desc</div>
                                        <div class="content">
                                            <div class="header">
                                                <div class="ui checkbox">
                                                    <input type="checkbox">
                                                    <label>Geas</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="five wide column">
                        <div class="ui raised red segment">
                            <h3 class="ui red header">Level: 6</h3>
                            Slots Expended
                            <div class="ui right labeled left icon input">
                                {{ Form::number('used', 0) }}
                                <div class="ui tag label">
                                    Total: 2
                                </div>
                            </div>
                            <div class="ui segment equipment-list">
                                <div class="ui divided list">
                                    <div class="item">
                                        <div class="right floated compact mini red ui button">Desc</div>
                                        <div class="content">
                                            <div class="header">
                                                <div class="ui checkbox">
                                                    <input type="checkbox">
                                                    <label>True Seeing</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br><br>

                        <div class="ui raised red segment">
                            <h3 class="ui red header">Level: 7</h3>
                            Slots Expended
                            <div class="ui right labeled left icon input">
                                {{ Form::number('used', 0) }}
                                <div class="ui tag label">
                                    Total: 2
                                </div>
                            </div>
                            <div class="ui segment equipment-list">
                                <div class="ui divided list">
                                    <div class="item">
                                        <div class="right floated compact mini red ui button">Desc</div>
                                        <div class="content">
                                            <div class="header">
                                                <div class="ui checkbox">
                                                    <input type="checkbox">
                                                    <label>Mordenkainen's Sword</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br><br>

                        <div class="ui raised red segment">
                            <h3 class="ui red header">Level: 8</h3>
                            Slots Expended
                            <div class="ui right labeled left icon input">
                                {{ Form::number('used', 0) }}
                                <div class="ui tag label">
                                    Total: 2
                                </div>
                            </div>
                            <div class="ui segment equipment-list">
                                <div class="ui divided list">
                                    <div class="item">
                                        <div class="right floated compact mini red ui button">Desc</div>
                                        <div class="content">
                                            <div class="header">
                                                <div class="ui checkbox">
                                                    <input type="checkbox">
                                                    <label>Power Word Stun</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="right floated compact mini red ui button">Desc</div>
                                        <div class="content">
                                            <div class="header">
                                                <div class="ui checkbox">
                                                    <input type="checkbox">
                                                    <label>Feeblemind</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <br><br>

                        <div class="ui raised red segment">
                            <h3 class="ui red header">Level: 9</h3>
                            Slots Expended
                            <div class="ui right labeled left icon input">
                                {{ Form::number('used', 0) }}
                                <div class="ui tag label">
                                    Total: 1
                                </div>
                            </div>
                            <div class="ui segment equipment-list">
                                <div class="ui divided list">
                                    <div class="item">
                                        <div class="right floated compact mini red ui button">Desc</div>
                                        <div class="content">
                                            <div class="header">
                                                <div class="ui checkbox">
                                                    <input type="checkbox">
                                                    <label>Power Word Heal</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="right floated compact mini red ui button">Desc</div>
                                        <div class="content">
                                            <div class="header">
                                                <div class="ui checkbox">
                                                    <input type="checkbox">
                                                    <label>True Polymorph</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>