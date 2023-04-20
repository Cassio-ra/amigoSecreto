<div class="flex col-span-6 col-start-4 grid grid-cols-6 mt-[1em]">
    <button class="col-span-2 text-center p-2 rounded-l-lg w-full h-full border hover:bg-gray-200 hover:border hover:border-black">
        Lorem Ipsum
    </button>
    <a href="{{ route('home') }}" class="col-span-2 text-center p-2 w-full h-full border hover:bg-gray-200 hover:border hover:border-black">
        @if (request()->routeIs(['home']))
            <i class="fi fi-sr-home"></i>
        @else
            <i class="fi fi-rr-home"></i>
        @endif
    </a>
    <a href="{{ route('sorteio.index') }}" class="col-span-2 text-center p-2 rounded-r-lg w-full h-full border hover:bg-gray-200 hover:border hover:border-black">
        @if (explode('.', request()->route()->getName())[0] == 'sorteio')
            <i class="fi fi-sr-dice-alt"></i>
        @else
            <i class="fi fi-rr-dice-alt"></i>
        @endif
    </a>
</div>