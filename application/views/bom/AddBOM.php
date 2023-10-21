
<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card mb-2">
                <div class="card-header pb-2 mb-2">
                    <span class="h6">Tambah BOM</span>
                </div>
                <div class="card-body px-4 pb-3 pt-0">
                    <form method="post" action="<?= base_url('BOMController/Insert');?>">
                        <div class="form-group row">
                            <label for="nama_bom" class="col-sm-10 col-form-label">Nama BOM</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="nama_bom" id="nama_bom" placeholder="Nama BOM" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jumlah" class="col-sm-10 col-form-label">Harga</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="harga" id="harga" placeholder="Harga" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="LT" class="col-sm-10 col-form-label">Deskripsi</label>
                            <div class="input-group">
                                <textarea class="form-control" name="deskripsi"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <hr>
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
                                            <th>Satuan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody_bahan">

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10 offset-md-2 text-end">
                                <a href="<?= base_url('BOMController') ?>"><button type="button" class="btn btn-secondary mt-4 mb-2">Batal</button></a>
                                <input type="submit" class="btn btn-primary mt-4 mb-2" name="btnSimpan" value="Tambah">
                            </div>
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
                    <table class="table tbl_bahan" id="data-table">
                        <thead>
                            <tr class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                <th>No</th>
                                <th>Nama Bahan</th>
                                <th>Satuan</th>
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
                                    <td class="nama"><?= $row->nama_bahan; ?></td>
                                    <td class="satuan"><?= $row->satuan; ?></td>
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
                            <label for="jumlah_bahan" class="col-sm-12 col-form-label">Jumlah</label>
                            <div class="col-sm-12">
                                <div class="input-group mb-3">
                                    <input type="number" name="jml_inp" class="form-control" id="jumlah_bahan_inp" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="st-add-satuan"></span>
                                    </div>
                                </div>
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
        var data_bhn = [];
        $(document).ready(function(){
            $(".btn_tambah").click(function () {
                $("#tambah_bahan").modal('show');
            });


            $(".pilih_bahan").click(function() {
                $("#tambah_bahan").modal('hide');

                var id = $(this).attr("data-id");
                var nama = $("#pl_"+id+">.nama").html();
                var satuan = $("#pl_"+id+">.satuan").html();

                pilih_bahan(id, nama, satuan);
            });

            $('.close').click(function() {
                $('#detail_bahan').modal('hide');
                $('#tambah_bahan').modal('hide');
                $('#modalBahan').modal('hide');
            });

            $(".btn_tambah_jumlah_bahan").click(function(){
                if($("#jumlah_bahan_inp").val()>0){
                    var idb = $("#id_bahan_inp").val();
                    var level = $("#level_bahan_inp").val();

                    var cek = cek_bahan(idb, parent); 
                    console.log(cek);
                    if(cek>=0) {
                        var jml = $("#jumlah_bahan_inp").val();
                        jml = parseInt(jml) + parseInt(data_bhn[cek].jumlah_bahan);
                        data_bhn[cek].jumlah_bahan = jml;
                        data_bhn[cek].level_bahan = level;
                    } else {
                        bhn = {
                            id_bahan : idb,
                            nama_bahan : $("#nama_bahan_inp").val(),
                            satuan_bahan : $("#satuan_bahan_inp").val(),
                            jumlah_bahan : $("#jumlah_bahan_inp").val(),
                            level_bahan : level,
                        };

                        data_bhn.push(bhn);
                    }
                    console.log(data_bhn);
                    $("#detail_bahan").modal('hide');
                    tambah_bahan(data_bhn);
                }
            });

            $(".btn-hapus").click(function(){
                var id = $(this).attr("data-id");
                $('#hapusModal').modal('show');
                $(".btnhapus-link").attr("href", "models/p_bom.php?id="+id);
            });

            $('#data-table').DataTable({
                responsive: true,
                fixedColumns: true,
                fixedRows: true,
                info: false,
            });
        });

        function cek_bahan(id, parent) {
            for(var i=0; i<data_bhn.length; i++){
                if(id == data_bhn[i].id_bahan && parent == data_bhn[i].parent){
                    return i;
                }
            }
            return -1;
        }

        function pilih_bahan(id, nama, satuan){
            console.log(id+" "+nama+" "+satuan);
            $("#modalBahan").modal('hide');
            $("#id_bahan_inp").val(id);
            $("#nama_bahan_inp").val(nama);
            $("#satuan_bahan_inp").val(satuan);
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
        }

        function gen_data_bahan(data_bhn, idx){
            var ret = '';
            ret += '<tr id="bhn_'+idx+'">';
            ret += '<td>'+data_bhn.nama_bahan;
            ret += '<input type="hidden" id="idbhn_'+idx+'" class="form-control id_bahan_class" name="id_bahan[]" value="'+data_bhn.id_bahan+'">';
            ret += '</td>';
            ret += '<td>'+data_bhn.jumlah_bahan;
            ret += '<input type="hidden" id="jmlbhn_'+idx+'" class="form-control" name="jumlah_bahan[]" value="'+data_bhn.jumlah_bahan+'">';
            ret += '</td>';
            ret += '<td>'+data_bhn.satuan_bahan+'</td>';
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
        }
    </script>
