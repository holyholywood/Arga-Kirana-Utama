<?= $this->extend('Layout/template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-lg-2 d-md-block mt-3">
            <form action="/AdminController/rekaptanggal" method="post">
                <h5 class="form-label mb-3">Data per tanggal</h5>
                <div class="form-group mb-2">
                    <input class="form-control" type="date" value="" name="inputtgl" value="">
                </div>
                <button type="submit" class="btn btn-outline-secondary form-group form-control">
                    OK
                </button>
            </form>
        </div>
        <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Data keluar-Masuk Barang</h1>
            </div>
            <div class="d-flex justify-content-between">
                <?php if ($dataBytanggal) : ?>
                    Data Tanggal : <?= $dataBytanggal ?>
                <?php endif; ?>
            </div>
            <div class="table-responsive text-center">
                <table class="table table-bordered table-sm">
                    <thead class="align-middle table-bordered">
                        <tr>
                            <th rowspan="2">No. </th>
                            <th rowspan="2">Hari/tanggal</th>
                            <th rowspan="2">Nama Barang</th>
                            <th colspan="3">Jumlah</th>
                            <th rowspan="2">Keterangan</th>
                        </tr>
                        <tr>
                            <td>Masuk</td>
                            <td>Keluar</td>
                            <td>Stock</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i =  1; ?>
                        <?php foreach ($data as $d) : ?>
                            <tr>
                                <td><?= $i++ . "." ?></td>
                                <?php $date = strtotime($d['tanggal']);
                                $tanggal = date("l, d-m-Y", $date);
                                ?>
                                <td><?= $tanggal ?>
                                    <button type="button" class="button-checkout button-edit ml-2" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap" data-bs-id="<?= $d['id_transaksi']; ?>" data-bs-barang="" data-bs-jumlah="" data-bs-title=" Data Keluar " data-bs-labeljumlah="Keluar " data-bs-action="#" data-toggle="tooltip" data-placement="bottom" title="Edit tangga">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                        </svg>
                                    </button>
                                </td>
                                <td><?= $d['namabarang']; ?></td>
                                <td><?= ($d['masuk']) ? $d['masuk'] : '-' ?></td>
                                <td><?= ($d['keluar']) ? $d['keluar'] : '-' ?></td>
                                <td><?= $d['stock']; ?></td>
                                <td><?= $d['tr_keterangan'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                </table>
            </div>

        </div>
    </div>
</div>
<!-- modal In -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Keluarkan Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form action="" method="post" class="post">
                        <div class="row mb-2">
                            <input type="hidden" class="id" name="id" value="">
                            <div class="col">
                                <label for="recipient-name" class="col-form-label">Material :</label>
                                <input type="text" class="form-control material" name="material" value="">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4">
                                <label for="recipient-name" class="col-form-label" id="label-jumlah"></label>
                                <input type="number" class="form-control jumlah" min="1" placeholder="1" name="jumlah">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-8">
                                <label class="form-label">Tanggal</label>
                                <div class="form-group">
                                    <input class="form-control" type="date" value="" name="InputTgl" value="">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <label for="message-text" class="col-form-label">Keterangan: </label>
                                <textarea class="form-control keterangan" name="keterangan"></textarea>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- modalEnd  -->
<?= $this->endSection() ?>