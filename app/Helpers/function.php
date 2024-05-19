<?php
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

function randString($length)
{
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $str = '';
    $size = strlen($chars);
    for ($i = 0; $i < $length; $i++) {
        $str .= $chars[rand(0, $size - 1)];
    }
    return $str;
}

/**
 * function Cut string
 *
 * @param    string $text
 * @return     string lenght $num
 */
function customDate($startDate, $endDate){

    Carbon::setLocale('vi'); // hiển thị ngôn ngữ tiếng việt.
    $fromDate = Carbon::parse($startDate);
    $toDate = Carbon::parse($endDate);

    return  $fromDate->diffForHumans($toDate); //12 phút trước
}

if ( ! function_exists('safeTitle')) {
    function safeTitle($str = '')
    {
        $str = html_entity_decode($str, ENT_QUOTES, "UTF-8");
        $filter_in = array('#(a|à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#', '#(A|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#', '#(e|è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#', '#(E|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#', '#(i|ì|í|ị|ỉ)#', '#(I|ĩ|Ì|Í|Ị|Ỉ|Ĩ)#', '#(o|ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#', '#(O|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#', '#(u|ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#', '#(U|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#', '#(y|ỳ|ý|ỵ|ỷ|ỹ)#', '#(Y|Ỳ|Ý|Ỵ|Ỷ|Ỹ)#', '#(d|đ)#', '#(D|Đ)#');
        $filter_out = array('a', 'A', 'e', 'E', 'i', 'I', 'o', 'O', 'u', 'U', 'y', 'Y', 'd', 'D');
        $text = preg_replace($filter_in, $filter_out, $str);
        $text = preg_replace('/[^a-zA-Z0-9]/', ' ', $text);
        $text = trim(preg_replace('/ /', '-', trim(strtolower($text))));
        $text = preg_replace('/--/', '-', $text);
        $text = preg_replace('/--/', '-', $text);
        return preg_replace('/--/', '-', $text);
    }
}

/**
 * @param string $stringDate
 * @return false|string
 */
if (!function_exists('formatDate')) {
    function formatDate(string $stringDate) {
        return date('Y-m-d', strtotime($stringDate));
    }
}

if (!function_exists('get_data_user')) {
    function get_data_user($type, $field = 'id')
    {
        return Auth::guard($type)->user() ? Auth::guard($type)->user()->$field : '';
    }
}


if (!function_exists('get_info_user'))
{
    function get_info_user($type, $field = 'id')
    {
        return Auth::guard($type)->user() ? Auth::guard($type)->user()->$field : '';
    }
}

if (!function_exists('upload_image')) {
    /**
     * @param $file [tên file trùng tên input]
     * @param array $extend [ định dạng file có thể upload được]
     * @return array|int [ tham số trả về là 1 mảng - nếu lỗi trả về int ]
     */
    function upload_image($file, $folder = '', array $extend = array())
    {
        $code = 1;
        // lay duong dan anh
        $baseFilename = public_path() . '/uploads/' . $_FILES[$file]['name'];

        // thong tin file
        $info = new SplFileInfo($baseFilename);

        // duoi file
        $ext = strtolower($info->getExtension());

        // kiem tra dinh dang file
        if (!$extend)
            $extend = ['png', 'jpg', 'jpeg', 'webp'];

        if (!in_array($ext, $extend))
            return $data['code'] = 0;

        // Tên file mới
        $nameFile = trim(str_replace('.' . $ext, '', md5($info->getFilename())));
        $filename = date('Y-m-d__') . \Illuminate\Support\Str::slug($nameFile) . '.' . $ext;;

        // thu muc goc de upload
        $path = public_path() . '/uploads/' . date('Y/m/d/');
        if ($folder)
            $path = public_path() . '/uploads/' . $folder . '/' . date('Y/m/d/');

        if (!File::exists($path))
            mkdir($path, 0777, true);

        // di chuyen file vao thu muc uploads
        move_uploaded_file($_FILES[$file]['tmp_name'], $path . $filename);

        $data = [
            'name'     => $filename,
            'code'     => $code,
            'path'     => $path,
            'path_img' => 'uploads/' . $filename
        ];

        return $data;
    }
}

if (!function_exists('pare_url_file')) {
    function pare_url_file($image, $folder = '')
    {
        if (!$image) {
            return 'page/img/teachers/teacher-01.png';
        }
        $explode = explode('__', $image);

        if (isset($explode[0])) {
            $time = str_replace('_', '/', $explode[0]);
            return '/uploads' . $folder . '/' . date('Y/m/d', strtotime($time)) . '/' . $image;
        }
    }
}

/**
 * function Cut string
 *
 * @param    string $text
 * @return     string lenght $num
 */
function the_excerpt($text ,$num){

    if(strlen($text)> $num){

        $cutstring = substr($text,0,$num);
        $word = substr($text,0,strrpos($cutstring,' '));
        return $word. ' ...';

    }
    else{
        return $text;
    }

}

function convertDatetimeLocal($value)
{
    return Carbon::parse($value)->format('Y-m-d\TH:i');
}

function diffTimeRun($startTime, $endTime)
{
     return Carbon::parse($endTime)->diffInMinutes($startTime);
}

if ( ! function_exists('getDateTime')) {

    function getDateTime($language = "vn", $getDay = 1, $getDate = 1, $getTime = 1, $timeZone = "GMT+7", $intTimestamp = "")
    {
        if ($intTimestamp != "") {
            $today = getdate($intTimestamp);
            $day = $today["wday"];
            $date = date("Y-m-d", $intTimestamp);
            $time = date("H:i", $intTimestamp);
        } else {
            $today = getdate();
            $day = $today["wday"];
            $date = date("Y-m-d");
            $time = date("H:i");
        }
        switch ($language) {
            case "vn":
                $dayArray = array("Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy");
                break;
            case "en":
                $dayArray = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
                break;
            case "jp":
                $dayArray = array("日曜日", "月曜日", "火曜日", "水曜日", "木曜日", "金曜日", "土曜日");
                break;
            default :
                $dayArray = array("日曜日", "月曜日", "火曜日", "水曜日", "木曜日", "金曜日", "土曜日");
                break;
        }
        $strDateTime = "";
        for ($i = 0; $i <= 6; $i++) {
            if ($i == $day) {
                if ($getDate != 0) $strDateTime .= $date . "(";
                if ($getDay != 0) $strDateTime .= $dayArray[$i] . ")";
                if ($getTime != 0) $strDateTime .= $time . "";
                //$strDateTime .= $timeZone;
                if (substr($strDateTime, -2, 2) == ", ") $strDateTime = substr($strDateTime, 0, -2);

                return $strDateTime;
            }
        }
    }
}



/**
 * @param int $is_number
 * @param int $length
 * @return int|string
 * @throws Exception
 */
function generateRandomString($is_number = 1, $length = 6)
{
    if ($is_number == 1) {
        $value = (microtime(true) * 10000) + random_int(0, 999);
        return strval($value);
    } else {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}


function geSeat($codeSeat, $numberSeat)
{
    return $codeSeat . $numberSeat;
}