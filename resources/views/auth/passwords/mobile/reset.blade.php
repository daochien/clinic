@extends('layouts.app')
@section('content')
    <div class="center">
        <button type="button" onclick="openApp()">Open App</button>
    </div>
@endsection
<script>
    function openApp()
    {
        window.open("{{$resetUrl}}");
    }
    {{--sleep(1000);--}}
    {{--window.open("{{$resetUrl}}");--}}
</script>
