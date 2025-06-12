<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-6">
        <!-- Vertical Form -->
        <?= form_open('buy', 'class="row g-3"') ?>
        <?= form_hidden('username', session()->get('username')) ?>
        <?= form_input(['type' => 'hidden', 'name' => 'total_harga', 'id' => 'total_harga', 'value' => '']) ?>
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
            <strong>select kelurahan</strong>
        </div>
        <div class="col-12">
            <label for="layanan" class="form-label">Layanan</label>
            <strong>select layanan</strong>
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
                        <td>Subtotal</td>
                        <td><?php echo number_to_currency($total, 'IDR') ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td>Total</td>
                        <td><span id="total"><?php echo number_to_currency($total, 'IDR') ?></span></td>
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