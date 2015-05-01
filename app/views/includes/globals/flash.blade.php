@if (($message = Session::get('flash_message', isset($flash_message) ? $flash_message : null)) !== null)
    <div class="ui column sixteen wide {{ $message['type'] or 'info' }} message">
        @if (isset($message['close']) && $message['close'])
            <i class="close icon"></i>
        @endif

        @if (isset($message['header']))
            <div class="header">
                {{{ $message['header'] or '' }}}
            </div>
        @endif

        @if (isset($errors) && $errors->all() != null)
            The following errors were encountered: <br />
            <ul class="ui list">
                @foreach ($errors->all('<li>:message</li>') as $message)
                    {{ $message }}
                @endforeach
            </ul>
        @else
            {{ $message['body'] or '' }}
        @endif
    </div>
@elseif (isset($errors) && $errors->all() != null)
    <div class="ui column sixteen wide red message">
        <i class="close icon"></i>

        <div class="header">
            The following errors were encountered:
        </div>

        <ul class="ui list">
            @foreach ($errors->all('<li>:message</li>') as $message)
                {{ $message }}
            @endforeach
        </ul>
    </div>
@endif

@section('inline-js')
    <script type="text/javascript">
        $('.message .close').on('click', function() {
            $(this).closest('.message').fadeOut();
        });
    </script>
@append