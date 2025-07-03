<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-6">
        <!-- Vertical Form -->
        <?= form_open('buy', 'class="row g-3"') ?>
        <?= form_hidden('username', session()->get('username')) ?>
        <?= form_input(['type' => 'hidden', 'name' => 'total_harga', 'id' => 'total_harga', 'value' => '']) ?>
        <?= form_input(['type' => 'hidden', 'name' => 'biaya_admin', 'id' => 'biaya_admin', 'value' => '']) ?> 
        <?= form_input(['type' => 'hidden', 'name' => 'ppn', 'id' => 'ppn', 'value' => '']) ?> 
        <?= form_input(['type' => 'hidden', 'name' => 'grand_total', 'id' => 'grand_total', 'value' => '']) ?> 

        <div class="col-12">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" id="nama" value="<?php echo session()->get('username'); ?>">
        </div>
        <div class="col-12">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat">
        </div> 
        <div class="col-12">
            <label for="kelurahan" class="form-label">Kelurahan</label>
            <select class="form-control" id="kelurahan" name="kelurahan" required></select>
        </div>
        <div class="col-12">
            <label for="layanan" class="form-label">Layanan</label>
            <select class="form-control" id="layanan" name="layanan" required></select>
        </div>
        <div class="col-12">
            <label for="ongkir" class="form-label">Ongkir</label>
            <input type="text" class="form-control" id="ongkir" name="ongkir" readonly>
        </div>
    </div>
    <div class="col-lg-6">
        <!-- Vertical Form -->
        <div class="col-12">
            <!-- Default Table -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    if (!empty($items)) :
                        foreach ($items as $index => $item) :
                    ?>
                            <tr>
                                <td><?php echo $item['name'] ?></td>
                                <td><?php echo number_to_currency($item['price'], 'IDR') ?></td>
                                <td><?php echo $item['qty'] ?></td>
                                <td><?php echo number_to_currency($item['price'] * $item['qty'], 'IDR') ?></td>
                            </tr>
                    <?php
                        endforeach;
                    endif;
                    ?>
                    <tr>
                        <td colspan="2"></td>
                        <td><strong>Subtotal</strong></td>
                        <td><?php echo number_to_currency($total, 'IDR') ?></td>
                    </tr>
<tr>
    <td colspan="2"></td>
    <td>PPN (11%)</td>
    <td><span id="ppn_tampil">IDR 0</span></td>
</tr>
<tr>
    <td colspan="2"></td>
    <td>Biaya Admin</td>
    <td><span id="biaya_admin_tampil">IDR 0</span></td>
</tr>
<tr>
    <td colspan="2"></td>
    <td>Ongkir</td>
    <td><span id="ongkir_tampil">IDR 0</span></td>
</tr>
<tr>
    <td colspan="2"></td>
    <th>Grand Total</th>
    <th><span id="grand_total_tampil">IDR 0</span></th>
</tr>

                </tbody>
            </table>
            <!-- End Default Table Example -->
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Buat Pesanan</button>
        </div>
        </form><!-- Vertical Form -->
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
$(document).ready(function() {
    var ongkir = 0;
    var total = 0; 

    hitungTotal();

    $('#kelurahan').select2({
    placeholder: 'Ketik nama kelurahan...',
    ajax: {
        url: '<?= base_url('get-location') ?>',
        dataType: 'json',
        delay: 1500,
        data: function (params) {
            return {
                search: params.term
            };
        },
        processResults: function (data) {
            return {
                results: data.map(function(item) {
                return {
                    id: item.id,
                    text: item.subdistrict_name + ", " + item.district_name + ", " + item.city_name + ", " + item.province_name + ", " + item.zip_code
                };
                })
            };
        },
        cache: true
    },
    minimumInputLength: 3
});

    $("#kelurahan").on('change', function() {
    var id_kelurahan = $(this).val(); 
    $("#layanan").empty();
    ongkir = 0;

    $.ajax({
        url: "<?= site_url('get-cost') ?>",
        type: 'GET',
        data: { 
            'destination': id_kelurahan, 
        },
        dataType: 'json',
        success: function(data) { 
            data.forEach(function(item) {
                var text = item["description"] + " (" + item["service"] + ") : estimasi " + item["etd"] + "";
                $("#layanan").append($('<option>', {
                    value: item["cost"],
                    text: text 
                }));
            });
            hitungTotal(); 
        },
    });
});

    $("#layanan").on('change', function() {
    ongkir = parseInt($(this).val());
    hitungTotal();
});  

    function hitungTotal() { 
    let subtotal = <?= $total ?>;
    let ppn = subtotal * 0.11;
    let biaya_admin = 0;

    if (subtotal <= 20000000) {
        biaya_admin = subtotal * 0.006;
    } else if (subtotal <= 40000000) {
        biaya_admin = subtotal * 0.008;
    } else if (subtotal > 40000000) {
        biaya_admin = subtotal * 0.01;
    }

    let grand_total = subtotal + ongkir + ppn + biaya_admin;

    // Set value ke input hidden
    $("#total_harga").val(subtotal);
    $("#ongkir").val(ongkir);
    $("#biaya_admin").val(biaya_admin);
    $("#ppn").val(ppn);
    $("#grand_total").val(grand_total);

    // Tampilkan di tabel
    $("#ongkir_tampil").html(formatRupiah(ongkir)); 
    $("#biaya_admin_tampil").html(formatRupiah(biaya_admin)); 
    $("#ppn_tampil").html(formatRupiah(ppn)); 
    $("#grand_total_tampil").html(formatRupiah(grand_total)); 
}
    function formatRupiah(angka) { 
    return "IDR " + angka.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
}

});
</script>
<?= $this->endSection() ?>