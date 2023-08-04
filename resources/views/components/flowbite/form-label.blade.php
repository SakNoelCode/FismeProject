@props(['for','value'])
<label for="{{$for}}" {{$attributes->merge(['class' => 'block mb-2 text-sm font-medium text-gray-900 dark:text-white' ])}}>
    {{$value}}
</label>