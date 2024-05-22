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
                    <div class="dropdown pe-5">
                        <input type="text" class="myInput" placeholder="Select champ..">
                        <div class="dropdown-content">
                            <div class="dropdown-choice-champ">A</div>
                            <div class="dropdown-choice-champ">B</div>
                            <div class="dropdown-choice-champ">C</div>
                            <div class="dropdown-choice-champ">Another option</div>
                            <div class="dropdown-choice-champ">Another option 2</div>
                            <div class="dropdown-choice-champ">Something else</div>
                            <div class="dropdown-choice-champ">Last choice</div>
                        </div>
                    </div>

                    <div class="dropdown">
                        <input type="text" class="myInput" placeholder="Select champ..">
                        <div class="dropdown-content">
                            <div class="dropdown-choice-champ">Gosho</div>
                            <div class="dropdown-choice-champ">Tosho</div>
                            <div class="dropdown-choice-champ">Santosho</div>
                            <div class="dropdown-choice-champ">Losho</div>
                            <div class="dropdown-choice-champ">Pipi</div>
                            <div class="dropdown-choice-champ">pupu</div>
                            <div class="dropdown-choice-champ">Gago</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layout>
<script src="{{asset('js/searchableDropdown.js')}}"></script>