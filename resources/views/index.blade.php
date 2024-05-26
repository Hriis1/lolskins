<x-layout>
        <div class="container">
            <div class="row mb-3">
                <div class="col d-flex justify-content-center ">
                    <img src="{{ asset('img/Logo_Transparent.png') }}" alt="" class="body-logo">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col d-flex justify-content-center">
                    <div class="main-content d-flex justify-content-center align-items-center p-5 mb-5">
                        <div class="dropdown pe-5" id="champDropDown">
                            <input type="text" class="myInput" id="champInput" placeholder="Select champ..">
                            <div class="dropdown-content">
                                <div class="dropdown-choice">A</div>
                                <div class="dropdown-choice">B</div>
                                <div class="dropdown-choice">C</div>
                                <div class="dropdown-choice">Another option</div>
                                <div class="dropdown-choice">Another option 2</div>
                                <div class="dropdown-choice">Something else</div>
                                <div class="dropdown-choice">Last choice</div>
                            </div>
                        </div>

                        <div class="dropdown uninteractable pe-5" id="skinDropDown">
                            <input type="text" class="myInput" id="skinInput" placeholder="Select skin..">
                            <div class="dropdown-content">
                                <div class="dropdown-choice">Gosho</div>
                                <div class="dropdown-choice">Tosho</div>
                                <div class="dropdown-choice">Santosho</div>
                                <div class="dropdown-choice">Losho</div>
                                <div class="dropdown-choice">Pipi</div>
                                <div class="dropdown-choice">pupu</div>
                                <div class="dropdown-choice">Gago</div>
                            </div>
                        </div>

                        <div class="skin-container">
                            <div class="skin-image-container">
                                <img src="path/to/your/image.png" alt="">
                            </div>
                            <div class="skin-text-container">
                                <h2 class="skin-title">Battle Queen Katarina</h2>
                                <p class="description">Busted skin! Lorem ipsum dolor sit amet consectetur adipisicing
                                    elit.
                                    Fuga quod debitis consectetur corrupti nemo. Veritatis, amet?.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-layout>
<script src="{{asset('js/searchableDropdown.js')}}"></script>
<script src="{{asset('js/getLoLChampsData.js')}}"></script>