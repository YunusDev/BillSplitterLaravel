{{--<table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">--}}
    {{--<tr>--}}
        {{--<td align="center">--}}
            {{--<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">--}}
                {{--<tr>--}}
                    {{--<td align="center">--}}
                        {{--<table border="0" cellpadding="0" cellspacing="0" role="presentation">--}}
                            {{--<tr>--}}
                                {{--<td>--}}
                                    {{--<a href="{{ $url }}" class="button button-{{ $color ?? 'primary' }}" target="_blank">{{ $slot }}</a>--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                        {{--</table>--}}
                    {{--</td>--}}
                {{--</tr>--}}
            {{--</table>--}}
        {{--</td>--}}
    {{--</tr>--}}
{{--</table>--}}

<table border="0" cellpadding="0" cellspacing="0" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;"><tr>
        <td style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box;">
            <a href="{{ $url }}" class="button button-green" target="_blank" style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; border-radius: 3px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); color: #ffffff; display: inline-block; text-decoration: none; -webkit-text-size-adjust: none; background-color: #2ab27b; border-top: 10px solid #2ab27b; border-right: 18px solid #2ab27b; border-bottom: 10px solid #2ab27b; border-left: 18px solid #2ab27b;">{{ $slot }}</a>
        </td>
</tr></table>
