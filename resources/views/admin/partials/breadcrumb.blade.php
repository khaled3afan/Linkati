<ul class="breadcrumb">
    <li class="@active(route('admin.index'))"><a href="{{ route('admin.index') }}">@lang('admin.dashboard')</a></li>
    @if(isset($texts))
        <li class="@active(route($texts['route'].'.index'))"><a
                href="{{ route($texts['route'].'.index') }}">{{ the($texts['plural']) }}</a></li>
    @endif

    @if(str_is('*trashed', current_route()))
        <li class="active">@lang('admin.trash')</li>
    @elseif(str_is('*create', current_route()))
        <li class="active">@lang('admin.add-new')</li>
    @elseif(str_is('*edit', current_route()))
        <li class="active">@lang('admin.edit')</li>
    @endif
</ul>
