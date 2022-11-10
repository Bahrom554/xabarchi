 <table id="example" class="table table-striped table-bordered" style="width:100%; ">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Parent</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($categories->count()>0)
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id}}</td>
                            <td class="text-truncate">{{$category->name}}</td>
                            <td class="text-truncate">{{$category->slug}}</td>
                            <td class="text-truncate">@if($category->category) {{$category->category->name}}@endif </td>
                            <td>
                                <div
                                    class="  table-actions d-flex align-items-center justify-content-evenly gap-3 fs-4">
                                    <a href="{{route('category.edit',$category->id)}}" class="text-warning"
                                        title="Edit"><i class="bi bi-pencil-fill"></i></a>
                                    <form method="POST" action="{{route('category.destroy',$category->id)}}">
                                        @method('delete')
                                        @csrf
                                        <input name="url" hidden value="{{$categories->currentPage()}}">
                                        <a href="#" style="color: red;" onclick="event.preventDefault();
                                        this.closest('form').submit();"><i class="bi bi-trash-fill"></i></a>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>NO</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Parent</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            
            <div class="d-flex align-items-center justify-content-end">
                {{ $categories->links() }}
            </div>
        