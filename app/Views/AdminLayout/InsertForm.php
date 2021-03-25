<?= $this->extend('Layout/template') ?>

<?= $this->section('content') ?>

<div class="container mt-4 w-100 ">
    <h1 class="h2">Tambah Data Barang</h1>
    <form action="/AdminController/save" method="POST">
        <div class="mb-3 row">
            <div class="col-6 col">
                <label class="form-label">Material</label>
                <input type="text" class="form-control <?= ($validation->hasError('InputMaterial')) ? 'is-invalid' : '' ?>" name="InputMaterial" autofocus value="<?= old('InputMaterial') ?>">
                <div class="invalid-feedback">
                    Nama Barang/material wajib diisi
                </div>
            </div>

        </div>
        <div class="mb-3 row">
            <div class="col-1">
                <label class="form-label">Jumlah</label>
                <input type="number" class="form-control" name="InputJumlah" min="1" placeholder="1" value="<?= old('InputMaterial') ?>">
            </div>
        </div>
        <div class="mb-3 row">
            <div class="col-4">
                <label class="form-label">Satuan</label>
                <input type="text" class="form-control <?= ($validation->hasError('InputSatuan')) ? 'is-invalid' : '' ?>" name="InputSatuan" value="<?= old('InputSatuan') ?>">
                <div class="invalid-feedback">
                    Satuan barang wajib diisi
                </div>
            </div>
        </div>
        <?php if (in_groups(1) || in_groups(3)) { ?>
            <div class=" mb-3 row">
                <div class="col-4">
                    <label class="form-label">Budget</label>
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">Rp. </span>
                        <input type="text" class="form-control <?= ($validation->hasError('InputBudget')) ? 'is-invalid' : '' ?>" name="InputBudget" value="<?= old('InputBudget') ?>">
                    </div>
                    <div class="invalid-feedback">
                        Harga Budget wajib diisi
                    </div>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-4">
                    <label class="form-label">Real</label>
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="addon-wrapping">Rp. </span>
                        <input type="text" class="form-control <?= ($validation->hasError('InputReal')) ? 'is-invalid' : '' ?>" name="InputReal" value="<?= old('InputReal') ?>">
                    </div>
                    <div class=" invalid-feedback">
                        Harga Real wajib diisi
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <input type="hidden" class="form-control" name="InputBudget" value="0">
            <input type="hidden" class="form-control" name="InputReal" value="0">
        <?php  } ?>
        <!-- approve input -->
        <div class="mb-3 row">
            <div class="col-1">
                <label class="form-label">Approve</label>
            </div>
            <div class="col">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="InputApprove" id="" value="pending" checked>
                    <label class="form-check-label" for="flexRadioDefault2">
                        Pending
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="InputApprove" value="approved" id="">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Approve
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="InputApprove" value="rejected" id="">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Reject
                    </label>
                </div>
            </div>
        </div>
        <!-- status input -->
        <div class="mb-3 row">
            <div class="col-1">
                <label class="form-label">Status</label>
            </div>
            <div class="col">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="InputStatus" id="" value="pending" checked>
                    <label class="form-check-label" for="flexRadioDefault2">
                        Pending
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="InputStatus" value="continue" id="">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Continue
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="InputStatus" value="close pending" id="">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Close Pending
                    </label>
                </div>
            </div>
        </div>
        <!-- Input Tanggal Pembelian -->
        <div class="mb-3 row">
            <div class="col-3">
                <label class="form-label">Tanggal Pembelian</label>
                <div class="form-group">
                    <div class="col-10">
                        <input class="form-control <?= ($validation->hasError('InputTglPembelian')) ? 'is-invalid' : '' ?>" type="date" value="" id="example-date-input" name="InputTglPembelian" value="<?= old('InputTglPembelian') ?>">
                        <div class=" invalid-feedback">
                            Tanggal Pembelian wajib diisi
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-3 row">
            <div class="col-6">
                <label class="form-label">Keterangan</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="InputKeterangan" value="<?= old('InputKeterangan') ?>"></textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-primary" onclick='return confirm(" Pastikan data yang anda masukan benar!")'>Submit</button>
        <button type="reset" class="btn btn-primary">Reset</button>
    </form>
</div>

<?= $this->endSection() ?>