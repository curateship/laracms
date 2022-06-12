<div class="margin-bottom-sm">
    <h4>Recommended Users</h4>
</div>
@include('components.users.lists.recommended-users', [
    'users' => \App\Models\User::getRecommendedUsers()
])

<div class="margin-top-md margin-bottom-md"></div>

<div class="margin-bottom-sm">
    <h4>Recommended Tags</h4>
</div>
@include('components.tags.lists.recommended-tags', [
    'tags' => \App\Models\Tag::getRecommendedTags()
])
