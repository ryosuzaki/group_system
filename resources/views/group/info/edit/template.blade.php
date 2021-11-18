<form method="POST" action="{{ route('group.info.update',[$group->id,$index]) }}">
    @csrf
    @method('PUT')
    
</form>