<x-adminLayout>
    <div class="container mt-rem-8 mb-5 p-5 main-content-admin">
        <div class="row mb-3">
            <div class="col-2">
                <button type="button" class="btn btn-primary btn-lg ms-5" data-bs-toggle="modal"
                    data-bs-target="#opinionAddModal">Add</button>
            </div>
            <div class="col-10"></div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12">
                <table id="dataSkins" class="table table-striped" style="width:100%">
                    <thead style="width: 100%;">
                        <tr>
                            <th>Champ Name</th>
                            <th>Skin Name</th>
                            <th>Usable</th>
                            <th>Opinion</th>
                            <th>Rating</th>
                            <th>Best skin</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ratings as $rating)
                        <tr>
                            <td>{{$rating['champ_name']}}</td>
                            <td>{{$rating['skin_name']}}</td>
                            <td>{{$rating['usable']}}</td>
                            <td>{{$rating['opinion']}}</td>
                            <td>{{$rating['rating']}}/10</td>
                            <td>{{$rating['best_skin']}}</td>
                            <td style="min-width : 50px;">
                                <a title="Edit" class="editBtn" data-bs-toggle="modal"
                                    data-bs-target="#opinionEditModal">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <a title="Delete" class="deleteBtn" href="">
                                    <i class="fa-sharp fa-solid fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <section id="modal-section">
        <!-- Add Modal -->
        <div class="modal fade" id="opinionAddModal" tabindex="1" aria-labelledby="opinionAddModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="opinionAddModalLabel">Add skin rating</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="addRatingForm" action="{{route('storeSkinRating')}}" method="post">
                        @csrf
                        <div class="modal-body">
                            <input type="text" class="hidden" name="user_id" id="user_id_input" value='{{$user->id}}'
                                required>
                            <div class="mb-3">
                                <label for="champ_name_add" class="col-form-label">Champ Name:</label><br>
                                <div class="dropdown pe-5" id="champDropDown" style="opacity: 100%;">
                                    <input type="text" class="form-control myInput" name="champ_name" id="champInput"
                                        placeholder="Select champ.." required>
                                    <div class="dropdown-content dropdown-content-champions">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="skin_name_add" class="col-form-label">Skin Name:</label><br>
                                <div class="dropdown uninteractable pe-5" id="skinDropDown" style="opacity: 100%;">
                                    <input type="text" class="form-control myInput" name="skin_name" id="skinInput"
                                        placeholder="Select skin.." skin-url="" required>
                                    <div class="dropdown-content dropdown-content-skins">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="usable_add" class="col-form-label">Usable:</label><br>
                                <select name="usable" id="usable_add" required>
                                    <option value='0' selected>No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="opinion_add" class="col-form-label">Opinion:</label>
                                <input type="text" class="form-control" name="opinion" id="opinion_add">
                            </div>
                            <div class="mb-3">
                                <label for="rating_add" class="col-form-label">Rating:</label><br>
                                <select name="rating" id="rating_add">
                                    <option value="0" selected></option>
                                    <option value="1">1/10</option>
                                    <option value="2">2/10</option>
                                    <option value="3">3/10</option>
                                    <option value="4">4/10</option>
                                    <option value="5">5/10</option>
                                    <option value="6">6/10</option>
                                    <option value="7">7/10</option>
                                    <option value="8">8/10</option>
                                    <option value="9">9/10</option>
                                    <option value="10">10/10</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="best_skin_add" class="col-form-label">Best skin:</label><br>
                                <select name="best_skin" id="best_skin_add">
                                    <option value='0' selected>No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="Submit" name="submit" value="Add" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-adminLayout>
<script src="{{asset('js/searchableDropdown.js')}}"></script>
<script src="{{asset('js/getLoLChampsData.js')}}"></script>
<script src="{{asset('js/skinsTable.js')}}"></script>