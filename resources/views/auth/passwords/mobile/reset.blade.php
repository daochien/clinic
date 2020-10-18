@extends('layouts.app')
@section('content')
@endsection
<script>
    var tid = setInterval(function() {
        if (document.readyState !== 'complete') return;
        clearInterval(tid);
        window.open("{{$resetUrl}}");
    }, 100);
</script>
