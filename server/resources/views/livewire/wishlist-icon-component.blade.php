@livewireStyles
@if(Auth::check())
<div class="header-action-icon-2">
    <a href="{{route('user.wishlist')}}">
        <img class="svgInject" alt="Surfside Media"  src="{{asset('assets/imgs/theme/icons/like.png')}}">
        @if(Auth::user()->wishes && Auth::user()->wishes->count() > 0)    
            <span class="pro-count blue">{{Auth::user()->wishes->count()}}</span>
        @endif
    </a>
</div>
@endif
@livewireScripts