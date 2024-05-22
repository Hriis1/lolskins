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
                            <div class="dropdown-choice">A</div>
                            <div class="dropdown-choice">B</div>
                            <div class="dropdown-choice">C</div>
                            <div class="dropdown-choice">Another option</div>
                            <div class="dropdown-choice">Another option 2</div>
                            <div class="dropdown-choice">Something else</div>
                            <div class="dropdown-choice">Last choice</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>
<script src="{{asset('js/searchableDropdown.js')}}"></script>