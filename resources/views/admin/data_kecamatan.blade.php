@include('admin/header')
@include('admin/sidebar')
<div class="content-wrapper">
<div class="p-4">
    <a href="/create_katalog" type="button" class="btn btn-primary mb-3">Tambah Data Kecamatan</a>
    <table class="table table-striped p-3">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Kecamatan</th>
                <th scope="col">Luas Kecamatan</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach($kecamatan as $cmt) : ?>
            <tr>
                <th scope="row"> <?= $no ?> </th>
                <td><?= $ktg['namaKecamatan'] ?></td>
                <td><?= $ktg['luasKecamatan'] ?></td>
                <td>
                    <div class="d-flex">
                        <a class="btn btn-warning mr-3" href="/edit_kecamatan/<?= $cmt['idKecamatan'] ?>">Edit</a>
                            <form action="/delete_kecamatan/<?= $cmt['idKecamatan'] ?>" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                    </div>
                </td>
            </tr>
            <?php $no++; endforeach;?>
        </tbody>
    </table>
</div>
</div>
<!-- /.container-fluid -->
<!-- End of Main Content -->

<!--modal-->
<!-- Button trigger modal -->

@include('admin/footer')