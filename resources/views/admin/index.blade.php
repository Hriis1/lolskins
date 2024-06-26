<x-adminLayout>
    <div class="container">
        <div class="mt-rem-5 p-5 main-content-admin">
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
                                <td id="champTD">{{$rating['champ_name']}}</td>
                                <td id="skinTD">{{$rating['skin_name']}}</td>
                                <td id="usableTD">{{$rating['usable'] ? 'Yes' : 'No'}}</td>
                                <td id="opinionTD">{{$rating['opinion']}}</td>
                                <td id="ratingTD">{{$rating['rating'] == 0 ? '' : $rating['rating'] . '/10'}}</td>
                                <td id="best_skinTD">{{$rating['best_skin'] ? 'Yes' : 'No'}}</td>
                                <td style="min-width : 60px;">
                                    <a title="Edit" class="editBtn" data-bs-toggle="modal"
                                        data-bs-target="#opinionEditModal" data-rating-id="{{$rating['id']}}"
                                        data-rating="{{$rating['rating']}}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{ route('deleteSkinRating', ['id' => $rating['id']]) }}"
                                        method="POST" class="delete-form">
                                        @csrf
                                        <button title="Delete" class="deleteLink">
                                            <i class="fa-sharp fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br>
        <br>
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
                            <div class="mb-3">
                                <label for="champ_name_add" class="col-form-label">Champ Name:</label><br>
                                <div class="dropdown champDropDown pe-5" style="opacity: 100%;">
                                    <input type="text" class="form-control myInput champInput champ_input"
                                        name="champ_name" id="champ_name_add" placeholder="Select champ.."
                                        autocomplete="off" required>
                                    <div class="dropdown-content dropdown-content-champions">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="skin_name_add" class="col-form-label">Skin Name:</label><br>
                                <div class="dropdown skinDropDown uninteractable pe-5" style="opacity: 100%;">
                                    <input type="text" class="form-control myInput skinInput skin_input"
                                        name="skin_name" id="skin_name_add" placeholder="Select skin.." skin-url=""
                                        autocomplete="off" required>
                                    <div class="dropdown-content dropdown-content-skins">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="usable_add" class="col-form-label">Usable:</label><br>
                                <select name="usable" id="usable_add" class="usable" required>
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
                            <div>
                                <p class="text-danger" id="addOptinionError"></p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="Submit" name="submit" value="Add" id="opinionAddBtn" class="btn btn-primary">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Edit Modal -->
        <div class="modal fade" id="opinionEditModal" tabindex="1" aria-labelledby="opinionEditModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="opinionEditModalLabel">Edit skin rating</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editRatingForm" action="{{route('editSkinRating')}}" method="post">
                        @csrf
                        <input type="number" class="form-control d-none rating_id_edit" name="rating_id">
                        <div class="modal-body" id="editModalBody">
                            <div class="mb-3">
                                <label for="champ_name_edit" class="col-form-label">Champ Name:</label><br>
                                <input type="text" class="form-control myInput champ_input uninteractable"
                                    name="champ_name" id="champ_name_edit" required>
                            </div>
                            <div class="mb-3">
                                <label for="skin_name_edit" class="col-form-label">Skin Name:</label><br>
                                <input type="text" class="form-control myInput skin_input uninteractable"
                                    name="skin_name" id="skin_name_edit" required>
                            </div>
                            <div class="mb-3">
                                <label for="usable_edit" class="col-form-label">Usable:</label><br>
                                <select name="usable" id="usable_edit" class="usable" required>
                                    <option value='0' selected>No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="opinion_edit" class="col-form-label">Opinion:</label>
                                <input type="text" class="form-control" name="opinion" id="opinion_edit">
                            </div>
                            <div class="mb-3">
                                <label for="rating_edit" class="col-form-label">Rating:</label><br>
                                <select name="rating" id="rating_edit">
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
                                <label for="best_skin_edit" class="col-form-label">Best skin:</label><br>
                                <select name="best_skin" id="best_skin_edit">
                                    <option value='0' selected>No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                            <div>
                                <p class="text-danger" id="editOptinionError"></p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="Submit" name="submit" value="Edit" id="opinionEditBtn" class="btn btn-primary">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-adminLayout>
<script src="{{asset('js/searchableDropdownTables.js')}}"></script>
<script src="{{asset('js/getLoLChampsData.js')}}"></script>
<script src="{{asset('js/skinsTable.js')}}"></script>