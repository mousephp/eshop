
<ul class="dropdown sub-dropdown border-0 shadow">
    @foreach($childs as $child)
    <li>
     <a href="{{route('product-sub-cat',[$category->slug,$child->slug])}}">{{ $child->name }}</a>  
        @if(count($child->children))
            @include('frontend.layouts.subCategoryList',['childs' => $child->children])
        @endif
    </li>
    @endforeach
</ul>
