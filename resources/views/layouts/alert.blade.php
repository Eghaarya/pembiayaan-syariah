@foreach (['success', 'error'] as $msg)
    @if (session($msg))
        <div class="alert alert-{{ $msg == 'error' ? 'danger' : $msg }} alert-dismissible fade show alert-fixed-right shadow alert-animate"
            role="alert">
            {{ session($msg) }}
        </div>
    @endif
@endforeach
