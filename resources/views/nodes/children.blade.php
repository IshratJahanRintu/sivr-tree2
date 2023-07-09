@if ($children->count() > 0)
    <ul style="display: none">
        @foreach ($children as $child)
            <li data-node-id={{$child->id}}>
                <span class="node-name" > {{ $child->title }}</span>
                @include('nodes.children', ['children' => $child->children])
            </li>
        @endforeach
    </ul>
@endif
