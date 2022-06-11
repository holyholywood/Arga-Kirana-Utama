<?= $this->extend('Layout/template') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <main class="col">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h1">Dashboard</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                        <a href="/add" class="btn btn-sm btn-outline-secondary">Tambah +</a>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <h2>Data Stock Material</h2>
                <?php if (session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= session()->getFlashdata('pesan') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
            </div>
            <div class="table-responsive text-center">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th style="width:10px">No. </th>
                            <th>Material</th>
                            <th>Jumlah</th>
                            <th>Satuan</th>
                            <?php if (in_groups(1) || in_groups(3)) : ?>
                                <th>Budget</th>
                                <th>Real</th>
                            <?php endif; ?>
                            <th>Approval</th>
                            <th>Status</th>
                            <th>Tanggal Pembelian</th>
                            <th>Keterangan</th>
                            <th style="width:10px"></th>
                            <th style="width:10px"></th>
                            <th style="width:10px"></th>
                            <th style="width:10px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($material as $m) : ?>
                            <tr>
                                <td><?= $i++ . '.' ?></td>
                                <td><?= $m['material']; ?></td>
                                <td><?= $m['jumlah']; ?></td>
                                <td><?= $m['satuan']; ?></td>
                                <?php if (in_groups(1) || in_groups(3)) : ?>
                                    <td><?= $m['harga_budget']; ?></td>
                                    <td><?= $m['harga_real']; ?></td>
                                <?php endif; ?>
                                <td><?= $m['approval']; ?></td>
                                <td><?= $m['status']; ?></td>
                                <?php $date = strtotime($m['tgl_beli']);
                                $tanggal = date("l, d-m-Y", $date);
                                ?>
                                <td><?= $tanggal ?></td>
                                <td><?= $m['keterangan']; ?></td>
                                <td>
                                    <button type="button" class="button-checkout button-edit" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap" data-bs-id="<?= $m['id']; ?>" data-bs-barang="<?= $m['material']; ?>" data-bs-jumlah="" data-bs-title="Data Masuk " data-bs-labeljumlah="Masuk " data-bs-action="/AdminController/materialmasuk" data-toggle="tooltip" data-placement="bottom" title="Masukan barang">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                        </svg>
                                    </button>
                                </td>
                                <td>
                                    <button type="button" class="button-checkout button-edit" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap" data-bs-id="<?= $m['id']; ?>" data-bs-barang="<?= $m['material']; ?>" data-bs-jumlah="<?= $m['jumlah']; ?>" data-bs-title=" Data Keluar " data-bs-labeljumlah="Keluar " data-bs-action="/AdminController/materialkeluar" data-toggle="tooltip" data-placement="bottom" title="Keluarkan barang">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z" />
                                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                                        </svg>
                                    </button>
                                </td>
                                <?php if (in_groups(1) || in_groups(3)) : ?>

                                    <td>
                                        <a href="/admin/edit/<?= $m['id'] ?>" class="button-edit" data-toggle="tooltip" data-placement="bottom" title="Edit data">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
                                            </svg>
                                        </a>
                                    </td>
                                    <td>
                                        <form action="/admin/delete" method="POST">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="id" value="<?= $m['id'] ?>">
                                            <button type="submit" class="button-delete button-edit" onclick="return confirm('Apakah anda yakin ingin menghapus <?= $m['material']; ?> dari daftar data material?')" data-toggle="tooltip" data-placement="bottom" title="Hapus data"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                </svg></button>
                                    </td>
                                <?php endif; ?>
                                </form>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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
        </main>
    </div>
</div>
<?= $this->endSection() ?>