<div class="container">
    <div class="row">
        <div class="offset-md-4 col-md-8 text-center">
            <div class="confirmation-box p-4" style="max-width: 400px;">
                <h4 class="pb-3">Bạn có muốn xoá không?</h4>
                <button type="button" class="btn btn-secondary" wire:click="cancelDelete">Trở lại</button>
                <button type="button" class="btn btn-danger" wire:click="deleteAuthor">Xoá</button>
            </div>
        </div>
    </div>
    @if(Session::has('message'))
        <div class="col-md-18 text-center" role="alert">{{Session::get('message')}}</div>
    @endif
    @livewireScripts
</div>



<style>
    .confirmation-box {
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f8f9fa; 
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
</style>
