@php
    if($type === 'shops'){
        $folder = 'shops';
    }elseif($type === 'products'){
        $folder = 'products';
    }
@endphp

<div {{ $attributes->merge([
    'class' => 'overflow-hidden'
    ]) }} >
    @if(empty($filename))
        <img class="rounded-t-lg" src="{{asset('image/no_image.jpg')}}" alt="" />
    @else
        <img class="object-cover" src="{{asset('storage/' . $folder . '/' . $filename)}}">
    @endif
</div>   