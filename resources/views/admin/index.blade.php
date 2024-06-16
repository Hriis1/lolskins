<x-adminLayout>
    <div class="container mt-rem-8 mb-5 p-5 main-content-admin">
        <div class="row mb-3">
            <div class="col-2">
                <button type="button" class="btn btn-primary btn-lg ms-5">Add</button>
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
                        <td>{{$rating['champ_name']}}</td>
                        <td>{{$rating['name']}}</td>
                        <td>{{$rating['usable']}}</td>
                        <td>{{$rating['opinion']}}</td>
                        <td>{{$rating['rating']}}/10</td>
                        <td>{{$rating['best_skin']}}</td>
                        <td style="min-width : 50px;">
                            <a title="Edit" class="editBtn" data-bs-toggle="modal" data-bs-target="#machineEditModal"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            <a title="Delete" class="deleteBtn" href=""><i class="fa-sharp fa-solid fa-trash"></i></a>
                        </td>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-adminLayout>
<script src="{{asset('js/skinsTable.js')}}"></script>