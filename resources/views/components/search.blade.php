<form action="{{ route('search') }}" method="GET" class="search-form">
    <input type="text" name="query" class="search-box" value="{{ request()->input('query') }}" placeholder="Search subject">
    <i class="fa fa-search search-icon"></i>
</form>
