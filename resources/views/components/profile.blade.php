<section class="card">
    <h2 class="card-header">Profile</h2>
    <div class="row">
        <div class="col" style="text-align: center">
            @if ($user->avatar)
            <img src="{{\Storage::disk('public')->url($user->avatar)}}
            " style="width: 18em;" />
            @endif

            @isset($is_home)
            <form method="POST" action="/home/avatar" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <button class="btn btn-primary">Submit</button>
                <input type="file" name="avatar"/>
            </form>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col">
            @isset($is_home)
            <form method="POST" action="/home/profile" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <textarea name="profile" style="width: 100%; height: 20em;">{{$user->profile}}</textarea>
                <button class="btn btn-primary">Submit</button>
            </form>
            @else
                {{$user->profile}}
            @endif
        </div>
    </div>
</section>
