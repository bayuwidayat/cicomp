<?= $this->extend('backend/layout'); ?>

<?= $this->section('content'); ?>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <form action="">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="keyword" placeholder="Keyword Pencarian" aria-label="Keyword Pencarian" aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="dubmit" id="button-addon2">Cari</button>
                    </div>
                </form>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th width="30"></th>
                    <th>Nama</th>
                    <th>Pesan</th>
                    <th>Tgl Masuk</th>
                    <th style="width: 100px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1 + ($jPost * ($currentPage - 1));

                if (count($hubungi) == 0) {
                ?>
                    <tr>
                        <td colspan="5" align="center"><span class="text-muted"><i>Belum ada data terbaru</i></span></td>
                    </tr>
                    <?php
                } else {
                    foreach ($hubungi as $h): ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td>
                                <b><?= $h['nama']; ?></b><br>
                                <?= $h['email']; ?><br>
                                <?= $h['no_wa']; ?>
                            </td>
                            <td>
                                <b>Subjek : </b><?= $h['subjek']; ?><br>
                                <b>Pesan : </b><?= $h['pesan']; ?>
                            </td>
                            <td><?= tgl_indo($h['created_at']); ?></td>
                            <td class="text-center">
                                <a href="javascript:void(0)" onclick="hapus('<?= $h['id_hubungi'] ?>')" class="btn btn-danger btn-sm"><i class="ri-close-line"></i></a>
                            </td>
                        </tr>
                <?php
                    endforeach;
                }
                ?>
            </tbody>
        </table>

        <?= $pager->links('hubungi', 'lintang_pagination') ?>
    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<link href="<?= base_url() ?>assets/vendor/sweetalert2@9.17.2/sweetalert2.min.css" rel="stylesheet" type="text/css">
<script src="<?= base_url() ?>assets/vendor/sweetalert2@9.17.2/sweetalert2.min.js"></script>

<script>
    // --- fungsi hapus data ---
    function hapus(id) {
        Swal.fire({
            title: "Hapus Data",
            text: "Apakah Anda yakin akan menghapus data ini ?",
            icon: "question",
            showCancelButton: true,
            cancelButtonColor: "#d33",
            cancelButtonText: "Batal",
            confirmButtonColor: "#3085d6",
            confirmButtonText: "Ya!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url(); ?>ladmin/hubungi/delete/" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        Swal.fire({
                            title: "Hapus!",
                            text: "Data Berhasil diHapus.",
                            icon: "success"
                        });
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        Swal.fire({
                            title: "Error!",
                            text: "Error Deleting Data",
                            icon: "danger"
                        });
                    }
                });
            }
        });
    }
</script>
<?= $this->endSection(); ?>