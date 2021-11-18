<form method="POST" action="{{ route('info_base.info.update',[$base->id]) }}">
    @csrf
    @method('PUT')
    
</form>