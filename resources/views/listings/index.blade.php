<x-layout>
    @include('partials.__hero')
    @include('partials.__search')
    @if (count($Listings)>0)
        <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
            @foreach ($Listings as $listing)
                <x-listing_cards :listing="$listing" />
            @endforeach
        </div>
    @else
        <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
            <p>No data Found</p>
        </div>
    @endif
    <div class="mt-6 p-4">
        {{ $Listings->links() }}
    </div>
</x-layout>
