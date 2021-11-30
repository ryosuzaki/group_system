<form method="POST" action="{{ route('group.store',$type) }}">
    @csrf
    <div class="form-group">
        <label for="name">名前</label>
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group">
        <label for="password">管理者パスワード</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
    </div>

    <div class="form-group">
        <label for="password-confirm">管理者パスワードを再入力</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
    </div>   

    <div class="form-group mb-0">
        <button type="submit" class="btn btn-primary btn-block">
        作成
        </button>
    </div>
</form>             