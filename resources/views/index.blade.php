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
                    <div class="dropdown champDropDown pe-5">
                        <input type="text" class="myInput champInput" placeholder="Select champ.." autocomplete="off">
                        <div class="dropdown-content dropdown-content-champions">
                        </div>
                    </div>

                    <div class="dropdown skinDropDown uninteractable pe-5">
                        <input type="text" class="myInput skinInput" placeholder="Select skin.." skin-url="" autocomplete="off">
                        <div class="dropdown-content dropdown-content-skins">
                        </div>
                    </div>

                    <div class="skin-container">
                        <div class="skin-image-container p-1">
                            <img id="skinImg" src="{{ asset('img/empty.png') }}" alt="">
                        </div>
                        <div class="skin-text-container">
                            <h2 class="skin-title"></h2>
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
<script src="{{asset('js/searchableDropdownMain.js')}}"></script>
<script src="{{asset('js/getLoLChampsData.js')}}"></script>
<script src="{{asset('js/index.js')}}"></script>