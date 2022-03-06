@php
    $classes = array();

    if ( !empty($block->stretched) && $block->stretched == 'true'){
        $classes[] = 'article-image--stretched';
    }

    if ( !empty($block->withBorder) && $block->withBorder == 'true'){
        $classes[] = 'article-image--bordered';
    }

    if ( !empty($block->withBackground) && $block->withBackground == 'true'){
        $classes[] = 'article-image--backgrounded';
    }
@endphp

<figure class="padding-y-sm article-enlil-editor-image<?= implode(' ', $classes) ?>">
    <img class="radius-sm" src="{{ $block->file['url'] }}" alt="{{ !empty($block->caption) ? $block->caption : '' }}">
    @if (!empty($block->caption))
        <footer class="article-image-caption text-gray-400 text-sm">
            {{ $block->caption }}
        </footer>
    @endif
</figure>
