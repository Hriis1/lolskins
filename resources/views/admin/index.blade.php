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
                            <td>{{$rating['name']}}</td>
                            <td>{{$rating['usable']}}</td>
                            <td>{{$rating['opinion']}}</td>
                            <td>{{$rating['rating']}}/10</td>
                            <td>{{$rating['best_skin']}}</td>
                            <td style="min-width : 50px;">
                                <a title="Edit" class="editBtn" data-bs-toggle="modal" data-bs-target="#opinionEditModal">
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
                        <h1 class="modal-title fs-5" id="opinionAddModalLabel">Add skin opinion</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="addMachineForm" action="/machines/store" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="brand_input_add" class="col-form-label">Champ Name:</label>
                                <input type="text" class="form-control" name="brand" id="brand_input_add" required>
                            </div>
                            <div class="mb-3">
                                <label for="model_input_add" class="col-form-label">Skin Name:</label>
                                <input type="text" class="form-control" name="model" id="model_input_add" required>
                            </div>
                            <div class="mb-3">
                                <label for="serial_number_input_add" class="col-form-label">Usable:</label>
                                <input type="text" class="form-control" name="serial_number"
                                    id="serial_number_input_add" required>
                                <p id="serial_number_errorText_add" class="text-danger"></p>
                            </div>
                            <div class="mb-3">
                                <label for="version_input_add" class="col-form-label">Opinion:</label>
                                <input type="text" class="form-control" name="software_version" id="version_input_add"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="price_input_add" class="col-form-label">Rating:</label>
                                <input type="number" class="form-control" name="price" id="price_input_add" step="any"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="client_input" class="col-form-label">Best skin:</label>
                                <select type="text" class="form-control" name="client_id" id="client_input" required>
                                    <option value="" selected disabled></option>
                                    <?php
                                    // $clients = \App\Models\Client::where('deleted', false)->latest()->get();
                                    ?>
                                    {{-- @foreach ( $clients as $client)
                                    <option value={{$client["id"]}}> {{$client["firm_name"]}}({{$client["ENK"]}})
                                    </option>
                                    @endforeach --}}
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
<script src="{{asset('js/skinsTable.js')}}"></script>
