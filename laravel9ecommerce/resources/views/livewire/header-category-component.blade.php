<div>
    @foreach ($categories as $category)
        <li><a href="{{ route('product.category', ['slug' => $category->slug]) }}">{{ $category->name }}</a>
        </li>
    @endforeach
</div>
