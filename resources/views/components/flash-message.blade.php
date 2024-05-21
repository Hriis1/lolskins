<style>
    .fixed-top-container {
        position: fixed;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 30%;
        z-index: 1000;
    }
</style>

@if(session()->has('messageError'))
<div class="fixed-top-container">
    <div x-data="{ showAlert: true }" x-init="setTimeout(() => showAlert = false, 3000)" x-show="showAlert"
        class="alert alert-danger text-center">
        <p class="mb-0">
            {{ session('messageError') }}
        </p>
    </div>
</div>
@endif

@if(session()->has('messageSuccess'))
<div class="fixed-top-container">
    <div x-data="{ showAlert: true }" x-init="setTimeout(() => showAlert = false, 3000)" x-show="showAlert"
        class="alert alert-success text-center">
        <p class="mb-0">
            {{ session('messageSuccess') }}
        </p>
    </div>
</div>
@endif