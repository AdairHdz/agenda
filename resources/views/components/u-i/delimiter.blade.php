<div class="flex align-items-baseline">
    <p class="font-weight-bold mr-3">
        {{ $title }}
    </p>
    <div class="flex-grow-1" style="height:1px; background-color: #ccc;"></div>
</div>
<div class="border-bottom border-left border-right row p-3 {{ $styleClasses }}">
    {{ $slot }}
</div>