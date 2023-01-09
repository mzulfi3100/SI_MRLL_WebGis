@include('admin/header')
@include('admin/sidebar')
<div class="content-wrapper">
    <div class="p-4">
        <a href="{{ route('kecamatan.create') }}" type="button" class="btn btn-primary mb-3">Tambah Data Kecamatan</a>
        <table class="table table-striped p-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kecamatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kecamatans as $kec)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $kec->namaKecamatan }}</td>
                    <td>
                        <form action="{{ route('kecamatan.destroy',$kec->id) }}" method="POST">
            
                            <a class="btn btn-primary" href="{{ route('kecamatan.edit',$kec->id) }}">Edit</a>
        
                            @csrf
                            @method('DELETE')
            
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    <td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-center">
            {!! $kecamatans->links() !!}
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<!-- End of Main Content -->

<!--modal-->
<!-- Button trigger modal -->

@include('admin/footer')