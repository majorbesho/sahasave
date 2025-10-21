<div class="user-card user-prof">
    <div class="avatar-upload">
        <div class="obj-el"><img src="{{asset('frontend2/assets/images/elements/team-obj.png')}}" alt="image"></div>
        <div class="avatar-edit">
            <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
            <label for="imageUpload"></label>
        </div>
        <div class="avatar-preview">
            <div id="imagePreview" style="background-image: url({{$user->photo}});">
            </div>
        </div>
    </div>
    <h3 class="user-card__name">{{$user->name}}</h3>
    {{-- <span class="user-card__id">ID : {{$user->id}}</span>
    <span class="user-card__id">email : {{$user->email}}</span> --}}
</div>
