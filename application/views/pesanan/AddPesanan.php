<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card mb-2">
                <div class="card-header pb-2 mb-2">
                    <span class="h6">Tambah Pesanan</span>
                </div>
                <div class="card-body px-4 pb-3 pt-0">
                    <form role="form" id="add-pesanan" action="<?= base_url('PesananController/Insert') ?>" method="POST">
                        <div class="mb-3">
                            <label for="name" class="text-sm">
                                Nama Supplir
                            </label>
                            <select name="nama_supplier" class="form-select" id="supplier_filter" onchange="setId()" required>
                                <option selected disabled value="">-- Pilih Supplier --</option>
                                <?php
                                foreach($user as $row){
                                    echo "<option value='".$row->id_user."'>".$row->nama_user."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <input type="hidden" name="id_supplier" id="id_supplier">
                        <div class="mb-3">
                            <label for="tanggal" class="text-sm">
                                Tanggal
                            </label>
                            <input type="datetime-local" class="form-control" placeholder="Tanggal" aria-label="Tanggal" name="tanggal" required>
                        </div>
                        <div class="form-group row">
                            <label for="bahan" class="col-sm-10 col-form-label">Bahan</label>
                            <div class="col-sm-10">
                                <button type="button" class="btn btn-success btn_tambah" data-toggle="modal" data-target="#tambah_bahan">Tambah Bahan</button>
                            </div>
                        </div>
                        <div class="form-group mx-2 row">
                            <label for="bhn" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <table class="table">
                                    <thead>
                                        <tr>                           
                                            <th>Nama Bahan</th>
                                            <th>Jumlah</th>
                                            <th>Total Biaya</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody_bahan">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="text-end">
                            <a href="<?= base_url('PesananController') ?>"><button type="button" class="btn btn-secondary mt-4 mb-0">Batal</button></a>
                            <button type="submit" class="btn btn-primary mt-4 mb-0" id="btn-confirm">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade container-fluid px-4" id="tambah_bahan">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data Bahan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Batal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table tbl_bahan" id="data-bahan" style="min-width: 100%;">
                        <thead>
                            <tr class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                <th>No</th>
                                <th>ID Supplier</th>
                                <th>Nama Bahan</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i=0;
                            foreach ($bahan as $row) {
                                ?>                               
                                <tr class="text-sm" id="pl_<?= $row->id_bahan ?>">
                                    <td><?= ++$i; ?></td>
                                    <td class="id_user"><?= $row->id_user; ?></td>
                                    <td class="nama"><?= $row->nama_bahan; ?></td>
                                    <td class="satuan"><?= $row->satuan; ?></td>
                                    <td class="harga"><?= $row->harga; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-success pilih_bahan" id="pilih_bahan"data-dismiss="modal" data-id="<?= $row->id_bahan ?>" >
                                            <i class="fa fa-check"></i></button>
                                        </td>
                                    </tr>
                                </form>
                            <?php }                                 
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="detail_bahan">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data Bahan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Batal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- <form method="post" name="bahan_detail"> -->
                        <input type="hidden" id="id_bahan_inp" name="id_inp">
                        <div class="form-group row m-2">
                            <label for="nama_bahan" class="col-sm-12 col-form-label">Nama Bahan</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="nama_inp" id="nama_bahan_inp" readonly>
                            </div>
                        </div>
                        <div class="form-group row m-2">
                            <label for="jumlah_bahan" class="col-sm-12 col-form-label">Jumlah Pesanan</label>
                            <div class="col-sm-12">
                                <div class="input-group mb-3">
                                    <input type="number" name="jml_inp" class="form-control" id="jumlah_bahan_inp" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="st-add-satuan"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row m-2">
                            <label for="harga_bahan" class="col-sm-12 col-form-label">Harga Satuan</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="harga_inp" id="harga_bahan_inp" readonly>
                            </div>
                        </div>
                        <input type="hidden" id="satuan_bahan_inp" name="satuan_inp">
                        <!-- </form> -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary btn_tambah_jumlah_bahan">Tambah Bahan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        var data_bhn = [];
        $(document).ready(function(){
            $('#data-bahan').DataTable({
                columnDefs: [
                {
                    target: 1,
                    visible: false,
                    searchable: true
                },
                ],
                responsive: true,
                fixedColumns: true,
                fixedRows: true,
                searching: true,
            });

            var table = $('#data-bahan').DataTable();
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    var selectedItem = $('#supplier_filter').val()
                    var supplier = data[1];
                    if (selectedItem === "" || supplier.includes(selectedItem)) {
                        return true;
                    }
                    return false;
                }
                );

            $("#supplier_filter").change(function (e) {
                table.draw();
            });

            table.draw();

            
            $(".btn_tambah").click(function () {
                $("#tambah_bahan").modal('show');
            });
            
            if(data_bhn.length == 0){
                var element = document.getElementById("btn-confirm");
                element.classList.add("disabled");
            } 

            $(".pilih_bahan").click(function() {
                $("#tambah_bahan").modal('hide');

                var id = $(this).attr("data-id");
                var nama = $("#pl_"+id+">.nama").html();
                var satuan = $("#pl_"+id+">.satuan").html();
                var harga = $("#pl_"+id+">.harga").html();

                pilih_bahan(id, nama, satuan, harga);
            });

            $('.close').click(function() {
                $('#detail_bahan').modal('hide');
                $('#tambah_bahan').modal('hide');
            });

            $(".btn_tambah_jumlah_bahan").click(function(){
                if($("#jumlah_bahan_inp").val()>0){
                    var idb = $("#id_bahan_inp").val();

                    var cek = cek_bahan(idb, parent);
                    console.log(cek);
                    var jml = $("#jumlah_bahan_inp").val();
                    var harga = $("#harga_bahan_inp").val();
                    var total = parseInt(jml) * parseInt(harga);
                    if(cek>=0) {
                        jml = parseInt(jml) + parseInt(data_bhn[cek].jumlah_bahan);
                        data_bhn[cek].jumlah_bahan = jml;                                                
                    } else {
                        bhn = {
                            id_bahan : idb,
                            nama_bahan : $("#nama_bahan_inp").val(),
                            satuan_bahan : $("#satuan_bahan_inp").val(),
                            jumlah_bahan : $("#jumlah_bahan_inp").val(),
                            total_biaya : total
                        };

                        data_bhn.push(bhn);
                    }
                    console.log(data_bhn);
                    $("#detail_bahan").modal('hide');                    
                    document.getElementById("supplier_filter").disabled = true;
                    tambah_bahan(data_bhn);
                }
            });

            $(".btn-hapus").click(function(){
                var id = $(this).attr("data-id");
                $('#hapusModal').modal('show');
                $(".btnhapus-link").attr("href", "models/p_bom.php?id="+id);
            });

        });

        function setId(){
            var id_supplier = document.getElementById("supplier_filter").value;
            console.log(id_supplier);
            document.getElementById("id_supplier").value = id_supplier;
        }

        function cek_bahan(id, parent) {
            for(var i=0; i<data_bhn.length; i++){
                if(id == data_bhn[i].id_bahan && parent == data_bhn[i].parent){
                    return i;
                }
            }
            return -1;
        }

        function pilih_bahan(id, nama, satuan, harga){
            console.log(id+" "+nama+" "+satuan+" "+harga);
            $("#tambah_bahan").modal('hide');
            $("#id_bahan_inp").val(id);
            $("#nama_bahan_inp").val(nama);
            $("#satuan_bahan_inp").val(satuan);
            $("#harga_bahan_inp").val(harga);
            $("#st-add-satuan").html(satuan);
            $("#detail_bahan").modal('show');
            $("#jumlah_bahan_inp").val('');
        }


        function tambah_bahan(data_bhn){
            /*id_bahan_class*/
            var frm = '';
            $(".tbody_bahan").html(" ");
            for(var i=0; i<data_bhn.length; i++){
                frm += gen_data_bahan(data_bhn[i], i);
            }
            $(".tbody_bahan").append(frm);
            var element = document.getElementById("btn-confirm");
            element.classList.remove("disabled");
        }

        function gen_data_bahan(data_bhn, idx){
            var ret = '';
            // var no = 0;
            ret += '<tr id="bhn_'+idx+'">';
            // ret += '<td>'+(no+1)+'</td>';
            ret += '<td>'+data_bhn.nama_bahan;
            ret += '<input type="hidden" id="idbhn_'+idx+'" class="form-control id_bahan_class" name="id_bahan[]" value="'+data_bhn.id_bahan+'">';
            ret += '</td>';
            ret += '<td>'+data_bhn.jumlah_bahan+" "+data_bhn.satuan_bahan;
            ret += '<input type="hidden" id="jmlbhn_'+idx+'" class="form-control" name="jumlah_bahan[]" value="'+data_bhn.jumlah_bahan+'">';
            ret += '</td>';
            ret += '<td>'+data_bhn.total_biaya;
            ret += '<input type="hidden" id="total_'+idx+'" class="form-control" name="total_biaya[]" value="'+data_bhn.total_biaya+'">';
            ret += '</td>';
            ret += '<td>';
            ret += '<button type="button" onclick="hapus_bahan('+idx+')" class="btn btn-sm btn-danger btn_hapus_bahan" data-id="'+data_bhn.id_bahan+'" data-toggle="tooltip" data-placement="top" title="Hapus">';
            ret += '<i class="fa fa-trash"></i>';
            ret += '</button>';
            ret += '</td>';
            ret += '</tr>';
            return ret;
        }

        function hapus_bahan(id) {
            $("#bhn_"+id).remove();
            data_bhn.splice(id, 1);
            tambah_bahan(data_bhn);

            if(data_bhn.length == 0){
                var element = document.getElementById("btn-confirm");
                element.classList.add("disabled");
                document.getElementById("supplier_filter").disabled = false;
            }
        }
    </script>