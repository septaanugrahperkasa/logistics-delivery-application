<?php
if (isset($_POST['data'])) {
    $data = json_decode($_POST['data'], true);
    file_put_contents('rider.json', json_encode($data));
    echo 'Data berhasil disimpan';
} else {
    echo 'Data tidak ditemukan';
}
