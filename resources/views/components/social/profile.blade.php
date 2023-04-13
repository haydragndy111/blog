@if (!empty($author->facebookProfile()))
    <a href="{{ $author->facebookProfile() }}">
        <x-fab-facebook-f class="h-4 text-theme-blue-200" />
    </a>
@endif

@if (!empty($author->twitterProfile()))
    <a href="{{ $author->twitterProfile() }}">
        <x-fab-twitter class="h-4 text-theme-blue-200" />
    </a>
@endif

@if (!empty($author->instagramProfile()))
    <a href="{{ $author->instagramProfile() }}">
        <x-fab-instagram-square class="h-4 text-theme-blue-200" />
    </a>
@endif

@if (!empty($author->linkedinProfile()))
    <a href="{{ $author->linkedinProfile() }}">
        <x-fab-linkedin-in class="h-4 text-theme-blue-200" />
    </a>
@endif
