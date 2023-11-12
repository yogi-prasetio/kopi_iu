<?php
if(!empty($_POST['hapus'])){
    echo "clicked";
}
?>

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
            <div class="card mb-2">
                <div class="card-header pb-2 mb-2">
                    <span class="h6">Tambah Bahan</span>
                </div>
                <div class="card-body px-4 pb-3 pt-0">
                    <form method="post" action="<?= base_url('BOMController/Insert');?>">
                        <div class="form-group row">
                            <label for="nama_bom" class="col-sm-2 col-form-label">Nama BOM</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="nama_bom" id="nama_bom" placeholder="Nama BOM" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jumlah" class="col-sm-2 col-form-label">Harga</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="harga" id="harga" placeholder="Harga" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="LT" class="col-sm-2 col-form-label">Deskripsi</label>
                            <div class="input-group">
                                <textarea class="form-control" name="deskripsi"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <hr>
                        </div>
                        <div class="form-group row">
                            <label for="bahan" class="col-sm-2 col-form-label">Bahan</label>
                            <div class="col-sm-10">
                                <button type="button" class="btn btn-success btn_tambah" data-toggle="modal" data-target="#tambah_bahan">Tambah Bahan</button>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="bhn" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Bahan</th>
                                            <th>Jumlah</th>
                                            <th>Satuan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody_bahan">
                                        <?php
                                        $tmp_id = array(); $tmp_nama = array(); $tmp_qty = array(); $tmp_satuan = array();


                                        if(isset($_POST['jml_inp'])){
                                            // var_dump($_POST['name']);
                                            if(NULL !== $this->session->userdata('id_bahan')){
                                                $tmp_id = $this->session->userdata('id_bahan');
                                            }
                                            if(NULL !== $this->session->userdata('nama_bahan')){
                                                $tmp_nama = $this->session->userdata('nama_bahan');
                                            }
                                            if(NULL !== $this->session->userdata('qty_bahan')){
                                                $tmp_qty = $this->session->userdata('qty_bahan');
                                            }
                                            if(NULL !== $this->session->userdata('satuan_bahan')){
                                                $tmp_satuan = $this->session->userdata('satuan_bahan');
                                            }

                                            $tmp_id[] = $_POST['id_inp'];
                                            $tmp_nama[] = $_POST['nama_inp'];
                                            $tmp_qty[] = $_POST['jml_inp'];
                                            $tmp_satuan[] = $_POST['satuan_inp'];

                                            $this->session->set_userdata('id_bahan', $tmp_id);
                                            $this->session->set_userdata('nama_bahan', $tmp_nama);
                                            $this->session->set_userdata('qty_bahan', $tmp_qty);
                                            $this->session->set_userdata('satuan_bahan', $tmp_satuan);

                                            unset($tmp_id);
                                            unset($tmp_nama);
                                            unset($tmp_qty);
                                            unset($tmp_satuan);        
                                        }


                                        if(NULL !== $this->session->userdata('id_bahan')){
                                            $tmp_id = $this->session->userdata('id_bahan');
                                        }
                                        if(NULL !== $this->session->userdata('nama_bahan')){
                                            $tmp_nama = $this->session->userdata('nama_bahan');
                                        }
                                        if(NULL !== $this->session->userdata('qty_bahan')){
                                            $tmp_qty = $this->session->userdata('qty_bahan');
                                        }
                                        if(NULL !== $this->session->userdata('satuan_bahan')){
                                            $tmp_satuan = $this->session->userdata('satuan_bahan');
                                        }

                                        $data_bahan = array();

                                        // Cetak dengan cara uraikan isi arraynya
                                        for ($i=0; $i < count($tmp_nama); $i++) {
                                            echo "<form method='post'>";
                                            $bhn = array();
                                            ?>
                                            <tr id="b_<?= $tmp_id[$i] ?>">
                                                <td><?= 1+$i ?></td>
                                                <td><?= $tmp_nama[$i] ?></td>
                                                <td><?= $tmp_qty[$i] ?></td>
                                                <td><?= $tmp_satuan[$i] ?></td>
                                                <td>
                                                    <input type="hidden" name="idx" id="b_<?= $tmp_id[$i]?>" value="<?= $i?>">
                                                    <button type="submit" name="hapus" id="b_<?= $tmp_id[$i]?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>                                                   
                                            <?php
                                            array_push($bhn, $tmp_id[$i], $tmp_nama[$i], $tmp_qty[$i]);
                                            array_push($data_bahan, $bhn);
                                            unset($bhn);
                                            echo "</form>";
                                        }
                                        // echo json_encode($data_bahan);
                                        // var_dump($tmp_nama);
                                        // $arr = array(0 => 'Amidis Botol');
                                        // $dat = 
                                        var_dump($this->session->userdata('nama_bahan'));

                                        if(isset($_POST['hapus'])){
                                            // unset($data_bahan[0]);
                                            // unset($tmp_id[0]);
                                            // unset($tmp_nama[0]);
                                            // unset($tmp_qty[0]);
                                            // unset($tmp_satuan[0]);

                                            unset($data_bahan[$_POST['idx']]);
                                            unset($tmp_id[$_POST['idx']]);
                                            unset($tmp_nama[$_POST['idx']]);
                                            unset($tmp_qty[$_POST['idx']]);
                                            unset($tmp_satuan[$_POST['idx']]);

                                            $this->session->unset_userdata('nama_  bahan'[0]);
                                            // $this->session->unset_userdata('id_bahan')[$_POST['idx']];
                                            // $this->session->unset_userdata('nama_bahan')[$_POST['idx']];
                                            // $this->session->unset_userdata('qty_bahan')[$_POST['idx']];
                                            // $this->session->unset_userdata('satuan_bahan')[$_POST['idx']];

                                            // var_dump($_POST['idx']);
                                        }                                        

                                        // htmlspecialchars(json_encode($data_bahan));
                                        // die();
                                        echo "<input type='hidden' name='data_bahan' value='".json_encode($data_bahan)."'>";

                                        ?>
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data Bahan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Batal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" name="bahan_detail">
                        <input type="hidden" id="id_bahan_inp" name="id_inp">
                        <div class="form-group row">
                            <label for="nama_bahan" class="col-sm-2 col-form-label">Nama Bahan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="nama_inp" id="nama_bahan_inp" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jumlah_bahan" class="col-sm-2 col-form-label">Jumlah</label>
                            <div class="col-sm-10">
                                <div class="input-group mb-3">
                                    <input type="number" name="jml_inp" class="form-control" id="jumlah_bahan_inp" >
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="st-add-satuan"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="satuan_bahan_inp" name="satuan_inp">
                        <div class="form-group row">
                            <label for="jumlah_bahan" class="col-sm-2 col-form-label">Level</label>
                            <div class="col-sm-10">
                                <div class="input-group mb-3">
                                    <input type="number" min="1" step="1" name="level_inp" class="form-control" id="level_bahan_inp" value="1">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary btn_tambah_jumlah_bahan" onclick="document.forms.bahan_detail.submit()">Tambah Bahan</button>
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

    <script type="text/javascript">
        $(document).ready(function(){
            // $(".hapus_bahan").click(function() {
            //     var id = $(this).attr("data-id");
            //     alert(id);
            // });

            $(".pilih_bahan").click(function() {
                $("#tambah_bahan").modal('hide');

                var id = $(this).attr("data-id");
                var nama = $("#pl_"+id+">.nama").html();
                var satuan = $("#pl_"+id+">.satuan").html();

                $("#detail_bahan").modal("show");
                document.getElementById("id_bahan_inp").value = id;
                document.getElementById("nama_bahan_inp").value = nama;
                document.getElementById("satuan_bahan_inp").value = satuan;
                $("#st-add-satuan").append(satuan);

                // alert(id+" "+nama+" "+" "+satuan);
            });

            $('.close').click(function() {
                $('#detail_bahan').modal('hide');
                $('#tambah_bahan').modal('hide');
                $('#modalBahan').modal('hide');
            });
        });

        function hapus(id){
            document.getElementById('idBahan').value = id;
            alert(id);
        }
    </script>
