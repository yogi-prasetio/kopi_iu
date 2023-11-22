<?php if ($this->session->flashdata('flashdata')) : ?>
    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flashdata'); ?>"></div>
<?php endif;
if ($this->session->flashdata('flashgagal')) : ?>
    <div class="flash-gagal" data-flashgagal="<?= $this->session->flashdata('flashgagal'); ?>"></div>
<?php endif; ?>
<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card mb-2">
                <form name="mrp" method="POST" action="<?= base_url("MRPController/Proses") ?>">
                    <div class="card-header pb-2">
                        <span class="h6">Material Requirement Planning</span>
                        <button type="submit" class="btn btn-sm btn-success mx-2" id="btn-proses" style="float: right;" >PROSES</i></button>
                    </div>
                    <div class="card-body px-4 pb-3 pt-0">
                        <div class="row col-12 mb-3 mx-2 mr-2">
                            <select name="bahan" class="form-select mr-2" id="bahan-mrp" required>
                                <option selected disabled>-- Pilih Bahan --</option>
                                <?php 
                                foreach($bahan as $item){
                                    echo "<option value='".$item->nama_bahan."'>".$item->nama_bahan."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="row col-12 mb-3 mx-2 mr-2">
                            <input type="hidden" name="id_bahan" class="form-control mr-2" id="id_bahan" required>
                        </div>
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0" id="data-pengeluaran">
                                <thead>
                                    <tr class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                        <th>Id Bahan</th>
                                        <th>Nama Bahan</th>
                                        <th>Bahan Keluar</th>
                                        <th>Waktu</th>
                                        <th>Lead Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($pengeluaran as $item) {
                                        // var_dump($pengeluaran);
                                        ?>
                                        <tr class="text-sm">
                                            <td id="id">
                                                <input type="hidden" name="id" id="idBahan" value="<?= $item->id_bahan ?>" required>
                                                <?= $item->id_bahan ?>                                                
                                            </td>
                                            <td id="name">
                                                <input type="hidden" name="nama_bahan" id="nama_bahan" value="<?= $item->nama_bahan ?>" required>
                                                <?= $item->nama_bahan ?>
                                            </td>
                                            <td id="jumlah">
                                                <input type="hidden" name="jumlah" id="jumlah_bahan" value="<?= $item->jumlah ?>" required>
                                                <?= $item->jumlah." ".$item->satuan ?>
                                            </td>
                                            <td id="tanggal">
                                                1 Tahun
                                            </td>
                                            <td id="lead_time">
                                                <input type="hidden" name="lead_time" value="<?= $item->LT ?>" required>
                                                <?= $item->LT ?> hari
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="alert alert-info text-light mt-4" role="alert">
                            <b>Perhitungan MRP POQ (Periode Order Quantity):</b><br>
                            <p class="math p-2 text-bold">\(POQ = \sqrt{2S \div DH}\)</p>
                            D = Demand / Permintaan Bahan <span class="text-bold" id="demand"></span> <br>
                            S = Biaya Pemesanan persekali pesan <span class="text-bold" id="pemesanan"></span> <br>
                            H = h x c = Biaya Penyimpanan (rupiah/unit/tahun) <span class="text-bold" id="penyimpanan"></span> <br><br>
                            
                            h = Biaya Penyimpanan 10% terhadap nilai bahan <span class="text-bold" id="persen"></span> <br>
                            c = Harga Bahan <span class="text-bold" id="harga_bhn"></span> <br>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card mb-2">
                <div class="card-header pb-2">
                    <span class="h6">Data MRP</span>
                    <a class="btn btn-sm btn-secondary mx-2 <?= $mrp == null ? 'disabled' : ''?>" style="float: right;" href="<?= base_url('MRPController/CetakMRP') ?>">
                        <i class="fa fa-print"></i>
                    </a>
                </div>
                <div class="card-body px-4 pb-3 pt-0">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="data-table-mrp">
                            <thead>
                                <tr class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                    <th>No</th>
                                    <th>Nama Bahan</th>
                                    <th>POQ</th>                                    
                                    <th>Frekuensi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($mrp as $item) {
                                    ?>
                                    <tr class="text-sm">
                                        <td><?= $no++ ?></td>
                                        <td><?= $item->nama_bahan ?></td>
                                        <td><?= $item->poq ?></td>
                                        <td>
                                            <?php echo round($item->frequensi/1000)." "; 
                                            if($item->satuan == "ml") { echo 'Liter'; } 
                                            elseif ($item->satuan == "gram") { echo 'Kg'; }
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="//www.turnjs.com/lib/turn.min.js "></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#data-table-mrp').DataTable({
                responsive: true,
                fixedColumns: true,
                fixedRows: true,
            });
            var bahan_inp = document.getElementById("id_bahan");
            var bahan_id = "";
            var table_keluar = $('#data-pengeluaran').DataTable({
                columnDefs: [
                {
                    target: 0,
                    visible: false,
                    searchable: true
                },
                ],
                responsive: true,
                fixedColumns: true,
                fixedRows: true,
                info: false,
            })

            var btnProcess = document.getElementById("btn-proses");
            
            var result = 0;
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    var select = $('#bahan-mrp').val();
                    var bahan = data[1];

                    if (bahan.includes(select)) {
                        var id_bahan = data[0];
                        bahan_id = data[0];
                        document.getElementById("id_bahan").value = id_bahan.toString();
                        return true;
                    } else {
                        return false;
                    }
                }                
            );

            var demand = document.getElementById("demand");
            var pemesanan = document.getElementById("pemesanan");
            var penyimpanan = document.getElementById("penyimpanan");
            var persen = document.getElementById("persen");
            var harga = document.getElementById("harga");

            $("#bahan-mrp").change(function (e) {
                table_keluar.draw();

                var filtered_data = table_keluar.rows( {search:'applied'} ).data();
                demand.innerHTML = "";
                pemesanan.innerHTML = "";
                penyimpanan.innerHTML = "";

                persen.innerHTML = "";
                harga_bhn.innerHTML = "";

                if(filtered_data.length < 1){
                    $("#btn-proses").addClass('disabled');
                } else {
                    $("#btn-proses").removeClass('disabled');

                    var formData = {
                        id_bahan: bahan_id.split(" ").join(""),
                        nama_bahan: $("#nama_bahan").val(),
                        jumlah: $("#jumlah_bahan").val(),
                    };

                    $.ajax({ 
                        type : "POST",
                        //set the data type
                        data: formData,
                        dataType:'json',
                        url: "<?= site_url('MRPController/ShowProcess'); ?>", 
                        //check this in Firefox browser
                        success : function(response){ 

                            demand.innerHTML = "= " + response.D;
                            pemesanan.innerHTML = "= " + new Intl.NumberFormat("id-ID", {
                                                            style: "currency",
                                                            currency: "IDR"
                                                        }).format(response.S);
                            // penyimpanan.innerHTML = "= " + response.H;

                            // persen.innerHTML = "= " + response.persen;
                            harga_bhn.innerHTML = "= " + new Intl.NumberFormat("id-ID", {
                                                            style: "currency",
                                                            currency: "IDR"
                                                        }).format(response.c * 1000);
                        },
                    });
                }                
            });

            table_keluar.draw();

            $("#btn-proses").addClass('disabled');
        });
    </script>