<x-layout>
    <main>
        <div class="container">
            <div class="row mb-3">
                <div class="col d-flex justify-content-center ">
                    <img src="{{ asset('img/Logo_Transparent.png') }}" alt="" class="body-logo">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col d-flex justify-content-center">
                    <div class="dropdown">
                        <input type="text" id="myInput" placeholder="Search..">
                        <div id="myDropdown" class="dropdown-content">
                            <div>A</div>
                            <div>B</div>
                            <div>C</div>
                            <div>Another option</div>
                            <div>Something else</div>
                            <div>Last choice</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>
<script src="{{asset('js/searchableDropdown.js')}}"></script>