<style>
    .search-style-1 {
        text-align: left; 
    }

    .search-style-1 form {
        display: inline-block;
    }

    .search-style-1 input[type="text"] {
        width: 600px;
        padding: 10px;
    }
</style>

<div class="search-style-1">
    <form action="{{ route('product.search') }}">
        <input type="text" name="q" placeholder="Tìm kiếm sản phẩm..." value="{{ $q }}">
    </form>
</div>
