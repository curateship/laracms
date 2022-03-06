@php
    if (property_exists($block, 'level')) {
        $level = $block->{'level'};
    }

    $centerClass = 'padding-y-md';

    switch ($level) {
        case '1':
        case '3':
        case '4':
        case '5':
        case '6':
            $tag = 'h' . $block->{'level'};
            break;
        default:
            $tag = 'h2';
    };
@endphp

<div class="editor-js-heading">
<!-- Create block tag -->
<{{$tag}} class={{$centerClass}}>
{{$block->text}}
</{{$tag}}>
</div>