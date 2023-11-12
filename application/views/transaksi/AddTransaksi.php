<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card mb-2">
                <div class="card-header pb-2 mb-2">
                    <span class="h6">Tambah Transaksi</span>
                </div>
                <div class="card-body px-4 pb-3 pt-0">
                    <form role="form" action="<?= base_url('TransaksiController/Insert') ?>" method="POST">
                        <div class="mb-3">
                            <label for="tanggal" class="text-sm">
                                Tanggal
                            </label>
                            <?php
                                if($this->session->userdata('role') == 'Customer'){
                            ?>
                            <input type="datetime" class="form-control" placeholder="Tanggal" aria-label="Tanggal" name="tanggal" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date('Y-m-d H:i:s') ?>" readonly required>
                            <?php } else { ?>
                            <input type="datetime-local" class="form-control" placeholder="Tanggal" aria-label="Tanggal" name="tanggal" required>
                        <?php } ?>
                        </div>
                        <div class="form-group row">
                            <label for="produk" class="col-sm-10 col-form-label">Produk</label>
                            <div class="col-sm-10">
                                <button type="button" class="btn btn-success btn_tambah" data-toggle="modal" data-target="#tambah_produk">Tambah Produk</button>
                            </div>
                        </div>
                        <div class="form-group mx-2 row">
                            <label for="bhn" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <table class="table">
                                    <thead>
                                        <tr>                           
                                            <th>Nama Produk</th>
                                            <th>Harga</th>
                                            <th>Quantity</th>
                                            <th>Total Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody_produk">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="text-end">
                            <a href="<?= base_url('TransaksiController') ?>"><button type="button" class="btn btn-secondary mt-4 mb-0">Batal</button></a>
                            <button type="submit" class="btn btn-primary mt-4 mb-0" id="btn-submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade container-fluid px-4" id="tambah_produk">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Batal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table tbl_produk" id="data-produk" style="min-width: 100%;">
                        <thead>
                            <tr class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=0;
                            foreach ($BOM as $row) {
                                ?>                               
                                <tr class="text-sm" id="pl_<?= $row->id_bom ?>">
                                    <td><?= ++$i; ?></td>
                                    <td class="nama"><?= $row->nama_bom; ?></td>
                                    <td class="harga"><?= $row->harga; ?></td>
                                    <td class="deskripsi"><?= $row->deskripsi; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-success pilih_produk" id="pilih_produk" data-dismiss="modal" data-id="<?= $row->id_bom ?>" >
                                            <i class="fa fa-check"></i></button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="detail_produk">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Data Produk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Batal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="id_produk_inp" name="id_inp">
                        <div class="form-group row m-2">
                            <label for="nama_produk" class="col-sm-12 col-form-label">Nama Produk</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="nama_inp" id="nama_produk_inp" readonly>
                            </div>
                        </div>
                        <div class="form-group row m-2">
                            <label for="harga" class="col-sm-12 col-form-label">Harga</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="harga_inp" id="harga_produk_inp" readonly>
                            </div>
                        </div>
                        <div class="form-group row m-2">
                            <label for="jumlah_produk" class="col-sm-12 col-form-label">Jumlah</label>
                            <div class="col-sm-12">
                                <div class="input-group mb-3">
                                    <input type="number" name="qty_inp" class="form-control" id="qty_produk_inp" required>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="satuan_produk_inp" name="satuan_inp">
                        <!-- </form> -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary btn_tambah_jumlah_produk">Tambah Produk</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Anda yakin ingin menghapus data?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <a class="btn btn-success btnhapus-link" href="login.html">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        var data_produk = [];
        $(document).ready(function(){
            $(".btn_tambah").click(function () {
                $("#tambah_produk").modal('show');
            });          

            $(".pilih_produk").click(function() {
                $("#tambah_produk").modal('hide');

                var id = $(this).attr("data-id");
                var nama = $("#pl_"+id+">.nama").html();
                var harga = $("#pl_"+id+">.harga").html();

                pilih_produk(id, nama, harga);
            });

            if(data_produk.length == 0){
                var element = document.getElementById("btn-submit");
                element.classList.add("disabled");
            } 

            $('.close').click(function() {
                $('#detail_produk').modal('hide');
                $('#tambah_produk').modal('hide');
            });

            $(".btn_tambah_jumlah_produk").click(function(){
                if($("#qty_produk_inp").val()>0){
                    var idb = $("#id_produk_inp").val();

                    var cek = cek_produk(idb, parent);
                    console.log(cek);
                    var jml = $("#qty_produk_inp").val();
                    var harga = $("#harga_produk_inp").val();
                    var total = parseInt(jml) * parseInt(harga);
                    if(cek>=0) {
                        jml = parseInt(jml) + parseInt(data_produk[cek].jumlah_produk);
                        data_produk[cek].jumlah_produk = jml;                                                
                    } else {
                        bhn = {
                            id_produk : idb,
                            nama_produk : $("#nama_produk_inp").val(),
                            harga : $("#harga_produk_inp").val(),
                            quantity : $("#qty_produk_inp").val(),
                            total_biaya : total
                        };

                        data_produk.push(bhn);
                    }
                    console.log(data_produk);
                    $("#detail_produk").modal('hide');                    
                    tambah_produk(data_produk);
                } else {
                    $('#qty_produk_inp').addClass('is-invalid');
                }
            });

            $(".btn-hapus").click(function(){
                var id = $(this).attr("data-id");
                $('#hapusModal').modal('show');
                $(".btnhapus-link").attr("href", "models/p_bom.php?id="+id);
            });

            $('#data-produk').DataTable({
                columnDefs: [                        
                {
                    render: function(data, type, full, meta){
                        return "<div class='text-wrap'>" + data + "</div>";
                    },
                    targets: -2
                }
                ],
                responsive: true,
                fixedColumns: true,
                fixedRows: true,
                searching: true,
            });
        });

        function cek_produk(id, parent) {
            for(var i=0; i<data_produk.length; i++){
                if(id == data_produk[i].id_produk && parent == data_produk[i].parent){
                    return i;
                }
            }
            return -1;
        }

        function pilih_produk(id, nama, harga){
            console.log(id+" "+nama+" "+harga);
            $("#tambah_produk").modal('hide');

            $("#id_produk_inp").val(id);
            $("#nama_produk_inp").val(nama);
            $("#harga_produk_inp").val(harga);
            $("#detail_produk").modal('show');
            $("#qty_produk_inp").val('');
            $('#qty_produk_inp').removeClass('is-invalid');
        }

        function tambah_produk(data_produk){
            var frm = '';
            $(".tbody_produk").html(" ");
            for(var i=0; i<data_produk.length; i++){
                frm += gen_data_produk(data_produk[i], i);
            }
            $(".tbody_produk").append(frm);
            var element = document.getElementById("btn-submit");
            element.classList.remove("disabled");
        }

        function gen_data_produk(data_produk, idx){
            var ret = '';

            ret += '<tr id="bhn_'+idx+'">';
            ret += '<td>'+data_produk.nama_produk;
            ret += '<input type="hidden" id="idbhn_'+idx+'" class="form-control id_produk_class" name="id_produk[]" value="'+data_produk.id_produk+'">';
            ret += '</td>';
            ret += '<td>'+toRupiah(data_produk.harga, 'Rp.');
            ret += '</td>';
            ret += '<td>'+data_produk.quantity
            ret += '<input type="hidden" id="jmlbhn_'+idx+'" class="form-control" name="quantity[]" value="'+data_produk.quantity+'">';
            ret += '</td>';
            ret += '<td>'+toRupiah(data_produk.total_biaya, 'Rp.');
            ret += '<input type="hidden" id="total_'+idx+'" class="form-control" name="jumlah_harga[]" value="'+data_produk.total_biaya+'">';
            ret += '</td>';
            ret += '<td>';
            ret += '<button type="button" onclick="hapus_produk('+idx+')" class="btn btn-sm btn-danger btn_hapus_produk" data-id="'+data_produk.id_produk+'" data-toggle="tooltip" data-placement="top" title="Hapus">';
            ret += '<i class="fa fa-trash"></i>';
            ret += '</button>';
            ret += '</td>';
            ret += '</tr>';
            return ret;
        }

        function hapus_produk(id) {
            $("#bhn_"+id).remove();
            data_produk.splice(id, 1);
            tambah_produk(data_produk);

            if(data_produk.length == 0){
                var element = document.getElementById("btn-submit");
                element.classList.add("disabled");
            }
        }

        function toRupiah(angka, prefix) {
            var number_string = angka.toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    </script>