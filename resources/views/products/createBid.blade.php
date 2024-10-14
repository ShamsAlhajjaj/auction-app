<form action="{{route('bids.store')}}" method="post">
    @csrf 
    @method('post')
    <input type="number" placeholder="price ($)" name="price">
    <button type="submit">Offer price</button>
</form>