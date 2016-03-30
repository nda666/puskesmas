<?php
/**
 * Get kepesertaan pasien
 * @param  integer $id      [Kode pada selection]
 * @return string  [Lembaga kepesertaan]
 */
function kepesertaan(integer $id)
{
    switch ($id) {
        case 1:
            return 'Umum & BPJS';
            break;
        case 2:
            return 'AKSESOS';
            break;
        case 3:
            return 'AKSESIN';
            break;
        case 4:
            return 'AKSES';
            break;
        case 5:
            return 'BUMIL';
            break;
        case 6:
            return 'ASPRAS';
            break;
        default:
            return '';
    }
}

/**
 * @param $operator
 * @param $value_filter
 * @return mixed
 */
function helper_filter($operator = '', $value_filter = '')
{
    switch ($operator) {
        case '%{o}%':
            return '%' . $value_filter . '%';
            break;
        case '{o}%':
            return $value_filter . '%';
            break;
        case '%{o}':
            return '%' . $value_filter;
            break;
        case '=':
            return $value_filter;
        default:
            return $operator . $value_filter;
            break;
    }
}

/**
 * @param $tgl_lahir
 * @return mixed
 */
function get_umur($tgl_lahir)
{
    $tgl_lahir = new \DateTime($tgl_lahir);
    $diff = new \DateTime('today');
    $res_diff = $tgl_lahir->diff($diff);
    $umur = '';
    if ($tgl_lahir > $diff) {
        return '';
    }
    if ($res_diff->y >= 1) {
        $umur = $res_diff->y . ' Tahun';
    } else if ($res_diff->m >= 1) {
        $umur = $res_diff->m . ' Bulan';
    } else if ($res_diff->d >= 1) {
        $umur = $res_diff->d . ' Hari';
    } else {
        $umur = '1 Hari';
    }
    return $umur;
}
