<div class="m-l-15">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="m-l-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    @if (session('success'))
        <div class="alert alert-success m-l-5">
            {{ session('success') }}
        </div>
    @endif
</div>